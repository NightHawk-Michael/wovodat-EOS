<?php

// Start session
session_start();

// Get root url
require_once "php/include/get_root.php";

// Get message
$message=$_SESSION['translate']['message'];
if ($message=="" || $message==NULL) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

unset($_SESSION['translate']);

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
	<link href="/js2/navig.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<script language="JavaScript" src="/js2/menu_array.js" type="text/javascript"></script>
	<script language="JavaScript" src="/js2/mmenu.js" type="text/javascript"></script>

	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>

		<!-- Content -->
		<div id="content">	
			<div id="contentl">
		<!-- Page content -->
		<h1>Translation successful!</h1>
		<p>Thank you for your contribution to WOVOdat.</p>
		<p><?php print $message; ?></p>
		<p>You may now go back to the <a href="home_populate.php">home page</a> to do any other operation.</p>

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