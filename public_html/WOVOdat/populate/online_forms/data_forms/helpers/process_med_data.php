<?php
date_default_timezone_set('UTC');
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');

function print_to_file($File,$data){
	$myfile = fopen($File, "a") or die("Unable to open file!");
	fwrite($myfile,$data."\n");
	fclose($myfile);
}

function not_null_fields($fields){
$not_null = array();
for($i =0;$i<sizeof($fields);$i++){
    if(preg_match('/[0-9]/', $fields[$i]) OR preg_match('/[a-zA-Z]/', $fields[$i])){
        $not_null[]=$i;
    }
}
return $not_null;
}

function get_your_obs_cc_id($cc_id){
	$sql = "SELECT u1.cc_id, u1.cc_code, u1.cc_obs
			FROM cc u1, cc u2
			WHERE u1.cc_obs = u2.cc_obs
			AND u2.cc_id = ".$cc_id."
			AND u1.cc_code REGEXP '[a-zA-Z]'";
	$result = mysql_query($sql);       
	if ($result){
		$My_row = array();
		while ($row = mysql_fetch_array($result)):
			$My_row[]=$row;	
		endwhile;
		return $My_row[0][0];
	}
	else {return NULL;}
}

$med_data  = array(
	$med_code = substr($_POST['vd_cavw'],0,8)."_".
				   substr($_POST['med_station'],0,8)."_".
			       substr(str_replace("-","",$_POST['med_time']),0,8).
			       substr($_POST['med_instrument'],0,4),
	$ms_id = $_POST['ms_id'],
	$mi_id = $_POST['mi_id'],
	$med_time = $_POST['med_time'],
	$med_temp = $_POST['air_temperature'],
	$med_stemp = $_POST['soil_temperature'],
	$med_bp = $_POST['barometric_pressure'],
	$med_prec = $_POST['daily_precipitation'],
	$med_tprec = $_POST['type_of_precipitation'],
	$med_hd = $_POST['humidity'],
	$med_wind = $_POST['wind_speed'],
	$med_wsmin = $_POST['minimum_wind_speed'],
	$med_wsmax = $_POST['maximum_wind_speed'],
	$med_wdir = $_POST['wind_direction'],
	$med_clc = $_POST['cloud_coverage'],
	$med_ori = $_POST['med_ori'],	
	$med_com = $_POST['med_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$med_loaddate = date("Y-m-d H:i:s",time()),
	$med_pubdate = $_POST['med_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $med_data ;
$Col = array(   
		"med_code",
		"ms_id",
		"mi_id",
		"med_time",
		"med_temp",
		"med_stemp",
		"med_bp",
		"med_prec",
		"med_tprec",
		"med_hd",
		"med_wind",
		"med_wsmin",
		"med_wsmax",
		"med_wdir",
		"med_clc",
		"med_ori",
		"med_com",
		"cc_id",
		"cc_id2",
		"cc_id3",
		"med_loaddate",
		"med_pubdate",
		"cc_id_load",
		"cb_ids"
);
//print_r($Col);
//print_r($med_data );

$TABLE = "med";

$Verify="med_code ='".$med_code."'";	
$rs = mysql_query("SELECT med_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where med_code = $med_code is already in the database"."\n";
}
else {

    $not_null = not_null_fields($Val);
	$length=sizeof($not_null);
	for ($l=0;$l<$length-1;$l++){
		$Column=$Column.$Col[$not_null[$l]].",";
		$Values =$Values."'".$Val[$not_null[$l]]."'".",";
	}
	$Column=$Column.$Col[$not_null[$length-1]];
	$Values =$Values."'".$Val[$not_null[$length-1]]."'";
	
	$sql = "INSERT INTO ".$TABLE." (".$Column.") "."VALUES (".$Values.")";
	$query = mysql_query($sql);     
	if ($query){
		echo "Data where med_code = $med_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where med_code = $med_code saved to med_log.txt"."\n";
		print_to_file("med_log.txt",$Values);
	}		

}


?>