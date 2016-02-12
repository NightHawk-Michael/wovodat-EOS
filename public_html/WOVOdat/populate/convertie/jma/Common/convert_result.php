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
	$observatory = $_SESSION['observatory'];// = $_POST['owner1'];
	$data_type = $_SESSION['data_type'];// = $_POST['data_type'];
	$volcano = $_SESSION['volcano'];// = $_POST['volcano'];
	$station_network = ucfirst($_SESSION['station_network']);// = $_POST['station_network'];
	$station = $_SESSION['station'];// = $_POST['station'];
	$instrument = $_SESSION['instrument'];
	$network = $_SESSION['network'];
	$error_list = $_SESSION['error_list'];
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
	<style>
	#result_table
	{
		font-size: 15px
	}
	#result_table td
	{
	height: 30px;
	vertical-align:bottom;
	}
	</style>
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->
		<div id="content">
			<br/><br/>	
			<p style="font-size:17px"> Sucessfully converted CSV file </p>
			<table id = "result_table">
			<?php 

				if ($data_type=='Gt')  {
					$station_network  = 'Station';
					$data_type="Ground Deformation: Tilt";
				}
				if ($data_type=="Hypo") {
					$station_network = 'Network';
					$data_type="Earthquake hypocenters";
				}
				if ($data_type=="Gg") {
					$data_type="Ground Deformation: GPS";
				}
				if ($data_type=="Eo") {
					$data_type="Volcanic Earthquakes And Tremors";
				}
				echo "<tr>";	
				echo "<td><strong>Time: </strong></td>" . "<td>" . date("Y-m-d H:i:s") . "</td>";
				echo "</tr>";
				echo "<tr>";	
				echo "<td><strong>Observatory name: </strong></td>" . "<td>" . $observatory. "</td>";
				echo "</tr>";
				echo "<tr>";	
				echo "<td><strong>Conversion data type: </strong></td>" . "<td>" . $data_type .  "</td>";
				echo "</tr>";
				if ($volcano) {
					echo "<tr>";	
					echo "<td><strong>Volcano Name: </strong></td>" . "<td>" . $volcano . "</td>";
					echo "</tr>";
				}
				if ($station_network) {
					echo "<tr>";	
					echo "<td><strong>" . $station_network . " name: </strong></td>" . "<td>" . $station . $network . "</td>";
					echo "</tr>";
				}

				if ($instrument) {
					echo "<tr>";
					echo "<td><strong>Instrument name: </strong></td>" . "<td>" . $instrument . "</td>";
					echo "</tr>";
				}
				
			?>
			</table>
			<br/><br/>

			<?php
				//echo '<script>console.log("target is '.count($error_list).'");</script>';
				if (count($error_list)>0) {
					if ($data_type=="Ground Deformation: GPS") 
						$station_network = "stations";	
					if ($data_type=="Volcanic Earthquakes And Tremors") 
						$station_network = "seismic stations";
					echo "<p>These ". $station_network ." are not available in the database. The data for these specific ". $station_network. " are not converted:<br/>			";
					foreach ($error_list as $key => $value) {
						echo $value." ";
					}
					echo "</p><br/><br/>";
				}
			?>

			<a href = "download_converted_file.php" style="font-size:20px"> <strong>Download converted file </strong></a> 
			<br/><br/>
			<a href = "../../../home_populate.php"> Go back </a> 			
		</div>
		
		<div>
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>
