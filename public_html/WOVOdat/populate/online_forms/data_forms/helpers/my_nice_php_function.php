<?php
if (!isset($_SESSION)) {
    session_start();
}

ini_set("memory_limit", "-1");
set_time_limit(0);
require_once('php/include/db_connect.php');

function query_mysql($query){
$My_rows=array();
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
while ($row = mysql_fetch_array($result)):
	$My_rows[]=$row;	
endwhile;
//mysql_close();
return $My_rows;
}

function query_mysql_beta($TABLE, $COND){
$My_rows=array();
$query = "SELECT * FROM $TABLE WHERE $COND";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
while ($row = mysql_fetch_array($result)):
	$My_rows[]=$row;	
endwhile;
//mysql_close();
return $My_rows;
}

function create_dropdown_from_column_data($TABLE, $Select1){
$query = "SELECT DISTINCT $Select1 FROM $TABLE ORDER BY $Select1";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
echo "<select>";
while ($property = mysql_fetch_array($result)){
echo "<option value='$property[0]'>$property[0]</option>";
}	
echo "</select>";
}

function create_dropdown_from_rows($My_rows){
echo "<select>";
$len_row = sizeof($My_rows);
for ($i=0;$i<$len_row;$i++){
	echo "<option value='".$My_rows[$i][0]."' my_id='".$My_rows[$i][1]."' my_id2='".$My_rows[$i][2]."'>".$My_rows[$i][0]."</option>";
}	
echo "</select>";
}

function create_multiselect_from_rows($My_rows){
echo "<select multiple='multiple' size='10' style='min-width:500px'>";
$len_row = sizeof($My_rows);
for ($i=0;$i<$len_row;$i++){
	echo "<option value='".$My_rows[$i][0]."'>".$My_rows[$i][1]." (".$My_rows[$i][2].") ".$My_rows[$i][3]."</option>";
}	
echo "</select>";	
}

function create_dir_if_not_exist($dir){
if (!file_exists($dir)) {
    mkdir($dir);
}
}

function space($spaces){
for ($i=0;$i<$spaces;$i++){
	echo "&nbsp";
}
}

function vd_id($vd_name){
$TABLE="vd";
$COND = "`vd_name` LIKE '%$vd_name%'";
$rs = query_mysql_beta($TABLE, $COND);
$vd_id = $rs[0][0];
$_SESSION['vd_cavw'] =  $rs[0][1];
return $vd_id;
}

function sn_id($vd_id){
$TABLE="sn";
$COND = "`vd_id` = '$vd_id'";
$rs = query_mysql_beta($TABLE, $COND);
$sn_id = $rs[0][0];
return $sn_id;
}

function sn_id_array($vd_id){
$TABLE="sn";
$COND = "`vd_id` = '$vd_id'";
$rs = query_mysql_beta($TABLE, $COND);
$sn_id = array();
for ($i=0;$i<sizeof($rs);$i++){
$sn_id[] = $rs[$i][0];
}
return $sn_id;
}


?>