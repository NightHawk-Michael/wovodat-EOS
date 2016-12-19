<?php
include 'php/include/db_connect_view.php';
//include 'db_connect_view.php';	


//Add 2 years to start date if the user leaves it blank.
/*
function getPubDate($pubDate,$startTime){
	
	if($pubDate == '' || $pubDate == "YYYY-MM-DD HH:MM:SS" ){
	
		$datetime=strtotime($startTime);

		$max_pubdate=date('Y-m-d H:i:s', mktime(date('H',$datetime), date('i',$datetime), date('s',$datetime), date('m',$datetime), date('d',$datetime), date('Y',$datetime)+2));
	}
	
	return $max_pubdate;
}


*/


/*
function getCount(){
	global $link;
	$sqlSelect ="select count(*) as rcount"; 
		
	$sqlFrom = " from vd,vd_inf as vjn,ed".$_SESSION['sqlFromData'];

	$sqlWhere =" where vd.vd_id=vjn.vd_id and vd.vd_id=ed.vd_id".$_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereEdPhase'].$_SESSION['sqlWhereVei'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTime'].$_SESSION['sqlWhereEdTimeData'];	

	$sql = $sqlSelect.$sqlFrom.$sqlWhere;

	echo $sql."<br/>";
	/*
	Cominbe Feature, Rock, VEI, Edtime, Edphase in one query
	select count(*) as rcount from vd,vd_inf as vjn,ed,ed_phs where vd.vd_id=vjn.vd_id and vd.vd_id=ed.vd_id and (vjn.vd_inf_type='Caldera' || vjn.vd_inf_type='Cinder cone') and vjn.vd_inf_rtype='Basalt' and (ed.ed_vei between '2' and '3') and (ed.ed_stime between '2014-08-03 00:00:00' and '2014-08-06 00:00:00') and ed.ed_id=ed_phs.ed_id and ed_phs.ed_phs_type='Explosive'		
	

	$result = mysql_query($sql, $link);
	$row=mysql_fetch_array($result);

	return $row['rcount'];
	
}
*/

function getNoMonitorData(){
	global $link;
	$data=array();
	$sqlSelect ="select distinct                            vd.vd_name,vjn.vd_inf_type,vjn.vd_inf_rtype,ed.ed_stime,ed.ed_etime,ed.ed_vei,concat('vd_id=', vd.vd_id, '&stime=', ed.ed_stime)"; 
		
	$sqlFrom = " from vd,vd_inf as vjn,ed".$_SESSION['sqlFromData'];
	
	$sqlWhere =" where vd.vd_id=vjn.vd_id and vd.vd_id=ed.vd_id".$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereEdPhase'].$_SESSION['sqlWhereVei'].$_SESSION['sqlWhereEdTime'];	
	
	$sql = $sqlSelect.$sqlFrom.$sqlWhere." order by vd.vd_name ASC";

	//echo $sql;
	/*
	Cominbe Feature, Rock, VEI, Edtime, Edphase in one query
	select distinct vd.vd_name,vjn.vd_inf_type,vjn.vd_inf_rtype,ed.ed_stime,ed.ed_etime,ed.ed_vei,concat(vd.vd_id,'-',ed.ed_stime) from vd,vd_inf as vjn,ed where vd.vd_id=vjn.vd_id and vd.vd_id=ed.vd_id and vjn.vd_inf_type='Stratovolcano' and vjn.vd_inf_rtype='Basalt/Picro-Basalt' and (ed.ed_vei between '2' and '5') and (ed.ed_stime between '1914-08-01 00:00:00' and '2014-11-01 00:00:00') order by vd.vd_name ASC	
	*/

	$result = mysql_query($sql, $link);
	while($row=mysql_fetch_array($result))
	$data[]=$row;
	
	return $data;

}



?>