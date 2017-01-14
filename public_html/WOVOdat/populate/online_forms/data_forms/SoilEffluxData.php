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
	
	function with_gas_conc(selected){
	var values = Array();
	var len = selected.length;	
	for (ih=1;ih<len;ih++){
	   var sel = selected.eq(ih);
	   if(sel.find('input').eq(0).val()!=""){
			values.push(new Array(
				sel.find('input').eq(0).val(),
				sel.find('input').eq(1).val(),
				sel.find('input').eq(2).val(),
				sel.find('input').eq(3).val(),
				sel.find('input').eq(4).val(),
				sel.find('input').eq(5).val(),
				sel.find('td input[type=checkbox]:checked').val(),
				sel.find('input[type=text]').eq(6).val(),
				sel.find('td').eq(0).html().replace("<sub>","").replace("</sub>","").replace("<sup>","").replace("</sup>","")
			));
	   }
	}
	return values;	
	}
	
	$(function(){
	
	var volcanos = $('volcano select');
	var stations = $('station select');
	var instruments = $('instrument select');
	
	$('#data_happen').hide();
	volcanos.prepend("<option>Select Volcano</option>");
	volcanos.val("Select Volcano");
	volcanos.change(function(){
		$.post('helpers/gs_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
		});
	});
	
	stations.change(function(){
		$.post('helpers/gs_instruments.php',{gs_code : stations.val()},function(data){
			instruments.html(data);
		});
	});
		
	var table_tr = $('#gas_conc tr');	
	var com = $('comments input');
	var sel = $('comments select');	
	var stime = $('sampling_time input');

    sel.eq(0).prepend("<option>Select Observatory</option>");
	sel.eq(0).val("Select Observatory");
	sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(2).val("-1");
	
	$('#Confirm').click(
		function(){
			var gas_with_conc = with_gas_conc(table_tr);
			var len_gwc = gas_with_conc.length;			
			for (var ih=0; ih<len_gwc;ih++){				
					$.post('helpers/process_gd_sol_data.php',{
						vd_cavw             	 : stations.find('option:selected').attr('vd_cavw'),
						gs_code                  : stations.val(),
						gs_id               	 : stations.find('option:selected').attr('gs_id'),
						gi_id     			 	 : instruments.find('option:selected').attr('gi_id'),
						gd_sol_time  			 : stime.eq(0).val()+" "+stime.eq(1).val(),
						gd_sol_species			 : gas_with_conc[ih][8],
						gd_sol_tflux         	 : gas_with_conc[ih][0],
						gd_sol_flux_err		     : gas_with_conc[ih][1],
						gd_sol_pts	             : gas_with_conc[ih][2],
						gd_sol_area              : gas_with_conc[ih][3],				
						gd_sol_high				 : gas_with_conc[ih][4],
						gd_sol_htemp			 : gas_with_conc[ih][5],
						gd_sol_units             : gas_with_conc[ih][7],
						gd_sol_ori               : gas_with_conc[ih][6],
						gd_sol_com               : gas_with_conc[ih][1],
						cc_id2 		  	         : sel.eq(0).find('option:selected').attr('my_id'),
						cc_id3 			         : sel.eq(1).find('option:selected').attr('my_id'),		
						gd_sol_pubdate           : pub_date($('#pub_date').val()),
						cb_ids                   : sel.eq(2).val().toString()
					},function(data){
						$('#data_happen').append(data);
						$('#data_happen').show();
					});
			}
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
		#gas_conc th, #gas_conc tr{
			text-align:center;
		}
		#gas_conc {
			width: 950px;		
			align :left;
		}
		#gas_conc input {
			width: 110px;		
			height: 25px;			
		}
		#gas_conc input[type="checkbox"] {
			width: 18px;
			height: 18px;
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
<h3 align='center' class='text-success'>INPUT FORM FOR SOIL EFFLUX</h3><br/><br/>
<div class="gd container">
		<volcano class="col-sm-2 text_center">
			<label>Volcano:</label><br/>
			<?php 
				create_dropdown_from_column_data("vd","vd_name"); 
			?> 
		</volcano>
		<station class="col-sm-2 text_center">
			<label>Station:</label><br/>
			<select><option>Select Station</option></select>
		</station>
		<instrument class="col-sm-2 text_center">
			<label>Instrument:</label><br/>
			<select><option>Select Instrument</option></select>
		</instrument>
		<sampling_time class="col-sm-4 text_center">
			<label><sup>*</sup>Sampling/measurement time:</label><br/>
			<input type="text" placeholder="YYYY-MM-DD" id="datepicker1">
			<input type="text" placeholder="HH:MM:SS">
		</sampling_time>
		<br/><br/><br/><br/>
		<h4 class='text-success'>Gas flux:</h4><br/>
		<gas_concentrations class="col-sm-12">
			<table class="table-hover table-condensed" id="gas_conc">   
				<tr>
					<th>Gas<br/>species:</th>
					<th>Total<br/>flux:</th>
					<th>Flux<br/>uncertainty:</th>
					<th>Number of<br/>measurement<br/>points:</th>
					<th>Measured<br/>area(m<sup>2</sup>)</th>
					<th>Highest<br/>flux</th>
					<th>Highest<br/>temperature(<sup>o</sup>C)</th>
					<th>Source of<br/>Data<br/>D=Digitized<br/>O=Original</th>
					<th>Measured<br/>Unit</th>
				</tr>
				<tr>
				     <td>SO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>CO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>H<sub>2</sub>S</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>HCL</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>HF</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>CO</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>H<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>N<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>NH<sub>3</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>CH<sub>4</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>Ar</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td><sup>3</sup>He<sup>4</sup>He</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>d<sup>13</sup>C</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>d<sup>18</sup>O</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td>dD</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
				<tr>
				     <td><sup>222</sup>Rn</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>					 
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td >
					 <td><input type="text" placeholder="t/d, g/m^2/d, etc."></td>
				</tr>
			</table>
			<br/><br/>
		</gas_concentrations>
		<h4 class='text-success'>Comments:</h4><br/>
		<comments class="col-sm-12" id="com">
			<label>General comments</label>:&nbsp <input type="text" placeholder="Max255 characters"><br/>
			<?php $rs = query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code REGEXP '[a-zA-Z]' ORDER BY cc_obs"); ?>
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