<?php

// Get posted fields
$code=trim($_POST['code']);
$volcano_code=trim($_POST['volcano_code']);
$evn_code=trim($_POST['evn_code']);
$evs_code=trim($_POST['evs_code']);
$time=trim($_POST['time']);
$time_unc=trim($_POST['time_unc']);
$city=trim($_POST['city']);
$maxdist=trim($_POST['maxdist']);
$maxrint=trim($_POST['maxrint']);
$maxrint_dist=trim($_POST['maxrint_dist']);
$collector=trim($_POST['collector']);
$publish_date=trim($_POST['publish_date']);

// Store fields
$_SESSION['upload_form'][$datatype]=array();
$_SESSION['upload_form'][$datatype]['code']=$_POST['code'];
$_SESSION['upload_form'][$datatype]['volcano_code']=$_POST['volcano_code'];
$_SESSION['upload_form'][$datatype]['evn_code']=$_POST['evn_code'];
$_SESSION['upload_form'][$datatype]['evs_code']=$_POST['evs_code'];
$_SESSION['upload_form'][$datatype]['time']=$_POST['time'];
$_SESSION['upload_form'][$datatype]['time_unc']=$_POST['time_unc'];
$_SESSION['upload_form'][$datatype]['city']=$_POST['city'];
$_SESSION['upload_form'][$datatype]['maxdist']=$_POST['maxdist'];
$_SESSION['upload_form'][$datatype]['maxrint']=$_POST['maxrint'];
$_SESSION['upload_form'][$datatype]['maxrint_dist']=$_POST['maxrint_dist'];
$_SESSION['upload_form'][$datatype]['collector']=$_POST['collector'];
$_SESSION['upload_form'][$datatype]['publish_date']=$_POST['publish_date'];

// Check errors
$code_has_error=FALSE;
$volcano_code_has_error=FALSE;
$evn_code_has_error=FALSE;
$evs_code_has_error=FALSE;
$time_has_error=FALSE;
$time_unc_has_error=FALSE;
$city_has_error=FALSE;
$maxdist_has_error=FALSE;
$maxrint_has_error=FALSE;
$maxrint_dist_has_error=FALSE;
$collector_has_error=FALSE;
$publish_date_has_error=FALSE;
$has_error=FALSE;
$code_error="";
$volcano_code_error="";
$evn_code_error="";
$evs_code_error="";
$time_error="";
$time_unc_error="";
$city_error="";
$maxdist_error="";
$maxrint_error="";
$maxrint_dist_error="";
$collector_error="";
$publish_date_error="";

// Database functions
require_once "php/funcs/db_funcs.php";
// Datetime functions
require_once "php/funcs/datetime_funcs.php";

