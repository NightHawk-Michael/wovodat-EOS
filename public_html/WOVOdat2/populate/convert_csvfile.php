<?php
	// Start session
	session_start();
	// Regenerate session ID
	session_regenerate_id(true);
	$uname="";
	$ccd="";
?>
<script src="/js/jquery.js"></script>

<?php
	if (isset($_SESSION['login'])) {
		$uname=$_SESSION['login']['cr_uname'];
		$ccd=$_SESSION['login']['cc_id'];
	}else{
		// Session was not yet started
		// Redirect to login required page
		header('Location: '.$url_root.'login_required.php');
		exit();
	}

?>
<html>
	<script language='javascript' type='text/javascript'>
		function select_observatory_change2(){
			$('#observ').change(update_volcano2);
			$('#instrument2form').hide();$('#instrument3form').hide();
		}
		function update_volcano2(){
			var institute=$('#observ').attr('value');
			$.get('./convertie/selectVolOfInstitute2.php?kode='+institute, show_gunung2);
		}
		function show_gunung2(res){
			$('#volano2').html(res);
		}
		function respon2filecontent(){
			var sg = document.form1.vol2.selectedIndex; var sgu = document.form1.vol2.options[sg].value;
			var statype=$('#sttype').attr('value');
			$('#networkblock').hide();$('#stationform').hide();$('#instrumentform').hide();
			$('#instrument2form').hide();$('#instrument3form').hide();
			
			if(statype=="SeismicNetwork" || statype=="DeformationNetwork" || statype=="GasNetwork" || statype=="HydrologicNetwork" || statype=="ThermalNetwork" || statype=="FieldsNetwork" || statype=="EventDataFromNetwork"){
				$('#networkblock').show();
				$('#stationform').hide();
				$.get('./convertie/selectNetwork.php?volcan='+sgu + '&statype='+statype, show_networkavail);
						
			}else if(statype=="SeismicStation" || statype=="DeformationStation" || statype=="GasStation" || statype=="HydrologicStation" || statype=="ThermalStation" || statype=="FieldStation"){
				$('#networkblock').show();
				$('#stationform').hide();
				$.get('./convertie/selectNetwork.php?volcan='+sgu + '&statype='+statype, show_networkavail);
				
			}else if(statype=="DeformationInstrumentG" || statype=="DeformationInstrumentT" || statype=="GasInstrument" || statype=="HydrologicInstrument" || statype=="ThermalInstrument" || statype=="FieldInstrument" || statype=="SeismicInstrument"){
				$('#networkblock').hide();
				$('#stationform').show();
				$.get('./convertie/selectStation_all.php?gunungnya='+sgu + '&netnya='+"..." + '&apadatanya='+statype, show_stationavail);

			}else if(statype=="EventDataFromSingleStation"){
				$('#networkblock').hide();
				$('#stationform').show();
				$.get('./convertie/selectStation.php?gunungnya='+sgu + '&netnya='+"..." + '&apadatanya='+statype, show_stationavail);
			 				
			}else{
				$('#networkform').show();
				$('#stationform').show();
				$.get('./convertie/selectNetwork.php?volcan='+sgu + '&statype='+statype, show_networkavail);
			}
		}
		function show_networkavail(res){
			$('#net').html(res);
			var apadata=$('#sttype').attr('value');
			if(apadata=="SeismicStation" || apadata=="SeismicInstrument" || apadata=="SeismicComponent" || apadata=="DeformationStation" || apadata=="DeformationInstrument" || apadata=="GasStation" || apadata=="GasInstrument" || apadata=="HydrologicStation" || apadata=="HydrologicInstrument" || apadata=="ThermalStation" || apadata=="ThermalInstrument" ||  apadata=="FieldsStation" || apadata=="FieldsInstrument" || apadata=="ElectronicTiltData" || apadata=="TiltVectorData" || apadata=="StrainMeterData" || apadata=="EDMData" || apadata=="AngleData" || apadata=="GPSData" || apadata=="GPSVectors" || apadata=="LevelingData" || apadata=="DirectlySampledGas" || apadata=="SoilEffluxData" || apadata=="PlumeData"  || apadata=="HydrologicData" || apadata=="MagneticFieldsData" || apadata=="MagneticVectorData" || apadata=="ElectricFieldsData" || apadata=="GravityData" || apadata=="GroundBasedThermalData" || apadata=="ThermalImage" || apadata=="ThermalImageData"){
				var sg = document.form1.vol2.selectedIndex; var sgu = document.form1.vol2.options[sg].value;
				var sne = document.form1.netw.selectedIndex; var snet = document.form1.netw.options[sne].value;
				$.get('./convertie/selectStation.php?gunungnya='+sgu + '&netnya='+snet + '&apadatanya='+apadata, show_stationavail);
			}
		}

		function show_stationavail(res){
			$('#stationdiv').html(res);
			for_component();
		}

		function for_component(){
			var apadata1=$('#sttype').attr('value');
			if(apadata1=="SeismicInstrument" || apadata1=="SeismicComponent" || apadata1=="DeformationInstrument" || apadata1=="GasInstrument" || apadata1=="HydrologicInstrument" || apadata1=="ThermalInstrument" || apadata1=="FieldsInstrument"){
				var sg = document.form1.vol2.selectedIndex; var sgu = document.form1.vol2.options[sg].value;
				var sne = document.form1.netw.selectedIndex; var snet = document.form1.netw.options[sne].value;
				var ssta = document.form1.stat2.selectedIndex; var sstas = document.form1.stat2.options[ssta].value;
				$.get('./convertie/selectInstrument.php?gunungnya='+sgu + '&netnya='+snet + '&apadatanya='+apadata1 + '&stationnya='+sstas, show_instrumentavail);
			}
		}
		function show_instrumentavail(res){
			$('#instrumdiv').html(res);
		}
		
		$(document).ready(select_observatory_change2);
		
	</script>

