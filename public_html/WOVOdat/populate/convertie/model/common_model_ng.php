<?php
if (!isset($_SESSION))     
    session_start();
	
include "php/include/db_connect.php";       


function getObsAccess() {
	global $link;

	$sql="select cc.cc_obs from cc where cc.cc_id={$_SESSION['login']['cc_id']}";	
	$result = mysql_query($sql);
	$row= mysql_fetch_array($result);

	return $row['cc_obs'];
}


function getobslist(){     
	global $link;

	$data=array();
	$sql = "select cc_code, cc_country, cc_obs, cc_id from cc order by cc_country";
	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	return $data;
}

/*
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
*/

// Update getvollist function to show all vol lists for those ppl who are not from Obs.  11-Dec-2014
function getvollist($obs){
	global $link;

	$data=array();
	
		
	$sql="select vd_name from vd where (vd.cc_id = (select cc_id from cc where cc.cc_code = '$obs') || 
	vd.cc_id2 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id3 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id4 = (select cc_id from cc where cc.cc_code = '$obs')	
	|| vd.cc_id5 = (select cc_id from cc where cc.cc_code = '$obs')) order by vd_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	if(!(isset($data[0]))){  // use this if ppl are not from observatory 
		$sql ="select vd_name from vd order by vd_name ASC";
		$result = mysql_query($sql, $link);
		while ($row = mysql_fetch_array($result))
			$data[] = $row;
	}

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

function getmultivolcode($vol,$volLength){
	global $link;
	$data=array();

	$sql='select vd.vd_cavw from vd where vd.vd_name IN (' ;

	for($i=0; $i < $volLength; $i++){
		
		$sql .= '"'.$vol[$i].'"';
		
		if($i< ($volLength-1))
			$sql .= ',';
	}
	$sql .= ')';

	$result = mysql_query($sql, $link);
	while ($row = mysql_fetch_array($result))
		$data[] = $row['vd_cavw'];
	
	return $data;
	
}

function getnetworkcode($network,$conv){    // All station xmls need network codes
	global $link;

	if($conv == 'SeismicStation'){
		$sql="select distinct sn.sn_code as ncode from sn where sn.sn_name = '$network'";
	}
	else if($conv == 'DeformationStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Deformation'";
	}
	else if($conv == 'GasStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Gas'";	
	}
	else if($conv == 'HydrologicStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Hydrologic'";	
	}
	else if($conv == 'ThermalStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Thermal'";	
	}
	else if($conv == 'FieldsStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Fields'";	
	} 
	else if($conv == 'MeteoStation'){
		$sql="select distinct cn.cn_code as ncode from cn where cn.cn_name = '$network' and cn.cn_type='Meteo'";	
	}
	
	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['ncode'];
}


function getstationcode($station,$conv){  // All Instruments xmls need station codes

	global $link;

	if($conv == 'SeismicInstrument'){
		$sql="select distinct ss.ss_code as scode from ss where ss.ss_name= '$station'";
	}
	else if($conv == 'DeformationInstrument_General' || $conv == 'DeformationInstrument_Tilt/Strain' ){
		$sql="select distinct ds.ds_code as scode from ds where ds.ds_name= '$station'";
	}
	else if($conv == 'GasInstrument'){
		$sql="select distinct gs.gs_code as scode from gs where gs.gs_name= '$station'";	
	}else if($conv == 'HydrologicInstrument'){
		$sql="select distinct hs.hs_code as scode from hs where hs.hs_name= '$station'";	
	}else if($conv == 'ThermalInstrument'){
		$sql="select distinct ts.ts_code as scode from ts where ts.ts_name= '$station'";	
	}else if($conv == 'FieldsInstrument'){
		$sql="select distinct fs.fs_code as scode from fs where fs.fs_name= '$station'";	
	}else if($conv == 'MeteoInstrument'){
		$sql="select distinct ms.ms_code as scode from ms where ms.ms_name= '$station'";	
	}
	
	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['scode'];
}


function getinstrcode($instrument,$conv){

	global $link;

	
	$sql="select si.si_code, si.si_stime, si.si_etime from si where si.si_name = '$instrument'";

	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row;
}	

function getcscode($csname){      //Added on 1-June-2012

	global $link;
	
	$sql="select cs_code from cs where cs_name ='$csname'";

	$result = mysql_query($sql, $link);
	$row= mysql_fetch_array($result);
	return $row['cs_code'];


}
?>