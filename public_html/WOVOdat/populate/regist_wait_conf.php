<?php
/**********************************
This page displays a message to a user who just registered to WOVOdat.
This message tells the user to check their mailbox for an email to confirm registration to WOVOdat.
**********************************/
if(!isset($_SESSION))
	session_start();

require_once "php/include/get_root.php";

if (!isset($_SESSION['register']['email_sent'])) {
	// Redirect to welcome page
	header('Location: '.$url_root.'index.php');
	exit();
}

// Get email address
$email=$_SESSION['register']['email'];

// Unset session variables used for registration
unset($_SESSION['register']);

include 'php/include/header.php'; 

include 'php/include/menu.php'; 
 
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/regist_form.php'>Register</a> > Registration in prgress </div>";
?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
		<!-- Page content -->
		<h1>Registration waiting for email confirmation</h1>
		<p>Thank you for registering to WOVOdat. An email was sent to your email address (<?php print $email; ?>) <b>for you to confirm registration</b>. Once you receive it, please click on the link provided.</p>
		<p>If you do not receive any email after several hours, please check your Spam/Junk email inbox (or) our email confirmation might be blocked by your mail server. Please make sure that your email address is valid and entered correctly. </p> 
		<p>Feel free to <a href="/populate/contact_us_form.php">contact us</a> if you have any question or issue.</p>
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