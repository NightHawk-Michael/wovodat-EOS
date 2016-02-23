<?php

// Check login
require_once "php/include/login_check.php";

// Start session
	session_start();
	// Regenerate session ID
	session_regenerate_id(true);
	$uname="";
	$ccd="";
	if (isset($_SESSION['login'])) {
		$uname=$_SESSION['login']['cr_uname'];
		$ccd=$_SESSION['login']['cc_id'];
	}

// Get root url
require_once "php/include/get_root.php";

// Initialize variable
$_SESSION['upload_form']['upload_ok']=FALSE;

?>
<html>
	<div style="padding:0px 0px 0px 10px;">		
		<!-- Page content -->
		<h1>Upload Data with Form</h1><br>
		<p>Type of Data to upload:</p>
		<ul>
			<li><p><a href="upload_form.php?type=cb">Bibliographic</a></p></li>
			<li><p>Inferred processes</p>
				<ul>
					<li><p><a href="upload_form.php?type=ip_hyd">Hydrothermal system interaction</a></p></li>
					<li><p><a href="upload_form.php?type=ip_mag">Magma movement</a></p></li>
					<li><p><a href="upload_form.php?type=ip_pres">Buildup of magma pressure</a></p></li>
					<li><p><a href="upload_form.php?type=ip_sat">Volatile saturation</a></p></li>
					<li><p><a href="upload_form.php?type=ip_tec">Regional tectonics interaction</a></p></li>
				</ul>
			</li>
			<li><p><a href="upload_form.php?type=sd_int">Seismic Intensity Data</a></p></li>
			<li><p><a href="upload_form.php?type=co">Observation about volcanic activity</a></p></li>
			<li><p><a href="upload_form.php?type=cc">Observatory Contact Information</a></p></li>

		</ul>
	</div>
</html>