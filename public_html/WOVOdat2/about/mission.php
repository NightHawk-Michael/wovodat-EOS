<?php
$redirect=substr($_SERVER['PHP_SELF'], 1);
include "php/include/check_login_beta.php";
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
	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>

	  <div id="content">	
			<div id="contentl"><br>
				<h1><b>MISSION</b></h1>
				<h3>Online tool for crisis response <br>and for study of volcanic unrest</h3>
				<p class="home1">
					During periods of volcanic unrest, forecasting of further activity is aided by knowledge of previous activity at the restless volcano and knowledge of unrest and eruptions at similar volcanoes.  WOVOdat expands access to that information. 
					<br><br>
					Advances in instrumentation, networking, and data storage technologies have greatly increased observer's ability to collect volcanic data and share observations with colleagues.   The wealth of data creates numerous opportunities for gaining a better understanding of magmatic conditions and processes, if the data can be easily accessed for comparison.   To allow comparison of volcanic unrest, a central database called WOVOdat is created.  WOVOdat will contain time-stamped and georeferenced data from WOVO observatories and other contributors in common and accessible formats<br>
					<br><br>
					</p>
					<p  style="padding:0px 15px 0px 50px;">
					<span style="font-style:oblique; font-size:14px; ">WOVOdat will serve as a reference for those handling volcanic crises, and as a tool for those studying the activity of volcanoes in between and leading to eruptions.   Initially, it will provide tools for simple graphical comparisons such as the RSAM plots on our homepage.    Later, we will add tools for Boolean searches and searches based on pattern recognition.</span> 
				</p>
			</div>

			<div id="contentr">
				<br><br>
				<p align="center"><img src="/maps2/Spurr.gif" width="350" height="350" alt="schema"></p>
				<p style="font-size:8px;margin-left:150px;margin-right:35px;">
						<b>Global relief model: ASTER-GDEM(NASA-METI); <br>
						      Global volcano list: GVP-Smithsonian Institution</b></p>
				<br><br>
			</div>
		</div>
		<div id="footer">
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
	</div>
	</div> <!--end of wrapborder-->
</body>
</html>



