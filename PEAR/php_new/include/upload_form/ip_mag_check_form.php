<?php

// Get posted fields
$code=trim($_POST['code']);
$volcano_code=trim($_POST['volcano_code']);
$time=trim($_POST['time']);
$time_unc=trim($_POST['time_unc']);
$start_time=trim($_POST['start_time']);
$start_time_unc=trim($_POST['start_time_unc']);
$end_time=trim($_POST['end_time']);
$end_time_unc=trim($_POST['end_time_unc']);
$deepsupp=trim($_POST['deepsupp']);
$asc=trim($_POST['asc']);
$convb=trim($_POST['convb']);
$conva=trim($_POST['conva']);
$mix=trim($_POST['mix']);
$dike=trim($_POST['dike']);
$pipe=trim($_POST['pipe']);
$sill=trim($_POST['sill']);
$comments=trim($_POST['comments']);
$interpreter=trim($_POST['interpreter']);
$publish_date=trim($_POST['publish_date']);

// Store fields
$_SESSION['upload_form'][$datatype]=array();
$_SESSION['upload_form'][$datatype]['code']=$_POST['code'];
$_SESSION['upload_form'][$datatype]['volcano_code']=$_POST['volcano_code'];
$_SESSION['upload_form'][$datatype]['time']=$_POST['time'];
$_SESSION['upload_form'][$datatype]['time_unc']=$_POST['time_unc'];
$_SESSION['upload_form'][$datatype]['start_time']=$_POST['start_time'];
$_SESSION['upload_form'][$datatype]['start_time_unc']=$_POST['start_time_unc'];
$_SESSION['upload_form'][$datatype]['end_time']=$_POST['end_time'];
$_SESSION['upload_form'][$datatype]['end_time_unc']=$_POST['end_time_unc'];
$_SESSION['upload_form'][$datatype]['deepsupp']=$_POST['deepsupp'];
$_SESSION['upload_form'][$datatype]['asc']=$_POST['asc'];
$_SESSION['upload_form'][$datatype]['convb']=$_POST['convb'];
$_SESSION['upload_form'][$datatype]['conva']=$_POST['conva'];
$_SESSION['upload_form'][$datatype]['mix']=$_POST['mix'];
$_SESSION['upload_form'][$datatype]['dike']=$_POST['dike'];
$_SESSION['upload_form'][$datatype]['pipe']=$_POST['pipe'];
$_SESSION['upload_form'][$datatype]['sill']=$_POST['sill'];
$_SESSION['upload_form'][$datatype]['comments']=$_POST['comments'];
$_SESSION['upload_form'][$datatype]['interpreter']=$_POST['interpreter'];
$_SESSION['upload_form'][$datatype]['publish_date']=$_POST['publish_date'];

// Check errors
$code_has_error=FALSE;
$volcano_code_has_error=FALSE;
$time_has_error=FALSE;
$time_unc_has_error=FALSE;
$start_time_has_error=FALSE;
$start_time_unc_has_error=FALSE;
$end_time_has_error=FALSE;
$end_time_unc_has_error=FALSE;
$deepsupp_has_error=FALSE;
$asc_has_error=FALSE;
$convb_has_error=FALSE;
$conva_has_error=FALSE;
$mix_has_error=FALSE;
$dike_has_error=FALSE;
$pipe_has_error=FALSE;
$sill_has_error=FALSE;
$comments_has_error=FALSE;
$interpreter_has_error=FALSE;
$publish_date_has_error=FALSE;
$has_error=FALSE;
$code_error="";
$volcano_code_error="";
$time_error="";
$time_unc_error="";
$start_time_error="";
$start_time_unc_error="";
$end_time_error="";
$end_time_unc_error="";
$deepsupp_error="";
$asc_error="";
$convb_error="";
$conva_error="";
$mix_error="";
$dike_error="";
$pipe_error="";
$sill_error="";
$comments_error="";
$interpreter_error="";
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
	$count_table_name="ip_mag";
	$count_field_name=array();
	$count_field_value=array();
	$count_field_name[0]="ip_mag_code";
	$count_field_value[0]=$code;
	$count_field_name[1]="cc_id";
	$count_field_value[1]=$interpreter;
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
		$code_error="Magma movement data with such code/ID already exist in database";
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

