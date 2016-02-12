<?php

// Database functions
require_once "php/funcs/db_funcs.php";

// Check functions
require_once "php/funcs/check_funcs.php";

// Get values of interest
$query_sql="SELECT ms_id, ms_code, cn_id, ms_lat, ms_lon, ms_stime, ms_etime, cc_id, cc_id2, cc_id3, cc_id_load FROM ms";
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [ms.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// For each row
foreach ($query_results as $row) {
	
	// Row ID
	$row_id=$row['ms_id'];
	
	// Check required field: ms_lat
	if (empty($row['ms_lat'])) {
		array_push($msgs, $row_id." - Required value is empty: ms_lat");
	}
	
	// Check required field: ms_lon
	if (empty($row['ms_lon'])) {
		array_push($msgs, $row_id." - Required value is empty: ms_lon");
	}
	
	// Check required field: ms_stime
	if (empty($row['ms_stime'])) {
		array_push($msgs, $row_id." - Required value is empty: ms_stime");
	}
	
	// Check time order: ms_stime < ms_etime
	if (!empty($row['ms_stime']) && !empty($row['ms_etime'])) {
		if (strcmp($row['ms_stime'], $row['ms_etime']) > 0) {
			array_push($msgs, $row_id." - Incorrect time order: ms_stime=".$row['ms_stime']." > ms_etime=".$row['ms_etime']);
		}
	}
	
	// Check link (inclusion 2): cn_id
	check_link_include2($row['cn_id'], 'cn_id', 'cn', 'cn_id', 'cn_stime', 'cn_etime', 'ms_stime', $row['ms_stime'], 'ms_etime', $row['ms_etime'], $row_id, $msgs);
	
	// Check link: cc_id
	check_link($row['cc_id'], 'cc_id', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id2
	check_link($row['cc_id2'], 'cc_id2', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id3
	check_link($row['cc_id3'], 'cc_id3', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check link: cc_id_load
	check_link($row['cc_id_load'], 'cc_id_load', 'cc', 'cc_id', $row_id, $msgs);
	
	// Check uniqueness
	check_unique_time("ms", $row['ms_code'], $row['cc_id'], $row['cc_id2'], $row['cc_id3'], $row['ms_stime'], $row['ms_etime'], $row_id, $msgs);
	
	if (count($msgs)>30) {
		break;
	}
}

?>