<!DOCTYPE html> 
<html>
<?php 
if (!isset($_SESSION)) {
    session_start();
}
include('helpers/my_nice_php_function.php');

?>
<head>
	<script src="/js/jquery-1.4.2.min.js"></script>
	<script src="/js/jquery.js"></script>
	<link rel="stylesheet" href="/js/development-bundle/themes/base/jquery.ui.all.css">	
	<link rel="stylesheet" href="helpers/bootstrap.min.css">
	<script src="/js/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script language='javascript' type='text/javascript'>
	
	$.fn.wru = function(color) {
		color = color || '#d6393d';
		console.log( this );
		return this.css('outline', '2px solid ' + color);
	};	
	
	function space(Number){
	var space = "";
		for (io=0;io<Number;io++){
			space = space + "&nbsp";
		}
	return space;
	}
	
	function date_now(){
		var d = new Date();
        var now = d.getUTCFullYear()+"-"+parseFloat(d.getUTCMonth()+1)+"-"+d.getUTCDate();
		return now;
	}
	
	function year(){
		var d = new Date();
        var now = d.getUTCFullYear();
		return now;
	}
	
	function time_now(){
		var d = new Date();
		var now = d.getUTCHours()+":"+d.getUTCMinutes()+":"+d.getUTCSeconds(); 
		return now;
	}
	
	function pub_date(pub_date){
		if(pub_date==""){
			var d = new Date();
			var now = parseFloat(d.getUTCFullYear())+2+"-"+parseFloat(d.getUTCMonth()+1)+"-"+d.getUTCDate()+" "+time_now();
			return now;
		}
		else {
			return pub_date;
		}
	}
	
	function array_sort(data){
		data.sort(
			function SortByName(a, b){
				if(a[1] == b[1]){
					if(a[2] < b[2]) return -1;
					if(a[2] > b[2]) return 1;
					return 0;
				}
				else {
					if(a[1] < b[1]) return -1;
					if(a[1] > b[1]) return 1;
					return 0;
				}
			}
		)
		return data;
	}
		
	$(function(){
		
	function with_measurement(selected){
	var values = [];
	var len = selected.length;	
	for (ih=0;ih<len;ih++){
	   var sel = selected.eq(ih);
	   if(sel.eq(0).val()!=""){
			values.push(new Array(
				properties[ih],
				stations.eq(ih).val(),
				instruments.eq(ih).val(),
				measurements.eq(ih).val(),
				measurement_unc.eq(ih).val(),
				remarks.eq(ih).val(),
				stations.eq(ih).find('option:selected').attr('ms_id'),
				instruments.eq(ih).find('option:selected').attr('mi_id')
			));
	   }
	}
	return values;	
	}
	
	function distinct_column(column,k){
		var col = [];
		var len = column.length;
		for(ih=0;ih<len;ih++){
			var len2 = col.length;
			var check=false;
			for (ij=0;ij<len2;ij++){
				if(column[ih][k]==col[ij]){
					check = true;
				}
			}
			if(check==false){
				col.push(column[ih][k]);
			}
		}
		return col;
	}
	
	function distinct_column2(column,k,l){		
		var col = [];
		var len1 = column.length;
		for(ih=0;ih<len1;ih++){
			var len2 = col.length;
			var check=false;						
			for (ij=0;ij<len2;ij++){
				if(column[ih][k]==col[ij][0] && column[ih][l]==col[ij][1]){
					check = true;
				}
			}
			if(check==false){
				col.push(new Array(column[ih][k],column[ih][l]));
			}
		}
		return col;
	}
	
	var properties = [  "air_temperature",
						"soil_temperature",
						"barometric_pressure",
						"daily_precipitation",
						"humidity",
						"wind_speed",
						"minimum_wind_speed",
						"maximum_wind_speed",
						"wind_direction",
						"cloud_coverage"];

	var table_tr = $('#meteo_obs tr');
	var volcanos = $('volcano select');
	var stations = table_tr.find('td:nth-child(2)').find('select');
	var instruments = table_tr.find('td:nth-child(3)').find('select');
	var measurements = table_tr.find('td:nth-child(4)').find('input'); 
	var measurement_unc = table_tr.find('td:nth-child(5)').find('input'); 
	var remarks = table_tr.find('td:nth-child(6)').find('input[type=radio]'); 
	var ppt_type = table_tr.find('td:nth-child(6)').find('select');

	$('#data_happen').hide();
	volcanos.prepend("<option>Select Volcano</option>");
	volcanos.val("Select Volcano");
	volcanos.change(function(){
		$.post('helpers/ms_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
		});
	});
	
	stations.change(function(){
		var index = stations.index($(this));
		$.post('helpers/ms_instruments.php',{ms_code : $(this).val()},function(data){
			instruments.eq(index).html(data);
		});
	});
		
	var com = $('comments input');
	var sel = $('comments select');	
	var stime = $('observation_time input');
    sel.eq(0).prepend("<option>Select Observatory</option>");
	sel.eq(0).val("Select Observatory");
	sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(2).val("-1");
	
	$('#Confirm').click(
		function(){
			var data_values = with_measurement(measurements);
			len_data = data_values.length;		
			var codes = distinct_column2(data_values,1,2);
			len_codes = codes.length;
			for(ij=0;ij<len_codes;ij++){
				var post = {};
				post["med_station"] = codes[ij][0];
				post["med_instrument"] = codes[ij][1];
				for(ig=0;ig<len_data;ig++){
					if (codes[ij][0]==data_values[ig][1] && codes[ij][1]==data_values[ig][2]){
						post[data_values[ig][0]] = data_values[ig][3];
						post[data_values[ig][0]+"_inc"] = data_values[ig][4];
						post["med_ori"] = data_values[ig][5];
						post["ms_id"] = data_values[ig][6];
						post["mi_id"] = data_values[ig][7];
						if(data_values[ig][0]=="daily_precipitation"){
							post["type_of_precipitation"] = ppt_type.val();
						}
					}
				}
				post["vd_cavw"] = stations.find('option:selected').attr('vd_cavw');
				post["med_time"] = stime.eq(0).val()+" "+stime.eq(1).val();
				post["med_com"] = $('meteorological_parameters #com').val();
				post["cc_id2"] = sel.eq(0).find('option:selected').attr('my_id');
				post["cc_id3"] = sel.eq(1).find('option:selected').attr('my_id');
				post["med_pubdate"] =  pub_date($('#pub_date').val());
				post["cb_ids"] = sel.eq(2).val().toString();
				$.post("helpers/process_med_data.php",post,function(data){
					$('#data_happen').append(data);					
				});
			}
			
			
			var visual_obs = $('visual_observation');
			var len_vobs = visual_obs.length;
			for(it=0;it<len_vobs;it++){
				var current_vobs = visual_obs.eq(it).find('input, textarea');
				if(current_vobs.eq(0).val()!=""){
					$.post('helpers/process_co_data.php',{
						vobs_num   : parseFloat(it+1),
						vd_cavw    : volcanos.find('option:selected').attr('my_id2'),
						vd_id      : volcanos.find('option:selected').attr('my_id'),
						stime_vobs : current_vobs.eq(0).val(),
						etime_vobs : current_vobs.eq(1).val(),
						descr_vobs : current_vobs.eq(2).val(),
						measu_vobs : current_vobs.eq(3).val(),
						units_vobs : current_vobs.eq(4).val(),
						comme_vobs : current_vobs.eq(5).val(),
						cc_id2     : sel.eq(0).find('option:selected').attr('my_id'),
						cc_id3     : sel.eq(1).find('option:selected').attr('my_id'),
						co_pubdate : pub_date($('#pub_date').val()),
						cb_ids     : sel.eq(2).val().toString()
					},
					function(data){
						$('#data_happen').append(data);
					});
				}
			}
			
			var alert_lev = $('alert_level');
			var len_lev = alert_lev.length;
			for(iy=0;iy<len_lev;iy++){
				var current_lev = alert_lev.eq(iy).find('input');
				if(current_lev.eq(0).val()!=""){
					$.post('helpers/process_ed_for_data.php',{
						aobs_num     	 : parseFloat(iy+1),
						vd_cavw      	 : volcanos.find('option:selected').attr('my_id2'),
						vd_id        	 : volcanos.find('option:selected').attr('my_id'),						
						ed_for_desc  	 : current_lev.eq(1).val(),
						ed_for_astime    : stime.eq(0).val()+" "+stime.eq(1).val(),
						ed_for_alevel    : current_lev.eq(0).val(),
						ed_for_com       : current_lev.eq(2).val(),
						cc_id2      	 : sel.eq(0).find('option:selected').attr('my_id'),
						cc_id3      	 : sel.eq(1).find('option:selected').attr('my_id'),
						ed_for_pubdate   : pub_date($('#pub_date').val()),
						cb_ids      	 : sel.eq(2).val().toString()
					},function(data){
						$('#data_happen').append(data);
					});
				}
			}
			
			$('#data_happen').show();
		}
	)
	
	$('#add_observe').click(function(){
		$('visual_observation').last().after("<br/><visual_observation>"+$('visual_observation').eq(0).html()+"</visual_observation>");
	});
	
	$('#add_alert').click(function(){
		$('alert_level').last().after("<br/><br/><alert_level>"+$('alert_level').eq(0).html()+"</alert_level>");;
	});
	
	$('#Back').click(function(){
		window.location="http://www.wovodat.org/populate/home_populate.php?back_to_previous=yes";
	});
	
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange:  parseFloat(year()-500)+":"+parseFloat(year()+100)
	});
   $( "#datepicker1" ).datepicker().val();
   $( "#pub_date" ).datepicker().val(); 
	
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
		.text_center {
			text-align:center;
		}
		input {
			width: 150px;
			height: 25px;
		}
		input[type="submit"] {
			width: 100px;
		}
		#result {
			color:red;
		}
		div.insertan {
			max-width:520px;
			text-align:center;
		}
		select {
			width: 150px;
			height: 25px;
		}
		pre {
			display: inline-block;
		}
		remarks input {
			width: 500px;
			margin-left:auto;
			margin-right:auto;
		}
		#meteo_obs th, #meteo_obs tr{
			text-align:center;
		}
		#meteo_obs {
			width: 950px;		
			align :left;
		}
		#meteo_obs input {
			width: 170px;		
			height: 25px;			
		}
		#meteo_obs input[type="radio"] {
			width: 18px;
			height: 18px;
		}
		visual_observation input {
			width: 200px;
		}
		alert_level input{
			width: 550px;
		}
		visual_observation label, alert_level label{
			width: 250px;
		}
		visual_observation textarea{
			width: 550px;
			height: 27px;
			resize: none;
		}
		#com label{
			width: 250px;
		}
		#com input{
			width: 600px;
		}
		#data_happen{
			width: 600px;
			min-height: 200px;
		}
		#com select{
			min-width: 250px;
		}
	</style>
