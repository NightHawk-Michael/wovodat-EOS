<?php

// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Initialize variable
$_SESSION['upload_form']['upload_ok']=FALSE;

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
		<!-- Top of the page -->
		
		<!-- Page content -->
		<h1>Data type selection</h1>
		<p>Click on the type of data that you wish to upload:</p>
		<ul>
			<li>
				<p><a href="upload_form.php?type=cb">Bibliographic information</a></p>
			</li>
			<li>
				<p>Inferred processes</p>
				<ul>
					<li>
						<p><a href="upload_form.php?type=ip_hyd">Hydrothermal system interaction</a></p>
					</li>
					<li>
						<p><a href="upload_form.php?type=ip_mag">Magma movement</a></p>
					</li>
					<li>
						<p><a href="upload_form.php?type=ip_pres">Buildup of magma pressure</a></p>
					</li>
					<li>
						<p><a href="upload_form.php?type=ip_sat">Volatile saturation</a></p>
					</li>
					<li>
						<p><a href="upload_form.php?type=ip_tec">Regional tectonics interaction</a></p>
					</li>
				</ul>
			</li>
			<li>
				<p><a href="upload_form.php?type=sd_int">Intensity</a></p>
			</li>
			<li>
				<p><a href="upload_form.php?type=co">Observation</a></p>
			</li>
		</ul>

			</div>
			<div id="contentr">
				<div id="top" align="left">
					<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
					<p align="right">Login as <b><?php print $uname; ?></b> | <a href="logout.php">Logout</a></p>
				</div><br>
		
			</div>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>