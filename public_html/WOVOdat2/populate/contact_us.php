<?php

// Start session
session_start();

// Regenerate session ID
session_regenerate_id(true);

// If session already started
if (isset($_SESSION['HTTP_USER_AGENT'])) {
	if ($_SESSION['HTTP_USER_AGENT']!=md5($_SERVER['HTTP_USER_AGENT'])) {
		// Destroy session variables
		session_destroy();
		
		// Redirect to registration form
		header('Location: http://www.wovodat.org/populate/regist_form.php');
		exit();
	}
}

// Else
$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['HTTP_USER_AGENT']);

/* Direct access
if (!isset($_POST['Submit']) || $_POST['Submit']!="Submit") {
	// Redirect to welcome page
	header('Location: http://www.wovodat.org/');
	exit();
}*/

if (!isset($_POST['message'])) {
	// Redirect to welcome page
	header('Location: http://www.wovodat.org/');
	exit();
}

// Get posted fields
$subject=trim($_POST['subject']);
$message=trim($_POST['message']);
$name=trim($_POST['name']);
$email=trim($_POST['email']);


// Store fields
$_SESSION['contact']['subject']=$_POST['subject'];
$_SESSION['contact']['message']=$_POST['message'];
$_SESSION['contact']['name']=$_POST['name'];
$_SESSION['contact']['email']=$_POST['email'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
</head>
<body>

<?php
// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";
// New mail object
$mail=Mail::factory("mail");
?>
	<div id="popupBox" title="Message from WOVOdat"></div>
	
	<div id="wrapborder">
		<div id="wrap">
			<!-- Header -->
			<?php include 'php/include/header_beta.php'; ?>
			<!-- Content -->
			<div id="content" >
<!-- Left -->
				<div id="contentlview">
					<br /><br /><p>You sent:</p><br />
					<?php
						$to ="wovodat@wovodat.org";
						$headers=array("From"=>$name." <".$email.">", "Subject"=>$subject);
	
						echo "To: WOVOdat Team<br />";
						echo "From: ".htmlentities($name)." &lt;".htmlentities($email)."&gt;<br />";
						echo "Subject: ".htmlentities($subject)."<br />";
						echo "Message: ".htmlentities($message)."<br /><br /><br />";

						$mail->send($to, $headers, $message);
						if($mail){ // Check, if message sent to your email
							echo "<b>Thank you</b>. We've received your information"; // display message "We've received your information"
							// Delete SESSION variables
							unset($_SESSION['contact']);
						}else {
							echo "<b>ERROR</b> -- Your message was not sent. Please try again later.";
						}
					?>
				</div>
<!-- Right -->
			
			</div>
			
			<!-- Footer -->
				<?php include 'php/include/footer_main_beta.php'; ?>

		</div> <!--end of wrap-->
	</div> <!--end of wrapborder-->
</body>
</html>
