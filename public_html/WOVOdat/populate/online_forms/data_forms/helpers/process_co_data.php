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

$co_data  = array(
	$co_code = substr($_POST['vd_cavw'],0,8)."_".
				   substr(str_replace("-","",$_POST['stime_vobs']),0,8)."_".
			       rand(10000000,99999999).substr($_POST['vobs_num'],0,4),
	$vd_id = $_POST['vd_id'],
    $co_observe = $_POST['descr_vobs'],
	$co_stime = $_POST['stime_vobs'],
	$co_etime = $_POST['etime_vobs'],	
	$co_com = $_POST['comme_vobs']."\t".$_POST['measu_vobs']."\t".$_POST['units_vobs'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$co_loaddate = date("Y-m-d H:i:s",time()),
	$co_pubdate = $_POST['co_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $co_data ;
$Col = array(   
	"co_code", 
	"vd_id", 
    "co_observe", 
	"co_stime", 
	"co_etime", 
	"co_com", 
	"cc_id", 
	"cc_id2", 
    "cc_id3", 
	"co_loaddate", 
	"co_pubdate", 
	"cc_id_load",
	"cb_ids"
);
//print_r($Col);
//print_r($med_data );

$TABLE = "co";

$Verify="co_code ='".$co_code."'";	
$rs = mysql_query("SELECT co_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where co_code = $co_code is already in the database"."\n";
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
		echo "Data where co_code = $co_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where co_code = $co_code saved to co_log.txt"."\n";
		print_to_file("co.txt",$Values);
	}		

}


?>