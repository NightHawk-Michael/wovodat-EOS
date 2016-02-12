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


?>

<html>
<script src="/js/jquery-1.4.2.min.js"></script>
<script language='javascript' type='text/javascript'>

	$(document).ready(function(){
		var observatory = $("#observatory").val();

		load_volcanoes (observatory);  

		function load_volcanoes(observatory){
			//console.log(observatory);
			$.ajax({
				method:"GET",
				url:"convertie/jma/Common/get_list.php",
				data:"observatory="+observatory + "&type=volcano",
				dataType:"json",
				success:function(result) {
					for (var i = 0; i < result.length; i++) {
						$("#volcano").append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['name']));
					}
				}
			});
		}		

		$("#data_type").change(function() {
			reset_values(['volcano','station','network','result','instrument','uploadfile']);
			var data_type = $("#data_type").val();
			//console.log(data_type);

			if (data_type=="Hypo") {
				if (volcano) {
					$("#network").empty();
					$.ajax({
						method:"GET",
						url:"convertie/jma/Common/get_list.php",
						data:"data_type="+data_type + "&type=network",
						dataType:"json",
						success:function(result) {

							if (result.length == 0) {
								$('#div_result').html('<p><b><i>There is no seismic network available for this volcano. Please create a seismic network first!</i></b></p><br/><br/>');
								turn_on_display('div_result');
								return;
							} else turn_off_display('div_result');

							$("#network").append(new Option("...",""));
							for (var i = 0; i < result.length; i++) {
								$("#network").append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['name']+'$'+ result[i]['code']));
							}
							turn_on_display('div_network');
							console.log(result.length);
						},
					});
				}
				return;	
			}

			if (data_type) 
				turn_on_display('div_volcano');

		});

		$("#volcano").change(function() {
			reset_values(['station','network','result','instrument','uploadfile']);
			var volcano = $("#volcano").val();
			var data_type = $("#data_type").val();

			if (data_type=="Gg" || data_type=="Eo" || data_type=="En") {
				turn_on_display("div_uploadfile");
			}

			if (data_type=="Gt") {
				if (volcano) {
					$("#station").empty();
					$.ajax({
						method:"GET",
						url:"convertie/jma/Common/get_list.php",
						data:"volcano="+volcano + "&data_type="+data_type + "&type=station",
						dataType:"json",
						success:function(result) {

							if (result.length == 0) {
								$('#div_result').html('<p><b><i>There is no station available for this volcano. Please create a station first!</i></b></p><br/><br/>');
								turn_on_display('div_result');
								return;
							} else turn_off_display('div_result');

							$("#station").append(new Option("...",""));
							for (var i = 0; i < result.length; i++) {
								$("#station").append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['name']+'$'+ result[i]['code']));
							}
							turn_on_display('div_station');
						},
					});
				}	
			}

			
		});

		$("#station").change(function() {
			reset_values(['result','instrument','uploadfile']);
			var station = $("#station").val();
			var data_type = $("#data_type").val();
			if (station) {
					$("#instrument").empty();
					$.ajax({
						method:"GET",
						url:"convertie/jma/Common/get_list.php",
						data:"station="+station+ "&data_type="+data_type + "&type=instrument",
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
								sel.append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['name'] + '$'+ result[i]['code']));
							}

							turn_on_display('div_instrument');
						},	
					});
			}
		});

		$("#network").change(function() {
			reset_values( ['result','uploadfile'] );
			var network = $('#network').val();
			if (network) {
				turn_on_display("div_uploadfile");
			}
		});

		$("#instrument").change(function(){
			reset_values(['result','uploadfile']);
			var instrument = $("#instrument").val();
			if (instrument) {
				turn_on_display("div_uploadfile");
			}
		});

		$("#submit_form").submit(function(){
			var data_type = $("#data_type").val();
			var path = 'convertie/jma/' + data_type + '/convert.php';
			$("#submit_form").attr('action', path);
			var file_name = $("#file_input").val();
			if (!file_name) {
				alert("Please choose a file to convert");
				return false;
			}
			return true;
		});


		function reset_values(list) {
			for(var i = 0; i < list.length; i++) {
				$("#" + list[i]).val('');
				turn_off_display('div_' + list[i]);
			}
		}

		function turn_on_display(id) {
			$('#'+id).css('display','block');
		}

		function turn_off_display(id) {
			$('#'+id).css('display','none');
		}
	});

</script>

<div id = 'whole_div'>

	<h2>Conversion of Customary-format Data</h2>
	<p><blockquote>Input: monitoring data, following a specific format which already listed in the WOVOdat </blockquote></p>
	<br/>
	<form name = "submit_form" id = "submit_form" action = "" method = "post" enctype = "multipart/form-data">

		<div class = "field_data">
            <p>Observatory (data owner): </p>
            <select name='owner1' id='observatory' class = "dropdown_list">
            	<option selected="selected" value="JMA">Japan,JMA</option>
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
				<option value = "Eo"> Volcanic Earthquakes And Tremors </option>
				<option value = "En"> Daily Volcanic Earthquakes Counts </option>
				<option value = "Tn"> Daily Volcanic Tremor Counts </option>
				<option value = "Gg"> Ground Deformation: GPS </option>
				<option value = "Gt"> Ground Deformation: Tilt </option>
				<option value = "Ge"> Ground Deformation: EDM </option>
				<option value = "V"> Visual Observation </option>
				<option value = "Hypo"> Earthquake hypocenters </option>
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

		<div id = "div_station" class = "hidden_field_data field_data">
			<p>Please choose a station:</p>
			<select name = "station" id = "station" class = "dropdown_list">
			</select>
			<br/><br/>
		</div>

		<div id="div_network" class = "hidden_field_data field_data">
			<p> Please choose a seismic network:</p>
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

		<div id='div_uploadfile' style="float:left;display:none;">
			<div style="padding-left:20px;">
				Browse file to convert:<br/> 
				<input name="file_input[]" multiple="multiple"  id="file_input" type="file">
				<br/>
				<input type="submit" name="submit" id="submit_button" value="Select">
			</div>
		</div>  

	</form>
</div>