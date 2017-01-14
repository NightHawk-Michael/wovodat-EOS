<?php/*
$redirect=substr($_SERVER['PHP_SELF'], 1);
include "php/include/check_login_beta.php";*/
?>
<?php

// Start session
session_start();

// If 1st access
if (!isset($_SESSION['forgot_pw'])) {
	// Blank field
	$uname="";
	
	// No error
	$uname_error=FALSE;
}

// 2nd time access
else {
	// Get field
	$uname=$_SESSION['forgot_pw']['uname'];
	
	// Get error, if any
	$uname_error=$_SESSION['forgot_pw']['uname_error'];
}

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
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
		<div id="headershadow">
			<?php include 'php/include/header_beta.php'; ?>
		</div>

		<!-- Content -->
		<div id="content" style="padding-top:35px;">	
			<div id="contentl">
				<h1>Forgot password</h1>
				<p>Please enter your contact information below:</p>
			
				<!-- Form -->
				<form method="post" action="forgot_password_check.php" name="login_forgot_form">
					<table class="formtable" id="formtable">
						<tr>
							<th>Username:</th>
							<td>
								<input type="text" maxlength="30" name="uname" value="<?php print $uname; ?>" /><span class="redtext"><?php if ($uname_error) {print " (User not registered, please check spelling)";} ?></span>
							</td>
						</tr>
					</table>
					<input type="submit" name="cancel" value="Cancel" />
					<input type="submit" name="ok" value="OK" />
				</form>

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