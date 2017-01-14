<?php

require_once('php/include/db_connect.php');

function get_owners_list (){
	$res = array();
	$used = array();
	$result = mysql_query("select distinct cc_code, cc_country, cc_obs, cc_id from cc order by cc_country");
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

function get_stations_list($data_type, $volcano_name) {
	$res = array();
	if($data_type == "IntervalSwarmData" || $data_type == "RSAM"){  
		$result = mysql_query("select distinct ss.ss_name, ss.ss_code from ss, sn, vd where ss.sn_id = sn.sn_id and sn.vd_id = vd.vd_id and vd.vd_name='$volcano_name'") or die(mysql_error());
		while ($station = mysql_fetch_array($result)) {
			array_push($res, array('name' => $station['ss_name'], 'code' => $station['ss_code']));
		}		
	}	
	if ($data_type == "ElectronicTiltData" || $data_type == "GPSPosition") {
		$link = "select distinct ds.ds_code, ds.ds_name from ds, cn, vd where vd.vd_name = '$volcano_name' and cn.vd_id = vd.vd_id and cn_type = 'Deformation' and ds.cn_id = cn.cn_id";
		$result = mysql_query($link) or die (mysql_error());
		while ($station = mysql_fetch_array($result)) {
			array_push($res, array('name'=>$station['ds_name'], 'code' => $station['ds_code']));
		}
	}
	return $res;
}

function get_instruments_list($station, $data_type) {
	$res = array();
	if ($data_type == "ElectronicTiltData") {
		$link = "select distinct di_tlt.di_tlt_code, di_tlt.di_tlt_name from di_tlt, ds where ds.ds_name = '$station' and di_tlt.ds_id = ds.ds_id and di_tlt.di_tlt_type = 'Tilt'";
		$result = mysql_query($link) or die (mysql_error());
		while ($instrument = mysql_fetch_array($result)) {
			array_push($res, array('name'=>$instrument['di_tlt_name'], 'code' => $instrument['di_tlt_code']));
		}
	}
	
	if ($data_type == "GPSPosition") {
		$link = "select distinct di_gen.di_gen_code, di_gen.di_gen_name from di_gen, ds where ds.ds_name = '$station' and di_gen.ds_id = ds.ds_id and di_gen.di_gen_type = 'GPS'";
		$result = mysql_query($link) or die (mysql_error());
		while ($instrument = mysql_fetch_array($result)) {
			array_push($res, array('name'=>$instrument['di_gen_name'], 'code' => $instrument['di_gen_code']));
		}
	}

	if ($data_type == "pbo_GPS") {
		$link = "select di_gen_code from di_gen, ds where ds_code = '$station' and ds.ds_id = di_gen.ds_id
		and (di_gen_type = 'GPS' or di_gen_type = 'CGPS')";
		$result = mysql_query($link) or die(mysql_error());
		while ($instrument = mysql_fetch_array($result)) {
			array_push($res, $instrument['di_gen_code']);
		}
	}
	return $res;
}

function get_networks_list($data_type, $volcano_name) {
	$res = array();
	if($data_type == "IntervalSwarmData" || $data_type == "RSAM" || $data_type == "SeismicEventNetwork"){  
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

	$data=array();
	
	$sql="select vd_name from vd where (vd.cc_id = (select cc_id from cc where cc.cc_code = '$obs') || 
	vd.cc_id2 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id3 = (select cc_id from cc where cc.cc_code = '$obs') || vd.cc_id4 = (select cc_id from cc where cc.cc_code = '$obs')	
	|| vd.cc_id5 = (select cc_id from cc where cc.cc_code = '$obs')) order by vd_name ASC";

	$result = mysql_query($sql, $link);
	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	return $data;
}

function get_latest_date($data_type, $obs) {
	global $link;
	$sql = "";
	if ($data_type == 'Seismic_Event') {
		if ($obs == 'ANSS') {
			$sn_id = 120;
		}
		if ($obs == 'PNSN') {
			$sn_id = 106;
		}
		$sql = "select MAX(sd_evn_time) from sd_evn where sn_id = $sn_id";
		//return $sql;
		$result = mysql_query($sql, $link);
		while ($row = mysql_fetch_array($result)) {
			return $row['MAX(sd_evn_time)'];
		}
	}
}

function get_station_information($observatory, $data_type, $station_code) {
	global $link;
	$result = array();
	if ($observatory == "PBO") {
		if ($data_type == "GPS") {
			$sql = "select * from ds where ds_code = '$station_code'";
			$tmp = mysql_query($sql, $link);
			while ($arr = mysql_fetch_array($tmp)) {
				$result["stationId"] = $arr['ds_id'];
				$result["refPosLat"] = $arr['ds_nlat'];
				$result["refPosLon"] = $arr['ds_nlon'];
				$result["refPosElev"] = $arr['ds_nelev'];
				return $result;
				break;
			}
		}
	}
}
?>
