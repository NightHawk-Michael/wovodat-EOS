<?php

// Insert values into sd_int
$insert_table_name="sd_int";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="sd_int_code";
$insert_field_value[0]=$code;
$insert_field_name[1]="cc_id";
$insert_field_value[1]=$collector;
$insert_field_name[2]="sd_int_pubdate";
$insert_field_value[2]=$publish_date;
$insert_field_name[3]="sd_int_loaddate";
$insert_field_value[3]=$load_date;
$insert_field_name[4]="cc_id_load";
$insert_field_value[4]=$_SESSION['login']['cc_id'];
$cnt=5;
if ($volcano_code!="") {
	$insert_field_name[$cnt]="vd_id";
	$insert_field_value[$cnt]=$vd_id;
	$cnt++;
}
if ($evn_code!="") {
	$insert_field_name[$cnt]="sd_evn_id";
	$insert_field_value[$cnt]=$sd_evn_id;
	$cnt++;
}
if ($evs_code!="") {
	$insert_field_name[$cnt]="sd_evs_id";
	$insert_field_value[$cnt]=$sd_evs_id;
	$cnt++;
}
if ($time!="") {
	$insert_field_name[$cnt]="sd_int_time";
	$insert_field_value[$cnt]=$time;
	$cnt++;
}
if ($time_unc!="") {
	$insert_field_name[$cnt]="sd_int_time_unc";
	$insert_field_value[$cnt]=$time_unc;
	$cnt++;
}
if ($city!="") {
	$insert_field_name[$cnt]="sd_int_city";
	$insert_field_value[$cnt]=$city;
	$cnt++;
}
if ($maxdist!="") {
	$insert_field_name[$cnt]="sd_int_maxdist";
	$insert_field_value[$cnt]=$maxdist;
	$cnt++;
}
if ($maxrint!="") {
	$insert_field_name[$cnt]="sd_int_maxrint";
	$insert_field_value[$cnt]=$maxrint;
	$cnt++;
}
if ($maxrint_dist!="") {
	$insert_field_name[$cnt]="sd_int_maxrint_dist";
	$insert_field_value[$cnt]=$maxrint_dist;
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