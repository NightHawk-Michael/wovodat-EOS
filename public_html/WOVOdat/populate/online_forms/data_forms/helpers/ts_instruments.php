<?php
require_once('php/include/db_connect.php');
$ts_code = $_POST['ts_code'];
$query = "SELECT ti_id, ti_code, ti.cc_id FROM ti, ts WHERE ti.ts_id = ts.ts_id AND ts.ts_code = \"$ts_code\" ORDER BY ti_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Instrument</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' ti_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>