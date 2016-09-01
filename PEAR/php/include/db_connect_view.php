<?php

/**********************************

This script is for connecting to the database with RESTRICTED permissions (SELECT only, no INSERT or UPDATE).

**********************************/

//$link=mysql_connect("127.0.0.1:3307", "wovodat_view", "+00World") or die(mysql_error());

$link=mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_query("SET CHARACTER SET utf8",$link);
mysql_query("SET NAMES utf8",$link);
mysql_select_db("wovodat") or die(mysql_error());

?>
