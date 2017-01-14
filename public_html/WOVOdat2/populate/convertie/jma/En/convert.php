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
	fclose($handle);

	$arr = explode('_', $filename);
	$arr2 = explode(".", $arr[1]);
	$date = $arr2[0]; 

	$lines_tmp = explode("\n",$content);
	$lines = array();
	foreach ($lines_tmp as $key => $value) 
		if (trim($value)) array_push($lines, $value);

	$line_3 = explode(",", $lines[3]);
	$ss_code = trim($line_3[1]); 

	if (!Analysis($ss_code)) continue;

	$line_4 = explode(",", $lines[4]);
	$description = trim($line_4[1]);

	$line_5 = explode(",", $lines[5]);

	$all_data = array();

	echo "<script>console.log('A');</script>";
	foreach ($line_5 as $i => $type) {  //word with each column
		if ($i<3) continue;
		if (trim($type)=="Total") break;
		// process input data
		
		foreach ($lines as $key => $value) {
			if ($key<6) continue;
			$data = explode(",", $value);
			//$ss_code, $type, $year, $month, $day, $number, $description
			array_push($all_data, new NetworkEvent($ss_code, trim($type), trim($data[0]), trim($data[1]) , trim($data[2]),trim($data[$i]),$description)  );
		}
	}
	echo "<script>console.log('B');</script>";
	$tmp_xml = tempnam(".","");
	$temp_xml = fopen($tmp_xml,"w");
	fwrite($temp_xml, IntervalDataset($all_data,0,count($all_data)-1) );
	$zip->addFile($tmp_xml, "En_".$volcano.'_'.$ss_code.'_'.$date.'.xml');
	fclose($temp_xml);
	echo "<script>console.log('C');</script>";
	
}
echo "<script>console.log('D');</script>";
// close zip file and save output
$zip->close();
save_converted_file($temp, "En_".$volcano.".zip");

// save original file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	$file = $_FILES['file_input']['tmp_name'][$i];
	$zip->addFile($file, $filename);
}
$zip->close();
save_original_file($temp, "En_".$volcano.".zip");


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

function IntervalDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8" ?>'. "\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.1.0" xsi:schemaLocation="http://www.org/WOVOdatV1.xsd">' . "\n";
	$result .= " <Data>\n";
	$result .= "  <Seismic>\n";
	$result .= '   <IntervalDataset>' ."\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </IntervalDataset>\n";
	$result .= "  </Seismic>\n";
	$result .= " </Data>\n";
	$result .= "</wovoml>\n";
	return $result;
}

function Analysis($ss_code) {
	global $ds_error_list;
	require_once('../../../../../../PEAR/php/include/db_connect.php');

	$link = "select distinct ss_id from ss where ss_code = '$ss_code'";
	$row = mysql_query($link);

	$c = 0;

	while ($data = mysql_fetch_array($row))
		$c++;

	if ($c==0) array_push($ds_error_list, $ss_code);

	if ($c==0) return false;
	return true;
}

?>