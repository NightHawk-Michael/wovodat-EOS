<?php
class NetworkEvent{
	public $attrs = array();
	public $tags = array();
	public $tokens = array();
	public function __construct($raw){
		$this->attrs = array('code'=>'', 'network'=>'NCDC_ANSS_Seisnet_Hawaii', 'owner1'=>'NCDC','owner2'=>'ANSS','owner3'=>'USGS','pubDate'=>'2013-01-01 00:00:00');
		$this->tags = array('seismoArchive'=>'','originTime'=>'','originTimeCsec'=>'', 'locaTechnique'=>'',
			'picksDetermination'=>'','lat'=>'','lon'=>'','depth'=>'','fixedDepth'=>'','numberOfStations'=>'',
			'largestAzimuthGap'=>'','distClosestStation'=>'','travelTimeRMS'=>'','primMagnitude'=>'', 'primMagnitudeType'=>'',
			'orgDigitize'=>'','comments'=>'');
		$this->raw =$raw;
		$this->setTimeAndCode();
		$this->setCode();
		$this->tags['seismoArchive'] = "NCDC";
		$this->tags['locaTechnique'] = "Hypoinverse2000 location program";
		$this->tags['picksDetermination'] = 'H';
		$this->setLat();
		$this->setLon();
		$this->setDepth();
		$this->tags['fixedDepth'] = 'N';
		$this->setNumberOfStations();
		$this->setlargestAzimuthGap();
		$this->setDistClosestStation();
		$this->setTravelTimeRMS();
		$this->setPrimMagnitude();
		$this->tags['orgDigitize'] = 'O';
		$this->setComments();
	}
	public function setLat() {
		$subst = trim(substr($this->raw, 22, 9));
		if ($subst === '') return;
		$this->tags['lat'] = doubleval($subst);
	}

	public function setLon() {
		$subst = trim(substr($this->raw, 31, 10));
		if ($subst === '') return;
		$this->tags['lon'] = doubleval($subst);		
	}

	public function setDepth() {
		$subst = trim(substr($this->raw, 41, 7));
		if ($subst === '') return;
		$this->tags['depth'] = doubleval($subst);		
	}

	public function setNumberOfStations() {
		$subst = trim(substr($this->raw, 59, 5));
		if ($subst === '') return;
		$this->tags['numberOfStations'] = intval($subst);				
	}

	public function setlargestAzimuthGap() {
		$subst = trim(substr($this->raw, 64, 4));
		if ($subst === '') return;
		$this->tags['largestAzimuthGap'] = doubleval($subst);				
	}

	public function setDistClosestStation() {
		$subst = trim(substr($this->raw, 68, 5));
		if ($subst === '') return;
		$this->tags['distClosestStation'] = intval($subst);				
	}

	public function setTravelTimeRMS() {
		$subst = trim(substr($this->raw, 73, 5));
		if ($subst === '') return;
		$this->tags['travelTimeRMS'] = doubleval($subst);						
	}

	public function setPrimMagnitude() {
		$subst = trim(substr($this->raw, 48, 6));
		if ($subst === '') return;
		$this->tags['primMagnitude'] = doubleval($subst);								
		$subst = strtoupper(trim(substr($this->raw, 54, 5)));
		if ($subst === '') return;
		$value = '';
		switch ($subst) {
			case 'ML': 
			case 'MLM':
			case 'MLT':
			case 'MLN':
			case 'MLB':
			case 'MX':
				$value = 'ML';
				break;
			case 'MD':
				$value = 'Md';
				break;
			case 'MW':
				$value = 'Mw';
		}
		$this->tags['primMagnitudeType'] = $value;														
	}

	public function setComments() {
		$subst = trim(substr($this->raw, 78, 4));
		if ($subst === '') return;
		$this->tags['comments'] = 'Source of data: '. $subst;								
	}

	public function setTimeAndCode(){
		$measTime = substr($this->raw, 0, 22);
		$year = substr($measTime, 0, 4);
		$month = substr($measTime, 5, 2);
		$day = substr($measTime, 8, 2);
		$hour = substr($measTime, 11, 2);
		$min = substr($measTime, 14, 2);
		$sec = substr($measTime, 17, 2);
		$msec = substr($measTime, 20, 2);
		$measTime = new DateTime("$year-$month-$day");
		$measTime->setTime($hour,$min,$sec);
		$this->tags['originTime'] = $measTime->format("Y-m-d H:i:s");
		$this->attrs['code'] = 'ANSS_' . $measTime->format("YmdHis") . $msec;
		$this->tags['originTimeCsec'] = '0.' . $msec;
		$measTime->add(new DateInterval('P7D'));
		$this->attrs['pubDate'] = $measTime->format("Y-m-d H:i:s");
	}

	public function setCode(){
		$originTime = new DateTime($this->tags['originTime']);
		$this->attrs['code'] = "ANSS_" . $originTime->format("YmdHis");
	}
	public function getCode(){
		return $this->attrs['code'];
	}

	public function toXml(){
		$result = "<NetworkEvent";
		$attr_names = array_keys($this->attrs);	
		foreach ($attr_names as $attr_name){
			$result = $result . " $attr_name=\"" . $this->attrs[$attr_name] . "\"";
		}
		$result = $result.">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if ($this->tags[$tag_name] !== '') {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result . "</NetworkEvent>\r\n";
		return $result;
	}
}
?>