<?php
//echo "<script>console.log(0)</script>";
include_once "network_event.php";
include_once "../Common/convert_header.php";
$max_entries = 500;


//create zip for output 
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
//echo "<script>console.log('B');</script>";
init_data();
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	// open file and read data
	$file = $_FILES['file_input']['tmp_name'][$i];
	$handle = fopen($file,"r");
	$content = fread($handle, filesize($file));
	fclose($handle);

	$arr = explode('.', $filename);
	$name = $arr[0]; 

	// process input data
	
	$lines = explode("\n",$content);
	//echo "<script>console.log('A');</script>";
	$num = 0;
	$count=0;
	$all_data = array();
	foreach ($lines as $key => $value) {
		if (!$value) continue; 
		array_push($all_data, new NetworkEvent( $network, '_'.$value )  );
		$num++;
		if ($num==$max_entries) {
			$tmp_xml = tempnam(".","");
			$temp_xml = fopen($tmp_xml,"w");
			fwrite($temp_xml, NetworkEventDataset($all_data,0,count($all_data)-1));
			$zip->addFile($tmp_xml, $name.'_'. $count .'.xml');
			fclose($temp_xml);
			$count++;
			$num=0;
			$all_data = array();
		}
	}
	if ($num>0) {
		$tmp_xml = tempnam(".","");
		$temp_xml = fopen($tmp_xml,"w");
		fwrite($temp_xml, NetworkEventDataset($all_data,0,count($all_data)-1) );
		$zip->addFile($tmp_xml, $name.'_'. $count .'.xml');
		fclose($temp_xml);
		$count++;
		$num=0;
		$all_data = array();
	}
	
	
}

// close zip file and save output
$zip->close();
save_converted_file($temp, "H_".$network);

// save original file
$temp = tempnam(".","");
$zip = new ZipArchive();
$zip->open($temp, ZipArchive::CREATE);
foreach ($_FILES['file_input']['name'] as $i => $filename) {
	$file = $_FILES['file_input']['tmp_name'][$i];
	$zip->addFile($file, $filename);
}
$zip->close();
save_original_file($temp, "H_".$network);

header('Location: ../Common/convert_result.php');

function init_data() {
	global $owner1, $owner2, $volcano, $network, $network_code;

	$owner1 = $_POST['owner1'];
	$owner2 = $_POST['owner2'];

	$tmp = $_POST['network'];
	$arr = explode('$', $tmp);
	$network = $arr[1];
	$network_code  = $arr[2];
	$_SESSION['network'] = $network;

}

function NetworkEventDataset($all_data,$start,$end) {
	$result = '<?xml version="1.0" encoding="UTF-8" ?>'. "\n";
	$result .= '<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">'."\n";
	$result .= " <Data>\n";
	$result .= "  <Seismic>\n";
	$result .= '   <NetworkEventDataset>' ."\n";
	for ($i=$start;$i<=$end;$i++){
		$result = $result . $all_data[$i]->ToXml();
	}
	$result .= "   </NetworkEventDataset>\n";
	$result .= "  </Seismic>\n";
	$result .= " </Data>\n";
	$result .= "</wovoml>\n";
	return $result;
}

?>