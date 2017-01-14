<?php

// Help debugging...
ini_set("display_startup_errors", "1");
ini_set("display_errors", "1");
error_reporting(E_ALL);

// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Direct access
if (!isset($_POST['upload_form_ok_home']) && !isset($_POST['upload_form_ok_new'])) {
	// Redirect to welcome page
	header('Location: '.$url_root.'index.php');
	exit();
}

// Get type of data
$datatype=$_GET['type'];

// Check datatype
$datatypes=array();
$datatypes[0]='cc';
$datatypes[1]='co';
$datatypes[2]='cb';
$datatypes[3]='ip_hyd';
$datatypes[4]='ip_mag';
$datatypes[5]='ip_pres';
$datatypes[6]='ip_sat';
$datatypes[7]='ip_tec';
$datatypes[8]='sd_int';
$datatypes[9]='ss';
$n_datatypes=10;
$is_correct=FALSE;
// Look for datatype in array
for ($i=0; $i<$n_datatypes; $i++) {
	// If datatype is in array
	if ($datatype==$datatypes[$i]) {
		$is_correct=TRUE;
		break;
	}
}
// If datatype was not found, redirect to home page
if (!$is_correct) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get posted fields, store them in session and check them
require_once "php/include/upload_form/".$datatype."_check_form.php";

// If there is an error, redirect to upload form
if ($has_error) {
	// Redirect to upload form
	header('Location: '.$url_root.'upload_form.php?type='.$datatype);
	exit();
}

// Upload data
require_once "php/include/upload_form/".$datatype."_upload.php";

// Upload was successful
$_SESSION['upload_form']['upload_ok']=TRUE;

// Unset session data
unset($_SESSION['upload_form'][$datatype]);


// Redirect to upload form (new data)
if (isset($_POST['upload_form_ok_new'])) {
	// Redirect to upload form
	header('Location: '.$url_root.'upload_form.php?type='.$datatype);
	exit();
}

// Redirect to home page
header('Location: '.$url_root.'home_populate.php');

?>