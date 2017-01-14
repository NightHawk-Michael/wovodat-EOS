<?php

/**********************************

This is the stand-alone version of the page for uploading a file to the database (upload_file_pu.php).
As of May 2011, this page is not used by the system but it is still valid.

**********************************/
/*
// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Security: cannot upload 2 files at the same time
if (isset($_SESSION['upload'])) {
	// Redirect to page: upload start
	header('Location: '.$url_root.'upload_file_continue.php');
	exit();
}

// Get type of file to be translated
if (!isset($_GET['type'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
} */
$file_type="wovoml_no_pub";
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
		$title="Upload CSV contact file to WOVOdat";
		$current_title="Upload CSV contact to WOVOdat";
		$file_ab="CSV";
		break;
	case "ini_csv_cc_no_ul":
		// Initialization CSV file for contacts, no upload to DB
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Upload CSV contact file to WOVOdat [NO UPLOAD]";
		$current_title="Upload CSV contact to WOVOdat [NO UL]";
		$file_ab="CSV";
		break;
	case "ori":
		// Observatory file
		// Get observatory
		if (!isset($_POST['select_user_upload_csv'])) {
			// Default user: themselves
			$obs=$_SESSION['login']['cc_id'];
		}
		else {
			$obs=$_POST['select_user_upload_csv'];
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
		$title="Upload original file to WOVOdat";
		$current_title="Upload original file to WOVOdat";
		$file_ab="Original";
		break;
	case "ori_no_ul":
		// Observatory file, no upload to DB
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Get observatory
		if (!isset($_POST['select_user_upload_csv_no_ul'])) {
			// Default user: themselves
			$obs=$_SESSION['login']['cc_id'];
		}
		else {
			$obs=$_POST['select_user_upload_csv_no_ul'];
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
		$title="Upload original file to WOVOdat [NO UPLOAD]";
		$current_title="Upload original file to WOVOdat [NO UL]";
		$file_ab="Original";
		break;
	case "ini":
		// Initialization WOVOML file
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Upload initialization WOVOML file to WOVOdat";
		$current_title="Upload ini WOVOML to WOVOdat";
		$file_ab="WOVOML";
		break;
	case "ini_no_ul":
		// Initialization WOVOML file, no upload to DB
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Upload initialization WOVOML file to WOVOdat [NO UPLOAD]";
		$current_title="Upload ini WOVOML to WOVOdat [NO UL]";
		$file_ab="WOVOML";
		break;
	case "wovoml":
		// WOVOML file
		// Prepare variables
		$title="Upload WOVOML file to WOVOdat";
		$current_title="Upload WOVOML to WOVOdat";
		$file_ab="WOVOML";
		$obs=NULL;
		break;
	case "wovoml_no_ul":
		// WOVOML file, no upload to DB
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Upload WOVOML file to WOVOdat [NO UPLOAD]";
		$current_title="Upload WOVOML to WOVOdat [NO UL]";
		$file_ab="WOVOML";
		$obs=NULL;
		break;
	case "wovoml_no_pub":
		// WOVOML file, no checking of publish dates
		// Check that user is a developper
		if ($_SESSION['permissions']['access']!=0) {
			// Redirect to home page
			header('Location: '.$url_root.'home.php');
			exit();
		}
		
		// Prepare variables
		$title="Upload WOVOML file to WOVOdat [NO CHECKING PUBDATES]";
		$current_title="Upload WOVOML to WOVOdat [NO CHECK PUBDATES]";
		$file_ab="WOVOML";
		$obs=NULL;
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
			<div id="contentl">
		<!-- Top of the page -->
		<div id="top"><br/>
			<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
			<p>You are logged in as <b><?php print $uname." (".$user_name.")"; ?></b> | <a href="logout.php">Logout</a></p>
		</div>
		
		<!-- Page content -->
		<form name="translate_file_form" method="post" action="upload_file_check.php" enctype="multipart/form-data">
<?php

if ($file_type=="ori" || $file_type=="ori_no_ul") {
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
			<p>Select file to upload:</p>
			<input type="hidden" name="file_type" value="<?php print $file_type; ?>" />
			<input type="hidden" name="obs_id" value="<?php print $obs; ?>" />
			<?php print $file_ab; ?> file (max size <?php print $max_filesize; ?>):
			<input type="file" size="50" name="upload_file_inputfile" />
			<br />
			<br />
			<input type="submit" name="upload_file_ok" value="OK" />
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