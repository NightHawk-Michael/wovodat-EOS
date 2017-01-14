<?php

/**********************************

This script does the "undo" operation for a selected upload.
After everything went well, it redirects to undo_upload_success.php.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// If "cancel" button was pressed
if (isset($_POST['undo_upload_confirm_cancel'])){
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Check direct access
if (!isset($_POST['undo_upload_confirm_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get posted information
$selected_id=$_POST['file_id'];
$selected_file=$_POST['file_name'];
$selected_date=$_POST['file_date'];
$selected_loader=$_POST['file_loader'];

// Get datetime of upload
$year=substr($selected_date, 0, 4);
$month=substr($selected_date, 5, 2);
$day=substr($selected_date, 8, 2);
$hour=substr($selected_date, 11, 2);
$min=substr($selected_date, 14, 2);
$sec=substr($selected_date, 17, 2);
$upload_time=$year.$month.$day.$hour.$min.$sec;

// Get undo file name (from original file name)
$dot_pos=strrpos($selected_file, ".");
$file_name_no_ext=substr($selected_file, 0, $dot_pos);

// Undo file URL
$undo_file="/home/wovodat/incoming/processed/undo/".$selected_loader."_".$upload_time."_".$file_name_no_ext."_undo.xml";

// WOVOML functions
require_once "php/funcs/wovoml_funcs.php";

// Undo upload
if (!wovoml_undo($undo_file, $undo_error)) {
	// Prepare error message
	$_SESSION['errors']=array();
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['message']=substr($undo_error, 2);
	$_SESSION['l_errors']=1;
	
	switch (substr($undo_error, 0, 1)) {
		case "1":
			// System error
			$_SESSION['errors'][0]['code']=1999;
			header('Location: '.$url_root.'system_error.php');
			exit();
		case "2":
		case "3":
			// Server error
			$_SESSION['errors'][0]['code']=2999;
			header('Location: '.$url_root.'server_error.php');
			exit();
		case "4":
			// System error
			$_SESSION['errors'][0]['code']=4999;
			header('Location: '.$url_root.'db_error.php');
			exit();
		default:
			// System error
			$_SESSION['errors'][0]['code']=1998;
			header('Location: '.$url_root.'system_error.php');
			exit();
	}
}

// Delete undo file
if (!unlink($undo_file)) {
	// Server error
	$_SESSION['errors']=array();
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=2999;
	$_SESSION['errors'][0]['message']="An error occurred when trying to delete ".$undo_file;
	$_SESSION['l_errors']=1;
	header('Location: '.$url_root.'server_error.php');
	exit();
}

// Move data file to "undone"
$file_name="/home/wovodat/incoming/processed/original/".$selected_loader."_".$upload_time."_".$selected_file;
$move_file_name="/home/wovodat/incoming/undone/".$selected_loader."_".$upload_time."_".$selected_file;
if (!rename($file_name, $move_file_name)) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1151;
	$_SESSION['errors'][0]['message']="wovoml.php -> rename(file_name=".$file_name.", move_file_name=".$move_file_name.")]";
	$_SESSION['l_errors']=1;
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// Database functions
require_once "php/funcs/db_funcs.php";

// Update row in C15 - Upload history table (cu)
$update_table_name="cu";
$update_field_name=array();
$update_field_name[0]="cu_type";
$update_field_value=array();
$update_field_value[0]="U";
$update_where_field_name=array();
$update_where_field_name[0]="cu_id";
$update_where_field_value=array();
$update_where_field_value[0]=$selected_id;
$errors="";
if (!db_update($update_table_name, $update_field_name, $update_field_value, $update_where_field_name, $update_where_field_value, FALSE, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1131;
			$_SESSION['errors'][0]['message']=$errors." to db_update()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4044;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}

// Redirect to "undo success" page
header('Location: '.$url_root.'undo_upload_success.php');
exit();

?>