<?php

// Database functions
require_once "php/funcs/db_funcs.php";

// Check functions
require_once "php/funcs/check_funcs.php";

// Get values of interest
$query_sql="SELECT mi_id, mi_code, ms_id, mi_stime, mi_etime, cc_id, cc_id2, cc_id3, cc_id_load FROM mi";
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [mi.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// For each row
foreach ($query_results as $row) {
	
	// Row ID
	$row_id=$row['mi_id'];
	
	// Check required field: mi_stime
	if (empty($row['mi_stime'])) {
		array_push($msgs, $row_id." - Required value is empty: mi_stime");
	}
	
	// Check time order: mi_stime < mi_etime
	if (!empty($row['mi_stime']) && !empty($row['mi_etime'])) {
		if (strcmp($row['mi_stime'], $row['mi_etime']) > 0) {
			array_push($msgs, $row_id." - Incorrect time order: mi_stime=".$row['mi_stime']." > mi_etime=".$row['mi_etime']);
		}
	}
	
	// Check link (inclusion 2): ms_id
	check_link_include2($row['ms_id'], 'ms_id', 'ms', 'ms_id', 'ms_stime', 'ms_etime', 'mi_stime', $row['mi_stime'], 'mi_etime', $row['mi_etime'], $row_id, $msgs);
	
	// Check link: cc_id
	check_link($row['cc_id'], 'cc_id', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id2
	check_link($row['cc_id2'], 'cc_id2', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id3
	check_link($row['cc_id3'], 'cc_id3', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id_load
	check_link($row['cc_id_load'], 'cc_id_load', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check uniqueness
	check_unique_time("mi", $row['mi_code'], $row['cc_id'], $row['cc_id2'], $row['cc_id3'], $row['mi_stime'], $row['mi_etime'], $row_id, $msgs);
	
	if (count($msgs)>30) {
		break;
	}
}

?>