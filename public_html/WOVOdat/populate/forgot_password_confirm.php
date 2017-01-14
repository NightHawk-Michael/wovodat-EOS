<?php 
if(!isset($_SESSION))
	session_start();

if (!isset($_SESSION['forgot_pw'])) {   // If 1st access
	$uname="";      	               // Blank field
	$uname_error=FALSE;  	           // No error
}
else {  							  // 2nd time access
	$uname=$_SESSION['forgot_pw']['uname'];
	$uname_error=$_SESSION['forgot_pw']['uname_error'];     // Get error, if any
}

include 'php/include/header.php';

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/forgot_password.php'>Forgot Password</a></div>";

?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
		
		<!-- Page content -->
		<h3>New password sent!</h3>
		<p>Your new password was sent to your email address. If you do not receive any email from us within a few hours, please try again.</p>
		<p>Please feel free to <a href="contact_us_form.php">contact us</a> with any question.</p>
		<p>You may now go to the <a href="/populate/index.php">Login page</a> to see more WOVOdat tools.</p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->