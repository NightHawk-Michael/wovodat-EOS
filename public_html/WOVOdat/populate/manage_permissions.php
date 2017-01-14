<?php

/**********************************

This page display a small form made of 4 check boxes.
Each one describes a special permission from a user to the selected granted user: upload, update, view and administrate (i.e. manage someone's account).
When the form is submitted, update_permissions.php is called.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Direct access
if (!isset($_POST['select_granted_user_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get granting and granted users ids
$granting_user_id=$_SESSION['mng_perm']['granting_user_id'];
$granted_user_id=$_POST['slgu_radio'];

// Search for granting user name
if ($granting_user_id==$_SESSION['login']['cc_id']) {
	$granting_user_name=$_SESSION['login']['user_name'];
}
else {
	// Get info from session variables
	$l_user_admin=$_SESSION['permissions']['l_user_admin'];
	$user_admin=$_SESSION['permissions']['user_admin'];
	for ($i=0; $i<$l_user_admin; $i++) {
		if ($granting_user_id!=$user_admin['id'][$i]) {
			continue;
		}
		// Correct user found
		$granting_user_name=$user_admin['name'][$i];
		break;
	}
}

// Search for first name and last name of granted user
$l_user_list=$_SESSION['mng_perm']['l_user_list'];
$id_list=$_SESSION['mng_perm']['id_list'];
$lname_list=$_SESSION['mng_perm']['lname_list'];
$fname_list=$_SESSION['mng_perm']['fname_list'];
for ($i=0; $i<$l_user_list; $i++) {
	if ($granted_user_id!=$id_list[$i]) {
		continue;
	}
	// We found the correct user
	$granted_user_fname=$fname_list[$i];
	$granted_user_lname=$lname_list[$i];
	break;
}
// Form granted user name
if ($granted_user_fname!="") {
	$granted_user_name=$granted_user_fname;
	if ($granted_user_lname!="") {
		$granted_user_name.=" ".$granted_user_lname;
	}
}
else {
	$granted_user_name=$granted_user_lname;
}

// Query database about any existing permission
require_once("php/funcs/db_funcs.php");

$select_table="jj_concon";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="jj_concon_id";
$select_field_name[1]="jj_concon_view";
$select_field_name[2]="jj_concon_upload";
$select_field_name[3]="jj_concon_update";
$select_field_name[4]="jj_concon_admin";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="cc_id";
$select_where_field_value[0]=$granting_user_id;
$select_where_field_name[1]="cc_id_granted";
$select_where_field_value[1]=$granted_user_id;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1102;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4035;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$l_select_field_value=count($select_field_value);
// Security check
if ($l_select_field_value>1) {
	// Only 1 result should be found
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1118;
	$_SESSION['errors'][0]['message']="Multiple rows in the jj_concon table correspond to this cc_id: '".$granting_user_id."' and this cc_id_granted: '".$granted_user_id."'";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}
// If no result found, new permissions
$jj_concon_id=0;
$view=FALSE;
$upload=FALSE;
$update=FALSE;
$admin=FALSE;
// If a result was found
if ($l_select_field_value==1) {
	// Get existing permissions
	$jj_concon_id=$select_field_value[0][0];
	if ($select_field_value[0][1]==1) {
		$view=TRUE;
	}
	if ($select_field_value[0][2]==1) {
		$upload=TRUE;
	}
	if ($select_field_value[0][3]==1) {
		$update=TRUE;
	}
	if ($select_field_value[0][4]==1) {
		$admin=TRUE;
	}
}

// Store information in session
$_SESSION['mng_perm']['granting_user_name']=$granting_user_name;
$_SESSION['mng_perm']['granted_user_id']=$granted_user_id;
$_SESSION['mng_perm']['granted_user_name']=$granted_user_name;
$_SESSION['mng_perm']['jj_concon_id']=$jj_concon_id;
$_SESSION['mng_perm']['view']=$view;
$_SESSION['mng_perm']['upload']=$upload;
$_SESSION['mng_perm']['update']=$update;
$_SESSION['mng_perm']['admin']=$admin;

include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'>Account</a> > Manage permissions </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">

			<!-- Page content -->
			
			<h3>Manage permissions</h3>
			
			<form method="post" action="update_permissions.php" name="form_mngperm">
			
				<p>I allow <input type="hidden" name="granted_user_id" value="<?php print $granted_user_id; ?>" /><?php print $granted_user_name; ?> to:</p>
				<ul>
					<li><input type="checkbox" <?php if ($upload) {print "checked=\"true\"";} ?> name="upload" value="upload" /> Upload data owned by</li>
					<li><input type="checkbox" <?php if ($update) {print "checked=\"true\"";} ?> name="update" value="update" /> Update data owned by</li>
					<li><input type="checkbox" <?php if ($view) {print "checked=\"true\"";} ?> name="view" value="view" /> View data owned by</li>
					<li><input type="checkbox" <?php if ($admin) {print "checked=\"true\"";} ?> name="admin" value="admin" /> Be an administrator for</li>
				</ul>
				<p><input type="hidden" name="granting_user_id" value="<?php print $granting_user_id; ?>" /><?php print $granting_user_name; ?></p>
				<br />
				<input type="submit" name="manage_permissions_ok" value="OK" />
			</form>

		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->	