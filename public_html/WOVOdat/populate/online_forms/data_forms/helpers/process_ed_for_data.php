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

$ed_for_data  = array(
	$ed_for_code = substr($_POST['vd_cavw'],0,8)."_".
				   substr(str_replace("-","",$_POST['ed_for_astime']),0,8)."_".
			       rand(10000000,99999999).substr($_POST['aobs_num'],0,4),
	$vd_id = $_POST['vd_id'],
	$ed_for_desc = $_POST['ed_for_desc'],
	$ed_for_astime = $_POST['ed_for_astime'],
	$ed_for_alevel = $_POST['ed_for_alevel'],
	$ed_for_com = $_POST['ed_for_com'],	
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$ed_for_loaddate = date("Y-m-d H:i:s",time()),
	$ed_for_pubdate = $_POST['ed_for_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $ed_for_data;
$Col = array(   
	"ed_for_code",
	"vd_id", 
	"ed_for_desc", 
	"ed_for_astime", 
	"ed_for_alevel", 
	"ed_for_com", 
	"cc_id", 
	"cc_id2", 
    "cc_id3", 
	"ed_for_loaddate", 
	"ed_for_pubdate", 
	"cc_id_load", 
	"cb_ids"
);
//print_r($Col);
//print_r($ed_for_data );

$TABLE = "ed_for";

$Verify="ed_for_code ='".$ed_for_code."'";	
$rs = mysql_query("SELECT ed_for_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where ed_for_code = $ed_for_code is already in the database"."\n";
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
		echo "Data where ed_for_code = $ed_for_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where ed_for_code = $ed_for_code saved to ed_for_log.txt"."\n";
		print_to_file("ed_for.txt",$Values);
	}		

}


?>