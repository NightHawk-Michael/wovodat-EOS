<?php
// Check login
require_once "php/include/login_check.php";
// Get root url
require_once "php/include/get_root.php";
?>

<?php
include 'php/include/db_connect_view.php';
$nr=2;
$gunungnya=$_GET["gunungnya"];
$netnya=$_GET["netnya"];
$datanya=$_GET["apadatanya"];
//echo $gunungnya." ".$netnya." - ".$datanya."<br>";

$ast="";
if($datanya=="SeismicStation" || $datanya=="SeismicInstrument" || $datanya=="SeismicComponent") {
	$ast="s";
}elseif($datanya=="DeformationStation" || $datanya=="DeformationInstrument" || $datanya=="DeformationInstrumentG" || $datanya=="DeformationInstrumentT") {	
	$ast="d";
}elseif($datanya=="GasStation" || $datanya=="GasInstrument") {	
	$ast="g";
}elseif($datanya=="HydrologicStation" || $datanya=="HydrologicInstrument") {	
	$ast="h";
}elseif($datanya=="ThermalStation" || $datanya=="ThermalInstrument") {	
	$ast="t";
}elseif($datanya=="FieldsStation" || $datanya=="FieldInstrument") {	
	$ast="f";	
}elseif($datanya=="EventDataFromNetwork" || $datanya=="EventDataFromSingleStation" || $datanya=="IntensityData" || $datanya=="SeismicTremor" || $datanya=="IntervalSwarmData" || $datanya=="RSAMSSAMData" || $datanya=="RSAMData" || $datanya=="SSAMData" || $datanya=="RepresentativeWaveform") {
	$ast="s";
}elseif($datanya=="ElectronicTiltData" || $datanya=="TiltVectorData" || $datanya=="StrainMeterData" || $datanya=="EDMData" || $datanya=="AngleData" || $datanya=="GPSData" || $datanya=="GPSVectors" || $datanya=="LevelingData") {
	$ast="d";
}elseif($datanya=="DirectlySampledGas" || $datanya=="SoilEffluxData" || $datanya=="PlumeData") {
	$ast="g";
}elseif($datanya=="HydrologicData") {
	$ast="h";
}elseif($datanya=="GroundBasedThermalData" || $datanya=="ThermalImage" || $datanya=="ThermalImageData") {
	$ast="t";
}elseif($datanya=="MagneticFieldsData" || $datanya=="MagneticVectorData" || $datanya=="ElectricFieldsData" || $datanya=="GravityData") {
	$ast="f";	
}



if($netnya=="..." || $netnya==""){
	if($ast=="s"){
		$result = mysql_query("SELECT a.sn_code, a.sn_name	FROM sn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' ") or die(mysql_error());
		$result1= mysql_query("SELECT a.sn_code, a.sn_name	FROM sn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='S' and c.jj_net_id=a.sn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}elseif($ast=="d"){
		$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Deformation'") or die(mysql_error());
		$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Deformation'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}elseif($ast=="t"){
		$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Thermal'") or die(mysql_error());
		$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Thermal'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}elseif($ast=="f"){
		$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Fields'") or die(mysql_error());
		$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Fields'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}elseif($ast=="g"){
		$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Gas'") or die(mysql_error());
		$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Gas'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}elseif($ast=="h"){
		$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Hydrologic'") or die(mysql_error());
		$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$gunungnya' and a.cn_type='Hydrologic'")or die(mysql_error());
		while ($v_r = mysql_fetch_array($result)) {
			$netnya=htmlentities($v_r[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_r[1], ENT_COMPAT, "cp1252");
		}
		if($netnya=="..." || $netnya==""){
			while ($v_arr1 = mysql_fetch_array($result1)) {
			$netnya=htmlentities($v_arr1[0], ENT_COMPAT, "cp1252");
			$networkName=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
			}
		}
	}
}


//echo $gunungnya."::: ".$netnya." ".$datanya."<br>";


//echo $datanya.",,,".$volca." ".$ast."<br>";


if($ast=="s") {
	$result = mysql_query("SELECT a.ss_code, a.ss_name	FROM ss a, sn b, vd c	WHERE  a.sn_id=b.sn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya'") or die(mysql_error());
	$result1= mysql_query("SELECT a.ss_code, a.ss_name	FROM ss a, sn b, vd c, jj_volnet d	WHERE d.jj_net_flag='S' and a.sn_id=b.sn_id and b.sn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya'")or die(mysql_error());
	
}elseif($ast=="d") {
	$result = mysql_query("SELECT a.ds_code, a.ds_name	FROM ds a, cn b, vd c	WHERE  a.cn_id=b.cn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Deformation'") or die(mysql_error());
	$result1= mysql_query("SELECT a.ds_code, a.ds_name	FROM ds a, cn b, vd c, jj_volnet d	WHERE d.jj_net_flag='C' and a.cn_id=b.cn_id and b.cn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_name='$netnya' and b.cn_type='Deformation'")or die(mysql_error());
}elseif($ast=="g") {
	$result = mysql_query("SELECT a.gs_code, a.gs_name	FROM gs a, cn b, vd c	WHERE  a.cn_id=b.cn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya'and b.cn_type='Gas'") or die(mysql_error());
	$result1= mysql_query("SELECT a.gs_code, a.gs_name	FROM gs a, cn b, vd c, jj_volnet d	WHERE d.jj_net_flag='C' and a.cn_id=b.cn_id and b.cn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Gas'")or die(mysql_error());
}elseif($ast=="h") {
	$result = mysql_query("SELECT a.hs_code, a.hs_name	FROM hs a, cn b, vd c	WHERE  a.cn_id=b.cn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Hydrologic'") or die(mysql_error());
	$result1= mysql_query("SELECT a.hs_code, a.hs_name	FROM hs a, cn b, vd c, jj_volnet d	WHERE d.jj_net_flag='C' and a.cn_id=b.cn_id and b.cn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Hydrologic'")or die(mysql_error());
}elseif($ast=="t") {
	$result = mysql_query("SELECT a.ts_code, a.ts_name	FROM ts a, cn b, vd c	WHERE  a.cn_id=b.cn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya'  and b.cn_type='Thermal'") or die(mysql_error());
	$result1= mysql_query("SELECT a.ts_code, a.ts_name	FROM ts a, cn b, vd c, jj_volnet d	WHERE d.jj_net_flag='C' and a.cn_id=b.cn_id and b.cn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Thermal'")or die(mysql_error());
}elseif($ast=="f") {
	$result = mysql_query("SELECT a.fs_code, a.fs_name	FROM fs a, cn b, vd c	WHERE  a.cn_id=b.cn_id and b.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Fields'") or die(mysql_error());
	$result1= mysql_query("SELECT a.fs_code, a.fs_name	FROM fs a, cn b, vd c, jj_volnet d	WHERE d.jj_net_flag='C' and a.cn_id=b.cn_id and b.cn_id=d.jj_net_id and d.vd_id=c.vd_id and c.vd_name='$gunungnya' and b.cn_type='Fields'")or die(mysql_error());
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

//echo $datanya."----".$gunungnya." ".$netnya." --".$ast."<br>";
//echo $nr;
echo '<select name="stat2" id="stat2"  style="width:200px" onChange="javascript:for_component()">';
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
