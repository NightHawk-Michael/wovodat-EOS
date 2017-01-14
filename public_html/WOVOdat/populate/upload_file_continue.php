<?php
/**********************************

This page is displayed if an upload was already launched (and not finished), while the user tries to upload another file.
It shows a small message for users to know about the issue and asks them whether they want to continue or abort the previous upload.
Depending on the answer, it launches upload_file_cancel.php or upload_file_confirm.php.

**********************************/
if(!isset($_SESSION))
	session_start();
	
// Set unlimited capacity and time for processing
ini_set("memory_limit","-1");
set_time_limit(0);

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// No upload started
if (!isset($_SESSION['upload'])) {
	// Redirect to page: upload start
	header('Location: '.$url_root.'home_populate.php');
	exit();
}

// Get file name and upload date
$ori_file_name=$_SESSION['upload']['ori_file_name'];


	include "php/include/header.php";  

	echo"<script language='javascript' type='text/javascript' src='/js/scripts.js'></script>";
	
	include 'php/include/menu.php'; 

	echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
	<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>Submit Data</a> > Upload WOVOml File </div>";
?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
		<!-- Page content -->
		
		<h3>File upload in progress</h3>
		
		<p><b>Warning!</b> You have already started to upload a file ("<b><?php print $ori_file_name; ?></b>") to WOVOdat. Do you wish to abort this upload?</p>
		
		<form method="post" action="upload_file_cancel.php" name="form1">
			<input type="submit" name="upload_file_cancel" value="Abort upload" />
		</form>
		<form method="post" action="upload_file_confirm.php" name="form2">
			<input type="submit" name="upload_file_confirm" value="Continue upload" />
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