<HTML>
<HEAD>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="../dropshadow_v1.css" rel="stylesheet">
	<link href="http://www.wovodat.org/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	
	<script language="JavaScript" src="http://gmaps-utility-library.googlecode.com/svn/trunk/mapiconmaker/1.1/src/mapiconmaker.js"></script>
	<script language="JavaScript" src="../JSClass/FusionCharts.js"></script>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAxDps_3N-nXQ_bdLMel4mmBSpYxtWavb02HYAejULMuX2376JrBRzgAQVIz2XhDDWIvBAQrCsmkOIYQ" type="text/javascript"></script>
	<link type="text/css" href="development-bundle/themes/redmond/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="development-bundle/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.tabs.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.draggable.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.resizable.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.dialog.js"></script>
	<link type="text/css" href="../demos.css" rel="stylesheet" />
	<script language="JavaScript" src="GPSCharts.js"></script>
</HEAD>
<BODY onunload="GUnload()">
	<?php include("checkuser.php");?>
	<div id="popupBox" title="Message from WOVOdat"></div>
	<div id="wrap">
		<div id="headershadow">
			<div id="header1">
				<div class="wovologo">
					<a href="http://www.wovo.org" target="_blank">
					<p align="center"><img src="../gif/WOVO_logo.gif" alt="WOVO logo" height="40" width="40" border="0"></p></a>
					<p align="center"><a title="The World Organization of Volcano Observatories" href="http://www.wovo.org" target="_blank">WOVO</a></p>
				</div>
				<div class="iavceilogo">
					<a href="http://www.iavcei.org" target="_blank">
					<p align="center"><img src="../gif/iavcei.gif" alt="IAVCEI" height="40" width="60" border="0"></p></a>
					<p align="center">
					<a title="International Association of Volcanology and Chemistry of the Earth's Interior" href="http://www.iavcei.org" target="_blank"> IAVCEI</a></p>	
				</div>
				<div class="wovodatlogo" align="center">
					<a href="http://www.wovodat.org/index.html" target="_parent">
					<img src="../gif/WOVOdat_banner_D.gif" alt="WOVOdat" height="90" width="500" border="0"></a>
				</div>
				<div class="eoslogo">
					<a href="http://www.earthobservatory.edu.sg" target="_blank">
					<p align="center"><img src="../gif/EOSlogo050610c.gif" alt="EOS logo" height="40" width="35" border="0"></p></a>
					<p align="center"><a title="Earth Observatory of Singapore" href="http://www.earthobservatory.edu.sg" target="_blank">E.O.S.</a></p>
				</div>
			</div>
		</div>
		<div id="navblock1">
			<div id="nav1">
				<ul>
					<li><a title="Home" href="../dropshadow_v1.html">Home</a>
					<li><a title="Documentation" href="../b_documentation/index.html">Documentation</a>
					<li><a title="Upload" href="../9_upload/index.html">Upload</a>
					<li><a class="active" title="Precursors" href="../a_precursors/index.html">Precursors</a>
					<li><a title="Links" href="">Links</a>
					<li><a title="Contact us" href="">Contact us</a>
				</ul>
			</div>
		</div>

		<div id="navblock2">
			<div id="nav2precursors">
				<ul>
					<li><a title="MultipleVolcano" href="./multiple.html">MultipleVolcano</a>
					<li><a class="active" title="SingleVolcano" href="./single.html">SingleVolcano</a>
				</ul>
			</div>
		</div>

	  <div id="content">	
			<div id="contentl" style="background-color:black;">
				<h1 class="ui-widget-header">Page for Single Volcano Precursors</h1>
					</script>
					<div id="viewcontent" style="width:98%+1px; align:center">
						<ul>
						<li><a href="#east" onclick="return false;">East</a></li>
						<li><a href="#north" onclick="return false;">North</a></li>
						<li><a href="#elevation" onclick="return false;">Elevation</a></li>
						</ul>
						<div style="float:bottom;" id="east"></div>
						<div style="float:bottom;" id="north"></div>
						<div style="float:bottom;" id="elevation"></div>
					</div>
				<div id="bigmap" style="position:relative; left:5%;top:5%;width:90%;height:80%;" title="Big Map"></div>
			</div>
			<div id="contentr">
				<div id="viewcontrol">
				<ul>
				<li><a href="#spatial" onclick="window.maporgraph = 0; $('#viewcontent').hide(); $('#bigmap').height('80%'); $('#bigmap').width('90%'); $('#temporal').hide(); $('#spatial').show();$('#bigmap').show(); return false;">Map</a></li>
				<li><a href="#temporal" onclick="window.maporgraph = 1; $('#viewcontent').show(); $('#temporal').show(); $('#spatial').hide();$('#bigmap').hide(); return false;">Graph</a></li>
				</ul></div>
				<div>
				<span id="filLoading">Loading... <img src="../loadinfo.net.gif"/></span>
				<select id="vd_name" onchange="setupMap()" style="width:100%">
				<option>Select a volcano name:</option>
				<?php
				$link = mysql_connect("localhost", "wovodat", "born2_makan") or die(mysql_error());
				mysql_select_db("wovodat") or die(mysql_error());
				$result = mysql_query("select vd_id, vd_cavw, vd_name from vd order by vd_name");
				while ($vdObj = mysql_fetch_object($result))
				{
					echo "<option value=\"$vdObj->vd_id\">$vdObj->vd_name</option>";
				}
				?>
				</select> <br/>
				<div id="spatial">
				<a href="#" onclick="return false;" id="plfil">use filters</a><a href="#" onclick="return false;" id="minfil">no filters</a>
				<div id="filterSS" title="Filter Maps">
				<table width='100%'>
				<input type="hidden" id="filter" value="0" />
				<tr><td>Events: </td><td align=right><select id="events"><option>100</option><option>200</option><option>300</option><option>400</option><option>500</option>
				</select></td></tr>
				<tr><td>Start Date: </td><td align=right><input type="textfield" id="ss_start" /></td></tr>
				<tr><td>End Date: </td><td align=right><input type="textfield" id="ss_end" /></td></tr>
				<tr><td>Depth: </td><td align=right><input id="dp_min" size='6'> to <input id="dp_max" size='6'></td></tr>
				<tr><td>Type: </td><td align=right><select id="eqtype"><option value="">All</option>
				<option value="R">Regional</option>
				<option value="Q">Quary Blast</option>
				<option value="V">Volcano Tectonic</option>
				<option value="H">Hybrid</option>
				<option value="LF">Low Frequency</option>
				<option value="VLP">Very Long Period</option>
				<option value="E">Explosion</option>
				<option value="T">Tremor</option>
				</select></td></tr></table>
				</div>
				<div align=center><button id="reloadBtn">Reload Map</button><button id="filterBtn">Filter</button></div>
				</div><div id="temporal">
				<div id="temporalQueryDiv">
				<select id="dataType" onchange="changedDataType();" style="width:100%; margin-top:2px">
				<option>Select Data Type</option>
				<option>Interval</option>
				<option>RSAM</option>
				<option>SSAM</option>
				<option>GPS</option>
				<option>Tiltmeter</option>
				<option>EDM</option>
				<option>Strainmeter</option>
				<option>SO2</option>
				<option>Thermal</option>
				</select>
				<div id="selectStationDiv"></div>
				<a href="#" onclick="return false;" id="plfilG">use filters</a><a href="#" onclick="return false;" id="minfilG">no filters</a>
				<div id="filterSSG" title="Filter Graphs">
				<table width='100%'>
				<input type="hidden" id="filterG" value="0" />
				<tr><td>Start Date: </td><td align=right><input type="textfield" id="startdate" /></td></tr>
				<tr><td>End Date: </td><td align=right><input type="textfield" id="enddate" /></td></tr>
				</table>
				</div>
				<div id="chartXML"></div>
				</div>
				</div>
				<div id="dialog" style="width:100%;height:360px;"title="Map"></div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div align="left">
				&nbsp;Copyright © 2000-2009 <a href="http://www.wovo.org" target="_blank">The World Organization of Volcano Observatories</a></div>
			<div align="right"><font size="1" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular">
				<b>last updated: <script type="text/javascript">document.write(document.lastModified)</script>
			 | website hosted by <a href="http://www.eos-singapore.org">EOS</a>&nbsp;</b>
			</div>
		</div>
	</div>
</BODY>
</HTML>