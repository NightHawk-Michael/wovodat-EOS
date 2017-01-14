<?php
/**********************************
This script checks the values entered in regist_form.php.
If any error is found, the user is redirected back to the form page.
Else, a confirmation email is sent to the user while they are redirected to the regist_wait_conf.php page.
**********************************/
if(!isset($_SESSION))
	session_start();

require_once("php/funcs/db_funcs.php");
require_once "php/include/get_root.php";

// Direct access
if (!isset($_POST['uname'])) {
	// Redirect to welcome page
	header('Location: '.$url_root.'index.php');
	exit();
}


// Get posted fields
$uname=trim($_POST['uname']);
$password=crypt($_POST['password']);
$conf_password=crypt($_POST['conf_password']);
$fname=trim($_POST['fname']);
$lname=trim($_POST['lname']);

if($_POST['obs'] == 'other'){                  
	$obs=trim($_POST['otherObs']);             
}else{                                         
	$obs=trim($_POST['obs']);                 
}
	
$add1=trim($_POST['add1']);
$add2=trim($_POST['add2']);
$city=trim($_POST['city']);
$state=trim($_POST['state']);
$country=trim($_POST['country']);
$post=trim($_POST['post']);
$url=trim($_POST['url']);
$email=trim($_POST['email']);
$phone=trim($_POST['phone']);
$phone2=trim($_POST['phone2']);
$fax=trim($_POST['fax']);
$com=trim($_POST['com']);
$captcha=(trim($_POST['code']));

// Store fields
$_SESSION['register']['uname']=$_POST['uname'];
$_SESSION['register']['password']=$_POST['password'];
$_SESSION['register']['conf_password']=$_POST['conf_password'];
$_SESSION['register']['fname']=$_POST['fname'];
$_SESSION['register']['lname']=$_POST['lname'];
$_SESSION['register']['obs']=$_POST['obs'];
$_SESSION['register']['otherObs']=$_POST['otherObs'];   
$_SESSION['register']['add1']=$_POST['add1'];
$_SESSION['register']['add2']=$_POST['add2'];
$_SESSION['register']['city']=$_POST['city'];
$_SESSION['register']['state']=$_POST['state'];
$_SESSION['register']['country']=$_POST['country'];
$_SESSION['register']['post']=$_POST['post'];
$_SESSION['register']['url']=$_POST['url'];
$_SESSION['register']['email']=$_POST['email'];
$_SESSION['register']['phone']=$_POST['phone'];
$_SESSION['register']['phone2']=$_POST['phone2'];
$_SESSION['register']['fax']=$_POST['fax'];
$_SESSION['register']['com']=$_POST['com'];
$_SESSION['register']['captcha']=(trim($_POST['code']));

