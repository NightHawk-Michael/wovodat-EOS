<?php

require_once('php/include/db_connect.php');
session_start();

// Regenerate session ID
session_regenerate_id(true);

// Get root url
require_once "php/include/get_root.php";

if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
}

function get_owners_list (){
	$res = array();
	$used = array();
	$result = mysql_query("select cc_code, cc_country, cc_obs, cc_id from cc order by cc_country");
	while ($arr = mysql_fetch_array($result)) {
		if(!is_numeric($arr['cc_code'])){
			if (!isset($used[$arr['cc_code']])) {
				array_push($res, array('value'=>$arr['cc_code'], 'title'=>$arr['cc_obs'], 'country'=>$arr['cc_country']));
				$used[$arr['cc_code']] = true;
			}
		}
	}
	return $res;
}

function get_stations_list($data_type, $volcano_id) {
	$res = array();
	if($data_type == "Meteorological"){  
		$result = mysql_query("select distinct ms.ms_name, ms.ms_id, ms.ms_code from ms, cn, vd where ms.cn_id = cn.cn_id and cn.vd_id = '$volcano_id'") or die(mysql_error());
		while ($station = mysql_fetch_array($result)) {
			array_push($res, array('name' => $station['ms_name'], 'id' => $station['ms_id'], 'code'=>$station['ms_code']));
		}		
	}	
	if($data_type == "Seismic"){  
		$result = mysql_query("select distinct ss.ss_name, ss.ss_id, ss.ss_code from ss, sn, vd where ss.sn_id = sn.sn_id and sn.vd_id = '$volcano_id'") or die(mysql_error());
		while ($station = mysql_fetch_array($result)) {
			array_push($res, array('name' => $station['ss_name'], 'id' => $station['ss_id'], 'code'=>$station['ss_code']));
		}		
	}	

	return $res;
}

function get_instruments_list($station) {
	$res = array();
	$link = "select distinct di_tlt.di_tlt_code, di_tlt.di_tlt_name from di_tlt, ds where ds.ds_name = '$station' and di_tlt.ds_id = ds.ds_id and di_tlt.di_tlt_type = 'Tilt'";
	$result = mysql_query($link) or die (mysql_error());
	while ($instrument = mysql_fetch_array($result)) {
		array_push($res, array('name'=>$instrument['di_tlt_name'], 'code' => $instrument['di_tlt_code']));
	}
	return $res;
}

function get_networks_list($data_type, $volcano_name) {
	$res = array();
	if($data_type == "IntervalSwarmData" || $data_type == "RSAM"){  
		$link = "select distinct sn.sn_name, sn.sn_code from sn, vd where sn.vd_id = vd.vd_id and vd.vd_name='$volcano_name'";
		$result = mysql_query("select distinct sn.sn_name, sn.sn_code from sn, vd where sn.vd_id = vd.vd_id and vd.vd_name='$volcano_name'") or die(mysql_error());
		while ($network = mysql_fetch_array($result)) {
			array_push($res, array('name' => $network['sn_name'], 'code' => $network['sn_code']));
		}		
	}	
	return $res;
}

function get_volcanoes_list($obs){
	global $link;

	$res=array();
	
	$sql="select vd.vd_name, vd.vd_id from vd where (vd.cc_id = (select cc_id from cc where cc.cc_code = '$obs') || 
	vd.cc_id2 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id3 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id4 = (select cc_id from cc where cc.cc_code = '$obs')	
	|| vd.cc_id5 = (select cc_id from cc where cc.cc_code = '$obs')) order by vd_name ASC";

	$result = mysql_query($sql, $link);
	while ($volcano = mysql_fetch_array($result))
		array_push($res, array('name'=>$volcano['vd_name'], 'id'=>$volcano['vd_id']));
	
	return $res;
}

?>
