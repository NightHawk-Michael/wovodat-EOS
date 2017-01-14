<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');
$query = "SELECT cs_id, cs_code, cs.cc_id, cs_name FROM cs ORDER BY cs_name";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Station</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[3]' cs_id='$property[0]' cc_id='$property[2]'>$property[3]</option>";
}	
?>