<?php
include 'php/include/db_connect_view.php';


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