<?php
// Help debugging
ini_set("display_startup_errors", "1");
ini_set("display_errors", "1");
error_reporting(E_ALL);

if(!isset($_SESSION))
	session_start();

// Find error to be printed
$found=FALSE;
for ($i=0; $i<$_SESSION['l_errors']; $i++) {
	$error_code=$_SESSION['errors'][$i]['code'];
	if ($error_code>=2000 && $error_code<4000) {
		// It's a server error
		$found=TRUE;
		$error_message=$_SESSION['errors'][$i]['message'];
		break;
	}
}

if (!$found) {
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1002;
	$_SESSION['errors'][0]['message']="Redirected to server error page but no server error was found in the list";
	$_SESSION['l_errors']=1;
	// Redirect to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}


// Report error to WOVOdat team

// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="system@wovodat.org";
$to ="wovodat@wovodat.org";
$subject="WOVOdat system - Server error report";
$headers=array("From"=>$from, "Subject"=>$subject);
$body="Hello WOVOdat administrator,\n\n".
"This message was sent to you because an error recently occurred during an operation on WOVOdat website.\n".
"Here are the details that may be useful for you to fix it:\n".
"Error type: Server error\n".
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
 <!--		
<script>
	function UnCryptMailto(s, shift) {
		var n=0; var r="";
		for(var i=0;i<s.length;i++) { 
			n=s.charCodeAt(i); 
			if (n>=8364) {n = 128;}
			r += String.fromCharCode(n-(shift));}
		return r;
	}
	function linkTo_UnCryptMailto(s, shift)	{
		location.href=UnCryptMailto(s, shift);}
	// 
</script>--> 

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
		<!-- Page content -->

		<h3>Server error <?php print $error_code; ?></h3>
		<p>An error occurred during this operation. It was due to some problems with the server. Please <a href="home_populate.php">Try again</a> later. We thank you to report this problem to the WOVOdat team (link to be added later) if this happens repeatedly.</p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->