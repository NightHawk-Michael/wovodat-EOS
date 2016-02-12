<?php

// Database functions
require_once "php/funcs/db_funcs.php";

// Check functions
require_once "php/funcs/check_funcs.php";

// Get values of interest
$query_sql="SELECT med_id, med_code, ms_id, mi_id, med_time, cc_id, cc_id2, cc_id3, cc_id_load FROM med";
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [hd.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// For each row
foreach ($query_results as $row) {
	
	// Row ID
	$row_id=$row['med_id'];
	
	// Check required field: med_time
	if (empty($row['med_time'])) {
		array_push($msgs, $row_id." - Required value is empty: med_time");
	}
	
	// Check link (inclusion 1): mi_id
	check_link_include1($row['mi_id'], 'mi_id', 'mi', 'mi_id', 'mi_stime', 'mi_etime', 'med_time', $row['med_time'], $row_id, $msgs);
	
	// Check link (inclusion 1): ms_id
	check_link_include1($row['ms_id'], 'ms_id', 'ms', 'ms_id', 'ms_stime', 'ms_etime', 'med_time', $row['med_time'], $row_id, $msgs);
	
	// Check link: cc_id
	check_link($row['cc_id'], 'cc_id', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id2
	check_link($row['cc_id2'], 'cc_id2', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id3
	check_link($row['cc_id3'], 'cc_id3', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id_load
	check_link($row['cc_id_load'], 'cc_id_load', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check value: hs_id=hi_id.hs_id
	check_value($row['ms_id'], 'ms_id', 'ms_id', 'mi', 'mi_id', $row['mi_id'], $row_id, $msgs);
	
	// Check uniqueness
	check_unique("med", $row['med_code'], $row['cc_id'], $row['cc_id2'], $row['cc_id3'], $row_id, $msgs);
	
	if (count($msgs)>30) {
		break;
	}
}

?>