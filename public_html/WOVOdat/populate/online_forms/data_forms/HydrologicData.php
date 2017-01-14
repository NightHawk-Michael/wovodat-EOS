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
	
	function with_hydro_conc(selected){
	var values = Array();
	var len = selected.length;	
	for (ih=1;ih<len;ih++){
	   var sel = selected.eq(ih);
	   if(sel.find('input').eq(0).val()!=""){
			values.push(new Array(
				sel.find('input').eq(0).val(),
				sel.find('input').eq(1).val(),
				sel.find('td input[type=radio]:checked').val(),
				sel.find('input[type=text]').eq(2).val(),
				sel.find('td').eq(0).attr("species")//html().replace("<sub>","").replace("</sub>","").replace("<sup>","").replace("</sup>","")
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
		$.post('helpers/hs_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
		});
	});
	
	stations.change(function(){
		$.post('helpers/hs_instruments.php',{hs_code : stations.val()},function(data){
			instruments.html(data);
		});
	});
		
	var table_tr = $('#hydro_conc tr');	
	var com = $('comments input');
	var sel = $('comments select');	
	var stime = $('sampling_time input');
	var wat_temp = $('water_temperature input');
	var bar_pres = $('barometric_pressure input');
	var ph_val = $('pH_value input');
	var cond_val = $('Conductivity input');
	var air_temp = $('air_temperature input');
	var tds_val = $('total_dissolve_solid input');
	var wat_elev = $('water_elevation input');
	var wat_dept = $('water_depth input');
	var wat_lev_ch = $('water_level_changes input');
	var spr_dis_rat = $('spring_discharge_rate input');
	var precipitation = $('precipitation input');
	var daily_precipi = $('daily_precipitation input');
	var type_precipit = $('type_of_precipitation select');
	
	//table_tr.wru();
	//com.wru();
	//sel.wru()
	//stime.wru();
	//wat_temp.wru();
	//bar_pres.wru();
	//ph_val.wru();
	//cond_val.wru();
	//air_temp.wru();
	//tds_val.wru();
	//wat_elev.wru();
	//wat_dept.wru();
	//wat_lev_ch.wru();
	//spr_dis_rat.wru();
	//precipitation.wru();
	//daily_precipi.wru();
	//type_precipit.wru();
	
    sel.eq(0).prepend("<option>Select Observatory</option>");
	sel.eq(0).val("Select Observatory");
	sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(2).val("-1");
	
	$('#Confirm').click(
		function(){
			var hydro_with_conc = with_hydro_conc(table_tr);
			var len_gwc = hydro_with_conc.length;			
			for (var ih=0; ih<len_gwc;ih++){				
					$.post('helpers/process_hd_data.php',{
						vd_cavw             	 : stations.find('option:selected').attr('vd_cavw'),
						hs_code                  : stations.val(),
						hs_id               	 : stations.find('option:selected').attr('hs_id'),
						hi_id     			 	 : instruments.find('option:selected').attr('hi_id'),
						hd_time  			     : stime.eq(0).val()+" "+stime.eq(1).val(),
						hd_temp					 : wat_temp.val(),
						hd_welev				 : wat_elev.val(),
						hd_wdepth				 : wat_dept.val(),
						hd_dwlev				 : wat_lev_ch.val(),	
						hd_bp					 : bar_pres.val(),					
						hd_sdisc				 : spr_dis_rat.val(),			
						hd_prec 				 : precipitation.val(),			
						hd_dprec				 : daily_precipi.val(),
						hd_tprec				 : type_precipit.val(),
						hd_ph					 : ph_val.val(),	
						hd_cond					 : cond_val.val(),					
						hd_comp_species			 : hydro_with_conc[ih][4],
						hd_comp_units         	 : hydro_with_conc[ih][3],
						hd_comp_content		     : hydro_with_conc[ih][0],
						hd_comp_content_err      : hydro_with_conc[ih][1],
						hd_atemp                 : air_temp.val(),				
						hd_tds   				 : tds_val.val(),
						hd_ori      			 : hydro_with_conc[ih][2],
	     				hd_com                   : com.eq(0).val(),
						cc_id2 		  	         : sel.eq(0).find('option:selected').attr('my_id'),
						cc_id3 			         : sel.eq(1).find('option:selected').attr('my_id'),		
						hd_pubdate               : pub_date($('#pub_date').val()),
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
		#hydro_conc th, #hydro_conc tr{
			text-align:center;
		}
		#hydro_conc {
			width: 950px;		
			align :left;
		}
		#hydro_conc input {
			width: 170px;		
			height: 25px;			
		}
		#hydro_conc input[type="radio"] {
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
<h3 align='center' class='text-success'>INPUT FORM FOR HYDRLOGIC DATA</h3><br/><br/>
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
		<water_temperature class="col-sm-2 text_center">
			<label>Water<br/>temperature (<sup>o</sup>C)</label><br/>
			<input type="text" placeholder="XXX.XX">
		</water_temperature>
		<barometric_pressure class="col-sm-2 text_center">
			<label>Barometric<br/>pressure (mbar)</label><br/>
			<input type="text" placeholder="XXX.XX">
		</barometric_pressure>
		<pH_value class="col-sm-2 text_center">
			<label><br/>pH<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</pH_value>
		<Conductivity class="col-sm-2 text_center">
			<label>Conductivity<br/>&mu;&Omega;/cm;&mu;S/cm<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</Conductivity>
		<air_temperature class="col-sm-2 text_center">
			<label>Air<br/>temperature (<sup>o</sup>C)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</air_temperature>
		<br/><br/><br/><br/>
		<total_dissolve_solid class="col-sm-2 text_center">
			<label>Total<br/>Dissolve Solids (TDS)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</total_dissolve_solid>
		<water_elevation class="col-sm-2 text_center">
			<label>Water<br/>elevation (m)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</water_elevation>
		<water_depth class="col-sm-2 text_center">
			<label>Water<br/>depth (m)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</water_depth>
		<water_level_changes class="col-sm-2 text_center">
			<label>Water level<br/>changes (m)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</water_level_changes>
		<spring_discharge_rate class="col-sm-2 text_center">
			<label>Spring discharge<br/>rate (L/s)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</spring_discharge_rate>
		<br/><br/><br/><br/>
		<precipitation class="col-sm-2 text_center">
			<label>Precipitation<br/>(mm)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</precipitation>
		<daily_precipitation class="col-sm-2 text_center">
			<label>Daily<br/>Precipitation (mm/d)<br/></label><br/>
			<input type="text" placeholder="XXX.XX">
		</daily_precipitation>
		<type_of_precipitation class="col-sm-2 text_center">
			<label>Type of<br/>Precipitation<br/></label><br/>
			<select>
				<option value="R">Rain</option>
				<option value="FR">Freezing Rain</option>
				<option value="S">Snow</option>
				<option value="H">Hail</option>
				<option value="R-FR">Rain-Freezing Rain</option>
				<option value="R-S">Rain-Snow</option>
				<option value="R-H">Rain-Hail</option>
				<option value="F">Freezing</option>
			</select>
		</type_of_precipitation>
		<br/><br/><br/><br/><br/>
		<h4 class='text-success'>Chemical species concentration in water:</h4>
		<hydro_concentrations class="col-sm-12">
			<table class="table table-hover table-condensed" id="hydro_conc">   
				<tr>
					<th>Chemical<br/>species:</th>
					<th>Concentration<br/>in water:</th>
					<th>Concentration<br/>uncertainty:</th>
					<th>Source of<br/>Data<br/>D=Digitized<br/>O=Original</th>			
					<th>Measured<br/>Unit</th>
				</tr>
				<tr>
				     <td species="SO4">SO<sub>4</sub><sup>-2</sup></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin1" value="D">D &nbsp <input type="radio" name="origin1" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="H2S">H<sub>2</sub>S</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin2" value="D">D &nbsp <input type="radio" name="origin2" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>				
				<tr>
				     <td species="Cl">Cl<sup>-</sup></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin3" value="D">D &nbsp <input type="radio" name="origin3" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="F">F<sup>-</sup></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin4" value="D">D &nbsp <input type="radio" name="origin4" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="HCO3">HCO<sub>3</sub><sup>-</sup></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin5" value="D">D &nbsp <input type="radio" name="origin5" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Mg">Mg</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin6" value="D">D &nbsp <input type="radio" name="origin6" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Fe">Fe</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin7" value="D">D &nbsp <input type="radio" name="origin7" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Ca">Ca</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin8" value="D">D &nbsp <input type="radio" name="origin8" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Na">Na</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin9" value="D">D &nbsp <input type="radio" name="origin9" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="K">K</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin10" value="D">D &nbsp <input type="radio" name="origin10" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="R2O3">R<sub>2</sub>O<sub>3</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin11" value="D">D &nbsp <input type="radio" name="origin11" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="SiO2">SiO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin12" value="D">D &nbsp <input type="radio" name="origin12" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="CO2">Free CO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin13" value="D">D &nbsp <input type="radio" name="origin13" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="B">B</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin14" value="D">D &nbsp <input type="radio" name="origin14" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="As">As</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin15" value="D">D &nbsp <input type="radio" name="origin15" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Li">Li</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin16" value="D">D &nbsp <input type="radio" name="origin16" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Ba">Ba</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin17" value="D">D &nbsp <input type="radio" name="origin17" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="Al">Al</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin18" value="D">D &nbsp <input type="radio" name="origin18" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="3He4He"><sup>3</sup>He/<sup>4</sup>He</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin19" value="D">D &nbsp <input type="radio" name="origin19" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="c3He4He"><sup>3</sup>He/<sup>4</sup>He<br/>corrected</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin20" value="D">D &nbsp <input type="radio" name="origin20" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="d13C">&delta;<sup>13</sup>C</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin21" value="D">D &nbsp <input type="radio" name="origin21" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="d34S">&delta;<sup>34</sup>S</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin22" value="D">D &nbsp <input type="radio" name="origin22" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="dD">&delta;D</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin23" value="D">D &nbsp <input type="radio" name="origin23" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
				<tr>
				     <td species="d18O">&delta;<sup>18</sup>O</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="radio" name="origin24" value="D">D &nbsp <input type="radio" name="origin24" value="O">O</td >
					 <td><input type="text" placeholder="mg/L, mol/L, mol/kg, etc"></td>
				</tr>
			</table>
			<br/><br/>
		</hydro_concentrations>
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