// Check code: 1) required + 2) must be unique
// Required
if ($code=="") {
	$has_error=TRUE;
	$code_has_error=TRUE;
	$code_error="This field is required";
}
else {
	// Must be unique
	$count_table_name="sd_int";
	$count_field_name=array();
	$count_field_value=array();
	$count_field_name[0]="sd_int_code";
	$count_field_value[0]=$code;
	$count_field_name[1]="cc_id";
	$count_field_value[1]=$collector;
	$count=0;
	$count_errors="";
	if (!db_count($count_table_name, $count_field_name, $count_field_value, $count, $count_errors)) {
		// Database error
		switch ($count_errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1039;
				$_SESSION['errors'][0]['message']=$count_errors." to db_count()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4011;
				$_SESSION['errors'][0]['message']=$count_errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	if ($count!=0) {
		// Data already in database
		$has_error=TRUE;
		$code_has_error=TRUE;
		$code_error="Observation data with such code/ID already exist in database";
	}
}

// Check collector: nothing

// Check volcano code: get vd_id
if ($volcano_code!="") {
	$select_table="vd_inf";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="vd_id";
	$select_where_field_name=array();
	$select_where_field_value=array();
	$select_where_field_name[0]="vd_inf_cavw";
	$select_where_field_value[0]=$volcano_code;
	$select_errors="";
	if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $select_errors)) {
		// Database error
		switch ($select_errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1043;
				$_SESSION['errors'][0]['message']=$select_errors." to db_select()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4015;
				$_SESSION['errors'][0]['message']=$select_errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	$num=count($select_field_value);
	// If no volcano was selected
	if ($num==0) {
		$has_error=TRUE;
		$volcano_code_has_error=TRUE;
		$volcano_code_error="No volcano with this CAVW number was found in database";
	}
	else {
		// Get vd_id
		$vd_id=$select_field_value[0][0];
	}
}

// Check network event code: get sd_evn_id
if ($evn_code!="") {
	$select_table="sd_evn";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="sd_evn_id";
	$select_where_field_name=array();
	$select_where_field_value=array();
	$select_where_field_name[0]="sd_evn_code";
	$select_where_field_value[0]=$evn_code;
	$select_where_field_name[1]="cc_id";
	$select_where_field_value[1]=$collector;
	$select_errors="";
	if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $select_errors)) {
		// Database error
		switch ($select_errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1043;
				$_SESSION['errors'][0]['message']=$select_errors." to db_select()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4015;
				$_SESSION['errors'][0]['message']=$select_errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	$num=count($select_field_value);
	// If no network event was selected
	if ($num==0) {
		$has_error=TRUE;
		$evn_code_has_error=TRUE;
		$evn_code_error="No network event with this code was found in database";
	}
	else {
		// Get sd_evn_id
		$sd_evn_id=$select_field_value[0][0];
	}
}

// Check single station event code: get sd_evs_id
if ($evs_code!="") {
	$select_table="sd_evs";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="sd_evs_id";
	$select_where_field_name=array();
	$select_where_field_value=array();
	$select_where_field_name[0]="sd_evs_code";
	$select_where_field_value[0]=$evs_code;
	$select_where_field_name[1]="cc_id";
	$select_where_field_value[1]=$collector;
	$select_errors="";
	if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $select_errors)) {
		// Database error
		switch ($select_errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1043;
				$_SESSION['errors'][0]['message']=$select_errors." to db_select()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4015;
				$_SESSION['errors'][0]['message']=$select_errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	$num=count($select_field_value);
	// If no single station event was selected
	if ($num==0) {
		$has_error=TRUE;
		$evs_code_has_error=TRUE;
		$evs_code_error="No single station event with this code was found in database";
	}
	else {
		// Get sd_evs_id
		$sd_evs_id=$select_field_value[0][0];
	}
}

// Check time: format
if ($time!="") {
	if (!is_datetime($time, FALSE)) {
		$has_error=TRUE;
		$time_has_error=TRUE;
		$time_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check time uncertainty: format
if ($time_unc!="") {
	if (!is_datetime($time_unc, TRUE)) {
		$has_error=TRUE;
		$time_unc_has_error=TRUE;
		$time_unc_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check city: nothing

// Check maximum distance felt: float format
if ($maxdist!="") {
	if (!is_numeric($maxdist)) {
		$has_error=TRUE;
		$maxdist_has_error=TRUE;
		$maxdist_error="Incorrect format (expected is a float)";
	}
}

// Check maximum reported intensity: float format
if ($maxrint!="") {
	if (!is_numeric($maxrint)) {
		$has_error=TRUE;
		$maxrint_has_error=TRUE;
		$maxrint_error="Incorrect format (expected is a float)";
	}
}

// Check distance at maximum reported intensity: float format
if ($maxrint_dist!="") {
	if (!is_numeric($maxrint_dist)) {
		$has_error=TRUE;
		$maxrint_dist_has_error=TRUE;
		$maxrint_dist_error="Incorrect format (expected is a float)";
	}
}

// Get current time (= load date)
$load_date=date("Y-m-d H:i:s", (time()-date("Z")));

// Check publish date: prepare automatically
// Get maximum publish date: 2 years after time OR 2 years after current time
if ($time!="" && !$time_has_error) {
	// Add 2 years to time
	if (!datetime_add_datetime($time, "0002-00-00 00:00:00", $max_publish_date, $error)) {
		// System error
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1043;
		$_SESSION['errors'][0]['message']=$error;
		$_SESSION['l_errors']=1;
		// Redirect user to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}
else {
	// Calculate 2 years after current time
	if (!datetime_add_datetime($load_date, "0002-00-00 00:00:00", $max_publish_date, $error)) {
		// System error
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1043;
		$_SESSION['errors'][0]['message']=$error;
		$_SESSION['l_errors']=1;
		// Redirect user to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}
// If user entered a publish date which is well formatted
if ($publish_date!="" && is_datetime($publish_date, FALSE)) {
	// If publish date is later than maximum publish date, take maximum publish date
	if (!datetime_date_before_date($publish_date, $max_publish_date, $is_before, $error)) {
		// System error
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1043;
		$_SESSION['errors'][0]['message']=$error;
		$_SESSION['l_errors']=1;
		// Redirect user to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
	if ($is_before==2) {
		$publish_date=$max_publish_date;
	}
}
else {
	// User publish date is not valid, so take maximum publish date (automatically calculated)
	$publish_date=$max_publish_date;
}

// Store errors
$_SESSION['upload_form'][$datatype]['code_has_error']=$code_has_error;
$_SESSION['upload_form'][$datatype]['volcano_code_has_error']=$volcano_code_has_error;
$_SESSION['upload_form'][$datatype]['evn_code_has_error']=$evn_code_has_error;
$_SESSION['upload_form'][$datatype]['evs_code_has_error']=$evs_code_has_error;
$_SESSION['upload_form'][$datatype]['time_has_error']=$time_has_error;
$_SESSION['upload_form'][$datatype]['time_unc_has_error']=$time_unc_has_error;
$_SESSION['upload_form'][$datatype]['city_has_error']=$city_has_error;
$_SESSION['upload_form'][$datatype]['maxdist_has_error']=$maxdist_has_error;
$_SESSION['upload_form'][$datatype]['maxrint_has_error']=$maxrint_has_error;
$_SESSION['upload_form'][$datatype]['maxrint_dist_has_error']=$maxrint_dist_has_error;
$_SESSION['upload_form'][$datatype]['collector_has_error']=$collector_has_error;
$_SESSION['upload_form'][$datatype]['publish_date_has_error']=$publish_date_has_error;
$_SESSION['upload_form'][$datatype]['has_error']=$has_error;
$_SESSION['upload_form'][$datatype]['code_error']=$code_error;
$_SESSION['upload_form'][$datatype]['volcano_code_error']=$volcano_code_error;
$_SESSION['upload_form'][$datatype]['evn_code_error']=$evn_code_error;
$_SESSION['upload_form'][$datatype]['evs_code_error']=$evs_code_error;
$_SESSION['upload_form'][$datatype]['time_error']=$time_error;
$_SESSION['upload_form'][$datatype]['time_unc_error']=$time_unc_error;
$_SESSION['upload_form'][$datatype]['city_error']=$city_error;
$_SESSION['upload_form'][$datatype]['maxdist_error']=$maxdist_error;
$_SESSION['upload_form'][$datatype]['maxrint_error']=$maxrint_error;
$_SESSION['upload_form'][$datatype]['maxrint_dist_error']=$maxrint_dist_error;
$_SESSION['upload_form'][$datatype]['collector_error']=$collector_error;
$_SESSION['upload_form'][$datatype]['publish_date_error']=$publish_date_error;

?>