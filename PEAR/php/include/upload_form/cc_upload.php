<?php

// Insert values into cc
$insert_table_name="cc";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="cc_loaddate";
$insert_field_value[0]=$load_date;
$cnt=1;

if ($code!="") {
	$insert_field_name[$cnt]="cc_code";
	$insert_field_value[$cnt]=$code;
	$cnt++;
}
if ($code2!="") {
	$insert_field_name[$cnt]="cc_code2";
	$insert_field_value[$cnt]=$code2;
	$cnt++;
}
/*
if ($firstname!="") {
	$insert_field_name[$cnt]="cc_fname";
	$insert_field_value[$cnt]=$firstname;
	$cnt++;
}
if ($lastname!="") {
	$insert_field_name[$cnt]="cc_lname";
	$insert_field_value[$cnt]=$lastname;
	$cnt++;
}
*/
if ($observatory!="") {
	$insert_field_name[$cnt]="cc_obs";
	$insert_field_value[$cnt]=$observatory;
	$cnt++;
}
if ($address1!="") {
	$insert_field_name[$cnt]="cc_add1";
	$insert_field_value[$cnt]=$address1;
	$cnt++;
}
if ($address2!="") {
	$insert_field_name[$cnt]="cc_add2";
	$insert_field_value[$cnt]=$address2;
	$cnt++;
}
if ($city!="") {
	$insert_field_name[$cnt]="cc_city";
	$insert_field_value[$cnt]=$city;
	$cnt++;
}
if ($state!="") {
	$insert_field_name[$cnt]="cc_state";
	$insert_field_value[$cnt]=$state;
	$cnt++;
}
if ($country!="") {
	$insert_field_name[$cnt]="cc_country";
	$insert_field_value[$cnt]=$country;
	$cnt++;
}
if ($post!="") {
	$insert_field_name[$cnt]="cc_post";
	$insert_field_value[$cnt]=$post;
	$cnt++;
}
if ($url!="") {
	$insert_field_name[$cnt]="cc_url";
	$insert_field_value[$cnt]=$url;
	$cnt++;
}
if ($email!="") {
	$insert_field_name[$cnt]="cc_email";
	$insert_field_value[$cnt]=$email;
	$cnt++;
}
if ($phone!="") {
	$insert_field_name[$cnt]="cc_phone";
	$insert_field_value[$cnt]=$phone;
	$cnt++;
}
if ($phone2!="") {
	$insert_field_name[$cnt]="cc_phone2";
	$insert_field_value[$cnt]=$phone2;
	$cnt++;
}
if ($fax2!="") {
	$insert_field_name[$cnt]="cc_fax";
	$insert_field_value[$cnt]=$fax;
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