<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');
$vd_name = $_POST['vd_name'];
$query = "SELECT cs_id, cs_code, cs.cc_id FROM cs ORDER BY cs_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Station</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' cs_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>