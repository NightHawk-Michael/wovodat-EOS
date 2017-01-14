<?php

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Get information stored
$cp_access=$_SESSION['permissions']['access'];
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
			<div id="contentl">
			
		<!-- Top of the page -->
		
		<!-- Page content -->
		<div>
			<p>What kind of upload do you want to do?</p>
			<ul>
<?php

// Original file
// If user has no upload permission for other users
if ($l_user_upload==0) {
	print <<<STRING
				<li>
					<p><a href="upload_file.php?type=ori">Upload an original file</a></p>
STRING;
}
else {
	print <<<STRING
				<li>
					<form action="upload_file.php?type=ori" enctype="multipart/form-data" method="post">
						<p>Convert an original file from:
							<select name="select_user_upload_csv">
								<option value="$cc_id"> Myself ($user_name) </option>\n
STRING;
	for ($i=0; $i<$l_user_upload; $i++) {
		$user_id=$user_upload['id'][$i];
		$username=$user_upload['name'][$i];
		if(strlen($username)>45){$username=substr($username,0,45);}
		print <<<STRING
								<option value="$user_id"> $username </option>\n
STRING;
	}
	print <<<STRING
							</select>
						</p>
						<p><input type="submit" name="upload_file_csv_ok" value="OK" /></p>
					</form>
STRING;
}
?>
				</li>
<?php
/*
// If user is Alex, allow them to see link to more upload options (can be changed later, it's just to avoid making other developers confused)
if ($_SESSION['login']['cc_id']==3) {
	print <<<STRING
				<li>
					<p><a href="upload_file.php?type=wovoml_no_ul">Upload a WOVOML file <b>[No upload to DB]</b></a></p>
				</li>
				<li>
					<p><a href="upload_file.php?type=wovoml_no_pub">Upload a WOVOML file <b>[No checking of publish dates]</b></a></p>
				</li>
STRING;
	// print <<<STRING
				// <li>
					// <p><a href="upload_file.php?type=ini">Initialization WOVOML (.xml)</a></p>
				// </li>
				// <li>
					// <p><a href="upload_file.php?type=ini_no_ul">Initialization WOVOML (.xml) <b>[No upload to DB]</b></a></p>
				// </li>
				// <li>
					// <p><a href="upload_file.php?type=ini_csv_cc">Initialization contact file (.csv)</a></p>
				// </li>
				// <li>
					// <p><a href="upload_file.php?type=ini_csv_cc_no_ul">Initialization contact file (.csv) <b>[No upload to DB]</b></a></p>
				// </li>
// STRING;
}
*/
?>
			</ul>
		</div>
			
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