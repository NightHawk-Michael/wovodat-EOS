<?php

/**********************************

This page displays a small message to let the users know that an email was sent to their newly updated email address.
They shall click the link given in that email in order to confirm the update.

**********************************/

// Start session
session_start();

// Get root url
require_once "php/include/get_root.php";

// If no registration was started
if (!isset($_SESSION['mng_ccinfo']['email_sent'])) {
	// Redirect to welcome page
	header('Location: '.$url_root.'index.php');
	exit();
}

// Get email address
$email=$_SESSION['mng_ccinfo']['email'];

// Unset session variables used for registration
unset($_SESSION['mng_ccinfo']);


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'>Account</a> > Manage contact information </div>";

?>

</div>  <!-- header-menu -->  
	
	<div class="body">

		<div class="widecontent">
		
			<!-- Page content -->
			<h2>Email update waiting confirmation</h2>
			
			<p>Thank you for registering to WOVOdat. An email was sent to your new email address (<?php print $email; ?>) for you to confirm its validity. Once you receive it, please click on the link provided.</p>
		
			<p>If you do not receive any email after several hours, please check your Spam/Junk email inbox. If it is not there, try to register again and make sure that the email address you entered is valid.</p>
			
			<p>Feel free to <a href="http://www.wovodat.org/populate/contact_us_form.php">Contact us</a> if you have any question or issue.</p>
			<br />
			
			<p><a href="index.php">Go back to home page</a></p>
			
		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->