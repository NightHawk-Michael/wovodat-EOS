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
	
	$(function(){
	
	var volcanos = $('volcano select');
	var stations = $('station select');
	var pair_stations = $('pair_station select');
	var ref_stations = $('reference_station select');
	var instruments = $('instrument select');

	$('#data_happen').hide();
	volcanos.prepend("<option>Select Volcano</option>");
	volcanos.val("Select Volcano");
	volcanos.change(function(){
		$.post('helpers/ds_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
			pair_stations.html(data);
			ref_stations.html(data);
		});
	});
	
	stations.change(function(){
		$.post('helpers/di_gen_instruments.php',{ds_code : stations.val()},function(data){
			instruments.html(data);
		});
	});
		
	var table_tr = $('.vertical table').eq(0).find('tr');	
	var table_tr1 = $('.vertical table').eq(1).find('tr');
	var lat = table_tr.eq(1).find('td input');
	var lon = table_tr.eq(2).find('td input');
	var elev = table_tr.eq(3).find('td input');
	var slop = table_tr1.eq(0).find('td input');
	var com = $('comments input');
	var sel = $('comments select');	
	var stime = $('sampling_time input');

	//lat.wru();
	//lon.wru();
	//elev.wru();
	//slop.wru();
	//com.wru();
	//sel.wru()
	//stime.wru();
    //$('#Confirm').wru();
	
    sel.eq(0).prepend("<option>Select Observatory</option>");
	sel.eq(0).val("Select Observatory");
	sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(2).val("-1");
	
	$('#Confirm').click(
		function(){
			if(lat.eq(0).val()!=""){	
				$.post('helpers/process_dd_gps_data.php',{
					type					 : 'POSITION',
					vd_cavw             	 : stations.find('option:selected').attr('vd_cavw'),
					ds_code                  : stations.val(),
					di_gen_id        	 	 : instruments.find('option:selected').attr('di_gen_id'),
					ds_id               	 : stations.find('option:selected').attr('ds_id'),
					ds_id_ref1				 : pair_stations.find('option:selected').attr('ds_id'),
					ds_id_ref2				 : ref_stations.find('option:selected').attr('ds_id'),
					dd_gps_time  			 : stime.eq(0).val()+" "+stime.eq(1).val(),
					dd_gps_lat				 : lat.eq(0).val(),
					dd_gps_lon				 : lon.eq(0).val(),
					dd_gps_elev				 : elev.eq(0).val(),
					dd_gps_nserr			 : lat.eq(1).val(),
					dd_gps_ewerr			 : lon.eq(1).val(),
					dd_gps_verr				 : elev.eq(1).val(),
					dd_gps_software			 : lat.eq(2).val(),
					dd_gps_orbits			 : lat.eq(3).val(),
					dd_gps_dur				 : lat.eq(4).val(),
					dd_gps_qual              : lat.eq(5).val(),
					dd_gps_ori      		 : lat.eq(6).parent().find('input[type=radio]:checked').val(),
					dd_gps_com               : com.eq(0).val(),
					cc_id2 		  	         : sel.eq(0).find('option:selected').attr('my_id'),
					cc_id3 			         : sel.eq(1).find('option:selected').attr('my_id'),		
					dd_gps_pubdate           : pub_date($('#pub_date').val()),
					cb_ids                   : sel.eq(2).val().toString()
				},function(data){
					$('#data_happen').append(data);
					$('#data_happen').show();
				});	
			}
			if(slop.eq(0).val()!=""){	
				$.post('helpers/process_dd_gps_data.php',{
					type					 : 'BASELINE',
					vd_cavw             	 : stations.find('option:selected').attr('vd_cavw'),
					ds_code                  : stations.val(),
					di_gen_id        	 	 : instruments.find('option:selected').attr('di_gen_id'),
					ds_id               	 : stations.find('option:selected').attr('ds_id'),
					ds_id_ref1				 : pair_stations.find('option:selected').attr('ds_id'),
					ds_id_ref2				 : ref_stations.find('option:selected').attr('ds_id'),
					dd_gps_time  			 : stime.eq(0).val()+" "+stime.eq(1).val(),
					dd_gps_software			 : slop.eq(2).val(),
					dd_gps_orbits			 : slop.eq(3).val(),
					dd_gps_dur				 : slop.eq(4).val(),
					dd_gps_qual              : slop.eq(5).val(),
					dd_gps_slope             : slop.eq(0).val(),
					dd_gps_errslope			 : slop.eq(1).val(),
					dd_gps_ori      		 : slop.eq(6).parent().find('input[type=radio]:checked').val(),
					dd_gps_com               : com.eq(0).val(),
					cc_id2 		  	         : sel.eq(0).find('option:selected').attr('my_id'),
					cc_id3 			         : sel.eq(1).find('option:selected').attr('my_id'),		
					dd_gps_pubdate           : pub_date($('#pub_date').val()),
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
		measurement_type input{
			width: 370px;
		}
		.vertical th {
			vertical-align : bottom;
			text-align : center;
			width : 120px;
		}
		.vertical input {
			input: 350px;
		}
		.vertical td {
			width : 120px;
		}
		input {
			width: 120px;
			height: 25px;
		}
		input[type="submit"] {
			width: 100px;
		}
		input[type="radio"]{
			width: 15px;
			height: 10px;
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
		td[rowpan="3"] {
			text-align: center;
			valign : middle;
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
	</style>
</head>
<body>
<h3 class='text-success' align="center">INPUT FORM FOR GPS DATA</h3><br/><br/>
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
		<pair_station class="col-sm-2 text_center">
			<label>Pair Station:</label><br/>
			<select><option>Select Station</option></select>
		</pair_station>
		<reference_station class="col-sm-2 text_center">
			<label>Reference Station:</label><br/>
			<select><option>Select Station</option></select>
		</reference_station>
		<instrument class="col-sm-2 text_center">
			<label>Instrument:</label><br/>
			<select><option>Select Instrument</option></select>
		</instrument>
		<br/><br/><br/><br/><br/>
		<sampling_time class="col-sm-6">
			<label><sup>*</sup>Measurement time:</label>
			<input type="text" placeholder="YYYY-MM-DD" id="datepicker1">
			<input type="text" placeholder="HH:MM:SS">
		</sampling_time>
		<br/><br/><br/><br/><br/>
		<div class="vertical">
		<h4>GPS position:</h4>
			<table class="table-hover table-condensed table" style="width:950px">   			
				<tr>
					<th></th>
					<th><br/><br/>GPS<br/>measurements</th>
					<th><br/><br/>Measurement<br/>uncertainty</th>
					<th><br/><br/>Position<br/>determining<br/>software</th>
					<th><br/><br/>Orbits<br/>used</th>
					<th><br/><br/>Duration of<br/>the solution</th>
					<th>Quality of the<br/>solution<br/>E=excellent<br/>G=Good<br/>P=Poor<br/>U=unknown</th>
					<th><br/>Source of<br/>data<br/>D=digitized<br/>O=original</th>
				</tr>
				<tr>
					<td>Latitude(<sup>o</sup>)</td>
					<td><input type="text" placeholder="XXX.XX"></td>
					<td><input type="text" placeholder="XXX.XX"></td>
					<td rowspan="3" bgcolor="lightblue"><br/><br/><input type="text" placeholder="Max50 char"></td>
					<td rowspan="3" bgcolor="lightblue"><br/><br/><input type="text" placeholder="Max255 char"></td>
					<td rowspan="3" bgcolor="lightblue"><br/><br/><input type="text" placeholder="Max255 char"></td>
					<td rowspan="3" bgcolor="lightblue"><br/><br/><input type="text" placeholder="E;G;P;U"></td>
					<td rowspan="3" bgcolor="lightblue"><br/><br/><input type="radio" name="origin" value="D">D<input type="radio" name="origin" value="D">O</td>
				</tr>
				<tr>
					<td>Longitude(<sup>o</sup>)</td>	
					<td><input type="text" placeholder="XXX.XX"></td>
					<td><input type="text" placeholder="XXX.XX"></td>
				<!--<td><input type="text" placeholder="Max50 char"></td>
					<td><input type="text" placeholder="Max255 char"></td>
					<td><input type="text" placeholder="Max255 char"></td>
					<td><input type="text" placeholder="E;G;P;U"></td>
					<td><input type="radio" name="origin" value="D">D<input type="radio" name="origin" value="D">O</td>-->
				</tr>
				<tr>
					<td>Elevation(m)</td>
					<td><input type="text" placeholder="XXX.XX"></td>
					<td><input type="text" placeholder="XXX.XX"></td>
				<!--<td><input type="text" placeholder="Max50 char"></td>
					<td><input type="text" placeholder="Max255 char"></td>
					<td><input type="text" placeholder="Max255 char"></td>
					<td><input type="text" placeholder="E;G;P;U"></td>
					<td><input type="radio" name="origin" value="D">D<input type="radio" name="origin" value="D">O</td>-->
				</tr>
			</table>
			<br/>
			<h4>GPS slope/ baseline chage :</h4>			
			<table class="table-hover table-condensed table" style="width:950px"> 
				<tr>
					<td>Slope baseline<br/>change</td>
					<td><br/><input type="text" placeholder="XXX.XX"></td>
					<td><br/><input type="text" placeholder="XXX.XX"></td>
				    <td><br/><input type="text" placeholder="Max50 char"></td>
					<td><br/><input type="text" placeholder="Max255 char"></td>
					<td><br/><input type="text" placeholder="Max255 char"></td>
					<td><br/><input type="text" placeholder="E;G;P;U"></td>
					<td><br/><input type="radio" name="origin1" value="D">D<input type="radio" name="origin1" value="D">O</td>
				</tr>
			</table>
		</div>
		<br/><br/><br/><br/>
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

<?php
/*
var data = $('#myForm').serializeArray();
data.push({name: 'wordlist', value: wordlist});

$.post("page.php", data);
*/
?>