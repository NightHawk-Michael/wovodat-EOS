<?php

// Start session
Session_start();

require_once "php/include/get_root.php";



// Session was not yet started
// If no username was posted
if (!isset($_POST['uname'])) {
	// Redirect to login required page
	header('Location:index.php?nopost=1');
	exit();
}

// Verify username and password
require_once("php/funcs/db_funcs.php");

// Get username
$uname=trim($_POST['uname']);

// If username was not entered
if ($uname=="") {
	header('Location:index.php?attempt=1');
	exit();
}

// Check if the user was registered and get password
$select_table="cr";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cr_pwd";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cr_uname";
$select_where_field_value[0]=$uname;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1043;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4015;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$num=count($select_field_value);

// If this is an unknown user
if ($num==0) {
	// Unknown user
	header('Location:index.php?attempt=1');
	exit();
}

// It's a known user
// Verify password
$cr_pwd=$select_field_value[0][0];
if (crypt($_POST['password'], $cr_pwd)!=$cr_pwd) {
	// Wrong password
	header('Location:index.php?attempt=1');
	exit();
}

// The user was correctly identified

// Store information in login history file
	$history_file=fopen("/home/wovodat/login_history.txt", "a");

// If error when opening file
if (!$history_file) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=2555;
	$_SESSION['errors'][0]['message']="An error occurred when trying to open login history file";
	$_SESSION['l_errors']=1;
	// Redirect user to server error page
	header('Location: '.$url_root.'server_error.php');
	exit();
}
$line=$uname."\t".$_SERVER['REMOTE_ADDR']."\t".date("c")."\n";
if (!fwrite($history_file, $line)) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=2020;
	$_SESSION['errors'][0]['message']="An error occurred when trying to write login history file";
	$_SESSION['l_errors']=1;
	// Redirect user to server error page
	header('Location: '.$url_root.'server_error.php');
	exit();
}
if (!fclose($history_file)) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=2556;
	$_SESSION['errors'][0]['message']="An error occurred when trying to close login history file";
	$_SESSION['l_errors']=1;
	// Redirect user to server error page
	header('Location: '.$url_root.'server_error.php');
	exit();
}

// Get cr_id and cc_id
$select_table="cr";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cr_id";
$select_field_name[1]="cc_id";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cr_uname";
$select_where_field_value[0]=$uname;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1044;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4016;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$l_select_field_value=count($select_field_value);
if ($l_select_field_value>1) {
	// Only 1 result should be found
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1092;
	$_SESSION['errors'][0]['message']="Multiple rows in the cr table correspond to this cr_uname: '".$uname."'";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}
$cr_id=$select_field_value[0][0];
$cc_id=$select_field_value[0][1];

// Get first name, last name and observatory name
$select_table="cc";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cc_fname";
$select_field_name[1]="cc_lname";
$select_field_name[2]="cc_obs";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cc_id";
$select_where_field_value[0]=$cc_id;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1045;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4017;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$l_select_field_value=count($select_field_value);
if ($l_select_field_value>1) {
	// Only 1 result should be found
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1093;
	$_SESSION['errors'][0]['message']="Multiple rows in the cc table correspond to this cc_id: '".$cc_id."'";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}
$cc_fname=$select_field_value[0][0];
$cc_lname=$select_field_value[0][1];
$cc_obs=$select_field_value[0][2];

// Form user name
$user_name="";
if ($cc_fname!="") {
	$user_name.=$cc_fname;
	if ($cc_lname!="") {
		$user_name.=" ".$cc_lname;
	}
}
else {
	if ($cc_lname!="") {
		$user_name.=$cc_lname;
	}
	else {
		// No first name and no last name
		$user_name.=$cc_obs;
	}
}

// Store login information in session variable
$_SESSION['login']=array();
$_SESSION['login']['cr_uname']=$uname;
$_SESSION['login']['cc_id']=$cc_id;
$_SESSION['login']['user_name']=$user_name;

// Get permission access
$select_table="cp";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cp_access";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cr_id";
$select_where_field_value[0]=$cr_id;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1046;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4018;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$l_select_field_value=count($select_field_value);
if ($l_select_field_value>1) {
	// Only 1 result should be found
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1094;
	$_SESSION['errors'][0]['message']="Multiple rows in the cp table correspond to this cr_id: '".$cr_id."'";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}
$cp_access=$select_field_value[0][0];
// Store permissions variable in session
$_SESSION['permissions']=array();
$_SESSION['permissions']['access']=$cp_access;

