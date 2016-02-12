<?php

include_once "networkevent.php";
$ENTRIES_PER_FILE = 500;
include_once "../common/header.php";
//create output zip file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
$file_list = array();
array_push($file_list, $temp);
$all_data = array();
$day_list = array();

$url = "http://pbosoftware.unavco.org/products/timeseries/" . $_POST["GPS_station_code"] . ".pbo_detrend.csv";
//echo ($url) . "<br/>";
$content = file_get_contents($url);
//echo strlen($content);
//save_original_file($file, $_POST['GPS_station_code'] . ".pbo_detrend.csv");

init_post();
$tok = strtok($content, "\n");
for ($i = 0; $i < 3; $i++)
	$tok = strtok("\n");

init_station_velocity($tok);
$tok = strtok("\n");
$tok = strtok("\n");

$timeChange = false;

while ($tok!==FALSE){	
	$line = trim($tok);
	if ($line) {
		$event = new NetworkEvent($owner1, $owner2, $owner3, $station, $line, $lastTime);
		$instrument = determineInstrument($station, $event->getTime(), $event->getEndTime(), $instrumentsList);

		$event->setInstrument($instrument);
		$event->setAttribute($refFrame, $projection, $ellipsoid, $datum, $refPosLat, $refPosLon,
							$refPosElev, $staVelNorth, $staVelNorthErr, $staVelEast, $staVelEastErr,
							$staVelVert, $staVelVertErr, $software);
		if ($event->valid()) {
			if (!isset($start_time)) {
				$start_time = $event->getTime()->format("Y-m-d");
			}
			$end_time = $event->getTime()->format("Y-m-d");
			array_push($all_data, $event);
		}
	}

	$tok = strtok("\n");
}
$i = 0;
$count = 1;

$suffix = "";

while ($i<count($all_data)){
	$tmp_xml = tempnam(".","");
	$temp_xml = fopen($tmp_xml,"w");
	$j = $i + $ENTRIES_PER_FILE -1;
	if ($j>=count($all_data))
		$j = count($all_data)-1;
	fwrite($temp_xml, CreateDataset($all_data,$i,$j));
	array_push($file_list, $tmp_xml);
	$zip->addFile($tmp_xml, "output_" . $count++ . ".xml");
	fclose($temp_xml);
	$i = $i + $ENTRIES_PER_FILE;
}

$zip->close();
save_converted_file($temp, $_POST['GPS_station_code']);

foreach ($file_list as $del_file)
	unlink($del_file);
$_SESSION['start_time'] = $start_time;
$_SESSION['end_time'] = $end_time;
$_SESSION['count'] = count($all_data);
header('Location: ../common/result.php');

function seperate($data) {
	return explode('$', $data);
}

function init_post() {
	global $owner1, $owner2, $owner3, $station, $instrumentsList, $lastTime,
			$refFrame, $projection, $ellipsoid, $datum, $refPosLat, $refPosLon,
			$refPosElev, $staVelNorth, $staVelNorthErr, $staVelEast, $staVelEastErr,
			$staVelVert, $staVelVertErr, $software;
	$owner1 = "PBO";
	$owner2 = "USGS";
	$owner3 = "UNAVCO";
	$refFrame = $_POST['refFrame'];
	$projection = $_POST['projection'];
	$ellipsoid = $_POST['ellipsoid'];
	$datum = $_POST['datum'];
	$refPosLat = $_POST['refPosLat'];
	$refPosLon = $_POST['refPosLon'];
	$refPosElev = $_POST['refPosElev'];
	$software = $_POST['software'];	

	require_once('php/include/db_connect.php');
	$station = $_POST["GPS_station_code"];
	$instrumentsList = loadInstrumentsList($station);

	$sql = "select * from ds where ds_code = '$station'";
	$result = mysql_query($sql);
	$stationId = '';
	while ($arr = mysql_fetch_array($result)) {
		$stationId = $arr['ds_id'];
		break;
	}
	$sql = 'select MAX(dd_gpv_time) where ds_id = ' . $stationId;
	$result = mysql_query($sql);
	while ($arr = mysql_fetch_array($result)) {
		$lastTime = new DateTime($arr['dd_gpv_stime']);
		break;
	}
}

function loadInstrumentsList($station) {
	require_once('php/include/db_connect.php');
	global $res;
	$res = array();
	$link = "select di_gen_code, di_gen_stime, di_gen_etime from di_gen, ds where ds_code = '$station' and ds.ds_id = di_gen.ds_id
	and (di_gen_type = 'GPS' or di_gen_type = 'CGPS') ORDER BY di_gen_stime, di_gen_etime";
	$result = mysql_query($link) or die(mysql_error());
	while ($instrument = mysql_fetch_array($result)) {
		array_push($res, 
			array('code'=>$instrument['di_gen_code'], 'stime'=> new DateTime($instrument['di_gen_stime']), 'etime'=>new DateTime($instrument['di_gen_etime'])));
	}
	return $res;
}

function determineInstrument($station, $startTime, $endTime, $instrumentsList) {
	foreach ($instrumentsList as $instrument) {
		if ($instrument['stime'] <= $startTime && $instrument['etime'] >= $endTime) 
			return $instrument['code']; 
	}
	return null;
}

function init_station_velocity($tok) {
	$line = trim($tok);
	preg_match_all('![+-]?\d+(?:\.\d+)?!', $line, $matches);
	$numbers = array_map('floatval', $matches[0]);
	global $staVelNorth, $staVelNorthErr, $staVelEast, $staVelEastErr, $staVelVert, $staVelVertErr;
	$staVelNorth = $numbers[0];
	$staVelNorthErr = $numbers[1];
	$staVelEast = $numbers[2];
	$staVelEastErr = $numbers[3];
	$staVelVert = $numbers[4];
	$staVelVertErr = $numbers[5];
}

function CreateDataset($all_data, $start, $end){
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Deformation>\r\n";
	$result .= '<GPSVectorDataset>' ."\r\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->toXml();
	}
	$result .= "</GPSVectorDataset>\r\n";
	$result .= "</Deformation>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>
