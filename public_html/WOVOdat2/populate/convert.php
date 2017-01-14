<?php

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Get information stored
$user_upload=$_SESSION['permissions']['user_upload'];
$l_user_upload=$_SESSION['permissions']['l_user_upload'];

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
		<div id="top">
			<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
			<p align="left">You are logged in as <b><?php print $uname." (".$user_name.")"; ?></b> | <a href="logout.php">Logout</a></p>
		</div><br>
		
		<!-- Page content -->
		<div>
			<p>What kind of conversion do you want to do?</p>
			<ul>
<?php

// If the user is a developer, print particular functions
if ($cp_access==0) {
	// print <<<STRING
				// <li>
					// <p><a href="translate_file.php?type=ini_csv_cc">Initialization contact file (.csv)</a></p>
				// </li>
// STRING;
}

// If user has no upload permission for other users
if ($l_user_upload==0) {
	print <<<STRING
				<li>
					<p><a href="translate_file.php?type=ori">Convert an original file</a></p>
STRING;
}
else {
	print <<<STRING
				<li>
					<form action="translate_file.php?type=ori" enctype="multipart/form-data" method="post">
						<p>Convert an original file from:<br>
							<select name="select_obs_translate" style="width:400px;">
								<option value="$cc_id"> Myself ($user_name) </option>\n
STRING;
	for ($i=0; $i<$l_user_upload; $i++) {
		$user_id=$user_upload['id'][$i];
		$username=$user_upload['name'][$i];
		print <<<STRING
								<option value="$user_id"> $username </option>\n
STRING;
	}
	print <<<STRING
							</select>
						</p>
						<p><input type="submit" name="translate_file_ok" value="OK" /></p>
					</form>
STRING;
}

?>
				</li>
			</ul>
		</div>
			
			</div>
			<div id="contentrview">
			</div>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>