// If the user is not a developper, get for whom they have permissions
if ($cp_access!=0) {
	$select_table="jj_concon";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="cc_id";
	$select_field_name[1]="jj_concon_view";
	$select_field_name[2]="jj_concon_upload";
	$select_field_name[3]="jj_concon_update";
	$select_field_name[4]="jj_concon_admin";
	$select_where_field_name=array();
	$select_where_field_value=array();
	$select_where_field_name[0]="cc_id_granted";
	$select_where_field_value[0]=$cc_id;
	$errors="";
	if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
		// Database error
		switch ($errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1046;
				$_SESSION['errors'][0]['message']=$errors." to db_select()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4018;
				$_SESSION['errors'][0]['message']=$errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	// Get results
	$num_users=count($select_field_value);
	// Create user permissions
	$user_view=array();
	$l_user_view=0;
	$user_upload=array();
	$l_user_upload=0;
	$user_update=array();
	$l_user_update=0;
	$user_admin=array();
	$l_user_admin=0;
	// Loop on results
	for ($i=0; $i<$num_users; $i++) {
		// Local variable
		$user_id=$select_field_value[$i][0];
		
		$select_table="cc";
		$select_field_name=array();
		$select_field_value=array();
		$select_field_name[0]="cc_fname";
		$select_field_name[1]="cc_lname";
		$select_field_name[2]="cc_obs";
		$select_field_name[3]="cc_code";
		$select_where_field_name=array();
		$select_where_field_value=array();
		$select_where_field_name[0]="cc_id";
		$select_where_field_value[0]=$user_id;
		$errors="";
		if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
			// Database error
			switch ($errors) {
				case "Error in the parameters given":
					$_SESSION['errors'][0]=array();
					$_SESSION['errors'][0]['code']=1046;
					$_SESSION['errors'][0]['message']=$errors." to db_select()";
					$_SESSION['l_errors']=1;
					// Redirect user to system error page
					header('Location: '.$url_root.'system_error.php');
					exit();
				default:
					$_SESSION['errors'][0]=array();
					$_SESSION['errors'][0]['code']=4018;
					$_SESSION['errors'][0]['message']=$errors;
					$_SESSION['l_errors']=1;
					// Redirect user to database error page
					header('Location: '.$url_root.'db_error.php');
					exit();
			}
		}
		// Get results
		$cc_fname=htmlentities($select_field_value[0][0], ENT_COMPAT, "cp1252");
		$cc_lname=htmlentities($select_field_value[0][1], ENT_COMPAT, "cp1252");
		$cc_obs=htmlentities($select_field_value[0][2], ENT_COMPAT, "cp1252");
		$cc_code=htmlentities($select_field_value[0][3], ENT_COMPAT, "cp1252");
		
		// Form user name
		if (trim($cc_code)!="") {
			$username=$cc_code." - ";
		}
		else {
			$username="";
		}
		if ($cc_fname!="") {
			$username.=$cc_fname;
			if ($cc_lname!="") {
				$username.=" ".$cc_lname;
			}
		}
		else {
			if ($cc_lname!="") {
				$username.=$cc_lname;
			}
			else {
				// No first name and no last name
				$username.=$cc_obs;
			}
		}
		
		// Viewing permissions
		if ($select_field_value[$i][1]==1) {
			// Store ID and name in user viewing permission array
			$user_view['id'][$l_user_view]=$user_id;
			$user_view['name'][$l_user_view]=$username;
			$l_user_view++;
		}
		
		// Uploading permissions
		if ($select_field_value[$i][2]==1) {
			// Store ID and name in user uploading permission array
			$user_upload['id'][$l_user_upload]=$user_id;
			$user_upload['name'][$l_user_upload]=$username;
			$l_user_upload++;
		}
		
		// Updating permissions
		if ($select_field_value[$i][3]==1) {
			// Store ID and name in user updating permission array
			$user_update['id'][$l_user_update]=$user_id;
			$user_update['name'][$l_user_update]=$username;
			$l_user_update++;
		}
		
		// Admin permissions
		if ($select_field_value[$i][4]==1) {
			// Store ID and name in user admin permission array
			$user_admin['id'][$l_user_admin]=$user_id;
			$user_admin['name'][$l_user_admin]=$username;
			$l_user_admin++;
		}
	}
}
// User is a developer
else {
	$select_table="cc";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="cc_id";
	$select_field_name[1]="cc_fname";
	$select_field_name[2]="cc_lname";
	$select_field_name[3]="cc_obs";
	$select_field_name[4]="cc_code";
	$select_where_field_name=array();
	$select_where_field_value=array();
	$errors="";
	if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
		// Database error
		switch ($errors) {
			case "Error in the parameters given":
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1046;
				$_SESSION['errors'][0]['message']=$errors." to db_select()";
				$_SESSION['l_errors']=1;
				// Redirect user to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
			default:
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=4018;
				$_SESSION['errors'][0]['message']=$errors;
				$_SESSION['l_errors']=1;
				// Redirect user to database error page
				header('Location: '.$url_root.'db_error.php');
				exit();
		}
	}
	// Get results
	$num_users=count($select_field_value);
	// Create user permissions
	$user_view=array();
	$l_user_view=0;
	$user_upload=array();
	$l_user_upload=0;
	$user_update=array();
	$l_user_update=0;
	$user_admin=array();
	$l_user_admin=0;
	// Loop on results
	for ($i=0; $i<$num_users; $i++) {
		// Local variable
		$user_id=$select_field_value[$i][0];
		
		// Do not include the user himself
		if ($user_id==$cc_id) {
			continue;
		}
		
		$cc_fname=htmlentities($select_field_value[$i][1], ENT_COMPAT, "cp1252");
		$cc_lname=htmlentities($select_field_value[$i][2], ENT_COMPAT, "cp1252");
		$cc_obs=htmlentities($select_field_value[$i][3], ENT_COMPAT, "cp1252");
		$cc_code=htmlentities($select_field_value[$i][4], ENT_COMPAT, "cp1252");
		
		// Form user name
		if (trim($cc_code)!="") {
			$username=$cc_code." - ";
		}
		else {
			$username="";
		}
		if ($cc_fname!="") {
			$username.=$cc_fname;
			if ($cc_lname!="") {
				$username.=" ".$cc_lname;
			}
		}
		else {
			if ($cc_lname!="") {
				$username.=$cc_lname;
			}
			else {
				// No first name and no last name
				$username.=$cc_obs;
			}
		}
		
		// Store ID and name in user viewing permission array
		$user_view['id'][$l_user_view]=$user_id;
		$user_view['name'][$l_user_view]=$username;
		$l_user_view++;
		// Store ID and name in user uploading permission array
		$user_upload['id'][$l_user_upload]=$user_id;
		$user_upload['name'][$l_user_upload]=$username;
		$l_user_upload++;
		// Store ID and name in user updating permission array
		$user_update['id'][$l_user_update]=$user_id;
		$user_update['name'][$l_user_update]=$username;
		$l_user_update++;
		// Store ID and name in user admin permission array
		$user_admin['id'][$l_user_admin]=$user_id;
		$user_admin['name'][$l_user_admin]=$username;
		$l_user_admin++;
	}
}

