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

$td_data  = array(
	$td_code = substr($_POST['vd_cavw'],0,8)."_".substr($_POST['ts_code'],0,8)."_".substr(str_replace("-","",$_POST['td_time']),0,8),
	$ts_id = $_POST['ts_id'],
	$ti_id = $_POST['ti_id'],
	$td_mtype = $_POST['td_mtype'],
	$td_time = $_POST['td_time'],
	$td_depth = $_POST['td_depth'],
	$td_distance = $_POST['td_distance'],
	$td_calc_flag = $_POST['td_calc_flag'],
	$td_temp = $_POST['td_temp'],
	$td_terr = $_POST['td_terr'],
	$td_aarea = $_POST['td_aarea'],
	$td_flux = $_POST['td_flux'],
	$td_ferr = $_POST['td_ferr'],
	$td_bkgg = $_POST['td_bkgg'],
	$td_tcond = $_POST['td_tcond'],
	$td_ori = $_POST['td_ori'],	
	$td_com = $_POST['td_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$td_loaddate = date("Y-m-d H:i:s"),
	$td_pubdate = $_POST['td_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $td_data;
$Col = array(   
	"td_code",
	"ts_id",
	"ti_id",
	"td_mtype",
	"td_time",
	"td_depth",
	"td_distance",
	"td_calc_flag",
	"td_temp",
	"td_terr",
	"td_aarea",
	"td_flux",
	"td_ferr",
	"td_bkgg",
	"td_tcond",
	"td_ori",	
	"td_com",
	"cc_id",
	"cc_id2",
    "cc_id3",
	"td_loaddate",
	"td_pubdate",
	"cc_id_load",
	"cb_ids",
);
//print_r($Col);
//print_r($td_data);

$TABLE = "td";

$Verify="td_code ='".$td_code."'";	
$rs = mysql_query("SELECT td_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where td_code = $td_code is already in the database"."\n";
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
		echo "Data where td_code = $td_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where td_code = $td_code saved to td_log.txt"."\n";
		print_to_file("td_log.txt",$Values);
	}		

}


?>


		