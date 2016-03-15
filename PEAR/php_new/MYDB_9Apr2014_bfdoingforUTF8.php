<?php

// Include PEAR DB package
require_once("DB.php");

function db_connect(){
	$dbUser = "wovodat";
	$dbPass = "+62Nusantara";
	$dbHost = "127.0.0.1:3307";
	$dbName = "wovodat";
	$dbType = "mysql";
	$dsn = "$dbType://$dbUser:$dbPass@$dbHost/$dbName";
	$conn = DB::connect($dsn);
	if (DB::isError($conn)){
        	die($conn->getMessage());
	}
	return $conn;
}

?>
