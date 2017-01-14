<?php
$ENTRIES_PER_FILE = 1000;
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

$tok = strtok($content, "\n");

init_post();

$base_time = get_time(trim($tok));

$flag = false;
while ($tok!==FALSE){	
	$line = trim($tok);
	if ($line) {
		$time = get_time($line);
		if ($flag) {
			$step = min($step, strtotime($time->format("Y-m-d H:i:s")) - strtotime($last->format("Y-m-d H:i:s")));
		}
		$last = $time;
		$flag = true;
		if (ok($time, $base_time, $counting_interval)) {
			$cnt = doubleval(substr($line, 22));
			array_push($all_data, array($time, $cnt));	
		}
	}
	$tok = strtok("\n");
}

if ($counting_interval == 1) $counting_interval = $step;
fclose($handle);
$i = 0;
$count = 1;
while ($i<count($all_data)){
	$tmp_xml = tempnam(".","");
	$temp_xml = fopen($tmp_xml,"w");
	$j = $i + $ENTRIES_PER_FILE -1;
	if ($j>=count($all_data))
		$j = count($all_data)-1;
	fwrite($temp_xml, RSAMDataset($all_data,$i,$j));
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
	global $owner1, $owner2, $owner3, $station, $counting_interval, $code, $step;
	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = $_POST['station'];
	$pos = strpos($tmp, '$');
	$station = substr($tmp, 0, $pos);
	$code = $station;
	$_SESSION['station'] = substr($tmp, $pos + 1);

	$counting_interval = $_POST['counting_interval'] * 60;
	if ($counting_interval < 0) {
		$counting_interval = 1;
		$step = 10000;
	} else $step = $counting_interval;
	$code = $_POST['RSAMSSAM_code'];
}

function get_time($line) {
	$date = new DateTime(substr($line, 0, 11));
	$hour = intval(substr($line, 12, 2));
	$minute = intval(substr($line, 15, 2));
	$second = intval(substr($line, 18, 2));
	$date->setTime($hour, $minute, $second);
	return $date;
}

function ok($time, $base_time, $counting_interval) {
	$diff = strtotime($time->format("Y-m-d H:i:s")) - strtotime($base_time->format("Y-m-d H:i:s"));
	return ($diff % $counting_interval == 0);
}

function create_tag($tag_name, $content) {
	return "<$tag_name>". $content."</$tag_name>\r\n";
}

function get_string($x, $s) {
	$res = ' ' . $x . ' ' . $s;
	if ($x > 1) $res .= 's';
	return $res;
}

function time_to_string($step) {
	$result = "";
	$hour = floor($step/3600);
	if ($hour) $result .= get_string($hour, "hour");
	$step %= 3600;
	$minute = floor($step/60);
	if ($minute) $result .= get_string($minute, "minute");
	$step %= 60;
	if ($step) $result .= get_string($step, "second");
	return trim($result);
/*	switch ($res) {
		case 1: return "1 minute";
		case 10: return "10 minutes";
		case 20: return "20 minutes";
		case 30: return "30 minutes";
		case 60: return "1 hour";
		case 120: return "2 hours";
	}*/
}

function create_attributes($attributes) {
	$res = '<RSAM-SSAM ';
	foreach ($attributes as $key => $value) if ($value) {
		$res .= " $key=\"" . $value . "\"";
	}
	return $res . ">\r\n";
}

function RSAMDataset($all_data, $start, $end){
	global $code, $station, $owner1, $owner2, $owner3, $counting_interval;
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Seismic>\r\n";
	$result .= '<RSAM-SSAMDataset>' ."\r\n";
	$result .= create_attributes(array('code'=> $code, 'station'=>$station, 'owner1'=>$owner1, 'owner2'=>$owner2, 'owner3'=>$owner3));
	$result .= create_tag('startTime', $all_data[$start][0]->format("Y-m-d H:i:s"));
	$offset = new DateInterval('PT' . $counting_interval. 'S');
	$tmp = new DateTime($all_data[$end][0]->format("Y-m-d H:i:s"));
	$result .= create_tag('endTime', $tmp->add($offset)->format("Y-m-d H:i:s"));
	$result .= create_tag('cntInterval', $counting_interval);
	$result .= create_tag('orgDigitize', "O");
	$result .= create_tag('comments', time_to_string($counting_interval). ' interval RSAM');
	$result .= '<RSAM>' . "\r\n";
	for ($i=$start;$i<=$end;$i++) {
		$result .= "<RSAMData>\r\n";
		$result .= create_tag('startTime', $all_data[$i][0]->format("Y-m-d H:i:s"));
		$result .= create_tag('cnt', $all_data[$i][1]);
		$result .= "</RSAMData>\r\n";
	}
	$result .= "</RSAM>\r\n";
	$result .= "</RSAM-SSAM>\r\n";
	$result .= "</RSAM-SSAMDataset>\r\n";
	$result .= "</Seismic>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>
