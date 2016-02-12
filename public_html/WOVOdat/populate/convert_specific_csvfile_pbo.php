<?php
require_once("query_database.php");
session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
$uname="";
$ccd="";
if(isset($_SESSION['login'])) {
	$uname=$_SESSION['login']['cr_uname'];
	$ccd=$_SESSION['login']['cc_id'];
}
else{
header('Location: '.$url_root.'login_required.php');// Session was not yet started.... Redirect to login required page
exit();
}

if(!isset($_GET['obs'])){
header('Location: '.$url_root.'home_populate.php');
exit();
}

?>
<html>
<script src="/js/jquery-1.9.1.js"></script>
<script language='javascript' type='text/javascript'>
	
	$(document).ready(function(){
			
		var observatory = $("#observatory").val();
		$("#data_type").change(function() {
			reset_values(['GPS_station_code']);
			var data_type = $("#data_type").val();
			if (data_type == "GPS") {
				loadGPSOption();
				return;
			}
			if (data_type) turn_on_display('div_volcano');
		});

		function loadGPSOption() {
			var sel = $("#GPS_station_code");
			sel.empty()
			sel.append(new Option("...",""));
			var codeList = ['AB04', 'AB06', 'AB07', 'AB13', 'AB21', 'AB49', 'AB51', 'AC10', 'AC17', 'AC21', 'AC25', 'AC27', 
							'AC38', 'AC40', 'AC41', 'AC50', 'AC59', 'AGMT', 'AV01', 'AV02', 'AV04', 'AV06', 'AV07', 'AV08', 
							'AV09', 'AV10', 'AV11', 'AV12', 'AV13', 'AV14', 'AV15', 'AV16', 'AV17', 'AV18', 'AV19', 'AV20', 
							'AV24', 'AV25', 'AV26', 'AV27', 'AV29', 'AV34', 'AV35', 'AV36', 'AV37', 'AV38', 'AV39', 'AV40', 
							'AVRY', 'BAY2', 'BBID', 'BBRY', 'BEPK', 'BKAP', 'BLYT', 'BMHL', 'BRPK', 'BSRY', 'CDMT', 'CMBB', 
							'CPBN', 'CPXX', 'CTMS', 'GMRC', 'GOL2', 'GRNX', 'HCMN', 'HCRO', 'HIVI', 'HVWY', 'I40A', 'JNPR', 
							'KOD5', 'LDES', 'LDSW', 'LKWY', 'LNMT', 'MAUI', 'MAWY', 'MKEA', 'MUSB', 'NBPS', 'NRWY', 'OAES', 
							'OFW2', 'OPBL', 'OPCL', 'OPCP', 'OPCX', 'OPRD', 'ORMT', 'P060', 'P065', 'P104', 'P107', 'P127', 
							'P148', 'P203', 'P206', 'P348', 'P349', 'P360', 'P385', 'P387', 'P414', 'P416', 'P420', 'P421', 
							'P428', 'P429', 'P431', 'P432', 'P442', 'P444', 'P460', 'P655', 'P656', 'P657', 'P658', 'P659', 
							'P660', 'P661', 'P663', 'P664', 'P665', 'P666', 'P667', 'P668', 'P669', 'P670', 'P671', 'P672', 
							'P673', 'P674', 'P676', 'P680', 'P686', 'P687', 'P688', 'P689', 'P690', 'P691', 'P692', 'P693', 
							'P694', 'P695', 'P696', 'P697', 'P698', 'P699', 'P700', 'P701', 'P702', 'P703', 'P704', 'P705', 
							'P708', 'P709', 'P710', 'P711', 'P712', 'P714', 'P716', 'P717', 'P720', 'P721', 'PHLB', 'PMAR', 
							'PUPU', 'RAMT', 'RDMT', 'RSTP', 'SCIA', 'SDHL', 'SEDR', 'SELD', 'SIBE', 'SLID', 'TIVA', 'TONO', 
							'TSWY', 'UNR1', 'WATC', 'WLWY', 'WOMT'];
			for (var i  = 0; i < codeList.length; i++) {
				sel.append(new Option (codeList[i], codeList[i]));
			}	
			turn_on_display("div_GPS_station_code");
		}

		$("#GPS_station_code").change(
			function() {
				var stationCode = $("#GPS_station_code").val();
				if (!stationCode) {
					turn_off_display('div_GPS_fillin_data');
					return;
				}				
				$.ajax({
					type: "GET",
					dataType: "json",
					url: "get_station_information.php",
					data: {observatory: "PBO", dataType: "GPS", stationCode: $("#GPS_station_code").val()}
				}). done(function(result) {
					$("#refPosLat").val(result["refPosLat"]);
					$("#refPosLon").val(result["refPosLon"]);
					$("#refPosElev").val(result["refPosElev"]);
				});
				turn_on_display('div_GPS_fillin_data');
			}
		);

		function reset_values(list) {
			for(var i = 0; i < list.length; i++) {
				$("#" + list[i]).val('');
				turn_off_display('div_' + list[i]);
			}
		}

		function turn_on_display(id) {
			$('#' + id).css('display', 'block');
		}

		function turn_off_display(id) {
			$('#' + id).css('display', 'none');
		}

		$("#submit_form").submit(function() {
			var data_type = $("#data_type").val();
			if (!data_type) {
				alert("Please choose type of data to convert");
				return false;
			}
			if (data_type == 'GPS') {
				var stationCode = $("#GPS_station_code").val();
				if (!stationCode) {
					alert("Please choose a station code");
					return false;
				}
			}

			var path = 'convertie/' + observatory + '/' + data_type + '/convert.php';
			$("#submit_form").attr('action', path);
			return true;
		});
	});	
	</script>

