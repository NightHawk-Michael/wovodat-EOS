<?php 
class NetworkEvent_sd_trm {
	private $eqtype = array(
			'T'=>'G',
			'TC'=>'G',
			'TK'=>'G',
			'TP'=>'H',
			'Tex'=>'G'
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
	public function __construct($year, $month, $day, $hour, $minute, $type,$ss_code,$Okind,$P_time,$SP,$Mz,$Unit,$Remark){
		$this->attrs = array(
			'code'=>'JMA_'.$ss_code.'_'.$type.'_'.$this->GetDateCode($year,$month,$day,$hour,$minute,$P_time),
			'owner1'=>'JMA',
			'pubDate'=>'2014-01-01 00:00:00',
			'station'=>$ss_code
			);
		$this->tags = array(
			'startTime'=>($SP=='c') ? $this->GetDate($year,$month,$day,'0','0','1') : $this->GetDate($year,$month,$day,$hour,$minute,round($P_time)),
			'endTime'=>($SP=='c') ? $this->GetDate($year,$month,$day,'23','59','59') : 
			    ( $SP=="" ? "" : $this->GetDate2($year,$month,$day,$hour,$minute,$P_time + $SP) ),
			'durationPerDay'=>(($SP=='c') ? '86400' : $SP ),
			'type'=>$this->eqtype[$type],
			'maxAmplitude'=>$Mz+0,
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

	private function GetDate2($year,$month,$day,$hour,$minute, $add_second) {
		$date = date_create($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00');
		date_add($date, date_interval_create_from_date_string(round($add_second).' seconds'));
		return date_format($date,"Y-m-d H:i:s");
	}

	private function GetDateCode($year,$month,$day,$hour,$minute,$P_time) {
		$date = date_create($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.floor($P_time));
		return date_format($date,"YmdHis");
	}

	public function ToXml() {
		$res = "";
		$res.= "    <Tremor";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= " ".$key."=\"".$value."\"";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			if ($value)
				$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </Tremor>\n";
		return $res;
	}
}
?>