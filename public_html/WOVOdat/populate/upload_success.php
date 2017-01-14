<?php

/**********************************

This page displays a small message to confirm that the operation of updating user's contact information/password was successful.

**********************************/
if(!isset($_SESSION))
	session_start();

// Get message
$message=$_SESSION['upload']['message'];
if ($message=="" || $message==NULL) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

unset($_SESSION['upload']);

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
		
		<h3>Upload successful</h3>
		
		<p><b>Thank you</b> for your contribution to WOVOdat.</p>
		<p><?php print $message; ?></p>
		<p>You may now go back to the <a href="home_populate.php">home page</a> for any other operation.</p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->					