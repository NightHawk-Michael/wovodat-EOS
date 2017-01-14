<?php
/**********************************

This page displays an error message, this error being related to the registration process.

**********************************/

// Start session
session_start();


// Find error to be printed
$found=FALSE;
for ($i=0; $i<$_SESSION['l_errors']; $i++) {
	$error_code=$_SESSION['errors'][$i]['code'];
	if ($error_code>=1000 && $error_code<2000) {
		// It's a system error
		$found=TRUE;
		$error_message=$_SESSION['errors'][$i]['message'];
		break;
	}
}

if (!$found) {
	$error_code=1105;
	$error_message="Redirected to registration error page but no system error was found in the list";
}

// Unset session variables
unset($_SESSION['register']);


// Report error to WOVOdat team

// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="system@wovodat.org";
$to="WOVOdat Team <wovodat@wovodat.org>";
$subject="WOVOdat system - Registration error report";
$headers=array("From"=>$from, "Subject"=>$subject);
$body="Hello WOVOdat administrator,\n\n".
"This message was sent to you because an error occurred during an operation on WOVOdat website.\n".
"Here are the details that may be useful for you to fix it:\n".
"Error type: Registration error\n".
"Error code: ".$error_code."\n".
"Error message: ".$error_message."\n".
"User IP: ".$_SERVER['REMOTE_ADDR']."\n".
"Date and time: ".date("Y-m-d H:i:s", (time()-date("Z")))." (UTC)\n\n".
"Thanks,\n".
"The WOVOdat system";

// Send email
$mail->send($to, $headers, $body);

include 'php/include/header.php'; 
 
include 'php/include/menu.php'; 
 
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/regist_form.php'>Register</a> > Registration in prgress </div>";

?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
		<!-- Page content -->
		<h1>Registration error <?php print $error_code; ?></h1>
		<p>Sorry, an error occurred during registration. It was due to some problem with the system. We thank you to <a href="contact_us_form.php">report this problem to the WOVOdat team</a> if this happens repeatedly.</p>
		<p>Please <a href="regist_form.php">try again</a> later.</p>
		<br />
		<p><a href="index.php">Go to WOVOdat welcome page</a></p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->	