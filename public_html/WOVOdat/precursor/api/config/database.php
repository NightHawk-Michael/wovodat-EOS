<?php
	
//	class Database{
//
//		const HOST_NAME = 'localhost';
//		const USERNAME = 'root';
//		const PASSWORD = '1234567';
//		const DB_NAME = 'Nang';
//
//		private $_dbconnection;
//		private $_db;
//
//		/* Constructor */
//		function __construct(){
//
//			// Connect with database server
//			$this->_dbconnection = mysql_connect('localhost', 'root', '')
//				or die(mysql_error());
//
//			// Some settings
//			mysql_query("SET CHARACTER SET utf8", $this->_dbconnection);
//			mysql_query("SET NAMES utf8", $this->_dbconnection);
//
//			// Connect with database name
//			$this->_db = mysql_select_db("Nang",$this->_dbconnection)
//  				or die("Could not connect Nang");
//		}
//
//		/* Query database */
//		public function query($query_string){
//			$result = array();
//			// Query database
//			$result = mysql_query($query_string);
//        	$row = mysql_fetch_array($result);
//			return $row;
//		}
//	}
?>