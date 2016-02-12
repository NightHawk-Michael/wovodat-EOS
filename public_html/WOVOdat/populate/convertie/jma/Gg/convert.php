<?php
//echo "<script>console.log(0)</script>";
include_once "network_event.php";
include_once "../Common/convert_header.php";



//create zip for output 
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);

init_data();
$ds_error_list = array();

foreach ($_FILES['file_input']['name'] as $i => $filename) {
	// open file and read data
	$file = $_FILES['file_input']['tmp_name'][$i];
	$handle = fopen($file,"r");
	$content = fread($handle, filesize($file));

	$arr = explode('_', $filename);
	$arr2 = explode(".", $arr[1]);
	$date = $arr2[0]; 

	$lines_tmp = explode("\n",$content);
	$lines = array();
	foreach ($lines_tmp as $key => $value) 
		if (trim($value)) array_push($lines, $value);

	$line_5 = explode(",", $lines[5]);
	foreach ($line_5 as $i => $station1_station2) {  //word with each column
		if ($i<3) continue;
		if (!Analysis($station1_station2)) continue;
		// process input data
		$all_data = array();
		foreach ($lines as $key => $value) {
			if ($key<6) continue;
			$data = explode(",", $value);
			$data[$i] = trim($data[$i]);
			if (is_numeric($data[$i]))
				array_push($all_data, new NetworkEvent($owner1, $owner2, $owner3, $volcano, $ds_code1, $ds_code2, $instrument, $data[0], $data[1], $data[2], $data[$i])  );
		}
		if (count($all_data)==0) continue;

		// write output data
		$tmp_xml = tempnam(".","");
		$temp_xml = fopen($tmp_xml,"w");
		fwrite($temp_xml, GPSDataset($all_data,0,count($all_data)-1) );
		$zip->addFile($tmp_xml, "Gg_".$volcano.'_'.$ds_code1.'_'.$ds_code2.'_'.$date.'.xml');
		fclose($temp_xml);

	}

	fclose($handle);

	
}

// close zip file and save output
$zip->close();
save_converted_file($temp, "Gg_".$volcano.".zip");

// save original file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	$file = $_FILES['file_input']['tmp_name'][$i];
	$zip->addFile($file, $filename);
}
$zip->close();
save_original_file($temp, "Gg_".$volcano.".zip");


$_SESSION["error_list"] = array_unique($ds_error_list);

header('Location: ../Common/convert_result.php');

function init_data() {
	global $owner1, $owner2, $owner3, $volcano;

	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];
	$owner3 = $_POST['owner3'];

	$tmp = $_POST['volcano'];
	$arr = explode('$', $tmp);
	$volcano = $arr[1];
	$_SESSION['volcano'] = $volcano;
}

function GPSDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8" ?>'. "\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.1.0" xsi:schemaLocation="http://www.org/WOVOdatV1.xsd">' . "\n";
	$result .= " <Data>\n";
	$result .= "  <Deformation>\n";
	$result .= '   <GPSDataset>' ."\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </GPSDataset>\n";
	$result .= "  </Deformation>\n";
	$result .= " </Data>\n";
	$result .= "</wovoml>\n";
	return $result;
}

function Analysis($station1_station2) {
	$data = explode("-", trim($station1_station2));
	global $ds_code1, $ds_code2, $ds_id, $instrument,$ds_error_list;
	$ds_code1 = $data[0];
	$ds_code2 = $data[1];
	require_once('../../../../../../PEAR/php/include/db_connect.php');

	$link = "select distinct ds_id from ds where ds_code = '$ds_code1'";
	$row = mysql_query($link) or die (mysql_error());

	$link = "select distinct ds_id from ds where ds_code = '$ds_code2'";
	$row2 = mysql_query($link) or die (mysql_error());

	$c1 = 0;
	$c2 = 0;

	while ($data = mysql_fetch_array($row)) {
		$c1++;
		$ds_id = $data[0];
	}

	while ($data = mysql_fetch_array($row2))
		$c2++;

	if ($c1==0) array_push($ds_error_list, $ds_code1);
	if ($c2==0) array_push($ds_error_list, $ds_code2); 

	if ($c1==0 || $c2==0) return false;

	

	$link = "select distinct di_gen.di_gen_code from di_gen where ( di_gen.di_gen_type='CGPS' or di_gen.di_gen_type='GPS' ) and di_gen.ds_id = '$ds_id'";
	$row = mysql_query($link) or die (mysql_error());
	while ($data = mysql_fetch_array($row))
		$instrument = $data[0];

	return true;
}

?>