<?php

// Insert values into ip_tec
$insert_table_name="ip_tec";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="ip_tec_code";
$insert_field_value[0]=$code;
$insert_field_name[1]="cc_id";
$insert_field_value[1]=$interpreter;
$insert_field_name[2]="ip_tec_pubdate";
$insert_field_value[2]=$publish_date;
$insert_field_name[3]="ip_tec_loaddate";
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
	$insert_field_name[$cnt]="ip_tec_time";
	$insert_field_value[$cnt]=$time;
	$cnt++;
}
if ($time_unc!="") {
	$insert_field_name[$cnt]="ip_tec_time_unc";
	$insert_field_value[$cnt]=$time_unc;
	$cnt++;
}
if ($start_time!="") {
	$insert_field_name[$cnt]="ip_tec_start";
	$insert_field_value[$cnt]=$start_time;
	$cnt++;
}
if ($start_time_unc!="") {
	$insert_field_name[$cnt]="ip_tec_start_unc";
	$insert_field_value[$cnt]=$start_time_unc;
	$cnt++;
}
if ($end_time!="") {
	$insert_field_name[$cnt]="ip_tec_end";
	$insert_field_value[$cnt]=$end_time;
	$cnt++;
}
if ($end_time_unc!="") {
	$insert_field_name[$cnt]="ip_tec_end_unc";
	$insert_field_value[$cnt]=$end_time_unc;
	$cnt++;
}
if ($change!="") {
	$insert_field_name[$cnt]="ip_tec_change";
	$insert_field_value[$cnt]=$change;
	$cnt++;
}
if ($sstress!="") {
	$insert_field_name[$cnt]="ip_tec_sstress";
	$insert_field_value[$cnt]=$sstress;
	$cnt++;
}
if ($dstrain!="") {
	$insert_field_name[$cnt]="ip_tec_dstrain";
	$insert_field_value[$cnt]=$dstrain;
	$cnt++;
}
if ($fault!="") {
	$insert_field_name[$cnt]="ip_tec_fault";
	$insert_field_value[$cnt]=$fault;
	$cnt++;
}
if ($seq!="") {
	$insert_field_name[$cnt]="ip_tec_seq";
	$insert_field_value[$cnt]=$seq;
	$cnt++;
}
if ($press!="") {
	$insert_field_name[$cnt]="ip_tec_press";
	$insert_field_value[$cnt]=$press;
	$cnt++;
}
if ($depress!="") {
	$insert_field_name[$cnt]="ip_tec_depress";
	$insert_field_value[$cnt]=$depress;
	$cnt++;
}
if ($hppress!="") {
	$insert_field_name[$cnt]="ip_tec_hppress";
	$insert_field_value[$cnt]=$hppress;
	$cnt++;
}
if ($etide!="") {
	$insert_field_name[$cnt]="ip_tec_etide";
	$insert_field_value[$cnt]=$etide;
	$cnt++;
}
if ($atmp!="") {
	$insert_field_name[$cnt]="ip_tec_atmp";
	$insert_field_value[$cnt]=$atmp;
	$cnt++;
}
if ($comments!="") {
	$insert_field_name[$cnt]="ip_tec_com";
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