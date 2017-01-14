<?php
include_once "networkevent.php";
$ENTRIES_PER_FILE = 300;
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

$tok = strtok($content, "\r");

init_post();
$earthquake_type = array();
init($tok);
$tok = strtok($content, "\r");
$tok = strtok("\r");
while ($tok!==FALSE){	
	$line = trim($tok);
	$element = substr($line, 0, 10);
	$time = new DateTime($element);
	$line = substr($line, 20);	
	$i = 0;
	while (TRUE) {
		$pos = strpos($line, ',');
		if ($pos === FALSE) $pos = strlen($line);
		$element = trim(substr($line, 0, $pos));
		if ($element) {
			$cnt = intval($element);
			$event = new NetworkEvent($owner1, $owner2, $owner3, $station, $network, $code, $time, $earthquake_type[$i], $cnt);
			if ($event->getCode()!=="") {
				array_push($all_data,$event);
				array_push($day_list, $event->getCode());
			}			
		}
		$i++;
		$line = substr($line, $pos + 1);
		if (!$line) break;
	}
	$tok = strtok("\r");
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
	fwrite($temp_xml,IntervalDataset($all_data,$i,$j));
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
	global $owner1, $owner2, $owner3, $station, $network, $code;
	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = $_POST['station'];
	if ($tmp) {
		$pos = strpos($tmp, '$');
		$station = substr($tmp, 0, $pos);
		$code = $station;
		$_SESSION['station'] = substr($tmp, $pos + 1);
		$_SESSION['network'] = '';
	} else {
		$tmp = $_POST['network'];
		$pos = strpos($tmp, '$');
		$network = substr($tmp, 0, $pos);
		$code = $network;
		$_SESSION['network'] = substr($tmp, $pos + 1);
		$_SESSION['station'] = '';
	}
}

function convert_name_to_code($name) {
	switch ($name) {
		case 'TJ': return 'R_D';
		case 'TL': return 'R_L';
		case 'VA': return 'VT_D';
		case 'VB': return 'VT_S';
		case 'LF': return 'LF';
		case 'Tornillo': return 'LF_T';
		case 'Hybrid': return 'H';
		case 'Tremor': return 'T_G';
		case 'Tremor Harmonik': return 'T_H';
		case 'Awan Panas': return 'PF';
		case 'Hembusan': return 'G';
		case 'Guguran': return 'RF';
		case 'Letusan': return 'E';
		case 'Multiphase': return 'MP';
		case 'Unknown origin': return 'U';
		case 'Other, non volcanic origin': return 'O';
		case 'Undefined': return 'X';
	}
}

function init($first_line)
{
	$tok = strtok($first_line, ',');
	$tok = strtok(',');
	$i = 0;
	while ($tok !== FALSE) {
		global $earthquake_type;
		$earthquake_type[$i++] = convert_name_to_code(trim($tok));
		$tok = strtok(',');
	}
}

function IntervalDataset($all_data, $start, $end){
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version ="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= "<Data>\r\n";
	$result .= "<Seismic>\r\n";
	$result .= '<IntervalDataset>' ."\r\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->toXml();
	}
	$result .= "</IntervalDataset>\r\n";
	$result .= "</Seismic>\r\n";
	$result .= "</Data>\r\n";
	$result .= "</wovoml>\r\n";
	return $result;
}
?>
