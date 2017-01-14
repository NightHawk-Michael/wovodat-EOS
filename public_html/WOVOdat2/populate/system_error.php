<?php

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
	$error_code=1038;
	$error_message="Redirected to system error page but no system error was found in the list";
}

// Unset session variables
unset($_SESSION['upload']);

// Report error to WOVOdat team
/*
// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

// Headers and body
$from="system@wovodat.org";
//$to="Alexandre Baguet <abaguet@ntu.edu.sg>, Purbo <rdpurbo@ntu.edu.sg>";
$to="Purbo <rdpurbo@ntu.edu.sg>";
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
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->
		<div id="content">	
			<div id="contentl"><br>
		<!-- Page content -->
		<h1>System error <?php print $error_code; ?></h1>
		<p>An error occurred during this operation. It was due to some problems with the system. We thank you to report this problem to the WOVOdat team (link to be added later) if this happens repeatedly.</p>
		<p>Please <a href="home_populate.php">Try again</a> later.</p>

			</div>
			<div id="contentr">
			</div>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>