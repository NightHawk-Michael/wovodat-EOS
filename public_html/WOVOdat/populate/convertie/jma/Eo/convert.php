<?php
//echo "<script>console.log(0)</script>";
include_once "NetworkEvent_sd_evs.php";
include_once "NetworkEvent_sd_trm.php";
include_once "../Common/convert_header.php";

$trm = array(
	'T'=>'ok',
	'TC'=>'ok',
	'TK'=>'ok',
	'TP'=>'ok',
	'Tex'=>'ok'
	);

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


	$all_data_evs = array();
	$all_data_trm = array();

	foreach ($lines as $key => $value) {
		if ($key<4) continue;
		$data = explode(",", $value);
		foreach ($data as $k => $v) {
			$data[$k] = trim($v);
		}
		if (!Analysis($data[7],$data[3])) continue;
		//echo '<script>console.log("Unit'.$data[26].'");</script>';
		if (array_key_exists($data[6], $trm)) 
			//$year, $month, $day, $hour, $minute, $type,$ss_code,$Okind,$P_time,$SP,$Mz,$Unit,$Remark
			array_push($all_data_trm, new NetworkEvent_sd_trm($data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[10],$data[15],$data[24],$data[26],$data[27]));
		else
			//$year, $month, $day, $hour, $minute, $type,$ss_code,$Okind,$P_time,$S_time,$SP,$Dur,$Pz,$Mz,$Unit, $Remark
			array_push($all_data_evs, new NetworkEvent_sd_evs($data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[10],$data[12],$data[15],$data[16],$data[19],$data[24],$data[26],$data[27]));
	}

	// write output data
	if (count($all_data_trm)>0) {
		$tmp_xml = tempnam(".","");
		$temp_xml = fopen($tmp_xml,"w");
		fwrite($temp_xml, TremorDataset($all_data_trm,0,count($all_data_trm)-1) );
		$zip->addFile($tmp_xml, "Eo_".$volcano.'_'.$date.'_sd_trm'.'.xml');
		fclose($temp_xml);
	}

	if (count($all_data_evs)>0) {
		$tmp_xml = tempnam(".","");
		$temp_xml = fopen($tmp_xml,"w");
		fwrite($temp_xml, SingleStationEventDataset($all_data_evs,0,count($all_data_evs)-1) );
		$zip->addFile($tmp_xml, "Eo_".$volcano.'_'.$date.'_sd_evs'.'.xml');
		fclose($temp_xml);
	}

	fclose($handle);

	
}

// close zip file and save output
$zip->close();
save_converted_file($temp, "Eo_".$volcano.".zip");

// save original file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	$file = $_FILES['file_input']['tmp_name'][$i];
	$zip->addFile($file, $filename);
}
$zip->close();
save_original_file($temp, "Eo_".$volcano.".zip");


$_SESSION["error_list"] = array_unique($ds_error_list);

header('Location: ../Common/convert_result.php');

function init_data() {
	global $owner1, $volcano;

	$owner1 = $_POST['owner1'];

	$tmp = $_POST['volcano'];
	$arr = explode('$', $tmp);
	$volcano = $arr[1];
	$_SESSION['volcano'] = $volcano;
}

function SingleStationEventDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8" ?>'. "\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.1.0" xsi:schemaLocation="http://www.org/WOVOdatV1.xsd">' . "\n";
	$result .= " <Data>\n";
	$result .= "  <Seismic>\n";
	$result .= '   <SingleStationEventDataset>' ."\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </SingleStationEventDataset>\n";
	$result .= "  </Seismic>\n";
	$result .= " </Data>\n";
	$result .= "</wovoml>\n";
	return $result;
}

function TremorDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8" ?>'. "\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.1.0" xsi:schemaLocation="http://www.org/WOVOdatV1.xsd">' . "\n";
	$result .= " <Data>\n";
	$result .= "  <Seismic>\n";
	$result .= '   <TremorDataset>' ."\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </TremorDataset>\n";
	$result .= "  </Seismic>\n";
	$result .= " </Data>\n";
	$result .= "</wovoml>\n";
	return $result;
}

function Analysis($ss_code,$day) {
	global $ds_error_list;
	require_once('../../../../../../PEAR/php/include/db_connect.php');
	//echo '<script>console.log("ss_code='.$ss_code.' day='.$day.'");</script>';
	$link = "select distinct ss_id from ss where ss_code = '$ss_code'";
	$row = mysql_query($link);

	$c = 0;
	while ($data = mysql_fetch_array($row)) {
		$c++;
	}

	if ($c==0) { 
		array_push($ds_error_list, $ss_code);
		//echo '<script>console.log("ss_code fail '.$ss_code.'");</script>';
	}
	if ($c==0) return false;
	return true;
}

?>