<div style="padding:0px 0px 0px 5px;">
<?php
	$mndata=$_GET['tipedata'];
	if($mndata=="data"){
		echo "<h1>Conversion of Monitoring Data</h1>";
		echo "<p><blockquote>Input: CSV file of seismic, deformation, gas, hydrology, field, or thermal data. The data must follow WOVOdat1.1 standard format</blockquote></p>";
	}elseif($mndata=="station"){
		echo "<h1>Conversion of Monitoring System</h1>";
		echo "<p><blockquote>Input: CSV file of network, station, or instrument information. The data must follow the WOVOdat1.1 standard format</blockquote></p>";
	}elseif($mndata=="specific"){
		echo "<h1>Conversion of Customary-format Data</h1>";
		echo "<p><blockquote>Input: CSV of monitoring data, following a specific format which already listed in the WOVOdat</blockquote></p>";
	}
?>
	<br>
	<form name="form1" id="form1" action="./convertie/Conversion2xml.php?monidata=<?php print $mndata; ?>" method="post" enctype="multipart/form-data">
	<div style="height:45px; padding-left:20px;">
		<div id="lfleft" style="width:5%;  float:left;"></div>
		<div style="width:40%; float:left;">
			<p1>Observatory (data owner): </p1><br>
			<div id='observo'>
				<select name='observ' id='observ' style="width:180px">
					<option value="Select institute">.....</option>
<?php
						include 'php/include/db_connect_view.php';
						if ($_SESSION['permissions']['access']==0){
								$result = mysql_query("select cc_code, cc_country, cc_obs, cc_id		from cc		order by cc_country");
						}else{
							$result = mysql_query("select cc_code, cc_country, cc_obs, cc_id 	from cc 	where cc_id='$ccd'  order by cc_country");
						} 
						while ($v_arr = mysql_fetch_array($result)) {
							if(!is_numeric($v_arr[0])){
								$titles=htmlentities($v_arr[2], ENT_COMPAT, "cp1252");
								if($v_arr[1]==""){
									if($v_arr[3]==$ccd){
										echo "<option value=\"$v_arr[0]\" title=\"$titles\" selected=\"selected\">".htmlentities($v_arr[0], ENT_COMPAT, "cp1252")."</option>";
									}else{echo "<option value=\"$v_arr[0]\" title=\"$titles\">".htmlentities($v_arr[0], ENT_COMPAT, "cp1252")."</option>";}
								}else{
									if($v_arr[3]==$ccd){echo "<option value=\"$v_arr[0]\" title=\"$titles\" selected=\"selected\">".htmlentities($v_arr[1].",".$v_arr[0], ENT_COMPAT, "cp1252")."</option>";
									}else{echo "<option value=\"$v_arr[0]\" title=\"$titles\">".htmlentities($v_arr[1].",".$v_arr[0], ENT_COMPAT, "cp1252")."</option>";}
								}
							}
						} 
