<?php

/**********************************

This page is for the administrator to confirm the selection of the file they want to delete.
When form is submitted, delete_ul_file_check.php is launched.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Check direct access
if (!isset($_POST['select_file_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Check no selection
if (!isset($_POST['select_file'])) {
	$_SESSION['delete_ul_file_check']['message']="Please select a file";
	// Redirect to home page
	header('Location: '.$url_root.'delete_ul_file_list.php');
	exit();
}

// Get posted information
$selected_cu_id=$_POST['select_file'];

// Import necessary scripts
require_once("php/funcs/db_funcs.php");

// Get file name and upload date
$query_sql="SELECT cu_file, cu_type, cu_loaddate, cc_id_load FROM cu WHERE cu_id=".$selected_cu_id;
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [delete_ul_file_confirm.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// Get type and check
if ($query_results[0]['cu_type']!="PE" && $query_results[0]['cu_type']!="TE") {
	$_SESSION['delete_ul_file_check']['message']="Cannot delete this type of file (only PE and TE)";
	// Redirect user to system error page
	header('Location: '.$url_root.'delete_ul_file_list.php');
	exit();
}
include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php'>Submit Data</a> > Incoming File </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
		
			<!-- Page content -->
			<h2>Delete uploaded file</h2>
			
			<p><b>Warning!</b> File <b><?php print htmlentities($query_results[0]['cu_file'], ENT_COMPAT, "cp1252"); ?></b> will be deleted from database and server. Are you really sure you want to do that?</p>
		
			<form method="post" action="delete_ul_file_check.php" name="delete_ul_file_confirm">
				<input type="hidden" name="cu_id" value="<?php print $selected_cu_id; ?>" />
				<input type="hidden" name="cu_file" value="<?php print htmlentities($query_results[0]['cu_file'], ENT_COMPAT, "cp1252"); ?>" />
				<input type="hidden" name="cu_type" value="<?php print htmlentities($query_results[0]['cu_type'], ENT_COMPAT, "cp1252"); ?>" />
				<input type="hidden" name="cu_loaddate" value="<?php print htmlentities($query_results[0]['cu_loaddate'], ENT_COMPAT, "cp1252"); ?>" />
				<input type="hidden" name="cc_id_load" value="<?php print htmlentities($query_results[0]['cc_id_load'], ENT_COMPAT, "cp1252"); ?>" />
				<input type="submit" name="delete_ul_file_check_ok" value="OK" />
			</form>

			<form method="post" action="home.php" name="donot_delete_ul_file_check">
				<input type="submit" name="delete_ul_file_check_cancel" value="Cancel" />
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