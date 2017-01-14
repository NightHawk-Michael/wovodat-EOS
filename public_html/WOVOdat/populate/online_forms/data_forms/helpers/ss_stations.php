<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');
$vd_name = $_POST['vd_name'];
$query = "SELECT ss_id, ss_code, ss.cc_id, ss.sn_id, vd_cavw FROM ss, sn, vd WHERE ss.sn_id = sn.sn_id AND sn.vd_id = vd.vd_id AND vd_name = \"$vd_name\" ORDER BY ss_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<Select>";
echo "<option>Select Station</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option ss_id='$property[0]' value='$property[1]' cc_id='$property[2]' sn_id='$property[3]' vd_cavw='$property[4]'>$property[1]</option>";
}
echo "</Select>";
?> 