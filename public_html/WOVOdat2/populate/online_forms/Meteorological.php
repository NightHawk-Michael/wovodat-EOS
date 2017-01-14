<html>
<head>
	<script src="/js/jquery-1.4.2.min.js"></script>
	<link rel="stylesheet" href="/js/development-bundle/themes/base/jquery.ui.all.css">	
	<script src="/js/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script language='javascript' type='text/javascript'>
		$(document).ready(function() {
			$("#datepicker").datepicker({dateFormat:'yy-mm-dd'});
			load_volcanoes_list();
			change_fog_spectrum();	
			change_dominant_wind_direction();

			function load_volcanoes_list() {
				$.ajax({
					method:"GET",
					url:"get_volcanoes_list.php",
					data:"observatory=CVGHM",
					dataType:"json",
					success:function(result) {
						for (var i = 0; i < result.length; i++) {
							$("#volcano").append(new Option(result[i]['name'], result[i]['id']));
						}
					}
				});			
			}

			function load_stations_list(volcano) {
				if (!volcano) return;
				$.ajax({
					method:"GET",
					url:"get_stations_list.php",
					data:"data_type=Meteorological" + "&volcano_id="+ volcano,
					dataType:"json",
					success:function(result) {
						var sel = $('#station');
						for(var i = 0; i < result.length; i++) {
							sel.append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['code']));
						}
					}
				});				
			}

			$("#volcano").change(function() {
				$("#station").empty();
				$("#station").append(new Option("Select station", ""));
				load_stations_list($("#volcano").val());
			});

			function change_fog_spectrum() {
				for (var i = 0; i < 24; i++) {
					var box = new $("<td></td>");
					box.attr('id', 'fog' + i);

					var select = $("<select name='fog"+i+"'></select>");
					select.append(new Option("","0"));
					select.append(new Option("01", "1"));
					select.append(new Option("02", "2"));
					select.append(new Option("03", "3"));
					select.css("width","42px");
					box.append(select);
					$("#div_fog_coverage").css({
						'position':'relative',
						'left':'-60px'
					});

					/*box.css({'width':'20px','height':'20px','background-color':'white'});
					box.click(function() {
						var color = $(this).css('background-color');
						//console.debug(color);
						if (color == "rgb(255, 255, 255)") color = 'grey';
						else color = 'white';
						//console.debug('2'+color);
						$(this).css('background-color', color);
					});*/

					$("#fog_spectrum").append(box);
				}	
			}

		    function change_dominant_wind_direction() {
		    	var list = ['06', '12', '18', '24'];
		    	for (var i = 0; i < list.length; i++) {
		    		var sel = $('select[name="' + 'dominant_wind_direction_' + list[i] + '"]');
		    		sel.addClass('dropdown_list');
		    		sel.append(new Option("B (Barat)", "W"));
		    		sel.append(new Option("BL (Baratlaut)", "NW"));
		    		sel.append(new Option("U (Utara)", "N"));
		    		sel.append(new Option("TL (Timurlaut)", "NE"));
		    		sel.append(new Option("T (Timur)", "E"));		    				    				    				    		
					sel.append(new Option("Tg (Tenggara)", "SE"));			    		
					sel.append(new Option("S (Selatan)", "S"));			    		
					sel.append(new Option("Tn (Tenang)", "calm"));			    		
		    	}
		    }

		    function isNumeric(val){
			    return !isNaN(parseFloat(val)) && isFinite(val);
			}

		    function error(name) {
		    	var obj = $('[name="' + name + '"]');
		    	if (!obj.val()) {
		    		if (name == 'volcano' || name == 'station' || name == 'date') return 1;
		    		return 0;
		    	}
		    	if (name == 'station' || name == 'volcano' || name == 'date') return 0;
		    	if (!isNumeric(obj.val())) return 2;
		    	return 0;
		    }

		    function get_error_code() {
		    	if (error('volcano')) return ['Volcano', error('volcano')];
		    	if (error('station')) return ['Station', error('station')];
		    	if (error('date')) return ['Date', error('date')];

		    	if (error('temperature_06')) return ['Temperature 06:00', error('temperature_06')];
		    	if (error('temperature_12')) return ['Temperature 12:00', error('temperature_12')];
		    	if (error('temperature_18')) return ['Temperature 18:00', error('temperature_18')];
		    	if (error('temperature_min')) return ['Temperature Min', error('temperature_min')];
		    	if (error('temperature_max')) return ['Temperature Max', error('temperature_max')];
		    	
		    	if (error('humidity_06')) return ['Humidity 06:00', error('humidity_06')];
		    	if (error('humidity_12')) return ['Humidity 12:00', error('humidity_12')];
		    	if (error('humidity_18')) return ['Humidity 18:00', error('humidity_18')];
		    	
		    	if (error('barometric_pressure_06')) return ['Barometric pressure 06:00', error('barometric_pressure_06')];
		    	if (error('barometric_pressure_12')) return ['Barometric pressure 12:00', error('barometric_pressure_12')];
		    	if (error('barometric_pressure_18')) return ['Barometric pressure 18:00', error('barometric_pressure_18')];
		    	if (error('total_daily_precipitation')) return ['Total daily precipication', error('total_daily_precipitation')];
		    	return '';
		    }


		    function submit (id, data, parent) {
		    	var index = id[0];
		    	$.post("replace_duplicate.php", {info: data[index]},
					  	function(response){
					  		parent.append(response);
					  	});
		    }

		    function display_result(data) {
		    	var title = $('<h2>Uploading Meteorological Data Result:</h2>');

		    	var success_title = $('<h3> List of data successfully uploaded into database: </h3>');
		    	var success = $('<ul></ul>');
		    	for (var i = 0; i < data['success'].length; i++) {
		    		success.append('<li>' + data['success'][i] + '</li>');
		    	}

		    	var duplicate_title = $('<h3> List of data already existed in database: </h3>');
		    	var duplicate = $('<ul></ul>');
		    	for (var i = 0; i < data['waiting'].length; i++) {
		    		var item = $('<li></li>');
		    		item.append(data['waiting'][i]['date'] + '&nbsp;&nbsp;&nbsp;'); 
		    		var replace = $('<a href = "#"> Replace</a>');
		    		replace.attr('id', i + "_replace");
		    		var sql = data['waiting'][i]['sql'];
		    		replace.click(function() {
		    			submit($(this).attr('id'), data['waiting'], $(this).parent());
		    			$(this).remove();
		    		});
		    		item.append(replace);
		    		duplicate.append(item);
		    	}	

		    	var error_title = $('<h3> List of data error found: </h3>');
		    	var error = $('<ul></ul>');
		    	for (var i = 0; i < data['error'].length; i++) {
		    		error.append('<li>' + data['error'][i] + '</li>');
		    	}	

		    	var res = $('<div></div>');
		    	res.append('<br/><br/>');
		    	res.append(title);
		    	res.append('<br/><br/>');
		    	res.append(success_title);
		    	res.append(success);
		    	res.append('<br/><br/>');
		    	res.append(duplicate_title);
		    	res.append(duplicate);
		    	res.append('<br/><br/>');
		    	res.append(error_title);
		    	res.append(error);
		    	res.append('<br/><br/>');

		    	var back = $('<a href = "#"></a>');
		    	back.html('<h3>Go Back!<h3>');
		    	back.click(function() {
		    		location.reload();
		    	});
		    	res.append(back);
		    	res.css('height', '400px');
		    	return res;
		    }

		    $("#submit_form").submit(function() {
		    	$("#result").html('');
		    	var s = get_error_code();
		    	code = ['Field require', 'Wrong format'];
		    	if (s) {
		    		$("#result").html('There is error in ' + s[0] + ': ' + code[s[1] - 1] + '!');
		    		return false;
		    	}
		    	var st = "";
		    	for(var i = 0; i < 24; i++) {
		    		var value = $("[name='fog"+i+"']").val();
		    		st+=value;
		    		console.log(st);
		    	}
		    	$('[name = "fog_coverage"]').val(st);
				var didConfirm = confirm("Are you sure to submit your data?");
				if (didConfirm) {				
					$.post("upload/Meteorological.php",  $("#submit_form").serialize(),
					  	function(data){
					  		$('#main_body').empty();
					  		$('#main_body').append(display_result(data));
					  		$('html, body').animate({ scrollTop: 0 });
					  	},"json"
					);
				}
				return false;
		    });

		});
	</script>
	<style>

		#submit_form td, #result {
			text-align:center;
			font-size: 120%;
			font-weight:bold;
		}

		.align_center {
			margin-left:auto;
			margin-right:auto;
		}

		input {
			width: 175px;
		}

		#result {
			color:red;
		}
	</style>
