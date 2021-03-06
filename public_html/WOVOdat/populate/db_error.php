<?php
if(!isset($_SESSION))
	session_start();

// Get root url
require_once "php/include/get_root.php";

// Find error to be printed
$found=FALSE;
for ($i=0; $i<$_SESSION['l_errors']; $i++) {
	$error_code=$_SESSION['errors'][$i]['code'];
	if ($error_code>=4000) {
		// It's a database error
		$found=TRUE;
		$error_message=$_SESSION['errors'][$i]['message'];
		break;
	}
}

// If error was not found
if (!$found) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1037;
	$_SESSION['errors'][0]['message']="Redirected to database error page but no database error was found in the list";
	$_SESSION['l_errors']=1;
	// Redirect to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// Prepare link
if (isset($_SESSION['login'])) {
	$link="<a href=\"home.php\">Go back to home page</a>";
}
else {
	$link="<a href=\"index.php\">Go back to welcome page</a>";
}

// Report error to WOVOdat team

// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="system@wovodat.org";
$to ="wovodat@wovodat.org";
$subject="WOVOdat system - Database error report";
$headers=array("From"=>$from, "Subject"=>$subject);
$body="Hello WOVOdat administrator,\n\n".
"This message was sent to you because an error recently occurred during an operation on WOVOdat website.\n".
"Here are the details that may be useful for you to fix it:\n".
"Error type: Database error\n".
"Error code: ".$error_code."\n".
"Error message: ".$error_message."\n";
if (isset($_SESSION['login']['cc_id'])) {
	$body.="User ID: ".$_SESSION['login']['cc_id']."\n";
}
else {
	$body.="User IP: ".$_SERVER['REMOTE_ADDR']."\n";
}
$body.="Date and time: ".date("Y-m-d H:i:s", (time()-date("Z")))." (UTC)\n\n".
"Thanks,\n".
"The WOVOdat system";

// Send email
$mail->send($to, $headers, $body);


include "php/include/header.php";  

include 'php/include/menu.php'; 


echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>Submit Data</a> > Upload WOVOml File </div>";

?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
		<!-- Page content -->
		<h3>Database error <?php print $error_code; ?></h3>
		<p>An error occurred during this operation. It was due to some problems with the database. Please try again later. We thank you to <a href="contact_us_form.php">report this problem to the WOVOdat team</a> if this happens repeatedly.</p>
		<p><?php print $link; ?></p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->