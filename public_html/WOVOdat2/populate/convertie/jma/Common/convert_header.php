<?php

session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
} else {
	$_SESSION['observatory'] = $_POST['owner1'];
	$_SESSION['data_type'] = $_POST['data_type'];
	$_SESSION['station'] = $_POST['station'];
	$_SESSION['instrument'] = $_POST['instrument'];
	$_SESSION['volcano'] = $_POST['volcano'];	
	$_SESSION['station1'] = $_POST['station1'];	
	$_SESSION['station2'] = $_POST['station2'];
}

set_time_limit(10000); 
ini_set("memory_limit","500M");
ini_set("upload_max_filesize","125M");
ini_set("post_max_size","250M");
$original_file_directory = "../../../../../../incoming/to_be_translated/";
$converted_file_directory = "../../../../../../incoming/translated/";

function save_original_file($file, $file_name) {
	global $original_file_directory;
	$save_original_location = $original_file_directory.$file_name;
	if (copy($file, $save_original_location) !== TRUE) {
		exit("Error: Unable to save original file");
	}
}

function save_converted_file($file, $file_name) {
	global $converted_file_directory;
	$save_converted_location = $converted_file_directory.$file_name;
	$_SESSION['save_location'] = $save_converted_location;
	if (copy($file, $save_converted_location) !== TRUE) {
		exit("Error: Unable to save converted file");
	}
}


?>