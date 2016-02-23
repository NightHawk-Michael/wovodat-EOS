<?php
// Check login
require_once "php/include/login_check.php";
// Get root url
require_once "php/include/get_root.php";
?>

<?php
$nr=2;
$gunungnya=$_GET["gunungnya"];
$datanya=$_GET["apadatanya"];
$netnya=$_GET["netnya"];
$stationnya=$_GET["stationnya"];
//echo $gunungnya." ".$datanya." ".$netnya." ".$stationnya."<br>";

include 'php/include/db_connect_view.php';

if($datanya=="SeismicInstrument" || $datanya=="SeismicComponent") {
	$result = mysql_query("SELECT a.si_code, a.si_name	FROM si a, ss b, sn c, vd d	WHERE  a.ss_id=b.ss_id and b.sn_id=c.sn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.sn_name='$netnya' and b.ss_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.si_code, a.si_name FROM si a, ss b, sn c, vd d, jj_volnet e	WHERE a.ss_id=b.ss_id and b.sn_id=c.sn_id and c.sn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.sn_name='$netnya' and b.ss_name='$stationnya'")or die(mysql_error());

}else if($datanya=="DeformationInstrument") {
	$result = mysql_query("SELECT a.di_gen_code, a.di_gen_name	FROM di_gen a, ds b, cn c, vd d	WHERE  a.ds_id=b.ds_id and b.cn_id=c.cn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.ds_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.di_gen_code, a.di_gen_name FROM di_gen a, ds b, cn c, vd d, jj_volnet e	WHERE a.ds_id=b.ds_id and b.cn_id=c.cn_id and c.cn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.ds_name='$stationnya'")or die(mysql_error());
}else if($datanya=="GasInstrument") {
	$result = mysql_query("SELECT a.gi_code, a.gi_name	FROM gi a, gs b, cn c, vd d	WHERE  a.gs_id=b.gs_id and b.cn_id=c.cn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.gs_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.gi_code, a.gi_name FROM gi a, gs b, cn c, vd d, jj_volnet e	WHERE a.gs_id=b.gs_id and b.cn_id=c.cn_id and c.cn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.gs_name='$stationnya'")or die(mysql_error());
}else if($datanya=="HydrologicInstrument") {
	$result = mysql_query("SELECT a.hi_code, a.hi_name	FROM hi a, hs b, cn c, vd d	WHERE  a.hs_id=b.hs_id and b.cn_id=c.cn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.hs_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.hi_code, a.hi_name FROM hi a, hs b, cn c, vd d, jj_volnet e	WHERE a.hs_id=b.hs_id and b.cn_id=c.cn_id and c.cn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.hs_name='$stationnya'")or die(mysql_error());
}else if($datanya=="ThermalInstrument") {
	$result = mysql_query("SELECT a.ti_code, a.ti_name	FROM ti a, ts b, cn c, vd d	WHERE  a.ts_id=b.ts_id and b.cn_id=c.cn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.ts_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.ti_code, a.ti_name FROM ti a, ts b, cn c, vd d, jj_volnet e	WHERE a.ts_id=b.ts_id and b.cn_id=c.cn_id and c.cn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.ts_name='$stationnya'")or die(mysql_error());
}else if($datanya=="FieldsInstrument") {
	$result = mysql_query("SELECT a.fi_code, a.fi_name	FROM fi a, fs b, cn c, vd d	WHERE  a.fs_id=b.fs_id and b.cn_id=c.cn_id and c.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.fs_name='$stationnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.fi_code, a.fi_name FROM fi a, fs b, cn c, vd d, jj_volnet e	WHERE a.fs_id=b.fs_id and b.cn_id=c.cn_id and c.cn_id=e.jj_net_id and e.vd_id=d.vd_id and d.vd_name='$gunungnya' and c.cn_name='$netnya' and b.fs_name='$stationnya'")or die(mysql_error());
}

$bar[0]='sta'; 
$bar[1]='new'; 
while ($v_arr = mysql_fetch_array($result)) {
	$bar[$nr]=htmlentities($v_arr[1], ENT_COMPAT, "cp1252");
	$nr++;
}
while ($v_arr1 = mysql_fetch_array($result1)) {
	$bar[$nr]=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
	$nr++;
}


//echo $nr;
echo '<select name="instrum" style="width:200px">';
if($nr==2){
	foreach($bar as $k => $v){
		if($v=="new"){
			echo "<option value=\"$v\" selected=\"selected\">".$v."</option>";
		}else{
			echo "<option value=\"$v\">".$v."</option>";
		}
	}
}elseif($nr>2){	
	foreach($bar as $k => $v){
		if($k==2){
			echo "<option value=\"$v\" selected=\"selected\">".$v."</option>";
		}else{
			echo "<option value=\"$v\">".$v."</option>";
		}
	}
}
echo '</select>';
/**/
?>