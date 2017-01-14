<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');
$vd_name = $_POST['vd_name'];
$query = "SELECT ds_id, ds_code, ds.cc_id, vd_cavw FROM ds, cn, vd WHERE ds.cn_id = cn.cn_id AND cn.vd_id = vd.vd_id AND vd_name = \"$vd_name\" ORDER BY ds_code";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<option>Select Station</option>";
while ($property = mysql_fetch_array($result)){
	echo "<option value='$property[1]' ds_id='$property[0]' cc_id='$property[2]' vd_cavw='$property[3]'>$property[1]</option>";
}	
?>