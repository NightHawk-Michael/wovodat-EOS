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

$dd_gps_data  = array(
	$dd_gps_code = substr($_POST['vd_cavw'],0,8)."_".
				   substr($_POST['ds_code'],0,8)."_".
			       substr(str_replace("-","",$_POST['dd_gps_time']),0,8).
				   substr($_POST['type'],0,4),
	$di_gen_id = $_POST['di_gen_id'],			   
	$ds_id = $_POST['ds_id'],
	$ds_id_ref1 = $_POST['ds_id_ref1'],
	$ds_id_ref2 = $_POST['ds_id_ref2'],
	$dd_gps_time = $_POST['dd_gps_time'],	
	$dd_gps_lat	= $_POST['dd_gps_lat'],
	$dd_gps_lon	= $_POST['dd_gps_lon'],	
	$dd_gps_elev = $_POST['dd_gps_elev'],		
	$dd_gps_nserr = $_POST['dd_gps_nserr'],	
	$dd_gps_ewerr = $_POST['dd_gps_ewerr'],	
	$dd_gps_verr = $_POST['dd_gps_verr'],			
	$dd_gps_software = $_POST['dd_gps_software'],		
	$dd_gps_orbits = $_POST['dd_gps_orbits'],		
	$dd_gps_dur = $_POST['dd_gps_dur'],			
	$dd_gps_qual = $_POST['dd_gps_qual'],     
	$dd_gps_slope = $_POST['dd_gps_slope'],       
	$dd_gps_errslope = $_POST['dd_gps_errslope'],		
	$dd_gps_ori = $_POST['dd_gps_ori'],	
	$dd_gps_com  = $_POST['dd_gps_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$dd_gps_loaddate = date("Y-m-d H:i:s",time()),
	$dd_gps_pubdate = $_POST['dd_gps_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $dd_gps_data;
$Col = array(   
	"dd_gps_code",
	"di_gen_id",		   
	"ds_id",
	"ds_id_ref1",
	"ds_id_ref2",
	"dd_gps_time",	
	"dd_gps_lat",
	"dd_gps_lon",
	"dd_gps_elev",		
	"dd_gps_nserr",
	"dd_gps_ewerr",
	"dd_gps_verr",		
	"dd_gps_software",		
	"dd_gps_orbits",	
	"dd_gps_dur",		
	"dd_gps_qual",   
	"dd_gps_slope",    
	"dd_gps_errslope",		
	"dd_gps_ori",
	"dd_gps_com ",
	"cc_id",
	"cc_id2",
    "cc_id3",
	"dd_gps_loaddate",
	"dd_gps_pubdate",
	"cc_id_load",
	"cb_ids",
);
//print_r($Col);
//print_r($dd_gps_data );

$TABLE = "dd_gps";

$Verify="dd_gps_code ='".$dd_gps_code."'";	
$rs = mysql_query("SELECT dd_gps_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where dd_gps_code = $dd_gps_code is already in the database"."\n";
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
	//echo $sql;
	$query = mysql_query($sql);     
	if ($query){
		echo "Data where dd_gps_code = $dd_gps_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where dd_gps_code = $dd_gps_code saved to dd_gps_log.txt"."\n";
		print_to_file("dd_gps_log.txt",$Values);
	}		

}


?>