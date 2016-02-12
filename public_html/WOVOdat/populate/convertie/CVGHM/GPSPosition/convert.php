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

$file = $_FILES['file_input']['tmp_name'];
$handle = fopen($_FILES['file_input']['tmp_name'],"r");
$content = fread($handle, filesize($file));
//save_original_file($file, $_FILES['file_input']['name']);

init_post();
$tok = strtok($content, "\n");
$tok = strtok("\n");

while ($tok!==FALSE){	
	$line = trim($tok);
	if ($line) {
		$event = new NetworkEvent($owner1, $owner2, $owner3, $station, $refStation1, $refStation2, $instrument, $line);
		array_push($all_data, $event);
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
	fwrite($temp_xml, ElectronicTiltDataset($all_data,$i,$j));
	array_push($file_list, $tmp_xml);
	$zip->addFile($tmp_xml, "output_" . $count++ . ".xml");
	fclose($temp_xml);
	$i = $i + $ENTRIES_PER_FILE;
}

$zip->close();
save_converted_file($temp, $_FILES['file_input']['name']);

foreach ($file_list as $del_file)
	unlink($del_file);

header('Location: ../common/result.php');

function seperate($data) {
	return explode('$', $data);
}

function init_post() {
	global $owner1, $owner2, $owner3, $station, $refStation1, $refStation2, $instrument;
	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = seperate($_POST['station']);
	$station = $tmp[0];
	$_SESSION['station'] = $tmp[1];
	echo $station;
	$tmp = seperate($_POST['reference_station1']);
	$refStation1 = $tmp[0];
	$_SESSION['refStation1'] = $tmp[1];

	$tmp = seperate($_POST['reference_station2']);
	$refStation2 = $tmp[0];
	$_SESSION['refStation2'] = $tmp[1];

	$tmp = seperate($_POST['instrument']);
	$instrument = $tmp[0];
	$_SESSION['instrument'] = $tmp[1];	
}

function get_millisecond($line) {
	$pos = strpos($line, ',');
	$date = new DateTime(substr($line, 0, 10));
	$hour = intval(substr($line, 11, 2));
	$minute = intval(substr($line, 14, 2));
	$second = intval(substr($line, 17, 2));
	if ($line[19] == '.') {
		$milli = doubleval(substr($line, 20, $pos - 20));
	} else $milli = 0;
	$date->setTime($hour, $minute, $second);
	return strtotime($date->format("Y-m-d H:i:s")) * 100 + $milli;
}

function ok($time, $base_time, $counting_interval) {
	$diff = $time - $base_time;
	return ($diff % $counting_interval == 0);
}

function create_tag($tag_name, $content) {
	return "<$tag_name>". $content."</$tag_name>\r\n";
}

function create_attributes($attributes) {
	$res = '<RSAM-SSAM ';
	foreach ($attributes as $key => $value) if ($value) {
		$res .= " $key=\"" . $value . "\"";
	}
	return $res . ">\r\n";
}

function ElectronicTiltDataset($all_data, $start, $end){
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Deformation>\r\n";
	$result .= '<GPSDataset>' ."\r\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->toXml();
	}
	$result .= "</GPSDataset>\r\n";
	$result .= "</Deformation>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>
