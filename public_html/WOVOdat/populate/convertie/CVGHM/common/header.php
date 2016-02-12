<?php
session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
} else {
	$_SESSION['observatory'] = $_POST['owner1'];
	$_SESSION['data_type'] = $_POST['data_type'];
	$_SESSION['volcano'] = $_POST['volcano'];
	$_SESSION['station_network'] = $_POST['station_network'];
	$_SESSION['file_name'] = $_FILES['file_input']['name'];
	$_SESSION['file_size'] = $_FILES['file_input']['size'];
}

$original_file_directory = "../../../../../../incoming/to_be_translated/";
$converted_file_directory = "../../../../../../incoming/translated/";

//set php parameters (execution time limit: 100s, upload_max_filesize and post_max_size:1000MB)
set_time_limit(10000); 
ini_set("memory_limit","500M");
ini_set("upload_max_filesize","125M");
ini_set("post_max_size","250M");

function save_original_file($file, $file_name) {
	$save_original_location = get_new_original_file_name($file_name);
	if (copy($file, $save_original_location) !== TRUE) {
		exit("Error: Unable to save original file");
	}
}

function save_converted_file($file, $file_name) {
	$save_converted_location = get_new_converted_file_name($file_name);
	$_SESSION['save_location'] = $save_converted_location;
	if (copy($file, $save_converted_location) !== TRUE) {
		exit("Error: Unable to save converted file");
	}
}

function get_new_original_file_name($file_name) {
	$pos = strrpos($file_name, '.');
	if ($pos !== FALSE) {
		$suffix = substr($file_name, $pos);
	} else {
		$suffix = '';
		$pos = strlen($file_name);
	}
	$prefix = substr($file_name, 0, $pos);
	global $original_file_directory;
	return $original_file_directory . $prefix . '_cvghm_' . date("Ymd") . $suffix;
}

function get_new_converted_file_name($file_name) {
	$pos = strrpos($file_name, '.');
	if ($pos === FALSE) $pos = strlen($file_name);
	$prefix = substr($file_name, 0, $pos);
	global $converted_file_directory;
	return $converted_file_directory . $prefix . '_cvghm_' . date("Ymd") . '.zip';
}
?>
