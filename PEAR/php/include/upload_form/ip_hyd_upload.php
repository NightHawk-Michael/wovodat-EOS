<?php

// Insert values into ip_hyd
$insert_table_name="ip_hyd";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="ip_hyd_code";
$insert_field_value[0]=$code;
$insert_field_name[1]="cc_id";
$insert_field_value[1]=$interpreter;
$insert_field_name[2]="ip_hyd_pubdate";
$insert_field_value[2]=$publish_date;
$insert_field_name[3]="ip_hyd_loaddate";
$insert_field_value[3]=$load_date;
$insert_field_name[4]="cc_id_load";
$insert_field_value[4]=$_SESSION['login']['cc_id'];
$cnt=5;
if ($volcano_code!="") {
	$insert_field_name[$cnt]="vd_id";
	$insert_field_value[$cnt]=$vd_id;
	$cnt++;
}
if ($time!="") {
	$insert_field_name[$cnt]="ip_hyd_time";
	$insert_field_value[$cnt]=$time;
	$cnt++;
}
if ($time_unc!="") {
	$insert_field_name[$cnt]="ip_hyd_time_unc";
	$insert_field_value[$cnt]=$time_unc;
	$cnt++;
}
if ($start_time!="") {
	$insert_field_name[$cnt]="ip_hyd_start";
	$insert_field_value[$cnt]=$start_time;
	$cnt++;
}
if ($start_time_unc!="") {
	$insert_field_name[$cnt]="ip_hyd_start_unc";
	$insert_field_value[$cnt]=$start_time_unc;
	$cnt++;
}
if ($end_time!="") {
	$insert_field_name[$cnt]="ip_hyd_end";
	$insert_field_value[$cnt]=$end_time;
	$cnt++;
}
if ($end_time_unc!="") {
	$insert_field_name[$cnt]="ip_hyd_end_unc";
	$insert_field_value[$cnt]=$end_time_unc;
	$cnt++;
}
if ($gwater!="") {
	$insert_field_name[$cnt]="ip_hyd_gwater";
	$insert_field_value[$cnt]=$gwater;
	$cnt++;
}
if ($ipor!="") {
	$insert_field_name[$cnt]="ip_hyd_ipor";
	$insert_field_value[$cnt]=$ipor;
	$cnt++;
}
if ($edef!="") {
	$insert_field_name[$cnt]="ip_hyd_edef";
	$insert_field_value[$cnt]=$edef;
	$cnt++;
}
if ($hfrac!="") {
	$insert_field_name[$cnt]="ip_hyd_hfrac";
	$insert_field_value[$cnt]=$hfrac;
	$cnt++;
}
if ($btrem!="") {
	$insert_field_name[$cnt]="ip_hyd_btrem";
	$insert_field_value[$cnt]=$btrem;
	$cnt++;
}
if ($abgas!="") {
	$insert_field_name[$cnt]="ip_hyd_abgas";
	$insert_field_value[$cnt]=$abgas;
	$cnt++;
}
if ($species!="") {
	$insert_field_name[$cnt]="ip_hyd_species";
	$insert_field_value[$cnt]=$species;
	$cnt++;
}
if ($chim!="") {
	$insert_field_name[$cnt]="ip_hyd_chim";
	$insert_field_value[$cnt]=$chim;
	$cnt++;
}
if ($comments!="") {
	$insert_field_name[$cnt]="ip_hyd_com";
	$insert_field_value[$cnt]=$comments;
	$cnt++;
}
$insert_id=0;
$insert_errors="";
if (!db_insert($insert_table_name, $insert_field_name, $insert_field_value, FALSE, $insert_id, $insert_errors)) {
	// Database error
	switch ($insert_errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1125;
			$_SESSION['errors'][0]['message']=$insert_errors." to db_insert()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4038;
			$_SESSION['errors'][0]['message']=$insert_errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}

?>