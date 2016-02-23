<?php

// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Get type of file to be translated
if (!isset($_GET['type'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}
$file_type=$_GET['type'];
$select_data=array();
$n_select_data=0;

switch ($file_type) {
	case "ini_csv_cc":
		// Initialization CSV file for contacts
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Translate CSV contact file to WOVOML";
		$current_url="translate_file.php?type=ini_csv_cc";
		$current_title="Translate CSV contact to WOVOML";
		break;
	case "ori":
		// Observatory file
		// Get observatory
		if (!isset($_POST['select_obs_translate'])) {
			// Default user: themselves
			$obs=$_SESSION['login']['cc_id'];
		}
		else {
			$obs=$_POST['select_obs_translate'];
		}
		
		// Store observatory ID
		$_SESSION['obs_id']=$obs;
		
		// Get data type
		switch ($obs) {
			case 159:
				// GNS
				break;
			case 202:
				// PBO
				$select_data[$n_select_data]="Strain";
				$n_select_data++;
				break;
		}
		$select_data[$n_select_data]="Other";
		$n_select_data++;
		
		// Prepare variables
		$title="Translate original file to WOVOML";
		$current_url="translate_file.php?type=ori";
		$current_title="Translate original file to WOVOML";
		break;
	default:
		// Redirect to home page
		header('Location: '.$url_root.'home.php');
		exit();
}

// Max file size
$max_filesize=ini_get('upload_max_filesize');

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
		<form name="translate_file_form" method="post" action="translate_file_check.php" enctype="multipart/form-data">
<?php

if ($file_type=="ori") {
	print <<<STRING
			<p>Select type of data:
				<select name="select_datatype">
STRING;
		// Loop on available data types
		for ($i=0; $i<$n_select_data; $i++) {
			$datatype=$select_data[$i];
			print <<<STRING
					<option value="$datatype"> $datatype </option>\n
STRING;
		}
		print <<<STRING
				</select>
			</p>
STRING;
}

?>
			<p>Select file to translate:</p>
			<input type="hidden" name="file_type" value="<?php print $file_type; ?>" />
			<input type="hidden" name="obs_id" value="<?php print $obs; ?>" />
			Original file (max size <?php print $max_filesize; ?>):
			<input type="file" size="50" name="translate_file_inputfile" />
			<br />
			<br />
			<input type="submit" name="translate_file_ok" value="OK" />
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