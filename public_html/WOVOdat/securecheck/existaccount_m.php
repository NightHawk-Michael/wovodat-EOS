<?php
include 'php/include/db_connect_view.php';

function exist($uname){
	global $link;

	$sql = "SELECT distinct cr.cr_id FROM cr WHERE cr.cr_uname='$uname'";

	$result = mysql_query($sql, $link);
	$num_rows= mysql_num_rows($result);
                                    

	if ($num_rows == 0) // if user is found                   
		$found = "true";
	else
		$found = "false";
 
	return $found;
}

$unameParam = $_POST['uname'];

$chkResult = exist($unameParam);
print ("$chkResult");

?>
