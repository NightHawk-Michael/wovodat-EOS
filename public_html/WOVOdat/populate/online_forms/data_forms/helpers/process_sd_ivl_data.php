<?php
date_default_timezone_set('UTC');
if (!isset($_SESSION)) {
    session_start();
}

require_once('php/include/db_connect.php');

function print_to_file($File){
	$myfile = fopen($File, "a") or die("Unable to open file!");
	fwrite($myfile,$data."\n");
	fclose($myfile);
}

$sd_ivl_data = array(
	$sd_ivl_code = substr($_SESSION['vd_cavw'],0,8)."_".substr($_POST['ss_code'],0,8)."_".substr(str_replace("-","",$_POST['sd_ivl_stime']),0,8).substr($_POST['sd_ivl_eqtype'],0,4),
	$sn_id = $_POST['sn_id'],
	$ss_id = $_POST['ss_id'],
	$sd_ivl_eqtype = $_POST['sd_ivl_eqtype'],
	$sd_ivl_stime = $_POST['sd_ivl_stime'],
	$sd_ivl_etime = $_POST['sd_ivl_etime'],
	$sd_ivl_data = "H",
	$sd_ivl_picks = "H",
	$sd_ivl_nrec = $_POST['sd_ivl_nrec'],
	$sd_ivl_nfelt = $_POST['sd_ivl_nfelt'],
	$sd_ivl_desc = "online form entry",
	$sd_ivl_ori = "O",
	$sd_ivl_com = $_POST['sd_ivl_com'],
	$cc_id = $_POST['cc_id'],
	$sd_ivl_loaddate = $_POST['sd_ivl_loaddate'],
	$sd_ivl_pubdate = $_POST['sd_ivl_pubdate'],
	$cc_id_load = "134"
);


					
$Column="";
$Values="";
$Val = $sd_ivl_data;
$Col = array(   "sd_ivl_code",
				"sn_id",
				"ss_id",
				"sd_ivl_eqtype",
				"sd_ivl_stime",
				"sd_ivl_etime",
				"sd_ivl_data",
				"sd_ivl_picks",
				"sd_ivl_nrec",
				"sd_ivl_nfelt",
				"sd_ivl_desc",
				"sd_ivl_ori",
				"sd_ivl_com",
				"cc_id",
				"sd_ivl_loaddate",
				"sd_ivl_pubdate",
				"cc_id_load"
);

$TABLE = "sd_ivl";

$Verify="`sd_ivl_code` ='".$sd_ivl_code."'";	
$rs = mysql_query("SELECT `sd_ivl_code` FROM ".$TABLE." WHERE ".$Verify);            
if (mysql_num_rows($rs)>0) {
     echo "Data where sd_ivl_code = $sd_ivl_code is already in the database"."\n";
}
else {		

	$length=sizeof($Val);
	for ($l=0;$l<$length-1;$l++){
		$Column=$Column.$Col[$l].",";
		$Values =$Values."'".$Val[$l]."'".",";
	}
	$Column=$Column.$Col[$length-1];
	$Values =$Values."'".$Val[$length-1]."'";

	$query = mysql_query("INSERT INTO ".$TABLE." (".$Column.") "."VALUES (".$Values.")");     
	if ($query){
		echo "Data where sd_ivl_code = $sd_ivl_code inserted to table"."\n";
	}	
	else {
		echo "Problem encountered: Data where sd_ivl_code = $sd_ivl_code saved to sd_ivl_log.txt"."\n";
		//print_to_file("sd_ivl_log.txt");
	}		

}


?>