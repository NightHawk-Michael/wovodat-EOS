<?php

// Insert values into co
$insert_table_name="co";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="co_code";
$insert_field_value[0]=$code;
$insert_field_name[1]="cc_id";
$insert_field_value[1]=$observer;
$insert_field_name[2]="co_pubdate";
$insert_field_value[2]=$publish_date;
$insert_field_name[3]="co_loaddate";
$insert_field_value[3]=$load_date;
$insert_field_name[4]="cc_id_load";
$insert_field_value[4]=$_SESSION['login']['cc_id'];
$cnt=5;
if ($volcano_code!="") {
	$insert_field_name[$cnt]="vd_id";
	$insert_field_value[$cnt]=$vd_id;
	$cnt++;
}
if ($description!="") {
	$insert_field_name[$cnt]="co_observe";
	$insert_field_value[$cnt]=$description;
	$cnt++;
}
if ($start_time!="") {
	$insert_field_name[$cnt]="co_stime";
	$insert_field_value[$cnt]=$start_time;
	$cnt++;
}
if ($start_time_unc!="") {
	$insert_field_name[$cnt]="co_stime_unc";
	$insert_field_value[$cnt]=$start_time_unc;
	$cnt++;
}
if ($end_time!="") {
	$insert_field_name[$cnt]="co_etime";
	$insert_field_value[$cnt]=$end_time;
	$cnt++;
}
if ($end_time_unc!="") {
	$insert_field_name[$cnt]="co_etime_unc";
	$insert_field_value[$cnt]=$end_time_unc;
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