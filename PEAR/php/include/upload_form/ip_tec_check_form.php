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
$change=trim($_POST['change']);
$sstress=trim($_POST['sstress']);
$dstrain=trim($_POST['dstrain']);
$fault=trim($_POST['fault']);
$seq=trim($_POST['seq']);
$press=trim($_POST['press']);
$depress=trim($_POST['depress']);
$hppress=trim($_POST['hppress']);
$etide=trim($_POST['etide']);
$atmp=trim($_POST['atmp']);
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
$_SESSION['upload_form'][$datatype]['change']=$_POST['change'];
$_SESSION['upload_form'][$datatype]['sstress']=$_POST['sstress'];
$_SESSION['upload_form'][$datatype]['dstrain']=$_POST['dstrain'];
$_SESSION['upload_form'][$datatype]['fault']=$_POST['fault'];
$_SESSION['upload_form'][$datatype]['seq']=$_POST['seq'];
$_SESSION['upload_form'][$datatype]['press']=$_POST['press'];
$_SESSION['upload_form'][$datatype]['depress']=$_POST['depress'];
$_SESSION['upload_form'][$datatype]['hppress']=$_POST['hppress'];
$_SESSION['upload_form'][$datatype]['etide']=$_POST['etide'];
$_SESSION['upload_form'][$datatype]['atmp']=$_POST['atmp'];
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
$change_has_error=FALSE;
$sstress_has_error=FALSE;
$dstrain_has_error=FALSE;
$fault_has_error=FALSE;
$seq_has_error=FALSE;
$press_has_error=FALSE;
$depress_has_error=FALSE;
$hppress_has_error=FALSE;
$etide_has_error=FALSE;
$atmp_has_error=FALSE;
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
$change_error="";
$sstress_error="";
$dstrain_error="";
$fault_error="";
$seq_error="";
$press_error="";
$depress_error="";
$hppress_error="";
$etide_error="";
$atmp_error="";
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
	$count_table_name="ip_tec";
	$count_field_name=array();
	$count_field_value=array();
	$count_field_name[0]="ip_tec_code";
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
		$code_error="Regional tectonics interaction data with such code/ID already exist in database";
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

// Check tectonic changes: nothing

// Check static stress: nothing

// Check dynamic strain: nothing

// Check local shear: nothing

// Check slow earthquake: nothing

// Check distal pressurization: nothing

// Check distal depressurization: nothing

// Check hydrothermal lubrication: nothing

// Check Earth-tide: nothing

// Check atmospheric influence: nothing

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
$_SESSION['upload_form'][$datatype]['change_has_error']=$change_has_error;
$_SESSION['upload_form'][$datatype]['sstress_has_error']=$sstress_has_error;
$_SESSION['upload_form'][$datatype]['dstrain_has_error']=$dstrain_has_error;
$_SESSION['upload_form'][$datatype]['fault_has_error']=$fault_has_error;
$_SESSION['upload_form'][$datatype]['seq_has_error']=$seq_has_error;
$_SESSION['upload_form'][$datatype]['press_has_error']=$press_has_error;
$_SESSION['upload_form'][$datatype]['depress_has_error']=$depress_has_error;
$_SESSION['upload_form'][$datatype]['hppress_has_error']=$hppress_has_error;
$_SESSION['upload_form'][$datatype]['etide_has_error']=$etide_has_error;
$_SESSION['upload_form'][$datatype]['atmp_has_error']=$atmp_has_error;
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
$_SESSION['upload_form'][$datatype]['change_error']=$change_error;
$_SESSION['upload_form'][$datatype]['sstress_error']=$sstress_error;
$_SESSION['upload_form'][$datatype]['dstrain_error']=$dstrain_error;
$_SESSION['upload_form'][$datatype]['fault_error']=$fault_error;
$_SESSION['upload_form'][$datatype]['seq_error']=$seq_error;
$_SESSION['upload_form'][$datatype]['press_error']=$press_error;
$_SESSION['upload_form'][$datatype]['depress_error']=$depress_error;
$_SESSION['upload_form'][$datatype]['hppress_error']=$hppress_error;
$_SESSION['upload_form'][$datatype]['etide_error']=$etide_error;
$_SESSION['upload_form'][$datatype]['atmp_error']=$atmp_error;
$_SESSION['upload_form'][$datatype]['comments_error']=$comments_error;
$_SESSION['upload_form'][$datatype]['interpreter_error']=$interpreter_error;
$_SESSION['upload_form'][$datatype]['publish_date_error']=$publish_date_error;

?>