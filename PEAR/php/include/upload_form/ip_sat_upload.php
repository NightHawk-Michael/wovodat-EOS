<?php

// Insert values into ip_sat
$insert_table_name="ip_sat";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="ip_sat_code";
$insert_field_value[0]=$code;
$insert_field_name[1]="cc_id";
$insert_field_value[1]=$interpreter;
$insert_field_name[2]="ip_sat_pubdate";
$insert_field_value[2]=$publish_date;
$insert_field_name[3]="ip_sat_loaddate";
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
	$insert_field_name[$cnt]="ip_sat_time";
	$insert_field_value[$cnt]=$time;
	$cnt++;
}
if ($time_unc!="") {
	$insert_field_name[$cnt]="ip_sat_time_unc";
	$insert_field_value[$cnt]=$time_unc;
	$cnt++;
}
if ($start_time!="") {
	$insert_field_name[$cnt]="ip_sat_start";
	$insert_field_value[$cnt]=$start_time;
	$cnt++;
}
if ($start_time_unc!="") {
	$insert_field_name[$cnt]="ip_sat_start_unc";
	$insert_field_value[$cnt]=$start_time_unc;
	$cnt++;
}
if ($end_time!="") {
	$insert_field_name[$cnt]="ip_sat_end";
	$insert_field_value[$cnt]=$end_time;
	$cnt++;
}
if ($end_time_unc!="") {
	$insert_field_name[$cnt]="ip_sat_end_unc";
	$insert_field_value[$cnt]=$end_time_unc;
	$cnt++;
}
if ($co2!="") {
	$insert_field_name[$cnt]="ip_sat_co2";
	$insert_field_value[$cnt]=$co2;
	$cnt++;
}
if ($h2o!="") {
	$insert_field_name[$cnt]="ip_sat_h2o";
	$insert_field_value[$cnt]=$h2o;
	$cnt++;
}
if ($decomp!="") {
	$insert_field_name[$cnt]="ip_sat_decomp";
	$insert_field_value[$cnt]=$decomp;
	$cnt++;
}
if ($dfo2!="") {
	$insert_field_name[$cnt]="ip_sat_dfo2";
	$insert_field_value[$cnt]=$dfo2;
	$cnt++;
}
if ($add!="") {
	$insert_field_name[$cnt]="ip_sat_add";
	$insert_field_value[$cnt]=$add;
	$cnt++;
}
if ($xtl!="") {
	$insert_field_name[$cnt]="ip_sat_xtl";
	$insert_field_value[$cnt]=$xtl;
	$cnt++;
}
if ($ves!="") {
	$insert_field_name[$cnt]="ip_sat_ves";
	$insert_field_value[$cnt]=$ves;
	$cnt++;
}
if ($deves!="") {
	$insert_field_name[$cnt]="ip_sat_deves";
	$insert_field_value[$cnt]=$deves;
	$cnt++;
}
if ($degas!="") {
	$insert_field_name[$cnt]="ip_sat_degas";
	$insert_field_value[$cnt]=$degas;
	$cnt++;
}
if ($comments!="") {
	$insert_field_name[$cnt]="ip_sat_com";
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