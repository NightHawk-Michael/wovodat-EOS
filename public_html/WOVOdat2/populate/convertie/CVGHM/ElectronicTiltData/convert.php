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
save_original_file($file, $_FILES['file_input']['name']);

init_post();
$tok = strtok($content, "\n");
$tok = strtok("\n");
$tok = strtok("\n");
$flag = false;
while ($tok!==FALSE){	
	$line = trim($tok);
	$time = get_millisecond($line);
	if ($line) {
		if ($flag) {
			$step = min($step, $time - $last);
		} else $base_time = $time;
		$last = $time;
		$flag = true;
	}
	$tok = strtok("\n");
}

if ($counting_interval == 1) $counting_interval = $step;

$tok = strtok($content, "\n");
$tok = strtok("\n");
$tok = strtok("\n");

while ($tok!==FALSE){	
	$line = trim($tok);
	if ($line) {
		$time = get_millisecond($line);
		if (ok($time, $base_time, $counting_interval)) {
			$event = new NetworkEvent($owner1, $owner2, $owner3, $station, $instrument, $process_type, $line, $counting_interval);
			array_push($all_data, $event);
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

function init_post() {
	global $owner1, $owner2, $owner3, $station, $instrument, $counting_interval, $step, $process_type;
	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = $_POST['station'];
	$pos = strpos($tmp, '$');
	$station = substr($tmp, 0, $pos);
	$_SESSION['station'] = substr($tmp, $pos + 1);

	$tmp = $_POST['instrument'];
	$pos = strpos($tmp, '$');
	$instrument = substr($tmp, 0, $pos);
	$_SESSION['instrument'] = substr($tmp, $pos + 1);

	$counting_interval = $_POST['counting_interval'] * 100;
	if ($counting_interval < 0) {
		$counting_interval = 1;
		$step = 1000000000;
	} else $step = $counting_interval;

	$process_type = $_POST['process_type'];
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

function ElectronicTiltDataset($all_data, $start, $end){
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Deformation>\r\n";
	$result .= '<ElectronicTiltDataset>' ."\r\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->toXml();
	}
	$result .= "</ElectronicTiltDataset>\r\n";
	$result .= "</Deformation>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>
