<?php

/**********************************

This page displays a small message to confirm that the operation of updating user's contact information/password was successful.

**********************************/

// Start session
session_start();

// Get message
$message=$_SESSION['upload']['message'];
if ($message=="" || $message==NULL) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

unset($_SESSION['upload']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
</head>
<body>

	<div class="body">
		<!-- Header -->
		<?php include 'php/include/header.php'; ?>               
		<div class="container">
			<div id="content"><br/>
				<!-- Page content -->
				<h1>Upload successful</h1>
				<p><b>Thank you</b> for your contribution to WOVOdat.</p>
				<p><?php print $message; ?></p>
				<p>You may now go back to the <a href="home_populate.php">home page</a> for any other operation.</p>
			</div>  <!-- end of content-->
 		</div> <!-- end of container -->  
    </div> <!-- end of body -->  
    <!-- Footer -->
    <?php include 'php/include/footer.php'; ?>  
    </body>
</html>