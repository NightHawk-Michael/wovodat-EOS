<?php
if(!isset($_SESSION))
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
	$error_code=1038;
	$error_message="Redirected to system error page but no system error was found in the list";
}

// Unset session variables
unset($_SESSION['upload']);


// Report error to WOVOdat team

// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="system@wovodat.org";
$to ="wovodat@wovodat.org";
$subject="WOVOdat system - System error report";
$headers=array("From"=>$from, "Subject"=>$subject);
$body="Hello WOVOdat administrator,\n\n".
"This message was sent to you because an error occurred during an operation on WOVOdat website.\n".
"Here are the details that may be useful for you to fix it:\n".
"Error type: System error\n".
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
		<h3>System error <?php print $error_code; ?></h3>
		<p>An error occurred during this operation. It was due to some problems with the system. We thank you to report this problem to the WOVOdat team (link to be added later) if this happens repeatedly.</p>
		<p>Please <a href="home_populate.php">Try again</a> later.</p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->