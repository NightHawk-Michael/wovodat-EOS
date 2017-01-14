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

$hd_data  = array(
	$hd_code = substr($_POST['vd_cavw'],0,8)."_".
				   substr($_POST['hs_code'],0,8)."_".
			       substr(str_replace("-","",$_POST['hd_time']),0,8).
			       substr($_POST['hd_comp_species'],0,4),
	$hs_id = $_POST['hs_id'],
	$hi_id = $_POST['hi_id'],
	$hd_time = $_POST['hd_time'],
	$hd_temp = $_POST['hd_temp'],
	$hd_welev = $_POST['hd_welev'],
	$hd_wdepth = $_POST['hd_wdepth'],
	$hd_dwlev = $_POST['hd_dwlev'],	
	$hd_bp = $_POST['hd_bp'],			
	$hd_sdisc = $_POST['hd_sdisc'],			
	$hd_prec = $_POST['hd_prec'],			
	$hd_dprec = $_POST['hd_dprec'],
	$hd_tprec = $_POST['hd_tprec'],	
	$hd_ph = $_POST['hd_ph'],	
	$hd_cond = $_POST['hd_cond'],					
	$hd_comp_species = $_POST['hd_comp_species'],
	$hd_comp_units = $_POST['hd_comp_units'],    
	$hd_comp_content = $_POST['hd_comp_content'],	
	$hd_comp_content_err = $_POST['hd_comp_content_err'],  
	$hd_atemp = $_POST['hd_atemp'],      			
	$hd_tds = $_POST['hd_tds'], 	
	$hd_ori = $_POST['hd_ori'],	
	$hd_com = $_POST['hd_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$hd_loaddate = date("Y-m-d H:i:s",time()),
	$hd_pubdate = $_POST['hd_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $hd_data ;
$Col = array(   
	"hd_code",
	"hs_id", 
	"hi_id", 
	"hd_time", 
	"hd_temp", 
	"hd_welev", 
	"hd_wdepth", 
	"hd_dwlev", 
	"hd_bp", 			
	"hd_sdisc", 		
	"hd_prec", 		
	"hd_dprec", 
	"hd_tprec", 
	"hd_ph", 	
	"hd_cond", 				
	"hd_comp_species", 
	"hd_comp_units",    
	"hd_comp_content", 	
	"hd_comp_content_err",   
	"hd_atemp",    			
	"hd_tds", 	
	"hd_ori", 
	"hd_com", 
	"cc_id",
	"cc_id2", 
    "cc_id3", 
	"hd_loaddate",
	"hd_pubdate", 
	"cc_id_load",
	"cb_ids",
);
//print_r($Col);
//print_r($hd_data );

$TABLE = "hd";

$Verify="hd_code ='".$hd_code."'";	
$rs = mysql_query("SELECT hd_code FROM ".$TABLE." WHERE ".$Verify);       
if (mysql_num_rows($rs)>0) {
     echo "Data where hd_code = $hd_code is already in the database"."\n";
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
		echo "Data where hd_code = $hd_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where hd_code = $hd_code saved to hd_log.txt"."\n";
		print_to_file("hd_log.txt",$Values);
	}		

}


?>