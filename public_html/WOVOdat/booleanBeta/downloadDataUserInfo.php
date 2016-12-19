<?php
session_start();

if(isset($_SESSION['downloadDataUsername'])){	
header('Location:booleanDownloadData.php?i='.$_GET['i'].'&data='.$_GET['data']);
}
	
echo <<<HTMLBLOCK
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
		<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
		<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
		<link href="/css/styles_beta.css" rel="stylesheet">
		<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
		<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.js"></script>
		<script type="text/javascript" src="/js/formValidation.js"></script>
		<style type="text/css">                             
			label.error { float: none; color: red; }
		</style>	
	</head>
	<body>

		<div id="wrapborder">
		<div id="wrap">
HTMLBLOCK;

	include 'php/include/header_beta.php';
echo <<<HTMLBLOCK

			<!-- Content -->
			<div id="content">	
				
	
HTMLBLOCK;

echo <<<HTMLBLOCK
					<div>
					
					<p><b>Please provide information before starting data download.</b></p> </br>
					
						<form name="downloadDataForm" id="downloadDataForm" method="get" action="booleanDownloadData.php">
					
						<table>	
							
							<tr>
								<th>Name:</th>
								<td>
									<input type="text" id="downloadDataUsername" name="downloadDataUsername" class="required"/>
								</td>
							</tr>
									
							<tr>
								<th>Email:</th>
								<td>
									<input id="downloadDataUseremail" name="downloadDataUseremail" class="required" />
								</td>
							</tr>
							
							<tr>
								<th>Institution/Observatory:</th>
								<td>
									<input id="downloadDataUserobs" name="downloadDataUserobs" class="required" />
								</td>
							</tr>
							
							<tr>
								<td align="right"><input type="checkbox" name="agree" value="T&C" id="agree"></td>
								<td align="left"><a href="/populate/dataPolicy.php" target="_blank"> I agree to WOVOdat Data Policy</a></td>
							</tr>
							
HTMLBLOCK;

		echo "<input type='hidden' name='i' value='{$_GET['i']}'>";
		echo "<input type='hidden' name='data' value='{$_GET['data']}'>";

	 
echo <<<HTMLBLOCK
							<tr>
								<td>
									<input type="submit" name="downloadData_submit" value="Submit" />
								</td>
							</tr>

HTMLBLOCK;
				echo "</table>";				
						
		echo"</div>";
		echo"</div>";

		echo"<div>";
		include "php/include/footer_main_beta.php"; 
		echo"</div>";
		
	echo"</div>";
		
	echo"</body>";
	echo"</html>";		
?>
