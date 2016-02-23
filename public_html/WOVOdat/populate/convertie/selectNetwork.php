<?php
// Check login
require_once "php/include/login_check.php";
// Get root url
require_once "php/include/get_root.php";
?>

<?php
$nr=2;
$volca=$_GET["volcan"];
$statyp=$_GET["statype"];
//echo $statyp." ".$volca;

include 'php/include/db_connect_view.php';

$ast="";

if($statyp=="SeismicNetwork" || $statyp=="SeismicStation" || $statyp=="SeismicInstrument" || $statyp=="SeismicComponent" || $statyp=="EventDataFromNetwork" || $statyp=="EventDataFromSingleStation" || $statyp=="IntensityData" || $statyp=="SeismicTremor" || $statyp=="IntervalSwarmData" || $statyp=="RSAMSSAMData" || $statyp=="RSAMData" || $statyp=="SSAMData" || $statyp=="RepresentativeWaveform") {$ast="s";}
elseif($statyp=="NonSeismicNetwork") {$ast="c";}
elseif($statyp=="DeformationNetwork" || $statyp=="DeformationStation" || $statyp=="DeformationInstrument") {	
	$ast="d";
}
elseif($statyp=="GasNetwork" || $statyp=="GasStation" || $statyp=="GasInstrument") {$ast="g";}
elseif($statyp=="HydrologicNetwork" || $statyp=="HydrologicStation" || $statyp=="HydrologicInstrument") {$ast="h";
}
elseif($statyp=="ThermalNetwork" || $statyp=="ThermalStation" || $statyp=="ThermalInstrument") {$ast="t";}
elseif($statyp=="FieldsNetwork" || $statyp=="FieldsStation" || $statyp=="FieldInstrument") {$ast="f";}
elseif($statyp=="ElectronicTiltData" || $statyp=="TiltVectorData" || $statyp=="StrainMeterData" || $statyp=="EDMData" || $statyp=="AngleData" || $statyp=="GPSData" || $statyp=="GPSVectors" || $statyp=="LevelingData") {$ast="d";}
elseif($statyp=="DirectlySampledGas" || $statyp=="SoilEffluxData" || $statyp=="PlumeData") {$ast="g";}
elseif($statyp=="HydrologicData") {$ast="h";}
elseif($statyp=="MagneticFieldsData" || $statyp=="MagneticVectorData" || $statyp=="ElectricFieldsData" || $statyp=="GravityData") {$ast="f";}
elseif($statyp=="GroundBasedThermalData" || $statyp=="ThermalImage" || $statyp=="ThermalImageData") {$ast="t";}

//echo $statyp." ".$volca." ".$ast;

if($ast=="s") {
	$result = mysql_query("SELECT a.sn_code, a.sn_name	FROM sn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca'") or die(mysql_error());
	$result1= mysql_query("SELECT a.sn_code, a.sn_name	FROM sn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='S' and c.jj_net_id=a.sn_id and c.vd_id=b.vd_id and b.vd_name='$volca'")or die(mysql_error());
}elseif($ast=="c") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca'");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca'")or die(mysql_error());
}elseif($ast=="d") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Deformation' ");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Deformation' ")or die(mysql_error());
}elseif($ast=="g") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Gas'");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Gas'")or die(mysql_error());
}elseif($ast=="h") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Hydrologic'");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Hydrologic'")or die(mysql_error());
}elseif($ast=="t") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Thermal'");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Thermal'")or die(mysql_error());
}elseif($ast=="f") {	
	$result = mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b	WHERE  a.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Fields'");
	$result1= mysql_query("SELECT a.cn_code, a.cn_name	FROM cn a, vd b, jj_volnet c	WHERE  c.jj_net_flag='C' and c.jj_net_id=a.cn_id and c.vd_id=b.vd_id and b.vd_name='$volca' and a.cn_type='Fields'")or die(mysql_error());
}

$row[0]='...'; 
$row[1]='new'; 
while ($v_arr = mysql_fetch_array($result)) {
	$row[$nr]=htmlentities($v_arr[1], ENT_COMPAT, "cp1252");
	$nr++;
}
while ($v_arr1 = mysql_fetch_array($result1)) {
	$row[$nr]=htmlentities($v_arr1[1], ENT_COMPAT, "cp1252");
	$nr++;
}

//echo $nr;
echo '<select name="netw" style="width:200px">';
if($nr==2){
	foreach($row as $k => $v){
		if($v=="new"){
			echo "<option value=\"$v\" selected=\"selected\">".$v."</option>";
		}else{
			echo "<option value=\"$v\">".$v."</option>";
		}
	}
}elseif($nr>2){	
	foreach($row as $k => $v){
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