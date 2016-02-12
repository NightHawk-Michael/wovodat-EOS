<?php
session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
}

$turn_on_download = true;

$str = $_SESSION['save_location'];
$pos = strrpos($str, '/');
$file_name = substr($str, $pos + 1);

if ($turn_on_download){
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
header("Content-disposition:attachment; filename=" . $file_name);
}

$location = $_SESSION['save_location'];
readfile($location);
?>