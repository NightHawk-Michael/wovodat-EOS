<?php
class NetworkEvent{
	public $attrs = array();
	public $tags = array();
	public function __construct($owner1, $owner2, $owner3, $station, $refStation1, $refStation2, $instrument, $source){
		$this->attrs = array('code'=>'', 'instrument'=>$instrument, 'owner1'=>$owner1, 'owner2'=>$owner2,'owner3'=>$owner3,
			'pubDate'=>'', 'refStation1'=>$refStation1, 'refStation2'=>$refStation2, 'station'=>$station);
		$this->tags = array('measTime'=>'', 'lat'=>'', 'lon'=>'', 'elev'=>'', 'N-SErr'=>'', 'E-WErr'=>'', 'verticalErr'=>'',
			'software'=>'', 'orgDigitize'=>'O', 'comments'=>'');

		$this->source = $source;
		$tmp = explode(',', $source);
		$this->set_time_and_code($tmp[2], $station, $refStation1);		
		$this->set_lat($tmp[3]);
		$this->set_lon($tmp[4]);
		$this->set_elev($tmp[5]);
		$this->set_NS_error($tmp[6]);
		$this->set_EW_error($tmp[7]);
		$this->set_verticalErr($tmp[8]);
		$this->set_software($tmp[11]);
		$this->set_comments($tmp[13]);
	}

	public function set_time_and_code($time, $station, $refStation1) {
		$date = new DateTime($time);
		$this->tags['measTime'] = $date->format("Y-m-d H:i:s");
		$this->attrs['code'] = 'dd_gps_'. substr($station, 0, 14) . '_' . $date->format("Ymd");
		$date->add(new DateInterval("P7D"));
		$this->attrs['pubDate'] = $date->format("Y-m-d H:i:s");
	}

	public function set_lat($lat) {
		$this->tags['lat'] = $lat;
	}

	public function set_lon($lon) {
		$this->tags['lon'] = $lon;
	}

	public function set_elev($elev) {
		$this->tags['elev'] = $elev;
	}

	public function set_NS_error($NS_error) {
		$this->tags['N-SErr'] = $NS_error;
	}

	public function set_EW_error($EW_error) {
		$this->tags['E-WErr'] = $EW_error;
	}

	public function set_verticalErr($verticalErr) {
		$this->tags['verticalErr'] = $verticalErr;
	}	

	public function set_software($software) {
		$this->tags['software'] = $software;
	}

	public function set_comments($interval) {
		$this->tags['comments'] = 'Interval data sampling = '. $interval;
	}

	public function getCode() {
		return $this->attrs['code'];
	}

	public function toXml(){
		$result = "<GPS";
		$attr_names = array_keys($this->attrs);	
		foreach ($attr_names as $attr_name) if ($this->attrs[$attr_name] !=='') {
			$result = $result . " $attr_name=\"" . $this->attrs[$attr_name] . "\"";
		}
		$result = $result.">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if ($this->tags[$tag_name] !=='') {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result . "</GPS>\r\n";
		return $result;
	}
}
?>
