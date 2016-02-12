<?php

// Get posted fields
$code=trim($_POST['code']);
$code2=trim($_POST['code2']);
//$firstname=trim($_POST['firstname']);
//$lastname=trim($_POST['lastname']);
$observatory=trim($_POST['observatory']);
$address1=trim($_POST['address1']);
$address2=trim($_POST['address2']);
$city=trim($_POST['city']);
$state=trim($_POST['state']);
$country=trim($_POST['country']);
$post=trim($_POST['post']);
$url=trim($_POST['url']);
$email=trim($_POST['email']);
$phone=trim($_POST['phone']);
$phone2=trim($_POST['phone2']);
$fax=trim($_POST['fax']);

// Store fields
$_SESSION['upload_form'][$datatype]=array();
$_SESSION['upload_form'][$datatype]['$code']=$_POST['code'];
$_SESSION['upload_form'][$datatype]['$code2']=$_POST['code2'];
//$_SESSION['upload_form'][$datatype]['$firstname']=$_POST['firstname'];
//$_SESSION['upload_form'][$datatype]['$lastname']=$_POST['lastname'];
$_SESSION['upload_form'][$datatype]['$observatory']=$_POST['observatory'];
$_SESSION['upload_form'][$datatype]['$address1']=$_POST['address1'];
$_SESSION['upload_form'][$datatype]['$address2']=$_POST['address2'];
$_SESSION['upload_form'][$datatype]['$city']=$_POST['city'];
$_SESSION['upload_form'][$datatype]['$state']=$_POST['state'];
$_SESSION['upload_form'][$datatype]['$country']=$_POST['country'];
$_SESSION['upload_form'][$datatype]['$post']=$_POST['post'];
$_SESSION['upload_form'][$datatype]['$url']=$_POST['url'];
$_SESSION['upload_form'][$datatype]['$email']=$_POST['email'];
$_SESSION['upload_form'][$datatype]['$phone']=$_POST['phone'];
$_SESSION['upload_form'][$datatype]['$phone2']=$_POST['phone2'];
$_SESSION['upload_form'][$datatype]['$fax']=$_POST['fax'];


// Check errors
$code_has_error=FALSE;
$code2_has_error=FALSE;
//$firstname_has_error=FALSE;
//$lastname_has_error=FALSE;
$observatory_has_error=FALSE;
$address1_has_error=FALSE;
$address2_has_error=FALSE;
$city_has_error=FALSE;
$state_has_error=FALSE;
$country_has_error=FALSE;
$post_has_error=FALSE;
$url_has_error=FALSE;
$email_has_error=FALSE;
$phone_has_error=FALSE;
$phone2_has_error=FALSE;
$code_has_error="";
$code2_has_error="";
//$firstname_has_error="";
//$lastname_has_error="";
$observatory_has_error="";
$address1_has_error="";
$address2_has_error="";
$city_has_error="";
$state_has_error="";
$country_has_error="";
$post_has_error="";
$url_has_error="";
$email_has_error="";
$phone_has_error="";
$phone2_has_error="";
$fax_has_error="";

// Database functions
require_once "php/funcs/db_funcs.php";
// Datetime functions
require_once "php/funcs/datetime_funcs.php";

// Check authors: nothing

// Check title: nothing

// Check journal: nothing

// Check volume: nothing

// Check publisher: nothing

// Check pages: nothing

// Check doi: nothing

// Check isbn: nothing

// Check url (web info): nothing

// Check laboratory email address: nothing

// Check keywords: nothing

// Get current time (= load date)
date_default_timezone_set('UTC');
//$load_date=date("Y-m-d H:i:s", (time()-date("Z")));
$load_date=date("Y-m-d H:i:s");

// Store errors
$_SESSION['upload_form'][$datatype]['code_has_error']=$code_has_error;
$_SESSION['upload_form'][$datatype]['code2_has_error']=$code2_has_error;
//$_SESSION['upload_form'][$datatype]['firstname_has_error']=$firstname_has_error;
//$_SESSION['upload_form'][$datatype]['lastname_has_error']=$lastname_has_error;
$_SESSION['upload_form'][$datatype]['observatory_has_error']=$observatory_has_error;
$_SESSION['upload_form'][$datatype]['address1_has_error']=$address1_has_error;
$_SESSION['upload_form'][$datatype]['address2_has_error']=$address2_has_error;
$_SESSION['upload_form'][$datatype]['city_has_error']=$city_has_error;
$_SESSION['upload_form'][$datatype]['state_has_error']=$state_has_error;
$_SESSION['upload_form'][$datatype]['country_has_error']=$country_has_error;
$_SESSION['upload_form'][$datatype]['post_has_error']=$post_has_error;
$_SESSION['upload_form'][$datatype]['url_has_error']=$url_has_error;
$_SESSION['upload_form'][$datatype]['email_has_error']=$email_has_error;
$_SESSION['upload_form'][$datatype]['phone_has_error']=$phone_has_error;
$_SESSION['upload_form'][$datatype]['phone2_has_error']=$phone2_has_error;
$_SESSION['upload_form'][$datatype]['fax_has_error']=$fax_has_error;

?>