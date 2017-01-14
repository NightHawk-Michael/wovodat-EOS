<?php

// Start session
session_start();

// Prepare error message
$error_message=$_SESSION['translate_file']['error_message'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/dropshadow.css" rel="stylesheet">
	<link href="http://www.wovodat.org/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
<script> <!--
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
	// --> 
</script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>
		<div id="navblock1">
			<div id="nav1">
			</div>
		</div>
		<div id="navblock2">
			<div id="nav2">
			</div>
		</div>
		
		<!-- Content -->
		<div id="content">	
			<div id="contentl">
		<!-- Page content -->
		<h1>Translate file error</h1>
		<p>Sorry! The file you tried to translate could not be recognized by our system. Our administrator was warned about this issue and will look at your file to understand the problem. We will update you later once the problem is resolved. Thank you.</p>
		<p><?php print $error_message; ?></p>
		<br />
		<p><a href="home_populate.php">Go back to home page</a></p>

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