<?php 
class NetworkEvent {
	private $attrs = array();
	private $tags = array();
	public function __construct($owner1, $owner2, $owner3, $volcanol, $ds_code1, $ds_code2, $instrument, $year, $month, $day, $slope){
		//echo "<script>console.log('day=".$day."')</script>";
		$this->attrs = array(
			'code'=>'Gg_'. substr($volcanol, 0, min(6, strlen($volcanol) ) ) .'_'. substr($ds_code1, 0, min(5, strlen($ds_code1) ) ). '_'.substr($ds_code2, 0, min(5, strlen($ds_code2) ) ).'_' .$this->GetDate($year,$month,$day), 
			'instrument'=>$instrument, 
			'owner1'=>$owner1, 
			'owner2'=>$owner2,
			'owner3'=>$owner3,
			'pubDate'=>$this->Get_pubDate($year,$month,$day),
			'refStation1'=>$ds_code2,
			'station'=>$ds_code1
			);
		//echo "<script>console.log('day2=".$day."')</script>";
		$this->tags = array(
			'measTime'=>$this->Get_measTime($year,$month,$day),
			'slope'=>$slope, 
			'orgDigitize'=>'O', 
			'comments'=>'Slanting distance between observing points using GPS. Average one day value in meters.'
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
		$res.= "    <GPS";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= " ".$key."=\"".$value."\"";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </GPS>\n";
		return $res;
	}
}
?>