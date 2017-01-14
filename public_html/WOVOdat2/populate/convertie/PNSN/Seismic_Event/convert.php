<?php
include_once "networkevent.php";
$ENTRIES_PER_FILE = 300;
include_once "../common/header.php";//create output zip file
$temp = tempnam(".","");
$zip = new ZipArchive();
$res = $zip->open($temp, ZipArchive::CREATE);

$start_date = get_latest_date();

$file_list = array();
array_push($file_list, $temp);
$all_data = array();
$day_list = array();
$file = $_FILES['file_input']['tmp_name'];
$handle = fopen($_FILES['file_input']['tmp_name'],"r");
$content = fread($handle, filesize($file));
save_original_file($file, $_FILES['file_input']['name']);
$start_time = null;
$end_time = null;

$outdated = 0;

$tok = strtok($content, "\n");
while ($tok!==FALSE){
	if (strlen($tok) > 20) {
		$event = new NetworkEvent($tok);
		$tmpTime = $event->tags['originTime'];
		$event_time = DateTime::createFromFormat("Y-m-d H:i:s", $tmpTime)->getTimestamp();

		if (($event->getCode()!=="") and (in_array($event->getCode(), $day_list) == False)){
			if ($start_time == null) $start_time = $event->tags['originTime'];
			$end_time = $event->tags['originTime'];
			if ($start_date < $event_time) {
				array_push($all_data,$event);
				array_push($day_list, $event->getCode());
			} else $outdated++;
		}
	}
	$tok = strtok("\n");
}
fclose($handle);
$i = 0;
$count = 1;

while ($i<count($all_data)){
	$tmp_xml = tempnam(".","");
	$temp_xml = fopen($tmp_xml,"w");
	$j = $i + $ENTRIES_PER_FILE -1;
	if ($j>=count($all_data))
		$j = count($all_data)-1;
//	echo networkEventDataset($all_data,$i,$j);
//	exit();
	fwrite($temp_xml,networkEventDataset($all_data,$i,$j));
	array_push($file_list, $tmp_xml);
	$zip->addFile($tmp_xml, "output_" . $count++ . ".xml");
	fclose($temp_xml);
	$i = $i + $ENTRIES_PER_FILE;
}
$zip->close();
$now = new DateTime();
save_converted_file($temp, "PNSN_sd_evn" . $now->format("Ymd"));
foreach ($file_list as $del_file)
	unlink($del_file);

$_SESSION['start_time'] = $start_time;
$_SESSION['end_time'] = $end_time;
$_SESSION['count'] = count($all_data);
$_SESSION['outdated'] = $outdated;
$_SESSION['start_date'] = $start_date;

foreach ($file_list as $del_file)
	unlink($del_file);

header('Location: ../common/result.php');

function get_latest_date() {
	require_once('php/include/db_connect.php');
	$sql = "";
	$sn_id = 106;
	$sql = "select MAX(sd_evn_time) from sd_evn where sn_id = $sn_id";
	$sql = "select MAX(sd_evn_time) from sd_evn where sd_evn_id = $sn_id";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row['MAX(sd_evn_time)'];
	}
}

function networkEventDataset($all_data, $start, $end){
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Seismic>\r\n";
	$result .= '<NetworkEventDataset>' ."\r\n";

	for ($i=$start;$i<=$end;$i++){
		$result .= $all_data[$i]->toXml()."\r\n";
	}
	$result .= "</NetworkEventDataset>\r\n";
	$result .= "</Seismic>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>