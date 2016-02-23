<?php

// // Help debugging...
// ini_set("display_startup_errors", "1");
// ini_set("display_errors", "1");
// error_reporting(E_ALL);

// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Get type of data
$datatype=$_GET['type'];
if ($datatype=="cb")$type_header="Bibliographic";
if ($datatype=="ip_hyd")$type_header="Hydrologic";
if ($datatype=="ip_mag")$type_header="Magma Movement";
if ($datatype=="ip_pres")$type_header="Buildup of Magma Pressure";
if ($datatype=="ip_sat")$type_header="Volatile Saturation";
if ($datatype=="ip_tec")$type_header="Regional Tectonic Interaction";
if ($datatype=="ip_int")$type_header="Seismic Intensity Data";
if ($datatype=="co")$type_header="Volcanic Activity";
if ($datatype=="cc")$type_header="Observatory Contact Information";

// Check datatype
$datatypes=array();
$datatypes[0]='cc';
$datatypes[1]='co';
$datatypes[2]='cb';
$datatypes[3]='ip_hyd';
$datatypes[4]='ip_mag';
$datatypes[5]='ip_pres';
$datatypes[6]='ip_sat';
$datatypes[7]='ip_tec';
$datatypes[8]='sd_int';
$datatypes[9]='ss';
$n_datatypes=10;
$is_correct=FALSE;

// Look for datatype in array
for ($i=0; $i<$n_datatypes; $i++) {
	// If datatype is in array
	if ($datatype==$datatypes[$i]) {
		$is_correct=TRUE;
		break;
	}
}

// If datatype was not found, redirect to home page
if (!$is_correct) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// If 1st access
if (!isset($_SESSION['upload_form'][$datatype])) {
	// Depending on datatype, include different file
	include "php/include/upload_form/".$datatype."_new_var.php";
	// Successful upload?
	$upload_ok=$_SESSION['upload_form']['upload_ok'];
	$_SESSION['upload_form']['upload_ok']=FALSE;
}

// 2nd time access
else {
	// Depending on datatype, include different file
	include "php/include/upload_form/".$datatype."_session_var.php";
	// Not successful upload
	$upload_ok=FALSE;
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
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<div id="content">	
				<!-- Top of the page -->
				<!-- Page content -->
				<br>
				<h1>Upload form <?php print " for ".$type_header.".  &nbspTable : ".$datatype." ";?><span style="font-size:12px;font-type:normal;"> (the fields preceded by * are required)</span></h1>
			
				<p class="green"><?php if ($upload_ok) {print "Upload successful!";} ?></p>
				<p class="redtext"><?php if ($has_error) {print "Upload unsuccessful! Please correct the fields in red:";} ?></p>
				
				<!-- Form -->
				<form method="post" action="upload_form_check.php?type=<?php print $datatype; ?>" name="upload_form">
					<table class="formtable" id="formtable">
						<!-- Fields are different, depending on datatype-->
						<?php include "php/include/upload_form/".$datatype."_form.php"; ?>
					</table>
					<br />
					<input type="submit" name="upload_form_ok_home" value="OK and back to the main page" />
					<input type="submit" name="upload_form_ok_new" value="OK and write new data" />
				</form>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>