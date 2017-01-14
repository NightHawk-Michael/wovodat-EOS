<?php
include "php/include/db_connect.php";        // Changed on 29-feb-2012


function getvollist($obs){
	global $link;

	$data=array();
	
	$sql="select vd_name from vd where (vd.cc_id = (select cc_id from cc where cc.cc_code = '$obs') || 
	vd.cc_id2 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id3 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id4 = (select cc_id from cc where cc.cc_code = '$obs')	
	|| vd.cc_id5 = (select cc_id from cc where cc.cc_code = '$obs')) order by vd_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	return $data;
}


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



function getstationid($code,$conv){  

	global $link;
 
	if($conv == 'IntervalSwarmData'){
		$sql="select distinct ss.ss_id as sid from ss where ss.ss_code='$code'";
		
	}
	else if($conv == 'ElectronicTiltData'){
		$sql="select distinct ds.ds_id as sid from ds where ds.ds_code='$code'";
	}
	
 	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row;
}
 
 
/* 
function getinstrcode($instrument,$conv){

	global $link;

	if($conv == 'ElectronicTiltData' || $conv == 'PostElectronicTiltData'){
		$sql="select distinct di_tlt.di_tlt_code as instrcode from di_tlt where di_tlt.di_tlt_name='$instrument' and di_tlt.di_tlt_type='TILT'";
	}
	
	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['instrcode'];
}	


*/



?>