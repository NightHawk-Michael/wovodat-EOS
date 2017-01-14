<?php
	require_once('php/include/db_connect.php');
	// Start session
	session_start();

	// Regenerate session ID
	session_regenerate_id(true);

	// Get root url
	require_once "php/include/get_root.php";

	if(!isset($_SESSION['login'])) {
		header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
		exit();
	}
	global $link;
	$data = $_POST['info'];
	$sql = $data['sql'];
	$res = mysql_query($sql, $link);
	if(!$res)echo 'Error!';
	else echo 'Replaced!';
	mysql_close($link);	
?>
