<?php
class NetworkEvent{
	public $attrs = array();
	public $tags = array();
	public function __construct($owner1, $owner2, $owner3, $station, $instrument, $process_type, $source, $counting_interval){
		$this->attrs = array('code'=>'', 'instrument'=>$instrument, 'owner1'=>$owner1, 'owner2'=>$owner2,'owner3'=>$owner3,'pubDate'=>'','station'=>$station);
		$this->tags = array('measTime'=>'', 'measTimeCsec'=>'', 'sampleRate'=>'', 'tilt1'=>'', 'tilt2'=>'',
			'processed'=>$process_type, 'temperature'=>'', 'orgDigitize'=>'O', 'comments'=>'');

		$this->source = $source;
		$this->set_time_and_code();		
		$this->tags['sampleRate'] = $counting_interval/100;		
		$this->set_features();
		$this->set_comments($counting_interval);
	}

	public function set_time_and_code() {
		$line = $this->source;
		$date = new DateTime(substr($line, 0, 10));
		$hour = intval(substr($line, 11, 2));
		$minute = intval(substr($line, 14, 2));
		$second = intval(substr($line, 17, 2));
		if ($line[19] == '.') {
			$pos = strpos($line, ',');
			$milli = substr($line, 20, $pos - 20);
		} else $milli = '00';
		$date->setTime($hour, $minute, $second);
		$this->tags['measTime'] = $date->format("Y-m-d H:i:s");
		$this->tags['measTimeCsec'] = intval($milli)/100;
		$this->attrs['code'] = 'dd_tlt_'. $process_type. $station. $date->format("YmdHis") . $milli;
		$date->add(new DateInterval("P7D"));
		$this->attrs['pubDate'] = $date->format("Y-m-d H:i:s");
	}

	public function set_features() {
		$pos = strpos($this->source, ',');
		$remain = substr($this->source, $pos + 1);
		$pos = strpos($remain, ',');
		$st = trim(substr($remain, 0, $pos));
		$this->tags['tilt1'] = doubleval($st);

		$remain = substr($remain, $pos + 1);
		$pos = strpos($remain, ',');
		$st = trim(substr($remain, 0, $pos));
		$this->tags['tilt2'] = doubleval($st);

		$remain = trim(substr($remain, $pos + 1));
		$this->tags['temperature'] = doubleval($remain);
	}

	public function get_string($x, $s) {
		$res = ' ' . $x . ' ' . $s;
		if ($x > 1) $res .= 's';
		return $res;
	}

	public function time_to_string($step) {
		$result = "";
		$hour = floor($step/360000);
		if ($hour) $result .= $this->get_string($hour, "hour");

		$step %= 360000;
		$minute = floor($step/6000);
		if ($minute) $result .= $this->get_string($minute, "minute");

		$step %= 6000;
		$second = $step/100;
		if ($step) $result .= $this->get_string($second, "second");
		return trim($result);
	}

	public function set_comments($time) {
		$this->tags['comments'] = $this->time_to_string($time).' interval tilt';
	}

	public function getCode() {
		return $this->attrs['code'];
	}

	public function toXml(){
		$result = "<ElectronicTilt";
		$attr_names = array_keys($this->attrs);	
		foreach ($attr_names as $attr_name) if ($this->attrs[$attr_name] !=='') {
			$result = $result . " $attr_name=\"" . $this->attrs[$attr_name] . "\"";
		}
		$result = $result.">\r\n";
		$tag_names = array_keys($this->tags);
		foreach ($tag_names as $tag_name) if ($this->tags[$tag_name] !=='') {
			$result .= "<$tag_name>" . $this->tags[$tag_name] . "</$tag_name>\r\n";
		}
		$result = $result . "</ElectronicTilt>\r\n";
		return $result;
	}
}
?>
