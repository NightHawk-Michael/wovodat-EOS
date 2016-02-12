<?php 
class NetworkEvent_sd_evs {
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
	private $com1 = array(
			'V'=>'velocity seismogram',
			'D'=>'displacement seismogram',
			'A'=>'acceleration seismogram',
			'M'=>'infrasonic microphone signals'
		);
	private $com2 = array(
			'mkine'=>'10 micro meter per second',
			'ƒÊm'=>'micro meter',
			'mgal'=>'10 micro meter per square seconds'
		);


	private $attrs = array();
	private $tags = array();
	public function __construct($year, $month, $day, $hour, $minute, $type,$ss_code,$Okind,$P_time,$S_time,$SP,$Dur,$Pz,$Mz,$Unit, $Remark){
		$this->attrs = array(  
			'code'=>'JMA_'.$ss_code.'_'.$type.'_'.$this->GetDateCode($year,$month,$day,$hour,$minute,$P_time),
			'owner1'=>'JMA',
			'pubDate'=>'2014-01-01 00:00:00',
			'station'=>$ss_code
			);
		$this->tags = array(
			'startTime'=>$this->GetDate($year,$month,$day,$hour,$minute,round($P_time)),
			'startTimeCsec'=>$P_time!="" ? $P_time - floor($P_time) : "",
			'picksDetermination'=>'H',
			'SPinterval'=>($S=="") ? "" : $S_time - $P_time,
			'duration'=>(is_numeric($SP) ? $SP : $Dur),
			'maxAmplitude'=>$Mz+0,
			'earthquakeType'=>$this->eqtype[$type],
			'firstMotion'=>(!is_numeric($Pz) ? 'Unknown' : ( $Pz>=0 ? 'Up' : 'Down')  ),
			'orgDigitize'=>'O',
			'comments'=>$this->com1[$Okind].
			', Amplitude init: '. ( ($Unit=="mkine" || $Unit=="mgal") ?   $this->com2[$Unit]  : "micro meter" ) .
			($Remark!='' ? ', maximum intensity: '.$Remark : '').', '.$type.'-type'
			);
	}
	
	private function GetDate($year,$month,$day,$hour,$minute,$second) {
		$date = date_create($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second);
		return date_format($date,"Y-m-d H:i:s");
	}

	private function GetDateCode($year,$month,$day,$hour,$minute,$P_time) {
		$date = date_create($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.round($P_time));
		$c = number_format($P_time,2,'.',',');
		$arr = explode('.',$c);
		return date_format($date,"YmdHis").$arr[1];
	}



	public function ToXml() {
		$res = "";
		$res.= "    <SingleStationEvent";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= " ".$key."=\"".$value."\"";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			if ($value)
				$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </SingleStationEvent>\n";
		return $res;
	}
}
?>