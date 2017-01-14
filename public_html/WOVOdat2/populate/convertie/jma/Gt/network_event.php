<?php 
class NetworkEvent {
	private $attrs = array();
	private $tags = array();
	public function __construct($owner1, $owner2, $owner3, $volcanol, $station, $station_code, $instrument, $year, $month, $day, $tilt1, $tilt2){
		//echo "<script>console.log('day=".$day."')</script>";
		$this->attrs = array(
			'code'=>'Gt_'. substr($volcanol, 0, min(10, strlen($volcanol) ) ) .'_'. substr($station_code, 0, min(7, strlen($station_code) ) ). '_'. $this->GetDate($year,$month,$day), 
			'instrument'=>$instrument, 
			'owner1'=>$owner1, 
			'owner2'=>$owner2,
			'owner3'=>$owner3,
			'pubDate'=>$this->Get_pubDate($year,$month,$day),
			'station'=>$station_code
			);
		//echo "<script>console.log('day2=".$day."')</script>";
		$this->tags = array(
			'measTime'=>$this->Get_measTime($year,$month,$day),
			'sampleRate'=>86400, 
			'tilt1'=>trim($tilt1),
			'tilt2'=>trim($tilt2),
			'processed'=>'P', 
			'orgDigitize'=>'O', 
			'comments'=>"Average of 24 hourly data (South-upward:+ West-upward:+),source: The Seismol. &amp; Volcanol. Bull. Of Japan"
			);
	}
	private function GetDate($year,$month,$day) {
		$date = date_create($year.'-'.$month.'-'.$day);
		return date_format($date,"Ymd");
	}
	private function Get_pubDate ($year,$month,$day) {
		$date = date_create($year.'-'.$month.'-'.$day);
		date_add($date,date_interval_create_from_date_string("7 days"));
		return date_format($date,"Y-m-d").' 00:00:00';
	} 
	private function Get_measTime ($year,$month,$day) {
		$date = date_create($year.'-'.$month.'-'.$day);
		return date_format($date,"Y-m-d").' 12:00:00';
	} 
	public function Take_pubDate () {
		return $attrs['pubDate'];
	}
	public function ToXml() {
		$res = "";
		$res.= "    <ElectronicTilt ";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= $key."=\"".$value."\" ";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </ElectronicTilt>\n";
		return $res;
	}
}
?>