<div id = "whole_div">

	<h2>Conversion of Customary-format Data </h2>
	<p><blockquote>Input: monitoring data, following a specific format which already listed in the WOVOdat </blockquote></p>
	<br/>	
	<form name = "submit_form" id = "submit_form" action = "" method = "post" enctype = "multipart/form-data">
	
        <div class = "field_data">
            <p>Observatory (data owner): </p>
            <select name='owner1' id='observatory' class = "dropdown_list">
            	<option selected="selected" value="PBO" title="Volcanological Survey of Indonesia">UNAVCO, PBO</option>
            </select>
            <br/><br/>
        </div>

		<div class = "field_data">
			<p>Data owner 2 (Optional): </p>
			<select name='owner2' id='owner2' class = "dropdown_list">
				<option value="">...</option> 
<?php					
					$owners_list = get_owners_list();
					for ($i = 0; $i < count($owners_list); $i++) {
						echo '<option value = "'.$owners_list[$i]['value'].'" title = "'.$owners_list[$i]['title'].'">' . $owners_list[$i]['country'].', '.$owners_list[$i]['value'].'</option>';
					}
?>
			</select>
			<br/><br/>
		</div>

		<div class = "field_data">
			<p>Data owner 3 (Optional): </p>
			<select name='owner3' id='owner3' class = "dropdown_list">
				<option value="">...</option>
<?php
					for ($i = 0; $i < count($owners_list); $i++) {
						echo '<option value = "'.$owners_list[$i]['value'].'" title = "'.$owners_list[$i]['title'].'">' . $owners_list[$i]['country'].', '.$owners_list[$i]['value'].'</option>';
					}
?>
			</select>
			<br/><br/>
		</div>			

		<div id="div_data_type" class = "field_data">
			<p>Type of data to convert: </p>
			<select name='data_type' id="data_type" class = "dropdown_list">
				<option selected="selected" value="" >...</option>
				<option value="GPS">GPS</option>
				<option value="Tiltmeter">Tiltmeter</option>
				<option value ="Strainmeter"> Strainmeter</option>
			</select>
			<br/><br/>		
		</div>

		<div id = "div_GPS_station_code" class = "hidden_field_data field_data">
			<p>Choose the station code: </p>
			<select name = "GPS_station_code" id = "GPS_station_code" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>
				
		<div id = "div_GPS_fillin_data" class = "hidden_field_data field_data">
			<p> Reference Frame (maxlength = 30): </p>
			<input name = "refFrame" maxlength = "30" class = "text_input" value = "SNARF 1.0"/>

			<p> Projection (maxlength = 30): </p>
			<input name = "projection" maxlength = "30" class = "text_input" value = "ITRF 2005"/>

			<p> Ellipsoid (maxlength = 30): </p>
			<input name = "ellipsoid" maxlength = "30" class = "text_input" value = "WGS84"/>

			<p> Datum (maxlength = 30): </p>
			<input name = "datum" maxlength = "30" class = "text_input" value = "WGS84"/>

			<p> Reference Position Latitude (maxlength = 30): </p>
			<input id = "refPosLat" name = "refPosLat" maxlength = "30" class = "text_input"/>

			<p> Reference Position Longittude (maxlength = 30): </p>
			<input id = "refPosLon" name = "refPosLon" maxlength = "30" class = "text_input"/>

			<p> Reference Position Elevation (maxlength = 30): </p>
			<input id = "refPosElev" name = "refPosElev" maxlength = "30" class = "text_input"/>

			<p> Software (maxlength = 255): </p>
			<input name = "software" maxlength = "255" class = "text_input" value = "GIPSY-OASIS II Release 5.0"/>

			<br/><br/>
		</div>
		<div id = "submit_button" class = "field_data">
			<input type="submit" name="submit" id="submit_button" value="Select">
		</div>
	</form>  
</div>

</html>
