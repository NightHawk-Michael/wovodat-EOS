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
<script src="/js/jquery-1.4.2.min.js"></script>
<script language='javascript' type='text/javascript'>
	
	$(document).ready(function(){

		var observatory = $("#observatory").val();

		load_volcanoes (observatory);  

		function load_volcanoes(observatory){
			$.ajax({
				method:"GET",
				url:"get_volcanoes_list.php",
				data:"observatory=" + observatory,
				dataType:"json",
				success:function(result) {
					for (var i = 0; i < result.length; i++) {
						$("#volcano").append(new Option(result[i][0], result[i][0]));
					}
				}
			})
		}		
					
		$("#data_type").change(function() {
			reset_values(['volcano', 'station_network', 'station', 'reference_station1', 'reference_station2', 'network', 'result', 'counting_interval', 'RSAMSSAM_code', 'instrument', 'process_type']);
			var data_type = $("#data_type").val();
			if (data_type) turn_on_display('div_volcano');
		});

		$("#volcano").change(function(){
			reset_values(['station_network', 'station', 'reference_station1', 'reference_station2', 'network', 'result', 'counting_interval', 'RSAMSSAM_code', 'instrument', 'process_type']);
			var volcano_name = $("#volcano").val();
			var data_type = $("#data_type").val();

			if (volcano_name) {
				if (data_type == 'RSAM' || data_type == 'ElectronicTiltData' || data_type == "GPSPosition") {
					$("#station_network").val("station").attr('selected', true);
					$("#station_network").change();
				} else {
					turn_on_display('div_station_network');
				}
			}
		});

		function change_station_network_options(data_type, volcano, choice) {
			$.ajax({
				method:"GET",
				url:"get_stations_networks_list.php",
				data:"data_type=" + $("#data_type").val() + "&volcano="+$("#volcano").val()+"&station_network=" + $("#station_network").val(),
				dataType:"json",
				success:function(result) {
					if (result.length == 0) {
						$('#div_result').html('<p><b><i>There is no ' + choice + ' available for this volcano. Please create a ' + choice + ' first!</i></b></p><br/><br/>');
						turn_on_display('div_result');
						return;
					} else turn_off_display('div_result');
					var list = [choice];
					if ($("#data_type").val() == 'GPSPosition') {
						list.push('reference_station1');
						list.push('reference_station2');
					}
					for (var j = 0; j < list.length; j++) {
						var sel = $("#" + list[j]);
						sel.append(new Option("...",""));
						for(var i = 0; i < result.length; i++) {
							sel.append(new Option(result[i]['name'], result[i]['code'] + '$' + result[i]['name']));
						}
						turn_on_display('div_' + list[j]);
					}
				}
			});
		}

		function change_instrument_options(station, data_type) {
			$.ajax({
				method:"GET",
				url:"get_instruments_list.php",
				data:"station=" + station + "&data_type=" + data_type,
				dataType:"json",
				success:function(result) {
					if (result.length == 0) {
						$('#div_result').html('<p><b><i>There is no instrument available for this station. Please create an instrument first!</i></b></p><br/><br/>');
						turn_on_display('div_result');						
						return;
					} else turn_off_display('div_result');
					var sel = $('#instrument');
					sel.append(new Option("...", ""));
					for (var i = 0; i < result.length; i++) {
						sel.append(new Option(result[i]['name'], result[i]['code'] + '$' + result[i]['name']));
					}
					turn_on_display('div_instrument');
				}
			});
		}

		function change_counting_interval_options() {
			var data_type = $('#data_type').val();
			var sel = $('#counting_interval');
			sel.append(new Option('...', ''));
			if (data_type == 'RSAM') {
				sel.append(new Option('1 minute', 1));
				sel.append(new Option('10 minutes', 10));				
				sel.append(new Option('20 minutes', 20));
				sel.append(new Option('30 minutes', 30));
				sel.append(new Option('1 hour', 60));								
				sel.append(new Option('2 hours', 120));							
				sel.append(new Option('Original data', -1));									
			}
			if (data_type == 'ElectronicTiltData') {
				sel.append(new Option('1 second', 1));
				sel.append(new Option('30 seconds', 30));				
				sel.append(new Option('1 minute', 60));
				sel.append(new Option('10 minutes', 600));
				sel.append(new Option('20 minutes', 1200));								
				sel.append(new Option('30 minutes', 1800));							
				sel.append(new Option('Original data', -1));													
			}
		}

		$("#station_network").change(function(){
			$('#station').empty();	
			$('#reference_station1').empty();
			$('#reference_station2').empty();
			$('#network').empty();
			reset_values(['station', 'reference_station1', 'reference_station2', 'network', 'counting_interval', 'RSAMSSAM_code', 'result', 'instrument', 'process_type']);
			var choice = $("#station_network").val();
			if (choice) {
				change_station_network_options($("#data_type").val(), $("#volcano").val(), choice);
			}
		});

		$("#station").change(function() {
			reset_values(['counting_interval', 'RSAMSSAM_code', 'instrument', 'process_type', 'result']);
			$('#instrument').empty();
			var station = $("#station").val();
			var data_type = $("#data_type").val();
			if (data_type == "RSAM" && station) {
				$('#counting_interval').empty();
				change_counting_interval_options();							
				turn_on_display('div_counting_interval');
				turn_on_display('div_RSAMSSAM_code');
			}

			if ((data_type == "ElectronicTiltData" || data_type == "GPSPosition") && station) {
				var pos = station.indexOf('$');
				change_instrument_options(station.substring(pos + 1), data_type);
			}
		});

		$("#instrument").change(function() {
			if ($("#data_type").val() != 'ElectronicTiltData') return;
			reset_values(['counting_interval', 'process_type']);
			if ($("#instrument").val() != '') {
				turn_on_display('div_process_type');
				$('#counting_interval').empty();
				change_counting_interval_options();			
				turn_on_display('div_counting_interval');
			}
		});

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
			var volcano_name = $("#volcano").val();
			if (!volcano_name) {
				alert("Please choose a volcano");
				return false;
			}

			var station_network = $("#station_network").val();
			if (!station_network) {
				alert("Please choose station or network");
				return false;
			}
			if (station_network == 'station') {
				var station = $("#station").val();
				if (!station) {
					alert("Please choose a station");
					return false;
				}
			} else {
				var network = $("#network").val();
				if (!network) {
					alert("Please choose a network");
					return false;
				}
			}

			if (data_type == 'RSAM') {
				var counting_interval = $("#counting_interval").val();
				if (!counting_interval) {
					alert("Please choose Interval length");
					return false;
				}
				var RSAMSSAM_code = $("#RSAMSSAM_code").val();
				if (!RSAMSSAM_code) {
					alert("Please enter RSAMSSAM Code");
					return false;
				}
			}

			if (data_type == 'ElectronicTiltData' || data_type == 'GPSPosition') {
				var instrument = $("#instrument").val();
				if (instrument == '') {
					alert("Please choose an instrument");
					return false;
				}
			}
			if (data_type == 'ElectronicTiltData') {
				var counting_interval = $("#counting_interval").val();
				if (!counting_interval) {
					alert("Please choose Interval length");
					return false;
				}
			}

			var path = 'convertie/' + observatory + '/' + data_type + '/convert.php';
			$("#submit_form").attr('action', path);
			var file_name = $("#file_input").val();
			if (!file_name) {
				alert("Please choose a file to convert");

				return false;
			}

			return true;
		});

	});	
	</script>

