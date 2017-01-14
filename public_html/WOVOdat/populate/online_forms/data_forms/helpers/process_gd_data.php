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

$gd_data = array(
	$gd_code = substr($_POST['vd_cavw'],0,8)."_".
			   substr($_POST['gs_code'],0,8)."_".
			   substr(str_replace("-","",$_POST['gd_time']),0,8).
			   substr($_POST['gd_species'],0,4),
	$gs_id = $_POST['gs_id'],
	$gi_id = $_POST['gi_id'],
	$gd_time = $_POST['gd_time'],
	$gd_gtemp = $_POST['gd_gtemp'],
	$gd_bp = $_POST['gd_bp'],
	$gd_flow = $_POST['gd_flow'],
	$gd_species = $_POST['gd_species'],
	$gd_waterfree_flag = $_POST['gd_waterfree_flag'],
	$gd_units = $_POST['gd_units'],
	$gd_concentration = $_POST['gd_concentration'],
	$gd_concentration_err = $_POST['gd_concentration_err'],
	$gd_recalc = $_POST['gd_recalc'],
	$gd_envir = $_POST['gd_envir'],
	$gd_submin = $_POST['gd_submin'],
	$gd_ori = $_POST['gd_ori'],
	$gd_com = $_POST['gd_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$gd_loaddate = date("Y-m-d H:i:s",time()),
	$gd_pubdate = $_POST['gd_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
				
$Column="";
$Values="";
$Val = $gd_data;
$Col = array(   
	"gd_code",
	"gs_id",
	"gi_id",
	"gd_time",
	"gd_gtemp",
	"gd_bp",
	"gd_flow",
	"gd_species",
	"gd_waterfree_flag",
	"gd_units",
	"gd_concentration",
	"gd_concentration_err",
	"gd_recalc",
	"gd_envir",
	"gd_submin",
	"gd_ori",
	"gd_com",
	"cc_id",
	"cc_id2",
	"cc_id3",
	"gd_loaddate",
	"gd_pubdate",
	"cc_id_load",
	"cb_ids"
);

$TABLE = "gd";

$Verify="`gd_code` ='".$gd_code."'";	
$rs = mysql_query("SELECT `gd_code` FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where gd_code = $gd_code is already in the database"."\n";
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
	
	$query = mysql_query("INSERT INTO ".$TABLE." (".$Column.") "."VALUES (".$Values.")");     
	if ($query){
		echo "Data where gd_code = $gd_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where gd_code = $gd_code saved to gd_log.txt"."\n";
		print_to_file("gd_log.txt",$Values);
	}		

}


?>