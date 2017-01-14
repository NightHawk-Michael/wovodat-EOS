<?php

include 'php/include/db_connect.php';

function get_volcanoes_list($obs){
	global $link;

	$data=array();
	
	$sql="
	select vd_id,vd_name from vd where vd.cc_id = (select cc_id from cc where cc.cc_code = '$obs') order by vd_name ASC";

	$result = mysql_query($sql, $link);
	while ($row = mysql_fetch_array($result)) {
		if (!is_null($row['vd_name']))
			array_push($data, array('name'=>$row['vd_name'],'id'=>$row['vd_id'])  );
	}
	
	return $data;
}

function get_stations_list($data_type , $volcano) {
	$res = array();

	$arr = explode('$', $volcano);
	$vd_id = $arr[0];

	if($data_type == "Gt"){  
		//array_push($res, array('name'=>'a', 'code' => 'b' ));
		$link = "select distinct ds.ds_id, ds.ds_name, ds.ds_code from ds, cn where cn_type = 'Deformation' and cn.vd_id = '$vd_id' and ds.cn_id = cn.cn_id";
		$result = mysql_query($link) or die (mysql_error());
		while ($station = mysql_fetch_array($result)) {
			if (!is_null($station['ds_name']))
				array_push($res, array('name'=>$station['ds_name'], 'id' => $station['ds_id'] , 'code'=>$station['ds_code']) );
		}
	}
	return $res;
}

function get_network_list($data_type) {
	$res = array();
	$obs_id= 150;
	 //array_push($res, array('name'=>'a', 'code' => 'b', 'id'=>'c' ));
	if ($data_type == "Hypo") {
		$link = "select distinct sn_id, sn_name, sn_code from sn where cc_id='$obs_id' or cc_id2='$obs_id' or cc_id3='$obs_id'";
		$result = mysql_query($link) or die(mysql_error());
		while ($network = mysql_fetch_array($result)) {
			if (!is_null($network['sn_name'])) 
				array_push($res, array('name'=>$network['sn_name'], 'id'=>$network['sn_id'], 'code'=>$network['sn_code']) );
		}
	}
	return $res;
}

function get_instruments_list($data_type , $station ) {
	$res = array();

	$arr = explode('$', $station);
	$ds_id = $arr[0];

	if ($data_type == "Gt") {
		//array_push($res, array('name'=>$arr[1], 'id' => 'd','code'=>'e'));
		$link = "select distinct di_tlt.di_tlt_id, di_tlt.di_tlt_name, di_tlt.di_tlt_code from di_tlt where di_tlt.ds_id = '$ds_id'";
		$result = mysql_query($link) or die (mysql_error());
		while ($instrument = mysql_fetch_array($result)) {
			if (!is_null($instrument['di_tlt_name']))
				array_push($res, array( 'name'=>$instrument['di_tlt_name'], 
										'id' => $instrument['di_tlt_id'], 
										'code'=>$instrument['di_tlt_code']));
		}	
	}
	return $res;
}

$type =  $_GET['type'];
if ($type == 'volcano') 
	echo json_encode( get_volcanoes_list( $_GET['observatory'] ) );
if ($type == 'station') 
	echo json_encode( get_stations_list( $_GET['data_type'] , $_GET['volcano'] ) );
if ($type == 'instrument') 
	echo json_encode( get_instruments_list( $_GET['data_type'] , $_GET['station'] ) );
if ($type == 'network') 
	echo json_encode( get_network_list( $_GET['data_type'] ) );
?>