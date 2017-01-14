<?php
require_once('php/include/db_connect.php');
$gs_code = $_POST['gs_code'];
$query = "SELECT gi_id, gi_code, gi.cc_id FROM gi, gs WHERE gi.gs_id = gs.gs_id AND gs.gs_code = \"$gs_code\" ORDER BY gi_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Instrument</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' gi_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>