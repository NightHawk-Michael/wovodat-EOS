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
	$network = $_SESSION['network'];// = $_POST['network'];
	$instrument = $_SESSION['instrument'];
	$file_name = $_SESSION['file_name'];// = $_FILES['file_input']['name'];
	$file_size = $_SESSION['file_size'];// = $_FILES['file_input']['size'];
	$count = $_SESSION['count']; // number of count
	$start_time = $_SESSION['start_time'];
	$end_time = $_SESSION['end_time'];
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
	}
	#result_table td
	{
	height:50px;
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
			<p> Sucessfully converted CSV file </p><br/><br/>
			<p> You have converted <?php echo $count; ?> dataset from <?php echo $start_time; ?> to <?php echo $end_time; ?> </p>
			<table id = "result_table">
			<?php 
		/*		echo "<tr>";	
				echo "<td>Time: </td>" . "<td>" . date("Y-m-d H:i:s") . "</td>";
				echo "</tr>";
				echo "<tr>";	
				echo "<td>Observatory name: </td>" . "<td>" . $observatory. "</td>";
				echo "</tr>";
				echo "<tr>";	
				echo "<td>Conversion data type: </td>" . "<td>" . $data_type . "_" . $station_network. "</td>";
				echo "</tr>";
				echo "<tr>";	
				echo "<td>Volcano Name: </td>" . "<td>" . $volcano . "</td>";
				echo "</tr>";

				echo "<tr>";	
				echo "<td> " . $station_network . " name: </td>" . "<td>" . $station . $network . "</td>";
				echo "</tr>";

				if ($instrument) {
					echo "<tr>";	
					echo "<td> Instrument name: </td>" . "<td>" . $instrument . "</td>";
					echo "</tr>";					
				}
				echo "<tr>";	
				echo "<td> File name: </td>" . "<td>" . $file_name . "</td>";
				echo "</tr>";

				echo "<tr>";	
				echo "<td> File size: </td>" . "<td>" . $file_size . " bytes </td>";
				echo "</tr>";
				*/
			?>
			</table>
			<br/><br/>
			<a href = "download_converted_file.php"> Download converted file </a> 
			<br/><br/>
			<a href = "/populate"> Go back </a> 			
		</div>
		
		<div>
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>