<div id="whole_div">

	<h2>Conversion of Customary-format Data </h2>
	<p><blockquote>Input: monitoring data, following a specific format which already listed in the WOVOdat </blockquote></p>
	<br/>	
	<form name = "submit_form" id = "submit_form" action = "" method = "post" enctype = "multipart/form-data">
	
        <div class = "field_data">
            <p>Observatory (data owner): </p>
            <select name='owner1' id='observatory' class = "dropdown_list">
            	<option selected="selected" value="CVGHM" title="Volcanological Survey of Indonesia">Indonesia,CVGHM</option>
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
				<option value="IntervalSwarmData">IntervalSwarmData</option>
				<option value="RSAM">RSAM</option>
				<option value ="ElectronicTiltData"> ElectronicTiltData	</option>
				<option value = "GPSPosition"> GPS Position </option>
			</select>
			<br/><br/>		
		</div>

		<div id = "div_volcano" class = "hidden_field_data">
			<p>Volcano: </p>
			<select name='volcano' id='volcano' class = "dropdown_list">
				<option value=""> ... </option>
			</select>
			<br/><br/>		
		</div>

		<div id = "div_station_network" class = "hidden_field_data field_data" > 
			<p>Please choose station or network:</p>
			<select name = "station_network" id = "station_network" class = "dropdown_list">
				<option value = ''> ... </option>
				<option value = 'station'> Station </option>
				<option value = 'network'> Network </option>
			</select>
			<br/><br/>
		</div>		

		<div id = "div_station" class = "hidden_field_data field_data">
			<p>Please choose a station:</p>
			<select name = "station" id = "station" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>

		<div id = "div_reference_station1" class = "hidden_field_data field_data">
			<p>Reference station:</p>
			<select name = "reference_station1" id = "reference_station1" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>

		<div id = "div_reference_station2" class = "hidden_field_data field_data">
			<p>Reference station 2:</p>
			<select name = "reference_station2" id = "reference_station2" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>

		<div id = "div_network" class = "hidden_field_data field_data">
			<p>Please choose a network:</p>
			<select name = "network" id = "network" class = "dropdown_list">
			</select>			
			<br/><br/>
		</div>
				
		<div id = "div_instrument" class = "hidden_field_data field_data">
			<p> Please choose instrument: </p>
			<select name = "instrument" id = "instrument" class = "dropdown_list">
			</select>						
			<br/><br/>
		</div>

		<div id = "div_result" class = "hidden_field_data field_data">
		</div>

		<div id = "div_process_type" class = "hidden_field_data field_data">
			<p> Please choose Process Type: </p>
			<select name = "process_type" id = "process_type" class = "dropdown_list">
				<option value = "R"> Raw </option>
				<option value = "P"> Processed </option>
			</select>
			<br/><br/>
		</div>

		<div id = "div_counting_interval" class = "hidden_field_data field_data">
			<p> Please choose Interval length:</p>
			<select name = "counting_interval" id = "counting_interval" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>

		<div id = "div_RSAMSSAM_code" class = "hidden_field_data field_data">
			<p> Please enter RSAMSSAM Code here:</p>
			<input id="RSAMSSAM_code" name="RSAMSSAM_code" style = "width: 176px;">
			<br/><br/>
		</div>

		<div id='uploadfile' style="float:left;">
			<div style="padding-left:20px;">
				Browse file to convert:<br/> 
				<input name="file_input" id="file_input" type="file">
				<br/>
				<input type="submit" name="submit" id="submit_button" value="Select">
			</div>
		</div>  
		
	</form>  
</div>

</html>
