<?php

// Start session
session_start();

// Regenerate session ID
session_regenerate_id(true);

// Get root url
require_once "php/include/get_root.php";

if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
} else {	
	$outdated = $_SESSION['outdated'];
	$count = $_SESSION['count']; // number of count
	$start_time = $_SESSION['start_time'];
	$end_time = $_SESSION['end_time'];
	$start_date = $_SESSION['start_date'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">	
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->
		<div id="content">
			<br/><br/>	
			<p> Sucessfully converted CSV file </p><br/><br/>
			<p> The latest time stored in the database is: <?php echo $start_date ?> </p>
			<p> The data in the file is from <?php echo $start_time ?> to <?php echo $end_time ?> </p>			
			<p> There are <?php echo $outdated ?> set(s) of data being outdated </p> 
			<p> There are <?php echo $count ?> set(s) of new data converted into xml files </p>
			<br><br>
			<div>
				<a href = "download_converted_file.php"> Download converted file </a> 
			</div>
			<br>
			<div>
				<a href = "/populate"> Go back </a> 			
			</div>	
		</div>
		
		<div>
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>
