<?php

/**********************************

This script is for connecting to the database with FULL permissions (INSERT, UPDATE, SELECT...).

**********************************/

$link=mysql_connect("127.0.0.1:3307", "wovodat", "+62Nusantara") or die(mysql_error());
mysql_query("SET CHARACTER SET utf8",$link);
mysql_query("SET NAMES utf8",$link);
mysql_select_db("wovodat") or die(mysql_error());

?>