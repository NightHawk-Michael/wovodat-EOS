<?php

/**********************************

This page is for user to confirm they want to undo the upload of the file that they selected on the admin_undo_upload.php page.
Submitting the form brings them to admin_undo_upload_check.php.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// If "back" button was pressed
if (isset($_POST['undo_upload_back'])){
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Check direct access
if (!isset($_POST['undo_upload_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get posted information
$selected_id=$_POST['file'];

// Get file name and upload date
session_start();
$num_files=$_SESSION['undo_upload']['num_files'];
$ids=$_SESSION['undo_upload']['ids'];
$files=$_SESSION['undo_upload']['files'];
$loaddates=$_SESSION['undo_upload']['loaddates'];
$loader_ids=$_SESSION['undo_upload']['loader_ids'];
for ($i=0; $i<$num_files; $i++) {
	if ($selected_id!=$ids[$i]) {
		continue;
	}
	$selected_file=$files[$i];
	$selected_date=$loaddates[$i];
	$selected_loader=$loader_ids[$i];
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
	<link href="/js2/navig.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<script language="JavaScript" src="/js2/menu_array.js" type="text/javascript"></script>
	<script language="JavaScript" src="/js2/mmenu.js" type="text/javascript"></script>

	<div id="wrapborder">
	<div id="wrap">
		<div id="headershadow">
			<?php include 'php/include/header_beta.php'; ?>
		</div>

		<!-- Content -->
		<div id="content">	
			<div id="contentl">
		<!-- Top of the page -->
		<div id="top">
			<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
			<p>You are logged in as <b><?php print $uname." (".$user_name.")"; ?></b> | <a href="logout.php">Logout</a></p>
		</div>
		
		<!-- Page content -->
		<h1>Undo upload confirmation</h1>
		<p>Warning! All data contained in <?php print $selected_file; ?> will be removed from the database OR get back to their previous state before upload. Are you really sure you want to do that?</p>
		<form method="post" action="admin_undo_upload_check.php" name="select_users">
			<input type="hidden" name="file_id" value="<?php print $selected_id ?>" />
			<input type="hidden" name="file_name" value="<?php print $selected_file ?>" />
			<input type="hidden" name="file_date" value="<?php print $selected_date ?>" />
			<input type="hidden" name="file_loader" value="<?php print $selected_loader ?>" />
			<input type="submit" name="undo_upload_confirm_cancel" value="Cancel" />
			<input type="submit" name="undo_upload_confirm_ok" value="OK" />
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