?>
				</select>
			</div>
		</div>
		<div style="width:10%;  float:left;">&nbsp</div>
		<div id="vola2" style="width:45%;  float:left;">
			<p1>Volcano: </p1><br>
			<div id="volano2">
				<select name='vol2' id='vol2' style="width:170px">
					<option>...</option>
				</select>
			</div>
		</div>
	</div>
	<div>
		<div id="rightleft" style="width:5%; height:45px;  float:left;"></div>
		<div id="rightleft" style="width:45%; height:45px;  float:left;">
			<div style="">
				<p1>Type of Data to convert: </p1><br>
				<select name='sttype' id='sttype' style="width:180px" onChange='javascript:respon2filecontent()'>
					<option value="select station type" option="selected">...</option>
<?php
				if($mndata=="data"){
					require("./convertie/wovodatdatatablelist.php");
					foreach($wovodattables as $k =>$v){echo '<option value='.$v.'>' .$v. '</option>';}
				}elseif($mndata=="station"){
					require("./convertie/wovodatmonitoringtablelist.php");
					foreach($wovodatmontables as $k =>$v){echo '<option value='.$v.'>' .$v. '</option>';}
				}
?>
				</select>
			</div>
		</div>
		<div id="rightright" style="width:50%;  height:50px; float:left;"></div>
	</div>
	
	<div id="networkblock">
		<div style="width:50%;  height:40px; float:left;"></div>
		<div id="networkform" style="width:40%;  height:40px; float:left;">
			<p1>Network: </p1><br> 
			<div id="net">
				<select name="netw" id="netw"  style="width:180px">
					<option value="netname">...</option>
				</select>
			</div>
		</div>
	</div>
	
	<div  id="stationblock">
		<div id="downleft" style="width:50%;  height:40px; float:left;"></div>
		<div id="downright" style="width:40%; height:40px; float:left;">
			<div id="stationform"  style="height:40px;">
				<p1>Station: </p1><br>
				<div id="stationdiv">
					<select name="stat2" id="stat2"  style="width:180px" onChange="javascript:for_component()">
						<option value="statname">...</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div id="instrumentblock">
		<div id="ddleft" style="width:50%;  height:110px; float:left;"></div>
		<div id="ddright" style="width:40%; height:110px; float:left;">
			<div id="instrumentform"  style="height:40px;">
				<p1>Instrument: </p1><br>
				<div id="instrumdiv">
					<select name="instrum" id="instrum"  style="width:180px">
						<option value="instrumentname">...</option>
					</select>
				</div>
			</div>
			<div id="instrument2form"  style="height:40px;">
				<p1>Instrument2: </p1><br>
				<div id="instrum2div">
					<select name="instrum2" id="instrum2"  style="width:180px">
						<option value="instrumentname">...</option>
					</select>
				</div>
			</div>
			<div id="instrument3form" style="height:50px;">
				<p1>Instrument3: </p1><br>
				<div id="instrum3div">
					<select name="instrum3" id="instrum3"  style="width:180px">
						<option value="instrumentname">...</option>
					</select>
				</div>
			</div>
		</div>
	</div>


	<div style="width:180px; float:left";">
		<div style="padding-left:20px;">
			Browse file to convert:<br>
			<input type="hidden" name="MAX_FILE_SIZE" value="900">
			<input name="fname" type="file" size="35" maxlength="90">
			<br>
			<input type="submit" name="Submit" value="Select">
		</div>
	</div>
	</form>  <!-- end form -->
</div>

<div id="extra">
</div>
</html>
