<?php

// Include PEAR DB package
require_once("DB.php");
/*
function db_connect(){
	$dbUser = "wovodat";
	$dbPass = "+62Nusantara";
	$dbHost = "127.0.0.1:3307";
	$dbName = "wovodat";
	$dbType = "mysql";
	$dsn = "$dbType://$dbUser:$dbPass@$dbHost/$dbName";
	$conn = DB::connect($dsn);
	mysql_query("SET NAMES 'utf8'");
	
	if (DB::isError($conn)){
        	die($conn->getMessage());
	}
	return $conn;
} */

function db_connect(){
	$dbUser = "root";
	$dbPass = "1234567";
	$dbHost = "localhost";
	$dbName = "wovodat";
	$dbType = "mysql";
	$dsn = "$dbType://$dbUser:$dbPass@$dbHost/$dbName";
	$conn = DB::connect($dsn);
	mysql_query("SET NAMES 'utf8'");
	
	if (DB::isError($conn)){
        	die($conn->getMessage());
	}
	return $conn;
}

?>
