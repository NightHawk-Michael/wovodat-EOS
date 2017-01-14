<?php 
class NetworkEvent {
	private $attrs = array();
	private $tags = array();
	private $locaQuality1 = array(
		'0'=>'',
		'1'=>'Depth-free method. ',
		'2'=>'Depth-slice method. ',
		'3'=>'Fixed depth. ',
		'4'=>'Using depth phase. ',
		'5'=>'Using S-P time. ',
		'7'=>'Poor solution. ',
		'8'=>'Not determined or not accepted. ' 
	);
	private $locaQuality2 = array(
		'0'=>'',
		'1'=>'Natural earthquake. ',
		'2'=>'Insufficient number of JMA station. ',
		'3'=>'Artificial event. ',
		'4'=>'Noise. ',
		'5'=>'Low frequency earthquake. '
	);
	private $locaQuality3 = array(
		'0'=>'',
		'K'=>'High-precision hypocenters. ',
		'S'=>'Low-precision hypocenters. '
	); 
	private $comments1 = array(
		'1'=>'Standard table (83A travel time table or other travel time table). ',
		'2'=>'Table of far east off the Sanriku district. ',
		'3'=>'Table of the east off Hokkaido district. ',
		'4'=>'Table of the regions of southern parts of Kurile Islands (with 83A travel time table). ',
		'5'=>'Standard table (JMA2001 travel time table). ',
		'6'=>'Table of regions of southern parts of Kurile Islands (with JMA2001 travel time table). ',
		'0'=>'Determimed by other agency. '
	); 
	private $comments2 = array(
		'0'=>'',
		'1'=>'Maximum intensity: 1. ',
		'2'=>'Maximum intensity: 2. ',
		'3'=>'Maximum intensity: 3. ',
		'4'=>'Maximum intensity: 4. ',
		'5'=>'Maximum intensity: 5(-September,1996). ',
		'6'=>'Maximum intensity: 6(-September,1996). ',
		'7'=>'Maximum intensity: 7. ',
		'A'=>'Maximum intensity: 5 lower. ',
		'B'=>'Maximum intensity: 5 Upper. ',
		'C'=>'Maximum intensity: 6 lower. ',
		'D'=>'Maximum intensity: 6 Upper. ',
		'R'=>'Maximum intensity: (Remarkable earthquake.) Distance of the furthest point there shock is felt, is greater than 300km. (-1977). ',
		'M'=>'Maximum intensity: (Moderate earthquake.) The distance is shorter than 300km, but greater than 200km. (-1977). ',
		'S'=>'Maximum intensity: (Earthquake of small felt area.) The distance if shorter than 200km, but greater than 100km. (-1977). ',
		'L'=>'Maximum intensity: (Local earthquake.) The distance is shorter than 100km. (-1977). ',
		'F'=>'Maximum intensity: Felt earthquake (-1984). ',
		'X'=>'Maximum intensity: Shock is felt by some people but not by JMA observers. (-September,1996). '
	);
	private $comments3 = array(
		'0'=>'',
		'1'=>'Damage: Slight damage (cracks on walls and ground). ',
		'2'=>'Damage: Light damage (broken houses, roads, etc.). ',
		'3'=>'Damage: 2 - 19 persons killed or 2 - 999 houses completely destroyed. ',
		'4'=>'Damage: 20 - 199 persons killed or 1,000 - 9,999 houses completely destroyed. ',
		'5'=>'Damage: 200 - 1,999 persons killed or 10,000 - 99,999 houses completely destroyed. ',
		'6'=>'Damage: 2,000 - 19,999 persons killed or 100,000 - 999,999 houses completely destroyed. ',
		'7'=>'Damage: 20,000 or more persons killed or 1,000,000 or more houses completely destroyed. ',
		'X'=>'Damage: Injures or damage were caused but the grade was not clear.(-1988). ',
		'Y'=>'Damage: Injures and damage are included in the grade for the preceding or following event.(-1988). '
	);
	private $comments4 = array(
		'0'=>'',
		'1'=>'Tsunami: Tsunami was observed by tide gage but it had no damage. ',
		'2'=>'Tsunami: 1 m / very slight damage. ',
		'3'=>'Tsunami: 2 m / slight damage to coastal areas and ships. ',
		'4'=>'Tsunami: 4 - 6 m / human injures. ',
		'5'=>'Tsunami: 10 - 20 m damage to more than 400km of coastline. ',
		'6'=>'Tsunami: 30 m / damage to more than 500km of coastline. ',
		'T'=>'Tsunami: Tsunami was generated. '
	);
	private $value_keep;
	public function __construct( $network, $value){
		//echo "<script>console.log('day=".$day."')</script>";
		$this->value_keep = $value;
		$value = $this->Check($value);

		$this->attrs = array(
			'code'=>'JMA'.'_'. ( ($value[1]=='0' ? '-' : $value[1] ) ) .'_'.substr($value,2,4).substr($value,6,2).substr($value, 8,2) . substr($value,10,2).substr($value,12,2).substr($value,14,2). substr($value,16,2),
			'network'=>$network,
			'owner1'=>'JMA',
			'owner2'=> ($value[1]=='U') ? 'USGS' : (  ($value[1]=='I') ? 'ISC' : ''  ),
			'pubDate'=>'2014-01-01 00:00:00'
			);
		//echo "<script>console.log('day2=".$day."')</script>";
		$this->tags = array(
			'seismoArchive'=>'JMA',
			'originTime'=>substr($value,2,4) . '-' . substr($value,6,2) . '-' . substr($value, 8,2) . ' ' . substr($value,10,2) . ':' . substr($value,12,2) . ':' . substr($value,14,2),
			'originTimeCsec'=>'0.' . substr($value,16,2),
			'originTimeUnc'=>($value[19]=='0') ? '' : ('0000-00-00 00:00:'.substr($value,18,2)),
			'originTimeCsecUnc'=>'0.' . substr($value,20,2),
			'picksDetermination'=>'H',
			'lat'=> number_format(substr($value, 22,3) +  $this->F(substr($value,25,4),4,2) /60,7,'.',','),
			'lon'=>	number_format(substr($value, 33,4) +  $this->F(substr($value,37,4),4,2) /60,7,'.',','),
			'depth'=>number_format($this->F(substr($value,45,5),5,2),2,'.',','),
			'fixedDepth'=> ($value[60]=='3') ? 'Y' : 'U',
			'numberOfStations'=>substr($value, 93,3) + '0',
			'maxLonErr'=> number_format($this->F(substr($value,41,4),4,2) / 60 * cos( ( substr($value, 22,3) +  $this->F(substr($value,25,4),4,2) /60 )/180 * M_PI   ) * 111.325 ,2,'.',','),
			'maxLatErr'=> number_format($this->F(substr($value,29,4),4,2) / 60 * 111.325 ,2,'.',','),
			'depthErr'=>substr($value, 50,1) . '.' . substr($value, 51,2),
			'locaQuality'=>$this->locaQuality1[$value[60]] .$this->locaQuality2[$value[61]] . $this->locaQuality3[$value[96]],
			'primMagnitude'=>$this->primMagnitude(substr($value, 53,2)) + '0',
			'primMagnitudeType'=>$this->primMagnitudeType(substr($value,55,1)),
			'secMagnitude'=>$this->primMagnitude(substr($value, 56,2)) + '0',
			'secMagnitudeType'=>$this->primMagnitudeType(substr($value,58,1)),
			'earthquakeType'=>'R',
			'orgDigitize'=>'O',
			'comments'=>$this->comments1[$value[59]].$this->comments2[$value[62]].$this->comments3[$value[63]].$this->comments4[$value[64]]
			);
	}
	private function Check( $s ) {
		for ($i=0;$i < strlen($s); $i++) 
			if ($s[$i]==' ') $s[$i] = '0';
		return $s;
	}
	private function F($s,$u,$v) {
		return ((substr($s,0,$u-$v) . '.' . substr($s,$u-$v))) + '0';
	}
	private function primMagnitude($s) {
		if (is_numeric($s)) {
			if ($s>=0) return number_format($this->F($s,2,1),1,'.',',');
			return '-0.'. $s[1];
		}
		return '-'.(ord($s[0])-ord('A')+1) . '.' . $s[1];
	}
	private function primMagnitudeType($s) {
		switch ($s) {
			case 'J':return 'MJ';
			case 'D':return 'Md';
			case 'd':return 'Md';
			case 'V':return 'Mv';
			case 'v':return 'Mv';
			case 'W':return 'Mw';
			case 'B':return 'Mb';
			case 'S':return 'Ms';
			default:
				return 'not determined';
		}
	}
	public function ToXml() {
		$res = "";
		//$res.= "'".$this->value_keep."'";
		$res.= "    <NetworkEvent ";
		foreach ($this->attrs as $key => $value) 
			if ($value)	
				$res.= $key."=\"".$value."\" ";
		$res.= ">\n";
		foreach ($this->tags as $key => $value) 
			if ($value)
				$res.= "     <".$key.">".$value."</".$key.">\n";
		$res.= "    </NetworkEvent>\n";
		return $res;
	}
}
?>