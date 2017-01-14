<?php
require_once('php/include/db_connect.php');
$ds_code = $_POST['ds_code'];
$query = "SELECT di_gen_id, di_gen_code, di_gen.cc_id FROM di_gen, ds WHERE di_gen.ds_id = ds.ds_id AND ds.ds_code = \"$ds_code\" ORDER BY di_gen_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Instrument</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' di_gen_id='$property[0]' cc_id='$property[2]'>$property[1]</option>";
}	
?>