// Check inferrence time: format
if ($time!="") {
	if (!is_datetime($time, FALSE)) {
		$has_error=TRUE;
		$time_has_error=TRUE;
		$time_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check inferrence time uncertainty: format
if ($time_unc!="") {
	if (!is_datetime($time_unc, TRUE)) {
		$has_error=TRUE;
		$time_unc_has_error=TRUE;
		$time_unc_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
}

// Check start time: format + before inferrence time
if ($start_time!="") {
	// Format
	if (!is_datetime($start_time, FALSE)) {
		$has_error=TRUE;
		$start_time_has_error=TRUE;
		$start_time_error="Incorrect format (YYYY-MM-DD hh:mm:ss)";
	}
	else {
		// Before inferrence time
		if ($time!="" && !$time_has_error) {
			if (!datetime_date_before_date($start_time, $time, $is_before, $error)) {
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
				$start_time_has_error=TRUE;
				$start_time_error="Must be an earlier date than inferrence time";
			}
		}
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

// Check deep supply: nothing

// Check ascent: nothing

// Check convection below: nothing

// Check convection above: nothing

// Check magma mixing: nothing

// Check dike intrusion: nothing

// Check pipe intrusion: nothing

// Check sill intrusion: nothing

// Check comments: max length = 255 characters
if (strlen($comments)>255) {
	$has_error=TRUE;
	$comments_has_error=TRUE;
	$comments_error="Maximum number of characters is limited to 255";
}

// Check interpreter: nothing

// Get current time (= load date)
$load_date=date("Y-m-d H:i:s", (time()-date("Z")));

// Check publish date: prepare automatically
// Get maximum publish date: 2 years after inferrence time OR start time OR end time OR current time
if ($time!="" && !$time_has_error) {
	// Add 2 years to start time
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
elseif ($start_time!="" && !$start_time_has_error) {
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
elseif ($end_time!="" && !$end_time_has_error) {
	// Calculate 2 years after end time
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
$_SESSION['upload_form'][$datatype]['time_has_error']=$time_has_error;
$_SESSION['upload_form'][$datatype]['time_unc_has_error']=$time_unc_has_error;
$_SESSION['upload_form'][$datatype]['start_time_has_error']=$start_time_has_error;
$_SESSION['upload_form'][$datatype]['start_time_unc_has_error']=$start_time_unc_has_error;
$_SESSION['upload_form'][$datatype]['end_time_has_error']=$end_time_has_error;
$_SESSION['upload_form'][$datatype]['end_time_unc_has_error']=$end_time_unc_has_error;
$_SESSION['upload_form'][$datatype]['deepsupp_has_error']=$deepsupp_has_error;
$_SESSION['upload_form'][$datatype]['asc_has_error']=$asc_has_error;
$_SESSION['upload_form'][$datatype]['convb_has_error']=$convb_has_error;
$_SESSION['upload_form'][$datatype]['conva_has_error']=$conva_has_error;
$_SESSION['upload_form'][$datatype]['mix_has_error']=$mix_has_error;
$_SESSION['upload_form'][$datatype]['dike_has_error']=$dike_has_error;
$_SESSION['upload_form'][$datatype]['pipe_has_error']=$pipe_has_error;
$_SESSION['upload_form'][$datatype]['sill_has_error']=$sill_has_error;
$_SESSION['upload_form'][$datatype]['comments_has_error']=$comments_has_error;
$_SESSION['upload_form'][$datatype]['interpreter_has_error']=$interpreter_has_error;
$_SESSION['upload_form'][$datatype]['publish_date_has_error']=$publish_date_has_error;
$_SESSION['upload_form'][$datatype]['has_error']=$has_error;
$_SESSION['upload_form'][$datatype]['code_error']=$code_error;
$_SESSION['upload_form'][$datatype]['volcano_code_error']=$volcano_code_error;
$_SESSION['upload_form'][$datatype]['time_error']=$time_error;
$_SESSION['upload_form'][$datatype]['time_unc_error']=$time_unc_error;
$_SESSION['upload_form'][$datatype]['start_time_error']=$start_time_error;
$_SESSION['upload_form'][$datatype]['start_time_unc_error']=$start_time_unc_error;
$_SESSION['upload_form'][$datatype]['end_time_error']=$end_time_error;
$_SESSION['upload_form'][$datatype]['end_time_unc_error']=$end_time_unc_error;
$_SESSION['upload_form'][$datatype]['deepsupp_error']=$deepsupp_error;
$_SESSION['upload_form'][$datatype]['asc_error']=$asc_error;
$_SESSION['upload_form'][$datatype]['convb_error']=$convb_error;
$_SESSION['upload_form'][$datatype]['conva_error']=$conva_error;
$_SESSION['upload_form'][$datatype]['mix_error']=$mix_error;
$_SESSION['upload_form'][$datatype]['dike_error']=$dike_error;
$_SESSION['upload_form'][$datatype]['pipe_error']=$pipe_error;
$_SESSION['upload_form'][$datatype]['sill_error']=$sill_error;
$_SESSION['upload_form'][$datatype]['comments_error']=$comments_error;
$_SESSION['upload_form'][$datatype]['interpreter_error']=$interpreter_error;
$_SESSION['upload_form'][$datatype]['publish_date_error']=$publish_date_error;

?>