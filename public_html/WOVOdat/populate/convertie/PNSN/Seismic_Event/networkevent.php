<?php
class NetworkEvent{
	public $tags = Array();
	public $attributes = Array();
	public $source;
	public function __construct($source){
		$this->attributes = array('code'=>'', 'network'=>'PNSN_Seisnet', 'owner1'=>'PNSN', 'owner2'=>'IRIS', 'owner3'=>'USGS',
			'pubDate'=>'');
		$this->tags = array('seismoArchive'=>'IRIS','originTime'=>'', 'originTimeCsec'=>'',
							'locaTechnique'=>'SPONG(adaptation of FASTHYPO and TRVDRV)', 
							'picksDetermination'=>'H', 
							'lat'=>'','lon'=>'','depth'=>'','fixedDepth'=>'', 'numberOfStations'=>'', 'numberOfPhases'=>'', 
							'largestAzimuthGap'=>'', 'distClosestStation'=>'', 'travelTimeRMS'=>'', 
							'horizLocaErr'=>'', 'locaQuality'=>'','primMagnitude'=>'','primMagnitudeType'=>'',
							'earthquakeType'=>'', 'orgDigitize'=>'O', 'comments'=>'');
		$this->source = $source;
		$this->setDateTimeAndCode();
		$this->setLat();
		$this->setLon();
		$this->setDepth();
		$this->setNumberOfStations();
		$this->setNumberOfPhases();
		$this->setLargestAzimuthGap();
		$this->setDistClosestStation();
		$this->setTravelTimeRMS();
		$this->setHorizLocaErr();
		$this->setLocaQuality();
		$this->setPrimMagnitude();		
		$this->setEarthquakeType();
		$this->setComments();
	}

	public function setDateTimeAndCode(){
		$year = substr($this->source,2,4);
		$month = substr($this->source,6,2);
		$day = substr($this->source,8,2);
		$hour = intval(substr($this->source,10,2));
		$min = intval(substr($this->source,12,2));
		$sec_str = substr($this->source, 14, 3);
		$sec_str = trim($sec_str);
		$sec = doubleval(substr($this->source, 14,3));
		$mili = substr($this->source, 18,2);
		$day = new DateTime("$year-$month-$day");
		$day->setTime($hour, $min, 0);
		
		if ($sec_str[0] != '-') {
			$day->add(new DateInterval("PT".$sec."S"));
		} else {
			if ($mili == 0) $day->sub(new DateInterval("PT".(-$sec)."S"));
			else {
				$day->sub(new DateInterval("PT".(-$sec + 1)."S"));
				$mili = 100 - $mili;
			}
		}
		$this->tags['originTime'] = $day->format("Y-m-d H:i:s");
		$this->tags['originTimeCsec'] = '0.' . $mili;
		$this->attributes['code'] = 'PNSN_' . $day->format("YmdHis") . $mili;
		$day->add(new DateInterval('P7D'));
		$this->attributes['pubDate'] = $day->format("Y-m-d H:i:s");
	}

	public function getCode() {
		return $this->attributes['code'];
	}

	public function setLat(){
		$degree = intval(substr($this->source, 20, 3));
		$minute = intval(substr($this->source, 24, 4));
		if (substr($this->source, 23, 1) === 'N'){
			$value = $degree+$minute/6000;
		}
		else
			$value = -($degree+$minute/6000);
		$this->tags['lat'] = number_format($value,5);
	}

	public function setLon(){
		$degree = intval(substr($this->source, 28, 4));
		$minute = intval(substr($this->source, 33, 4));
		if (substr($this->source, 32, 1) === 'E'){
			$value = $degree+$minute/6000;
		}
		else
			$value = -($degree+$minute/6000);
		$this->tags['lon'] = number_format($value,5);
	}

	public function setDepth(){
		$subst = substr($this->source, 37, 6);
		if (trim($subst) === '') return;
		$value = doubleval($subst);
		$this->tags['depth'] = $value;

		$type = substr($this->source, 43, 1);
		if ($type==='*' or $type==='#' or $type==='$')
			$this->tags["fixedDepth"] = "Y";
		else
			$this->tags["fixedDepth"] = "N";		
	}

	public function setNumberOfStations(){
		$value = intval(substr($this->source, 48, 3));
		$this->tags["numberOfStations"] = $value;
	}

	public function setNumberOfPhases(){
		$value = intval(substr($this->source, 52, 3));
		$this->tags["numberOfPhases"] = $value;
	}

	public function setLargestAzimuthGap(){
		$value = intval(substr($this->source, 55, 4));
		$this->tags["largestAzimuthGap"] = $value;
	}

	public function setDistClosestStation(){
		$value = intval(substr($this->source, 59, 3));
		$this->tags["distClosestStation"] = $value;
	}
	public function setTravelTimeRMS(){
		$value = doubleval(substr($this->source, 62, 5));
		$this->tags["travelTimeRMS"] = $value;
	}
	public function setHorizLocaErr(){
		$value = doubleval(substr($this->source, 67, 5));
		$this->tags["horizLocaErr"] = $value;
	}
	public function setLocaQuality(){
		$loca1 = substr($this->source, 72, 1);
		$loca2 = substr($this->source, 73, 1);
		if ($loca1!=='' and $loca2!=='')
			$this->tags["locaQuality"] = "residual travel time quality = $loca1; spatial coverage of station quality = $loca2";
	}
	public function setPrimMagnitude(){
		$subst = substr($this->source, 44, 4);
		if (trim($subst) === '') return;
		$value = doubleval($subst);
		$this->tags["primMagnitude"] = $value;
		$this->tags['primMagnitudeType'] = 'Mc';
	}

	public function setEarthquakeType() {
		$type = substr($this->source, 1, 1);
		$value = '';
		if ($type == 'P') $value = 'Q';
		if ($type == 'L') $value = 'LF';
		if ($type == 'X') $value = 'Q';
		if ($type == 'R') $value = 'R';
		if ($type == 'T') $value = 'R';
		$this->tags["earthquakeType"] = $value;								
	}

	public function setComments() {
		$subst = trim(substr($this->source, 74, 3));
		if ($subst === '') return;
		$value = 'vel-model = ' . $subst;
		if ($subst === 'P3') $value .= '(Puget Sound model)';
		if ($subst === 'C3') $value .= '(Cascade model)';
		if ($subst === 'S3') $value .= '(Mt. St. Helens model including Elk Lake)';
		if ($subst === 'N3') $value .= '(Northeastern model)';
		if ($subst === 'E3') $value .= '(Southeastern model)';
		if ($subst === 'O0') $value .= '(Oregon model)';
		if ($subst === 'J1') $value .= '(Offshore model)';
		$this->tags['comments'] = $value;
	}

	public function toXml(){
		$result = "<NetworkEvent";
		$attr_names = array_keys($this->attributes);	
		foreach ($attr_names as $attr_name){
			$result .= " $attr_name=\"" . $this->attributes[$attr_name] . '"';
		}
		$result .= ">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if ($this->tags[$tag_name] !== '') {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result. "</NetworkEvent>\r\n";
		return $result;
	}
}
?>
