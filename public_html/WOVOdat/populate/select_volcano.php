<?php

/**********************************

This page allows a developer to select a volcano. When form is submitted, view.php is called for displaying all related eruptions.

**********************************/

// Import necessary scripts
require_once("php/funcs/db_funcs.php");

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Check that user is a developper
if ($_SESSION['permissions']['access']!=0) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get list of volcanoes stored in database
$query_sql="SELECT vd_id, vd_name, vd_cavw FROM vd ORDER BY vd_name ASC";
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [select_volcano.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// Get number of results
$cnt_results=count($query_results);

// Store in session
$_SESSION['view_eruption']['list_volcanoes']=$query_results;

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
			<div id="contentlview">
		<!-- Top of the page -->
		
		<!-- Page content -->
		<h1>Volcano selection</h1>
		<p>Select volcano for which you wish to view eruption:</p>
		<form action="view.php" enctype="multipart/form-data" method="post">
			<p>
				<select name="select_volcano">
<?php
		// Loop on volcanoes
		for ($i=0; $i<$cnt_results; $i++) {
			print "\t\t\t\t\t<option value=\"".htmlentities($query_results[$i]['vd_id'], ENT_COMPAT, "cp1252")."\"> ".htmlentities($query_results[$i]['vd_name'], ENT_COMPAT, "cp1252")." - ".htmlentities($query_results[$i]['vd_cavw'], ENT_COMPAT, "cp1252")." </option>\n";
		}
?>
				</select>
			</p>
			<p><input type="submit" name="select_volcano_ok" value="OK" /></p>
		</form>

			</div>
			<div id="contentrview">
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