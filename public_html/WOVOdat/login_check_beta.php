<?php
// Start session
session_start();
// Regenerate session ID
session_regenerate_id(true);

// Get root url
//$url_root="http://www.wovodat.org/";
$url_root="http://{$_SERVER['SERVER_NAME']}/";

// Get redirect URL
if (isset($_GET['redirect'])) {
	$redirect=$_GET['redirect'];
}
else {
	$redirect='';
}

// Check developers login

// If no username was posted
if (!isset($_POST['uname'])) {
	// Redirect to page
	header('Location: '.$url_root.'login_beta.php');
	exit();
}

// Verify username and password
require_once("php/funcs/db_funcs.php");

// Get username
$uname=trim($_POST['uname']);

// If username was not entered
if ($uname=="") {
	header('Location: '.$url_root.'login_beta.php?redirect='.$redirect.'&attempt=1');
	exit();
}

// Check if the user was registered and get password
$select_table="cr";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cr_pwd";
$select_field_name[1]="cr_id";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cr_uname";
$select_where_field_value[0]=$uname;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1043;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4015;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$num=count($select_field_value);

// If this is a unknown user
if($num==0) {
	// Unknown user
	header('Location: '.$url_root.'login_beta.php?redirect='.$redirect.'&attempt=1');
	exit();
}

// It's a known user
// Verify password
$cr_pwd=$select_field_value[0][0];
$cr_id=$select_field_value[0][1];
if (crypt($_POST['password'], $cr_pwd)!=$cr_pwd || $cr_id!=32) {
	// Wrong password
	header('Location: '.$url_root.'login_beta.php?redirect='.$redirect.'&attempt=1');
	exit();
}

// The user was correctly identified
$_SESSION['dev_login']=TRUE;
$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['HTTP_USER_AGENT']);

// Redirect
header('Location: '.$url_root.$redirect);

?>