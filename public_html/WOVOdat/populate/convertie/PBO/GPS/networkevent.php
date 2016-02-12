<?php
class NetworkEvent{
	public $attrs = array();
	public $tags = array();
	public function __construct($owner1, $owner2, $owner3, $station, $source, $lastTime){
		$this->attrs = array('code'=>'', 'instrument'=>'', 'owner1'=>$owner1, 'owner2'=>$owner2,'owner3'=>$owner3, 
			'pubDate'=>'', 'station'=>$station);
		$this->tags = array('startTime'=>'', 'endTime'=>'', 'northDispl'=>'', 'eastDispl'=>'', 'vertDispl'=>'', 
			'northDisplErr'=>'','eastDisplErr'=>'', 'vertDisplErr' => '', 'refFrame' => '', 'projection' => '', 
			'ellipsoid' => '', 'datum'=> '', 'refPosLat'=>'','refPosLon'=>'', 'refPosElev'=>'', 'staVelNorth'=>'',
			'staVelNorthErr'=>'', 'staVelEast'=>'', 'staVelEastErr'=>'', 'staVelVert'=>'', 'staVelVertErr'=>'', 
			'gpvDataType'=>'detrended data', 'gpvArchive'=>'PBO-UNAVCO', 'gpvSoftware' => '', 'orgDigitize'=>'O', 'comments'=>'',
			);
		$this->valid = false;
		
		$this->source = $source;
		$tmp = explode(',', $source);
		$date = new DateTime($tmp[0]);
		
		if ($date <= $lastTime) {
			//remove the comment before return statement when want to take the time after latest date
			return;
		}				
		$this->set_time($tmp[0]);		
		$this->set_northDispl($tmp[2]);
		$this->set_eastDispl($tmp[4]);	
		$this->set_vertDispl($tmp[6]);

		$this->set_northDisplErr($tmp[3]);
		$this->set_eastDisplErr($tmp[5]);
		$this->set_vertDisplErr($tmp[7]);
		$this->set_comments($tmp[8]);
		$this->valid = true;
	}

	public function setAttribute($refFrame, $projection, $ellipsoid, $datum, $refPosLat, $refPosLon,
								$refPosElev, $staVelNorth, $staVelNorthErr, $staVelEast, $staVelEastErr,
								$staVelVert, $staVelVertErr, $software, $stationStime) {
		$this->tags['refFrame'] = $refFrame;
		$this->tags['projection'] = $projection;
		$this->tags['ellipsoid'] = $ellipsoid;
		$this->tags['datum'] = $datum;
		$this->tags['refPosLat'] = $refPosLat;
		$this->tags['refPosLon'] = $refPosLon;
		$this->tags['refPosElev'] = $refPosElev;
		$this->tags['staVelNorth'] = $staVelNorth;
		$this->tags['staVelNorthErr'] = $staVelNorthErr;
		$this->tags['staVelEast'] = $staVelEast;
		$this->tags['staVelEastErr'] = $staVelEastErr;
		$this->tags['staVelVert'] = $staVelVert;
		$this->tags['staVelVertErr'] = $staVelVertErr;
		$this->tags['gpvSoftware'] = $software;
	}
	
	public function valid() {
		return $this->valid;
	}
	
	public function getTime() {
		return new DateTime($this->tags['startTime']);
	}

	public function getEndTime() {
		return new DateTime($this->tags['endTime']);
	}

	public function set_time($time) {
		$starting_time = new DateTime($time);
		$ending_time = clone $starting_time;
		$ending_time->setTime(23, 59, 59);
		$this->tags['startTime'] = $starting_time->format("Y-m-d H:i:s");
		$this->tags['endTime'] = $ending_time->format("Y-m-d H:i:s");
		$starting_time->add(new DateInterval("P7D"));
		$this->attrs['pubDate'] = $starting_time->format("Y-m-d H:i:s");
	}

	public function setInstrument($instrument) {
		$instrument = trim($instrument);
		$this->attrs['instrument'] = $instrument;
		$this->attrs['code'] = 'PBO_'. substr($instrument, 0, 17) . '_' . $this->getTime()->format('Ymd');
	}

	public function set_northDispl($data) {
		$this->tags['northDispl'] = $data;
	}

	public function set_eastDispl($data) {
		$this->tags['eastDispl'] = $data;
	}

	public function set_vertDispl($data) {
		$this->tags['vertDispl'] = $data;
	}
	
	public function set_magnitudeErr($data) {
		$this->tags['magnitudeErr'] = $data;
	}

	public function set_northDisplErr($data) {
		$this->tags['northDisplErr'] = $data;
	}

	public function set_eastDisplErr($data) {
		$this->tags['eastDisplErr'] = $data;
	}

	public function set_vertDisplErr($data) {
		$this->tags['vertDisplErr'] = $data;
	}	

	public function set_comments($quality) {
		$this->tags['comments'] = 'Detrended data (Reference frame SNARF 1.0) Quality = '. $quality;
	}

	public function getCode() {
		return $this->attrs['code'];
	}

	public function toXml(){
		$result = "<GPSVector";
		$attr_names = array_keys($this->attrs);	
		foreach ($attr_names as $attr_name) if (isset($this->attrs[$attr_name]) && $this->attrs[$attr_name] !=='') {
			$result = $result . " $attr_name=\"" . $this->attrs[$attr_name] . "\"";
		}
		$result = $result.">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if (isset($this->tags[$tag_name]) && $this->tags[$tag_name] !=='') {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result . "</GPSVector>\r\n";
		return $result;
	}
}
?>
