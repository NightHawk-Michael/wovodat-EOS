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

$gd_plu_data = array(
	$gd_plu_code = substr($_POST['type_of_data'],0,8)."_".
				   substr($_POST['vd_cavw'],0,8)."_".
			       substr(str_replace("-","",$_POST['gd_plu_time']),0,8).
			       substr($_POST['gd_plu_species'],0,4),
	$vd_id = $_POST['vd_id'],
	$gd_plu_volc1 = $_POST['gd_plu_volc1'],
	$gd_plu_volc2 = $_POST['gd_plu_volc2'],
	$cs_id = $_POST['cs_id'],
	$gs_id = $_POST['gs_id'],
	$gi_id = $_POST['gi_id'],
	$gd_plu_lat = $_POST['gd_plu_lat'],
	$gd_plu_lon = $_POST['gd_plu_lon'],
	$gd_plu_minboxlat = $_POST['gd_plu_minboxlat'],
	$gd_plu_maxboxlat = $_POST['gd_plu_maxboxlat'],
	$gd_plu_minboxlon = $_POST['gd_plu_minboxlon'],
	$gd_plu_maxboxlon = $_POST['gd_plu_maxboxlon'],	
	$gd_plu_image = $_POST['gd_plu_image'],
	$gd_plu_image_path = $_SERVER['DOCUMENT_ROOT']."/populate/online_forms/helpers/Plume_images"."/".$gd_plu_code,
	$gd_plu_inter = $_POST['gd_plu_inter'],
	$gd_plu_height = $_POST['gd_plu_height'],
	$gd_plu_hdet = $_POST['gd_plu_hdet'],
	$gd_plu_colheight = $_POST['gd_plu_colheight'],	
	$gd_plu_time = $_POST['gd_plu_time'],
	$gd_plu_species = $_POST['gd_plu_species'],
	$gd_plu_units = $_POST['gd_plu_units'],
	$gd_plu_emit = $_POST['gd_plu_emit'],
	$gd_plu_emit_err = $_POST['gd_plu_emit_err'],
	$gd_plu_recalc = $_POST['gd_plu_recalc'],
	$gd_plu_wind = $_POST['gd_plu_wind'],
	$gd_plu_wsmin= $_POST['gd_plu_wsmin'],
	$gd_plu_wsmax= $_POST['gd_plu_wsmax'],
	$gd_plu_wdir= $_POST['gd_plu_wdir'],
	$gd_plu_ori = $_POST['gd_plu_ori'],	
	$gd_plu_com = $_POST['gd_plu_com'],
	$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
	$cc_id2 = $_POST['cc_id2'],
    $cc_id3 = $_POST['cc_id3'],
	$gd_plu_loaddate = date("Y-m-d H:i:s",time()),
	$gd_plu_pubdate = $_POST['gd_plu_pubdate'],
	$cc_id_load = $_SESSION['login']['cc_id'],
	$cb_ids = $_POST['cb_ids']
);
		
$Column="";
$Values="";
$Val = $gd_plu_data;
$Col = array(   
		"gd_plu_code",
		"vd_id",
		"gd_plu_volc1",
		"gd_plu_volc2",
		"cs_id",
		"gs_id",
		"gi_id",
		"gd_plu_lat",
		"gd_plu_lon",
		"gd_plu_minboxlat",
		"gd_plu_maxboxlat",
		"gd_plu_minboxlon",
		"gd_plu_maxboxlon",
		"gd_plu_image",
		"gd_plu_image_path",
		"gd_plu_inter",
		"gd_plu_height",
		"gd_plu_hdet",
		"gd_plu_colheight",
		"gd_plu_time",
		"gd_plu_species",
		"gd_plu_units",
		"gd_plu_emit",
		"gd_plu_emit_err",
		"gd_plu_recalc",
		"gd_plu_wind",
		"gd_plu_wsmin",
		"gd_plu_wsmax",
		"gd_plu_wdir",
		"gd_plu_ori",
		"gd_plu_com",
		"cc_id",
		"cc_id2",
		"cc_id3",
		"gd_plu_loaddate",
		"gd_plu_pubdate",
		"cc_id_load",
		"cb_ids"
);
//print_r($Col);
//print_r($gd_plu_data);

$TABLE = "gd_plu";

$Verify="gd_plu_code ='".$gd_plu_code."'";	
$rs = mysql_query("SELECT gd_plu_code FROM ".$TABLE." WHERE ".$Verify);       
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
	
	$sql = "INSERT INTO ".$TABLE." (".$Column.") "."VALUES (".$Values.")";
	$query = mysql_query($sql);     
	if ($query){
		echo "Data where gd_plu_code = $gd_plu_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where gd_code = $gd_plu_code saved to gd_log.txt"."\n";
		print_to_file("gd_plu_log.txt",$Values);
	}		

}
$_SESSION['gd_plu_code'] = $gd_plu_code;

?>