<?php
class NetworkEvent{
	public $attrs = array();
	public $tags = array();
	public $tokens = array();
	public function __construct($owner1, $owner2, $owner3, $station, $network, $code, $tmpTime, $earthquake_type, $cnt){
		$this->attrs = array('code'=>'', 'network'=>$network, 'owner1'=>$owner1,'owner2'=>$owner2,'owner3'=>$owner3,'pubDate'=>'','station'=>$station);
		$this->tags = array('earthquakeType'=>'', 'startTime'=>'', 'endTime'=>'', 'dataType'=>'', 'picksDetermination'=>'',
			'numbOfRecEq'=>'', 'description'=>'', 'orgDigitize'=>'', 'comments'=>'');
		$time = new DateTime($tmpTime->format("Y-m-d"));
		$this->tags['earthquakeType'] = $earthquake_type;
		$this->attrs['code'] = $code . '_sd_ivl_' . $time->format("Ymd") . '_' . $earthquake_type;
		$this->tags['startTime'] = $time->format("Y-m-d H:i:s");
		$time->setTime(23, 59, 59);
		$this->tags['endTime'] = $time->format("Y-m-d H:i:s");
		$time->setTime(0, 0, 0);
		$time->add(new DateInterval('P7D'));		
		$this->attrs['pubDate'] = $time->format("Y-m-d H:i:s");
		$this->tags['dataType'] = 'H';
		$this->tags['picksDetermination'] = 'H';
		$this->tags['numbOfRecEq'] = $cnt;
		$this->tags['description'] = 'daily earthquake counts based on ';
		if ($station) $this->tags['description'].= 'single station';
		else $this->tags['description'].= 'network';
		$this->tags['orgDigitize'] = 'O';
		$this->tags['comments'] = 'counting method and pick based on drum-plot/helicorder';	
	}

	public function getCode() {
		return $this->attrs['code'];
	}

	public function toXml(){
		$result = "<Interval";
		$attr_names = array_keys($this->attrs);	
		foreach ($attr_names as $attr_name) if ($this->attrs[$attr_name]) {
			$result = $result . " $attr_name=\"" . $this->attrs[$attr_name] . "\"";
		}
		$result = $result.">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if ($this->tags[$tag_name]) {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result . "</Interval>\r\n";
		return $result;
	}
}
?>
