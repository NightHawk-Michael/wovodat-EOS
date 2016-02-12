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
	<script language="JavaScript" src="/js2/menu_array.js" type="text/javascript"></script>
	<script language="JavaScript" src="/js2/mmenu.js" type="text/javascript"></script>
	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>

	  <div id="content">	
			<div id="contentl">
				<h1><br>THE FIRST IDEA</h1>
				<h3>The Idea of Volcano Epidemiology</h3>
					<p class="home1">
						After the eruption of Mount St. Helens (USA) in 1980, researchers in various research groups around the world were trying to find ways to better understand volcanic unrest.   C. Newhall (USGS) and H. Okada (Hokkaido University) began planning how to organize and use information on volcanic unrest in a database.   They also started discussions with the Smithsonian Institution's Global Volcanism Program (GVP), to interface with information in the GVP database of historical eruptions.<br>
						<br>
						By analogy to medicine, WOVOdat contains data on "symptoms" and the GVP catalogues outcomes.  Together, WOVOdat and the GVP database are concerned with global occurrences and associations of unrest and eruptions.  Practicing doctors and volcanologists can use epidemiological databases to aid their diagnoses..<br>
						<br>
						Before the era of computers and databases, all of this was done by a few scholars and years of research in libraries.   But it is impractical for any individual to do all of the needed library study, and such study also takes much longer than is available during crises.<br>
						<br>
						The internet now makes interactive access with the database possible for all.<br>
						<br>
					</p>
			</div>

			<div id="contentr">
				<br><br><p align="center"><img src="/maps2/St_Helens.gif" width="350" height="350" alt="schema"></p>
				<p style="font-size:8px;margin-left:150px;margin-right:35px;">
						<b>Global relief model: ASTER-GDEM(NASA-METI); <br>
						      Global volcano list: GVP-Smithsonian Institution</b></p>
				<br><br>
				<p class="home2">
				</p>
			</div>
		</div>
		<div id="footer">
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
	</div>
	</div> <!--end of wrapborder-->
</body>
</html>