</head>
<body>
<h3 align='center' class='text-success'>DAILY VOLCANO OBSERVATION DATA</h3><br/><br/>
<div class="gd container">
		<div id="centerer" style="width:700px;margin:auto">
		<volcano class="col-sm-3 text_center">
			<label><sup>*</sup>Volcano:</label><br/>
			<?php 
				create_dropdown_from_rows(query_mysql("SELECT vd_name, vd_id, vd_cavw FROM vd ORDER BY vd_name")); 
			?> 
		</volcano>
		<observation_time class="col-sm-7 text_center">
			<label><sup>*</sup>Todays date:</label><br/>
			<input type="text" placeholder="YYYY-MM-DD" id="datepicker1">
			<input type="text" placeholder="HH:MM:SS">
		</observation_time>
		</div>
		<br/><br/><br/><br/>
		<h4 class='text-success'>METEOROLOGICAL PARAMETERS</h4><br/>
		<meteorological_parameters class="col-sm-12">
			<table class="table table-hover table-condensed" id="meteo_obs">   
				<tr>
					<th><br/>Measurement<br/>type</th>
					<th><br/>Station</th>
					<th><br/>Instrument</th>
					<th><br/>Measurement</th>
					<th><br/>Measurement<br/>uncertainty</th>					
					<th>Remarks<br/>Source of data<br>D=digitized O=original</th>
				</tr>		
				<tr>
					<td>Air temperature (<sup>o</sup>C)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori1" value="D"/>D<input type="radio" name="ori1" value="O"/>O</td>
				</tr>
				<tr>
					<td>Soil temperature (<sup>o</sup>C)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori2" value="D"/>D<input type="radio" name="ori2" value="O"/>O</td>
				</tr>
				<tr>
					<td>Barometric pressure (mbar)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori3" value="D"/>D<input type="radio" name="ori3" value="O"/>O</td>
				</tr>					
				<tr>
					<td>Daily precipitation (mm)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td>
						<select style="width:70px">
							<option>Type</option>
							<option value="R">Rain</option>
							<option value="FR">Freezing Rain</option>
							<option value="S">Snow</option>
							<option value="H">Hail</option>
							<option value="R-FR">Rain-Freezing Rain</option>
							<option value="R-S">Rain-Snow</option>
							<option value="R-H">Rain-Hail</option>
							<option value="F">Freezing</option>
						</select><br/>
						<input type="radio" name="ori4" value="D"/>D<input type="radio" name="ori4" value="O"/>O
					</td>
				</tr>	
				<tr>
					<td>Humidity (%)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori5" value="D"/>D<input type="radio" name="ori5" value="O"/>O</td>
				</tr>	
				<tr>
					<td>Wind speed (m/s)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori6" value="D"/>D<input type="radio" name="ori6" value="O"/>O</td>
				</tr>
				<tr>
					<td>Minimum wind speed (m/s)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori7" value="D"/>D<input type="radio" name="ori7" value="O"/>O</td>
				</tr>
				<tr>
					<td>Maximum wind speed (m/s)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori8" value="D"/>D<input type="radio" name="ori8" value="O"/>O</td>
				</tr>
				<tr>
					<td>Wind direction</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori9" value="D"/>D<input type="radio" name="ori9" value="O"/>O</td>
				</tr>	
				<tr>
					<td>Cloud coverage (%)</td>
					<td><select><option>Select Station</option></select></td>
					<td><select><option>Select Instrument</option></select></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>
					<td><input type="text" placeholder="XXXX.XX"/></td>					
					<td><input type="radio" name="ori10" value="D"/>D<input type="radio" name="ori10" value="O"/>O</td>
				</tr>					
			</table>
			<label>General Comments</label><b>:</b>&nbsp <input id="com" style="width:500px" type="text" placeholder="maximum 255 characters" />
			<br/><br/>
		</meteorological_parameters><br/>		
		<h4 class='text-success'>VISUAL OBSERVATION (VOLCANIC ACTIVITY)</h4>
		<br/>
		<visual_observation>
			<label>Start time of observed activity</label><b>:</b>&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" /><br/>
			<label>End time of observed activity</label><b>:</b>&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" /><br/>
			<label>Description of activity</label><b>:</b>&nbsp <textarea placeholder="Pyroclastic flow, lava flow, dome extrusion, explosion, plume, incandescence, rock fall, lahar, etc." /></textarea><br/>
			<label>Measured value</label><b>:</b>&nbsp <input type="text" placeholder="XXXX.XXX" /><br/>
			<label>Unit</label><b>:</b>&nbsp <input type="text" placeholder="km, m, etc." /><br/>
			<label>General comments</label><b>:</b>&nbsp <input style="width:550px" type="text" placeholder="Maximum 255 characters" /><br/>
		</visual_observation>
		<br/>
		<input id="add_observe" style="width:150px" type="submit" value="Add observed activity" />
		<br/><br/><br/>
		<h4 class='text-success'>ALERT LEVEL</h4><br/>
		<alert_level>
			<label>Alert level</label><b>:</b>&nbsp <input type="text" placeholder="maximum 255 characters" /><br/>
			<label>Description/recommendation</label><b>:</b>&nbsp <input type="text" placeholder="maximum 255 characters" /><br/>
			<label>General Comments</label><b>:</b>&nbsp <input type="text" placeholder="maximum 255 characters" />
		</alert_level>
		<br/><br/>
		<input id="add_alert" style="width:150px" type="submit" value="Add alert level" />
		<br/><br/>
		<h4 class='text-success'>Comments:</h4><br/>
		<comments id="com">
			<?php $rs = query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code REGEXP '[a-zA-Z]' ORDER BY cc_obs"); ?>
			<label>Second Institution/Observatory</label><b>:</b>&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Third Institution/Observatory </label><b>:</b>&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Publish Date</label><b>:</b>&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" id="pub_date" style="width:150px;height:25px;"><br/>
			<label>Bibliography</label><b>:</b>&nbsp <?php create_multiselect_from_rows(query_mysql("SELECT cb_id, cb_auth, cb_year, cb_title FROM cb ORDER by cb_auth")); ?> 
			<br/><br/>
		</comments>		
		 <button type="button" id="Back">Back to previous page</button>  <button type="button" id="Confirm">Confirm</button> 
		 <br/>
		 <br/>
		 <textarea id="data_happen"></textarea>
</div>
</body>	
</html>

<?php
/*
var data = $('#myForm').serializeArray();
data.push({name: 'wordlist', value: wordlist});

$.post("page.php", data);
*/
?>