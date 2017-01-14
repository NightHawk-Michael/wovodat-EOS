<?php 
class NetworkEvent {
	private $eqtype = array(
			'A'=>'VT',
			'B'=>'LF',
			'BH'=>'H',
			'BL'=>'LF',
			'BP'=>'LF_T',
			'BT'=>'LF_T',
			'BS'=>'U',
			'Ex'=>'E',
			'DL'=>'VT_D',
			''=>'X',
			'Air'=>'X',
			'Pyr'=>'U'
		);

	private $attrs = array();
	private $tags = array();
	public function __construct($ss_code, $type, $year, $month, $day, $number, $description){
		//echo "<script>console.log('day=".$day."')</script>";
		$this->attrs = array(
			'code'=>'JMA_ivl_'.$ss_code.'_'.$type.'_'.$this->getDate_no_underscore($year,$month,$day),
			'owner1'=>'JMA',
			'pubDate'=>'2014-01-01 00:00:00',
			'station'=>$ss_code
			);
		//echo "<script>console.log('day2=".$day."')</script>";
		$this->tags = array(
			'earthquakeType'=>$this->eqtype[$type],
			'startTime'=>$this->getDate_with_underscore($year, $month, $day) . ' 00:00:01',
			'endTime'=>$this->getDate_with_underscore($year, $month, $day) . ' 23:59:59',
			'dataType'=>'C',
			'picksDetermination'=>'H',
			'numbOfRecEq'=>$number,
			'description'=>substr($description,0,min(256,strlen($description))),
			'orgDigitize'=>'O',
			'comments'=>( $type=='' ? 'undefined' : $type ) . '-type'.($type=='Air' ? ', Infrasound' : '')
			);
	}
	private function getDate_no_underscore($year, $month, $day) {
		$date = date_create($year.'-'.$month.'-'.$day);
		return date_format($date,"Ymd");
	} 

	private function getDate_with_underscore($year, $month, $day) {
		$date = date_create($year.'-'.$month.'-'.$day);
		return date_format($date,"Y-m-d");
	} 
	
	public function ToXml() {
		$res = "";
		$res.= "    <Interval";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= " ".$key."=\"".$value."\"";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </Interval>\n";
		return $res;
	}
}
?>