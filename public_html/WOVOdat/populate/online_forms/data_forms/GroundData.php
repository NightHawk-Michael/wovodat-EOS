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
	
	function concatenate_input_array(inputs){
		var value = "";
		var len = inputs.length;	
		for (ih=0;ih<len;ih++){
			value = value + inputs.eq(ih).val();
		}
		return value;
	}
	
	$(function(){
	
	var volcanos = $('volcano select');
	var stations = $('station select');
	var instruments = $('instrument select');

	$('#data_happen').hide();
	volcanos.prepend("<option>Select Volcano</option>");
	volcanos.val("Select Volcano");
	volcanos.change(function(){
		$.post('helpers/ts_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
		});
	});
	
	stations.change(function(){
		$.post('helpers/ts_instruments.php',{ts_code : stations.val()},function(data){
			instruments.html(data);
		});
	});
		
	var com = $('comments input');
	var sel = $('comments select');	
	var stime = $('sampling_time input');
	var measurement_type = $('table tr td:nth-child(2)').find('input');
	var measurement_value = $('table tr td:nth-child(3)').find('input');
	var uncertainty = $('table tr td:nth-child(4)').find('input');
	var recalculated = $('table tr td:nth-child(5), table tr th:eq(4)');
	var source = $('table tr td:nth-child(6), table tr th:eq(5)');
	var checkboxes = $('table tr td:nth-child(2)').find('input[type=radio]:checked');
	
	//com.wru();
	//sel.wru()
	//stime.wru(); 
	//measurement_type.wru();
	//measurement_value.wru();
	//uncertainty.wru();
	recalculated.hide();
	source.hide();
	checkboxes.wru();

	
    sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option>Select Observatory</option>");
	sel.eq(2).val("Select Observatory");
	sel.eq(3).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(3).val("-1");
	
	$('#Confirm').click(
		function(){	
			$.post('helpers/process_td_data.php',{
				vd_cavw             	 : stations.find('option:selected').attr('vd_cavw'),
				ts_code                  : stations.val(),
				ts_id               	 : stations.find('option:selected').attr('ts_id'),
				ti_id     			 	 : instruments.find('option:selected').attr('ti_id'),
				td_mtype				 : concatenate_input_array(measurement_type),
				td_time					 : stime.eq(0).val()+" "+stime.eq(1).val(),
				td_depth				 : measurement_value.eq(1).val(),
				td_distance			     : measurement_value.eq(2).val(),
				td_calc_flag			 : checkboxes.eq(0).val(),
				td_temp					 : measurement_value.eq(0).val(),
				td_terr					 : uncertainty.eq(0).val(),
				td_aarea				 : measurement_value.eq(3).val(),
				td_flux					 : measurement_value.eq(4).val(),
				td_ferr					 : uncertainty.eq(4).val(),
				td_bkgg					 : measurement_value.eq(5).val(),
				td_tcond				 : measurement_value.eq(6).val(),
				td_ori      			 : sel.eq(0).find('option:selected').val(),
				td_com                   : com.eq(0).val(),
				cc_id2 		  	         : sel.eq(1).find('option:selected').attr('my_id'),
				cc_id3 			         : sel.eq(2).find('option:selected').attr('my_id'),		
				td_pubdate               : pub_date($('#pub_date').val()),
				cb_ids                   : sel.eq(3).val().toString()
			},function(data){
				$('#data_happen').append(data);
				$('#data_happen').show();
			});			
		}
	)
	
	$('#Back').click(function(){
		window.location="http://www.wovodat.org/populate/home_populate.php";
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
		measurement_type input{
			width: 370px;
		}
		.vertical label {
			width: 300px;
		}
		.vertical input {
			input: 350px;
		}
		input {
			width: 150px;
			height: 25px;
		}
		input[type="submit"] {
			width: 100px;
		}
		input[type="radio"] {
			width: 25px;
			height: 15px;
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
		table#data_table {
			position: relative;
			left: 100px;
		}
	</style>
</head>
<body>
<h3 class='text-success text_center'>INPUT FORM FOR GROUND-BASED THERMAL DATA</h3><br/><br/>
<div class="gd container">
		<volcano class="col-sm-2 text_center">
			<label><sup>*</sup>Volcano:</label><br/>
			<?php 
				create_dropdown_from_column_data("vd","vd_name"); 
			?> 
		</volcano>
		<station class="col-sm-2 text_center">
			<label><sup>*</sup>Station:</label><br/>
			<select><option>Select Station</option></select>
		</station>
		<instrument class="col-sm-2 text_center">
			<label><sup>*</sup>Instrument:</label><br/>
			<select><option>Select Instrument</option></select>
		</instrument>
		<sampling_time class="col-sm-4 text_center">
			<label><sup>*</sup>Sampling/measurement time:</label><br/>
			<input type="text" placeholder="YYYY-MM-DD" id="datepicker1">
			<input type="text" placeholder="HH:MM:SS">
		</sampling_time>
		<br/><br/><br/><br/><br/>
		<div class="vertical">
		<table class="table-bordered table-condensed text_center" id="data_table">
			<tr>
				<th>Type of Data</th>
				<th>Measurement type</th>
				<th>Measurement value</th>
				<th>Uncertainty</th>
				<th>Recalculated</th>
				<th>Source of Data</th>
			</tr>
			<tr>
				<td>Temperature(<sup>o</sup>C)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori" value="R"/>Yes<input type="radio" name="ori" value="O"/>No</td>
				<td><input type="radio" name="origi" value="D"/>D<input type="radio" name="origi" value="O"/>O</td>
			</tr>
			<tr>
				<td>Depth of measurement(m)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori1" value="R"/>Yes<input type="radio" name="ori1" value="O"/>No</td>
				<td><input type="radio" name="origi1" value="D"/>D<input type="radio" name="origi1" value="O"/>O</td>
			</tr>
			<tr>
				<td>Distance from source(m)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori2" value="R"/>Yes<input type="radio" name="ori2" value="O"/>No</td>
				<td><input type="radio" name="origi2" value="D"/>D<input type="radio" name="origi2" value="O"/>O</td>
			</tr>	
			<tr>
				<td>Area measured(m<sup>2</sup>)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori3" value="R"/>Yes<input type="radio" name="ori3" value="O"/>No</td>
				<td><input type="radio" name="origi3" value="D"/>D<input type="radio" name="origi3" value="O"/>O</td>
			</tr>			
			<tr>
				<td>Heat flux (W/m<sup>2</sup>)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori4" value="R"/>Yes<input type="radio" name="ori4" value="O"/>No</td>
				<td><input type="radio" name="origi4" value="D"/>D<input type="radio" name="origi4" value="O"/>O</td>
			</tr>	
			<tr>
				<td>Background geothermal gradient(<sup>o</sup>C/km)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori5" value="R"/>Yes<input type="radio" name="ori5" value="O"/>No</td>
				<td><input type="radio" name="origi5" value="D"/>D<input type="radio" name="origi5" value="O"/>O</td>
			</tr>	
			<tr>
				<td>Thermal conductivity W/(m<sup>2</sup>.<sup>o</sup>C)</td>
				<td><input type="text" placeholder="max 255 characters"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="text" placeholder="XXX.XX"/></td>
				<td><input type="radio" name="ori6" value="R"/>Yes<input type="radio" name="ori6" value="O"/>No</td>
				<td><input type="radio" name="origi6" value="D"/>D<input type="radio" name="origi6" value="O"/>O</td>
			</tr>
			<tr>
				<td>Recalculated ?</td>
				<td><input type="radio" name="ori6" value="R"/>Yes<input type="radio" name="ori6" value="O"/>No</td>
			</tr>		
		</table>
		</div>
		<br/><br/>
		<h4 class='text-success'>Comments:</h4><br/>
		<comments class="col-sm-12" id="com">
			<label>General comments</label>:&nbsp <input type="text" placeholder="Max255 characters"><br/>
			<?php $rs = query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code REGEXP '[a-zA-Z]' ORDER BY cc_obs"); ?>
			<label><sup>*</sup>Source of data</label>:&nbsp <select><option>Select the source of data</option><option value="D">Digitized/Bibliography</option><option value="O">Original from Observatory</option></select><br/>
			<label>Second Institution/Observatory</label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Third Institution/Observatory </label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Publish Date</label>:&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" id="pub_date" style="width:150px;height:25px;"><br/>
			<label>Bibliography</label>:&nbsp <?php create_multiselect_from_rows(query_mysql("SELECT cb_id, cb_auth, cb_year, cb_title FROM cb ORDER by cb_auth")); ?> 
			<br/><br/>
		</comments>		
		 &nbsp&nbsp&nbsp <button type="button" id="Back">Back to previous page</button>  <button type="button" id="Confirm">Confirm</button> 
		 <br/>
		 <br/>
		 <textarea id="data_happen"></textarea>
</div>
</body>	
</html>
