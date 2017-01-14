<?php
//echo "<script>console.log(0)</script>";
include_once "network_event.php";
include_once "../Common/convert_header.php";



//create zip for output 
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);

init_data();
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	// open file and read data
	$file = $_FILES['file_input']['tmp_name'][$i];
	$handle = fopen($file,"r");
	$content = fread($handle, filesize($file));

	$arr = explode('_', $filename);
	$arr2 = explode(".", $arr[1]);
	$date = $arr2[0]; 

	// process input data
	$all_data = array();
	$lines = explode("\n",$content);
	foreach ($lines as $key => $value) {
		if ($key<7) continue;
		if (!$value) continue; 
		$data = explode(",", $value);
		array_push($all_data, new NetworkEvent($owner1, $owner2, $owner3, $volcano, $station, $station_code, $instrument, $data[0], $data[1], $data[2], $data[4], $data[3])  );
	}
	fclose($handle);

	// write output data
	$tmp_xml = tempnam(".","");
	$temp_xml = fopen($tmp_xml,"w");
	fwrite($temp_xml, ElectronicTiltDataset($all_data,0,count($all_data)-1) );
	$zip->addFile($tmp_xml, "Gt_".$volcano.'_'.$station_code.'_'.$date.'.xml');
	fclose($temp_xml);
}

// close zip file and save output
$zip->close();
save_converted_file($temp, "Gt_".$volcano.'_'.$station_code);

// save original file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	$file = $_FILES['file_input']['tmp_name'][$i];
	$zip->addFile($file, $filename);
}
$zip->close();
save_original_file($temp, "Gt_".$volcano.'_'.$station_code);

header('Location: ../Common/convert_result.php');

function init_data() {
	global $owner1, $owner2, $owner3, $volcano, $station, $instrument,$station_code;

	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = $_POST['volcano'];
	$arr = explode('$', $tmp);
	$volcano = $arr[1];
	$_SESSION['volcano'] = $volcano;

	$tmp = $_POST['station'];
	$arr = explode('$', $tmp);
	$station = $arr[1];
	$station_code  = $arr[2];
	$_SESSION['station'] = $station;

	$tmp = $_POST['instrument'];
	$arr = explode('$', $tmp);
	$instrument = $arr[2];
	$_SESSION['instrument'] = $instrument;
}

function ElectronicTiltDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8"?>'. "\r\n";
	$result .= '<wovoml pubDate="2001-12-31 12:00:00" version ="1.1.0" xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">' . "\r\n";
	$result .= " <Data>"."\r\n";
	$result .= "  <Deformation>"."\r\n";
	$result .= '   <ElectronicTiltDataset>' ."\r\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </ElectronicTiltDataset>"."\r\n";
	$result .= "  </Deformation>"."\r\n";
	$result .= " </Data>"."\r\n";
	$result .= "</wovoml>"."\r\n";
	return $result;
}

?>