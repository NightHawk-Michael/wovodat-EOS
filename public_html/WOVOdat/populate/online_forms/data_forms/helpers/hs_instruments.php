<?php
require_once('php/include/db_connect.php');
$hs_code = $_POST['hs_code'];
$query = "SELECT hi_id, hi_code, hi.cc_id FROM hi, hs WHERE hi.hs_id = hs.hs_id AND hs.hs_code = \"$hs_code\" ORDER BY hi_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Instrument</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' hi_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>