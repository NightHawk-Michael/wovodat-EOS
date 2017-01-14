<?php
require_once('php/include/db_connect.php');
$ms_code = $_POST['ms_code'];
$query = "SELECT mi_id, mi_code, mi.cc_id FROM mi, ms WHERE mi.ms_id = ms.ms_id AND ms.ms_code = \"$ms_code\" ORDER BY mi_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Instrument</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' mi_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>