</head>
<body>
	<div id = "main_body">
	<br/>
	<h2 style = "text-align:center">Upload form for Meteorological data</h2>
	<br/><br/>
	<form name = "submit_form" id = "submit_form">

		<div id = "div_volcano_station_date">
			<table border = "1" class = "align_center">
				<tr>
					<td> Volcano </td>
					<td> Station </td>
					<td> Date </td>
				</tr> 
				<tr>
					<td>
						<select id = "volcano" name = "volcano" class = "dropdown_list">
							<option value = "">Select volcano</option>
						</select>
					</td>
					<td>
						<select id = "station" name = "station" class = "dropdown_list">
							<option value = "">Select station</option>			
						</select>						
					</td>
					<td> 
						<input name="date" id="datepicker" type = "text"></input> 
					</td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div id = "div_temperature" class = "field_data2">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "5"> Temperature (&#176;C):</td>
				</tr>

				<tr>
					<td>06:00</td>
					<td>12:00</td>
					<td>18:00</td>
					<td>Min</td>
					<td>Max</td>
				</tr>

				<tr>
					<td> <input name = "temperature_06"></input></td>
					<td> <input name = "temperature_12"></input></td>
					<td> <input name = "temperature_18"></input></td>
					<td> <input name = "temperature_min"></input></td>
					<td> <input name = "temperature_max"></input></td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div id = "div_humidity">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "3"> Humidity (&#37;):</td>
				</tr>

				<tr>
					<td>06:00</td>
					<td>12:00</td>
					<td>18:00</td>
				</tr>

				<tr>
					<td> <input name = "humidity_06"></input></td>
					<td> <input name = "humidity_12"></input></td>
					<td> <input name = "humidity_18"></input></td>
				</tr>
			</table>			
		</div>
		<br/><br/>
		<div id = "div_barometric_pressure">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "3"> Barometric pressure (mmHg):</td>
				</tr>

				<tr>
					<td>06:00</td>
					<td>12:00</td>
					<td>18:00</td>
				</tr>

				<tr>
					<td> <input name = "barometric_pressure_06"></input></td>
					<td> <input name = "barometric_pressure_12"></input></td>
					<td> <input name = "barometric_pressure_18"></input></td>
				</tr>
			</table>			
		</div>		
		<br/><br/>
		<div id = "div_visual_observation">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "3"> Visual observation:</td>
				</tr>

				<tr>
					<td>06:00</td>
					<td>12:00</td>
					<td>18:00</td>
				</tr>

				<tr>
					<td> 
						<select name = "visual_observation_06" class = "dropdown_list">
							<option value = "Clear"> Clear </option>
							<option value = "Cloudy"> Cloudy </option>
							<option value = "Rain"> Rain </option>
						</select>
					</td>
					<td> 
						<select name = "visual_observation_12" class = "dropdown_list">
							<option value = "Clear"> Clear </option>
							<option value = "Cloudy"> Cloudy </option>
							<option value = "Rain"> Rain </option>
						</select>
					</td>
					<td> 
						<select name = "visual_observation_18" class = "dropdown_list">
							<option value = "Clear"> Clear </option>
							<option value = "Cloudy"> Cloudy </option>
							<option value = "Rain"> Rain </option>
						</select>
					</td>
				</tr>
			</table>			
		</div>
		<br/><br/>
		<div id = "div_dominant_wind_direction">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "4"> Domminant wind direction:</td>
				</tr>

				<tr>
					<td>06:00</td>
					<td>12:00</td>
					<td>18:00</td>
					<td>24:00</td>
				</tr>

				<tr>
					<td> 
						<select name = "dominant_wind_direction_06">
						</select>
					</td>
					<td> 
						<select name = "dominant_wind_direction_12">
						</select>
					</td>
					<td> 
						<select name = "dominant_wind_direction_18">
						</select>
					</td>
					<td> 
						<select name = "dominant_wind_direction_24">
						</select>
					</td>
				</tr>
			</table>						
		</div>
		<br/><br/>
		<div id = "div_fog_coverage">
			<table border = "1" class = "align_center">
				<tr>
					<td colspan = "24">Fog Coverage</td>
				</tr>
				<tr>
					<td colspan = "6">00:00-06:00</td>
					<td colspan = "6">06:00-12:00</td>
					<td colspan = "6">12:00-18:00</td>
					<td colspan = "6">18:00-24:00</td>
				</tr>
				<tr id = "fog_spectrum"></tr>
			</table>
			<input name = "fog_coverage" type = "hidden"></input>
		</div>
		<br/><br/>

		<div id = "div_precipitation">
			<table border = "1" class = "align_center">
				<tr>
					<td>
						Observed precipitation period
					</td>
					<td>
						Total daily precipitation (mm)
					</td>
				</tr>
				<tr>
					<td>
						<input name = "observed_precipitation_period"> </input>
					</td>
					<td>
						<input name = "total_daily_precipitation"> </input>
					</td>
				</tr>
			</table>
		</div>
		<br/><br/>

		<div id = "div_comments">
			<table border = 1 class = "align_center">
				<tr>
					<td>
						Remarks/Comments
					</td>
				</tr>
				<tr>
					<td>
						<input name = "comments" style = "width: 300px" maxlength = "50"> </input>
					</td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div id = "result"> </div>
		<br/><br/>
		<div class = "align_center" style = "width:170px;"><input type = "submit"> </input></div>
	</form>  
	</div>
</body>	
<html>