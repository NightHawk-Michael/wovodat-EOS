<?php

// Get posted fields
$code=trim($_POST['code']);
$volcano_code=trim($_POST['volcano_code']);
$description=trim($_POST['description']);
$start_time=trim($_POST['start_time']);
$start_time_unc=trim($_POST['start_time_unc']);
$end_time=trim($_POST['end_time']);
$end_time_unc=trim($_POST['end_time_unc']);
$observer=trim($_POST['observer']);
$publish_date=trim($_POST['publish_date']);

// Store fields
$_SESSION['upload_form'][$datatype]=array();
$_SESSION['upload_form'][$datatype]['code']=$_POST['code'];
$_SESSION['upload_form'][$datatype]['volcano_code']=$_POST['volcano_code'];
$_SESSION['upload_form'][$datatype]['description']=$_POST['description'];
$_SESSION['upload_form'][$datatype]['start_time']=$_POST['start_time'];
$_SESSION['upload_form'][$datatype]['start_time_unc']=$_POST['start_time_unc'];
$_SESSION['upload_form'][$datatype]['end_time']=$_POST['end_time'];
$_SESSION['upload_form'][$datatype]['end_time_unc']=$_POST['end_time_unc'];
$_SESSION['upload_form'][$datatype]['observer']=$_POST['observer'];
$_SESSION['upload_form'][$datatype]['publish_date']=$_POST['publish_date'];

// Check errors
$code_has_error=FALSE;
$volcano_code_has_error=FALSE;
$description_has_error=FALSE;
$start_time_has_error=FALSE;
$start_time_unc_has_error=FALSE;
$end_time_has_error=FALSE;
$end_time_unc_has_error=FALSE;
$observer_has_error=FALSE;
$publish_date_has_error=FALSE;
$has_error=FALSE;
$code_error="";
$volcano_code_error="";
$description_error="";
$start_time_error="";
$start_time_unc_error="";
$end_time_error="";
$end_time_unc_error="";
$observer_error="";
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
	$count_table_name="co";
	$count_field_name=array();
	$count_field_value=array();
	$count_field_name[0]="co_code";
	$count_field_value[0]=$code;
	$count_field_name[1]="cc_id";
	$count_field_value[1]=$observer;
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

// Check description: nothing

// Check start time: format
if ($start_time!="") {
	if (!is_datetime($start_time, FALSE)) {
		$has_error=TRUE;
		$start_time_has_error=TRUE;
		$start_time_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check start time uncertainty: format
if ($start_time_unc!="") {
	if (!is_datetime($start_time_unc, TRUE)) {
		$has_error=TRUE;
		$start_time_unc_has_error=TRUE;
		$start_time_unc_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check end time: format + later than start time
if ($end_time!="") {
	// Format
	if (!is_datetime($end_time, FALSE)) {
		$has_error=TRUE;
		$end_time_has_error=TRUE;
		$end_time_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
	else {
		// Later than start time
		if ($start_time!="" && !$start_time_has_error) {
			if (!datetime_date_before_date($start_time, $end_time, $is_before, $error)) {
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
				$has_error=TRUE;
				$end_time_has_error=TRUE;
				$end_time_error="Must be a later date compared to start time";
			}
		}
	}
}

// Check end time uncertainty: format
if ($end_time_unc!="") {
	if (!is_datetime($end_time_unc, TRUE)) {
		$has_error=TRUE;
		$end_time_unc_has_error=TRUE;
		$end_time_unc_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check observer: nothing

// Get current time (= load date)
$load_date=date("Y-m-d H:i:s", (time()-date("Z")));

// Check publish date: prepare automatically
// Get maximum publish date: 2 years after start time OR 2 years after end time OR 2 years after current time
if ($start_time!="" && !$start_time_has_error) {
	// Add 2 years to start time
	if (!datetime_add_datetime($start_time, "0002-00-00 00:00:00", $max_publish_date, $error)) {
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
	// Calculate 2 years after end time
	if ($end_time!="" && !$end_time_has_error) {
		// Add 2 years to end time
		if (!datetime_add_datetime($end_time, "0002-00-00 00:00:00", $max_publish_date, $error)) {
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
$_SESSION['upload_form'][$datatype]['description_has_error']=$description_has_error;
$_SESSION['upload_form'][$datatype]['start_time_has_error']=$start_time_has_error;
$_SESSION['upload_form'][$datatype]['start_time_unc_has_error']=$start_time_unc_has_error;
$_SESSION['upload_form'][$datatype]['end_time_has_error']=$end_time_has_error;
$_SESSION['upload_form'][$datatype]['end_time_unc_has_error']=$end_time_unc_has_error;
$_SESSION['upload_form'][$datatype]['observer_has_error']=$observer_has_error;
$_SESSION['upload_form'][$datatype]['publish_date_has_error']=$publish_date_has_error;
$_SESSION['upload_form'][$datatype]['has_error']=$has_error;
$_SESSION['upload_form'][$datatype]['code_error']=$code_error;
$_SESSION['upload_form'][$datatype]['volcano_code_error']=$volcano_code_error;
$_SESSION['upload_form'][$datatype]['description_error']=$description_error;
$_SESSION['upload_form'][$datatype]['start_time_error']=$start_time_error;
$_SESSION['upload_form'][$datatype]['start_time_unc_error']=$start_time_unc_error;
$_SESSION['upload_form'][$datatype]['end_time_error']=$end_time_error;
$_SESSION['upload_form'][$datatype]['end_time_unc_error']=$end_time_unc_error;
$_SESSION['upload_form'][$datatype]['observer_error']=$observer_error;
$_SESSION['upload_form'][$datatype]['publish_date_error']=$publish_date_error;

?>