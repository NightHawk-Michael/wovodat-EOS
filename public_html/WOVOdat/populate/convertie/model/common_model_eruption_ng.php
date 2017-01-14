<?php
if (!isset($_SESSION))      
    session_start();
	
include "php/include/db_connect.php";       


function getowner($obs){
	global $link;

	$sql="select cc.cc_code from cc where cc.cc_id='$obs'";

	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['cc_code'];
	
}


function getvolcode($vol){
	global $link;
	
	$sql="select vd.vd_cavw from vd where vd.vd_name='$vol'";
	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['vd_cavw'];

}


function getEruptionCode($edId){    // Get Eruption Code
	global $link;

	$sql="select ed.ed_code from ed where ed.ed_id='$edId'";

	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['ed_code'];
}


function getEruptionPhaseCode($edPhsId){    // Get Eruption Phase Code
	global $link;

	$sql="select ed_phs.ed_phs_code from ed_phs where ed_phs.ed_phs_id='$edPhsId'";

	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['ed_phs_code'];
}
?>