// Check if user was already registered
$count_table_name="cr";
$count_field_name=array();
$count_field_name[0]="cr_uname";
$count_field_value=array();
$count_field_value[0]=$uname;
$num=0;
$errors="";
if (!db_count($count_table_name, $count_field_name, $count_field_value, $num, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1039;
			$_SESSION['errors'][0]['message']=$errors." to db_count()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4011;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}


if ($num!=0) {
	// User already registered
	$_SESSION['register']['regist_error']=TRUE;
	// Redirect to form page
	header('Location: '.$url_root.'regist_form.php');
	exit();
}


// Check if user has already tried to register
$count_table_name="cr_tmp";
$count_field_name=array();
$count_field_name[0]="cr_tmp_uname";
$count_field_value=array();
$count_field_value[0]=$uname;
$num=0;
$errors="";
if (!db_count($count_table_name, $count_field_name, $count_field_value, $num, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1127;
			$_SESSION['errors'][0]['message']=$errors." to db_count()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'regist_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4040;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}


if ($num!=0) {
	// User already registered
	$_SESSION['register']['regist_error']=TRUE;
	// Redirect to form page
	header('Location: '.$url_root.'regist_form.php');
	exit();
}

// Store information in temporary table in the database
// Get current time
$current_time=date("Y-m-d H:i:s");

// Insert values into cr_tmp (C14. Temporary registry) table
$insert_table_name="cr_tmp";
$insert_field_name=array();
$insert_field_value=array();
$insert_field_name[0]="cr_tmp_time";
$insert_field_value[0]=$current_time;
$insert_field_name[1]="cr_tmp_email";
$insert_field_value[1]=$email;
$insert_field_name[2]="cr_tmp_uname";
$insert_field_value[2]=$uname;
$insert_field_name[3]="cr_tmp_pwd";
$insert_field_value[3]=$password;
$cnt=4;
if ($fname!="") {
	$insert_field_name[$cnt]="cr_tmp_fname";
	$insert_field_value[$cnt]=$fname;
	$cnt++;
}
if ($lname!="") {
	$insert_field_name[$cnt]="cr_tmp_lname";
	$insert_field_value[$cnt]=$lname;
	$cnt++;
}
if ($obs!="") {
	$insert_field_name[$cnt]="cr_tmp_obs";
	$insert_field_value[$cnt]=$obs;
	$cnt++;
}
if ($add1!="") {
	$insert_field_name[$cnt]="cr_tmp_add1";
	$insert_field_value[$cnt]=$add1;
	$cnt++;
}
if ($add2!="") {
	$insert_field_name[$cnt]="cr_tmp_add2";
	$insert_field_value[$cnt]=$add2;
	$cnt++;
}
if ($city!="") {
	$insert_field_name[$cnt]="cr_tmp_city";
	$insert_field_value[$cnt]=$city;
	$cnt++;
}
if ($state!="") {
	$insert_field_name[$cnt]="cr_tmp_state";
	$insert_field_value[$cnt]=$state;
	$cnt++;
}
if ($country!="") {
	$insert_field_name[$cnt]="cr_tmp_country";
	$insert_field_value[$cnt]=$country;
	$cnt++;
}
if ($post!="") {
	$insert_field_name[$cnt]="cr_tmp_post";
	$insert_field_value[$cnt]=$post;
	$cnt++;
}
if ($url!="") {
	$insert_field_name[$cnt]="cr_tmp_url";
	$insert_field_value[$cnt]=$url;
	$cnt++;
}
if ($phone!="") {
	$insert_field_name[$cnt]="cr_tmp_phone";
	$insert_field_value[$cnt]=$phone;
	$cnt++;
}
if ($phone2!="") {
	$insert_field_name[$cnt]="cr_tmp_phone2";
	$insert_field_value[$cnt]=$phone2;
	$cnt++;
}
if ($fax!="") {
	$insert_field_name[$cnt]="cr_tmp_fax";
	$insert_field_value[$cnt]=$fax;
	$cnt++;
}
if ($com!="") {
	$insert_field_name[$cnt]="cr_tmp_com";
	$insert_field_value[$cnt]=$com;
	$cnt++;
}
$cr_tmp_id=0;
$errors="";
if (!db_insert($insert_table_name, $insert_field_name, $insert_field_value, FALSE, $cr_tmp_id, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1125;
			$_SESSION['errors'][0]['message']=$errors." to db_insert()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4038;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}


// Send confirmation email
// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// Form user name
$user_name="";
if ($fname!="") {
	$user_name.=$fname;
	if ($lname!="") {
		$user_name.=" ".$lname;
	}
}
else {
	if ($lname!="") {
		$user_name.=$lname;
	}
	else {
		// No first name and no last name
		$user_name.=$obs;
	}
}


// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="noreply@wovodat.org";
$to=$user_name." <".$email.">";
$subject="WOVOdat registration confirmation";
$headers=array("From"=>$from, "Subject"=>$subject);
$body="Hello ".$user_name.",\n\n".
"You recently registered for WOVOdat using this email address. To complete your registration, follow the link below:\n".
"http://www.wovodat.org/populate/regist_confirm.php?id=".$cr_tmp_id."&code=".urlencode(crypt($current_time))."&email=".urlencode($email)."\n".
"(If clicking on the link does not work, try to copy and paste it into your browser's address bar.)\n\n".
"If you did not register for WOVOdat, please disregard this message.\n".
"Please contact wovodat@ntu.edu.sg with any questions.\n\n".
"Thanks,\n".
"The WOVOdat team";

// Send email
$mail->send($to, $headers, $body);

// If error
if (PEAR::isError($mail)) {
	// Could not send email - Redirect to regist_error.php
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1134;
	$_SESSION['errors'][0]['message']="Registration could not be completed. Please try again later.";
	$_SESSION['l_errors']=1;
	header('Location: '.$url_root.'regist_error.php');
	exit();
}

// Inform user that they will receive an email for confirming registration soon
$_SESSION['register']['email_sent']=TRUE;
header('Location: '.$url_root.'regist_wait_conf.php');
exit();


?>