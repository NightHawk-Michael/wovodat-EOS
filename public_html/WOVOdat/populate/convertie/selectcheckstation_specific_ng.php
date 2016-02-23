<?php
//require_once "php/include/login_check.php";  // Check login   Nang Commented on 25-Feb-2013
require_once "php/include/get_root.php";    // Get root url
include "php/include/db_connect.php";  // Changed on 29-feb-2012
	
	
	
$volca=trim($_GET['volcan']);  			    	   // Get valcano name
$stationdisplay=trim($_GET['stationdisplay']);    //get ElectronicTiltData or TiltVectorData, etc..


if($stationdisplay == "IntervalSwarmData" || $stationdisplay == "RSAM"){  

//	$result = mysql_query("select s.ss_name from ss as s,sn as n,vd where s.sn_id = n.sn_id and n.vd_id = vd.vd_id and vd.vd_name='$volca'") or die(mysql_error());

	$result = mysql_query("select distinct s.ss_name from ss as s,sn as n,vd where s.sn_id = n.sn_id and n.vd_id = vd.vd_id and vd.vd_name='$volca'") or die(mysql_error());

}
else if($stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"){ 
		
		$sql ="select distinct s.ds_name from ds as s, cn, vd, di_tlt as di where s.cn_id = cn.cn_id and cn.vd_id = vd.vd_id and s.ds_id= di.ds_id and cn.cn_type='Deformation' and di.di_tlt_type='TILT' and vd.vd_name = '$volca'";		
		$result = mysql_query($sql);
	
}	
	$row=mysql_fetch_array($result);
	
	if(!$row){   // false means no data result
		echo "false";
	}else{
		echo "true";
	}
?>