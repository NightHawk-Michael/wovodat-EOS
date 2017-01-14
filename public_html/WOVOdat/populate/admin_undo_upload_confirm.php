<?php

/**********************************

This page is for user to confirm they want to undo the upload of the file that they selected on the admin_undo_upload.php page.
Submitting the form brings them to admin_undo_upload_check.php.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// If "back" button was pressed
if (isset($_POST['undo_upload_back'])){
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Check direct access
if (!isset($_POST['undo_upload_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get posted information
$selected_id=$_POST['file'];

// Get file name and upload date
session_start();
$num_files=$_SESSION['undo_upload']['num_files'];
$ids=$_SESSION['undo_upload']['ids'];
$files=$_SESSION['undo_upload']['files'];
$loaddates=$_SESSION['undo_upload']['loaddates'];
$loader_ids=$_SESSION['undo_upload']['loader_ids'];
for ($i=0; $i<$num_files; $i++) {
	if ($selected_id!=$ids[$i]) {
		continue;
	}
	$selected_file=$files[$i];
	$selected_date=$loaddates[$i];
	$selected_loader=$loader_ids[$i];
}
	
	
include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'> Undo upload (Direct Access) </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
		
			<!-- Page content -->
			<h2>Undo upload confirmation</h2>
			
			<p>Warning! All data contained in <?php print $selected_file; ?> will be removed from the database OR get back to their previous state before upload. Are you really sure you want to do that?</p>
			
			<form method="post" action="admin_undo_upload_check.php" name="select_users">
				<input type="hidden" name="file_id" value="<?php print $selected_id ?>" />
				<input type="hidden" name="file_name" value="<?php print $selected_file ?>" />
				<input type="hidden" name="file_date" value="<?php print $selected_date ?>" />
				<input type="hidden" name="file_loader" value="<?php print $selected_loader ?>" />
				<input type="submit" name="undo_upload_confirm_cancel" value="Cancel" />
				<input type="submit" name="undo_upload_confirm_ok" value="OK" />
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