// Sort arrays
if ($l_user_view>1) {
	$user_view_lowercase=array_map('strtolower', $user_view['name']);
	array_multisort($user_view_lowercase, $user_view['name'], $user_view['id']);
}
if ($l_user_upload>1) {
	$user_upload_lowercase=array_map('strtolower', $user_upload['name']);
	array_multisort($user_upload_lowercase, $user_upload['name'], $user_upload['id']);
}
if ($l_user_update>1) {
	$user_update_lowercase=array_map('strtolower', $user_update['name']);
	array_multisort($user_update_lowercase, $user_update['name'], $user_update['id']);
}
if ($l_user_admin>1) {
	$user_admin_lowercase=array_map('strtolower', $user_admin['name']);
	array_multisort($user_admin_lowercase, $user_admin['name'], $user_admin['id']);
}

// Store permissions
$_SESSION['permissions']['user_view']=$user_view;
$_SESSION['permissions']['l_user_view']=$l_user_view;
$_SESSION['permissions']['user_upload']=$user_upload;
$_SESSION['permissions']['l_user_upload']=$l_user_upload;
$_SESSION['permissions']['user_update']=$user_update;
$_SESSION['permissions']['l_user_update']=$l_user_update;
$_SESSION['permissions']['user_admin']=$user_admin;
$_SESSION['permissions']['l_user_admin']=$l_user_admin;

// No "upload ok" message
$upload_ok=FALSE;

header('Location:download_installable.php');


?>
