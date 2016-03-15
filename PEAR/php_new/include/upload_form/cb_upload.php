<?php

// Insert values into cb
$insert_table_name="cb";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="cb_loaddate";
$insert_field_value[0]=$load_date;
$insert_field_name[1]="cc_id_load";
$insert_field_value[1]=$_SESSION['login']['cc_id'];
$cnt=2;
if ($authors!="") {
	$insert_field_name[$cnt]="cb_auth";
	$insert_field_value[$cnt]=$authors;
	$cnt++;
}
if ($pub_year!="") {
	$insert_field_name[$cnt]="cb_year";
	$insert_field_value[$cnt]=$pub_year;
	$cnt++;
}
if ($title!="") {
	$insert_field_name[$cnt]="cb_title";
	$insert_field_value[$cnt]=$title;
	$cnt++;
}
if ($journal!="") {
	$insert_field_name[$cnt]="cb_journ";
	$insert_field_value[$cnt]=$journal;
	$cnt++;
}
if ($volume!="") {
	$insert_field_name[$cnt]="cb_vol";
	$insert_field_value[$cnt]=$volume;
	$cnt++;
}
if ($publisher!="") {
	$insert_field_name[$cnt]="cb_pub";
	$insert_field_value[$cnt]=$publisher;
	$cnt++;
}
if ($page!="") {
	$insert_field_name[$cnt]="cb_page";
	$insert_field_value[$cnt]=$page;
	$cnt++;
}
if ($doi!="") {
	$insert_field_name[$cnt]="cb_doi";
	$insert_field_value[$cnt]=$doi;
	$cnt++;
}
if ($isbn!="") {
	$insert_field_name[$cnt]="cb_isbn";
	$insert_field_value[$cnt]=$isbn;
	$cnt++;
}
if ($url!="") {
	$insert_field_name[$cnt]="cb_url";
	$insert_field_value[$cnt]=$url;
	$cnt++;
}
if ($labadr!="") {
	$insert_field_name[$cnt]="cb_labadr";
	$insert_field_value[$cnt]=$labadr;
	$cnt++;
}
if ($keywords!="") {
	$insert_field_name[$cnt]="cb_keywords";
	$insert_field_value[$cnt]=$keywords;
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