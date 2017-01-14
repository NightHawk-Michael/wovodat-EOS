<?php
if (!isset($_SESSION))
    session_start();  
	

// Get root url  
require_once "php/include/get_root.php";
include "php/include/db_connect.php";  


// If session was already started
if (isset($_SESSION['login'])) {

	// Get login ID and user name                           // Nang added  on 22-Feb-2013
	$uname = $_SESSION['login']['cr_uname'];
	$user_name=$_SESSION['login']['user_name'];
	
	// Get cp_access
	$cp_access=$_SESSION['permissions']['access'];
	
	// Message from upload_form
	if (isset($_SESSION['upload_form']['upload_ok'])) {
		$upload_ok=$_SESSION['upload_form']['upload_ok'];
		$_SESSION['upload_form']['upload_ok']=FALSE;
	}
	else {
		$upload_ok=FALSE;
	}
}
else {
	// Session was not yet started
	// If no username was posted
	if (!isset($_POST['uname'])) {
		// Redirect to login required page
		header('Location: '.$url_root.'login_required.php');
		exit();
	}

	// Verify username and password
	require_once("php/funcs/db_funcs.php");

	// Get username
	$uname=trim($_POST['uname']);

	// If username was not entered
	if ($uname=="") {
		header('Location: '.$url_root.'index.php?attempt=1');
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
		header('Location: '.$url_root.'index.php?attempt=1');
		exit();
	}

	// It's a known user
	// Verify password
	$cr_pwd=$select_field_value[0][0];
	if (crypt($_POST['password'], $cr_pwd)!=$cr_pwd) {
		// Wrong password
		header('Location: '.$url_root.'index.php?attempt=1');
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
}

	include "php/include/header.php";  
	include 'php/include/menu.php';	
	include "convertie/model/common_model_ng.php";   
 
	
	echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Submit Data</div>";
	echo"</div>";

	
	$observatory = getObsAccess();       // Get log-in user' observatory name
	

	
	//Add more arrays here if there are more new obs 
	$observatorylist= array("Philippine Institute of Volcanology and Seismology" => "phivolcs", "PHIVOLCS" => "phivolcs", "Volcanological Survey of Indonesia" => "cvghm", "CVGHM" => "cvghm", "Plate Boundary Observatory, UNAVCO" => "pbo");  
	
	 if ($_SESSION['login']['cc_id'] == '332' || $_SESSION['login']['cc_id'] == '269' || $_SESSION['login']['cc_id'] == '199' || $_SESSION['login']['cc_id'] == '230' || $_SESSION['login']['cc_id'] == '331' || $_SESSION['login']['cc_id'] == '612') {
		$obs_filename = "admin";
	}else if(isset($observatorylist[$observatory])){
		$obs_filename = $observatorylist[$observatory]; 
	}else{
		$obs_filename = "";
	}
	
	$_SESSION['obs'] = $observatory;         // Create observatory session
	
	// Get observatory list to use in monitoring system/data/specific. 
	if(!isset($_SESSION['obsSession']))    
		$_SESSION['obsSession'] = getobslist();	
	
?>
	

	<script src="/js/jquery.js"></script>
	<script language="javascript" type="text/javascript">
		function sendfile(){
			$("#submitfile2").hide();
			$.get('/populate/submit_file_pu.php', show_form_submit);
		}
		function convertdatafile(){
			$("#submitfile2").hide();
			$.get('/populate/convert_data_csvfile_ng.php?tipedata='+"data", show_form_submit);
		}
		function convertstationfile(){
			$("#submitfile2").hide();
			$.get('/populate/convert_monitor_csvfile_ng.php?tipedata='+"station", show_form_submit);
		} 
		
		/* Nang added on 21-Mar-2015 */
		function converteruptionfile(){
			$("#submitfile2").hide();
			$.get('/populate/convert_eruption_csvfile_ng.php?tipedata='+"eruption", show_form_submit);
		} 		
		/* Nang added on 21-Mar-2015 */			
		
		//type = 5 when user is admin/developer

		function convertspecificfile(obs_filename, type){   	
			$("#submitfile2").hide();
			if (type == 5) 
				$.get('/populate/convert_specific_csvfile_' + obs_filename + '.php?obsfilename=' + obs_filename + '&obs=' + '<?php echo $observatory ?>' + '&tipedata=specific',show_form_submit_common);
			else $.get('/populate/convert_specific_csvfile_' + obs_filename + '.php?obsfilename=' + obs_filename + '&obs=' + '<?php echo $observatory ?>' + '&tipedata=specific',show_form_submit);
		}

		//check if the script for this observatory available or not
		function scriptExisted(obs_filename) {
			var result;
			$.ajax({
			  url: '/populate/convert_specific_csvfile_' + obs_filename + '.php',
			  success: function(data){
			    result = true;
			  },
			  error: function(data){
			    result = false;
			  },
		      async: false, 
			});
			return result;			
		}

		// this function load the observatory list for developer usage
		function convertspecificfile_admin(){  
			$("#submitfile2").hide();
			$("#submitfile").empty();
			<?php
				if ($obs_filename == "admin") {
			?>
				$.ajax({
					method:"GET",
					url:"get_observatories_list.php",
					dataType:"json",
					success:function(result) {
						var adminSelection = $("<select></select>");
						for (var i = 0; i < result.length; i++) {
							var observatory = result[i]['value'].toLowerCase();
							var newOption = new Option(result[i]['country'] + ', ' + result[i]['value'], observatory);
						//	if (scriptExisted(observatory))
								adminSelection.append(newOption);
						}
						
						adminSelection.change(function(){
							var fileName = $(this).val();
							convertspecificfile(fileName, 5);
						});
						adminSelection.css({"width": "180px", "margin-left": "93px"});
						var adminSelectionDiv = $("<div id = 'adminSelectionDiv'></div>");
						adminSelectionDiv.append('<h2>For developer, choose an observatory:</h2><br/>');
						adminSelectionDiv.append(adminSelection);
						adminSelectionDiv.append("<br/><br/><br/>");
						$("#submitfile").append(adminSelectionDiv);
						$("#submitfile").append($("<div></div>"));
						adminSelection.change();
					}
				});
			<?php
				} 
			?>
		}		

		function convertspecificfile_invalidobs(){   // This function will be calling from line 770 
		
			$("#submitfile2").hide();
			
			$('#submitfile').html("<h2>Conversion of Specific Data</h2><h4 style='margin-top:30px;'><blockquote>You do not have any customary script to submit your observatory data. Please <a href='/populate/contact_us_form.php'>contact us</a> if you need to create a customary script, or use file submission for CSV in WOVOdat1.1 standard/compliant format. </blockquote></h4>");
		}
		function uploadwovomlfile(){
			$("#submitfile2").hide();
			$.get('/populate/upload_file_pu.php?type=wovoml',  show_form_submit);
		}
		function uploadform(){ 
			$("#submitfile2").hide();     // Nang added on 26-Feb-2013
			$.get('/populate/controller/insertForm.php?type=insertForm', show_form_submit); // Nang added on 26-Feb-2013
			//	$.get('/populate/upload_withform_pu.php', show_form_submit);
		}
		
		function uploadcsvfile(){
			$.get('/populate/upload_csvfile_pu.php?type=wovoml', show_form_submit);
		}
		function onlineForm() {
			$("#submitfile2").hide();
			$.get("/populate/upload_online_form.php", show_form_submit);
		}		
		function show_form_submit(res){
			$('#submitfile').html(res);
		}
		function show_form_submit_common(res){
			$("#submitfile>div:nth-child(2)").html(res);
		}		
	</script>

	<div class="body">
		<div class="twocolcontent">
			<div class="leftcolumn">

				<!-- Page content -->
				<h2 class="pagetitle">Submit Data</h2>
					<div>
						<?php 
							if ($upload_ok) {
							    echo "<p class='green'>Upload successful!</p>";
							} 
						?> 
						<p>
							For now, the database only accepts data in <a href="/doc/system/1.1.0/wovoml_110.php" title="view WOVOml descriptions">WOVOdat-XML (WOVOml)</a> format. Short explanation on how to submit data into WOVOdat is available here <a href="/populate/submitDataDoc/HowToUploadDataIntoWOVOdat.pdf" target="_blank" title="upload data into WOVOdat">(pdf)</a>.
							<br>
							We offer 3 options for contributors to submit data:
						</p>
					</div>
					
					<div>
						<ul>
							<li>
								<p>
									<a href="javascript:sendfile()"><span>Submission of original observatory data format</a>.<span><br>
									Send a file of any format to WOVOdat; and let the WOVOdat team convert and upload it to the database.
								</p>
							</li>
							<li>
								<p><span>Submission of spreadsheet (comma-separated values CSV) file.(<2Mb):<span><br>Send comma-separated values CSV file in WOVOdat1.1 standard/compliant format; find csv template files here <a href="/populate/submitDataDoc/csv.zip" >(zip)</a>. Please refer to <a href="/doc/database/1.1/index.php" title="view WOVOdat manual on-line">WOVOdat1.1<a> documentations for detail information on data format. <br> 
								(a)<a href="javascript:convertstationfile()">CSV of monitoring system:</a> <br>network, station, instrument, airplane, satellite<br> 
								(b)<a href="javascript:convertdatafile()">CSV of data:</a><br> seismic, deformation, gas, hydrology, fields, thermal, meteo<br> 
								<?php if($obs_filename==''){  ?>
								<a href="javascript:convertspecificfile_invalidobs()">	
								
								<?php }else if ($obs_filename !== 'admin') {   ?>
								<a href="javascript:convertspecificfile('<?php echo $obs_filename?>', 1)">
								
								<?php } else {?>
								<a href="javascript:convertspecificfile_admin()">
								<?php }?>
								(c)CSV of customary format data</a><br> 
								Send comma-separated values CSV file in customary format; known/registered by
								and	WOVOdat:<br> 	
								
								(d)<a href="javascript:converteruptionfile()">Csv of Eruption data:</a><br>and eruption, eruption phase, eruption forecast, eruption video	
								</p>
							</li>
						</ul>
					</div>
<?php
// If user is administrator, allow them to see link to do DB admin (can be changed later, it's just to avoid making other developers confused)
	if ($_SESSION['permissions']['access']==0){
	print <<<STRING
		
			<div>
			<p>Option below appears for admin or developer team only:</p>
				<ul>
					<li>
						<p><span>Submission of small amount of data through <a href="javascript:uploadform()">online forms.</a><br></span> bibliographic, inferred processes, volcano, Observation about volcanic activity, observatory contact information
						</p>
					</li>					
				</ul>
				<ul>
					<li>
						<p><a href="javascript:uploadwovomlfile()"><span>Upload WOVOml file<span></a><br> Upload of WOVOml format file to MySQL database</p>
					</li>
				</ul>
				<ul>	
					<b><span>Checking Tools:</span></b><br>
					<li style="float:left; display:inline; width:27%;"><p><a href="check_select_table.php">[1]Table check</a></p></li> 
					<li style="float:left; display:inline; width:35%;"><p><a href="delete_ul_file_list.php">[2]Incoming File</a></p></li>
					
				</ul>
			</div>
STRING;
}
?>
 	
		</div>  <!-- end of leftcontent -->		           	
		<br/><br/>
		
		<div id="contentr"  class="rightcolumn">   
			<div id="submitfile"></div>
					
			<div id="submitfile2">
				<p align="center"><img src="/img/flowChart/WOVOdat_submitdata2014.png" style="max-width:100%;
				max-height:100%;" alt="WOVOdat Data Flow"></p>
			</div>	
		</div>		
				
	</div>
</div>

<br/><br/><br/>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->
