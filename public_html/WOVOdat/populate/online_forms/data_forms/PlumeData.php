<!DOCTYPE html> 
<html>
<?php 
if (!isset($_SESSION)) {
    session_start();
}
include('helpers/my_nice_php_function.php');
//session_start();
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
	
	function add_value_in_select_if_not_exist(select, value){
		var exists = false;
		select.find('option').each(function(){
			if (this.value == value) {
				exists = true;
			}
		});
		if(exists == false){
			select.prepend("<option>"+value+"</option>");
			select.val(value);
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
				sel.find('td').eq(3).find('input[type=checkbox]:checked').val(),
				sel.find('td').eq(4).find('input[type=checkbox]:checked').val(),
				sel.find('input[type=text]').eq(2).val(),
				sel.find('td').eq(0).html().replace("<sub>","").replace("</sub>","").replace("<sup>","").replace("</sup>","")
			));
	   }
	}
	return values;	
	}
	
	$(function(){
	
	var ground = $('ground_based_plume_data');
	var airplane = $('airplane_based_plume_data');
	var satellite = $('satellite_based_plume_data');
	
	airplane.html(ground.html());
	airplane.find('h4').first().html("AIRPLANE BASED PLUME DATA");
    airplane.find('station').find('label').html("<sup>*</sup>Airplane");
	satellite.html(ground.html());
	satellite.find('h4').first().html("SATELLITE BASED PLUME DATA");
	satellite.find('station').find('label').html("<sup>*</sup>Satellite/Airplane");
	
	var volc_select = satellite.find('volcano').find('select').html();
	satellite.find('volcano').replaceWith(
	"<space_holder class=\"col-sm-1 text_center\"></space_holder>"+
	"<volcano class=\"col-sm-2 text_center\">"+"<label><sup>*</sup>Volcano1:</label><br/><br/><select>"+volc_select+"</select></volcano>"+
	"<volcano class=\"col-sm-2 text_center\">"+"<label><sup>*</sup>Volcano2:</label><br/><br/><select>"+volc_select+"</select></volcano>"+
	"<volcano class=\"col-sm-2 text_center\">"+"<label><sup>*</sup>Volcano3:</label><br/><br/><select>"+volc_select+"</select></volcano>"
	);
	
	satellite.find('latitude, longitude, plume_height').remove();
	
	var new_elem = '\
	<br/><br/><br/><br/><br/>\
	<h4 class="text-success">Observed Latitude/Longitude area(<sup>o</sup>)</h4><br/>\
	<div align="center">\
	<location>\
	<label>North:</label><input type="text" placeholder="XXX.XXXX"></input><br/>\
	<label>West:</label><input type="text" placeholder="XXX.XXXX"></input>'+space(35)+'<label>East:</label><input type="text" placeholder="XXX.XXXX"></input><br/>\
	<label>South:</label><input type="text" placeholder="XXX.XXXX"></input>\
	</location>\
	</div>\
	<br/><br/>\
	<image_file>\
	<form id="convert_form" class="center" role="form" method="post" enctype="multipart/form-data">\
		   <div class="form-group">\
			<label>Upload image file:<br/><br/></label><input type="file" style="width:350px" placeholder="Browse image file (jpg, tif, png, etc)" id="file" name="files[]" multiple="multiple"/>\
		  </div>\
	</form>\
	</image_file><br/>\
	<interference_sources>\
	<label>List of interference sources:</label><input type="text" style="width:350px" placeholder="Pollution, copper smelter, cloud cover, etc (max. 255 characters)"><br/>\
	</interference_sources>\
	<plume_height>\
		<label>Plume height (Km) :</label><input type="text" style="width:150px" placeholder="XXX.XXXX">\
	</plume_height>\
	';
	satellite.find('instrument').after(new_elem);
	
	airplane.hide();
	satellite.hide();
	var tabs = $('.gd_plu').find('ground_based_plume_data, airplane_based_plume_data , satellite_based_plume_data');
	var type_of_data = $('type_of_data').find('select');
	type_of_data.change(function(){
		tabs.hide();
		tabs.eq(type_of_data.find('option:selected').index()).show();
		visible_ini();
	});
	
	function visible_ini(){
		var volcanoes = $('volcano select:visible');
		var stations = $('station select:visible');
		var instruments = $('instrument select:visible');
		$('#data_happen').hide();
		
		volcanoes.prepend("<option>Select Volcano</option>");
		volcanoes.val("Select Volcano");
		volcanoes.change(function(){  
			if(type_of_data.val()=="Ground-based data"){
				$.post('helpers/gs_stations.php',{vd_name : volcanoes.val()},function(data){
					stations.html(data);
				});
			}
			else{
				$.post('helpers/cs_stations.php',{vd_name : volcanoes.val()},function(data){
					stations.html(data);
				});
			}
		});
		
		stations.change(function(){
			if(type_of_data.val()=="Ground-based data"){
				$.post('helpers/gs_instruments.php',{gs_code : stations.val()},function(data){
					instruments.html(data);
				});
			}
			else{
				$.post('helpers/cs_instruments.php',{gs_code : stations.val()},function(data){
					instruments.html(data);
				});				
			}
		});
		
		var table_tr = $('gas_emission table tr:visible');	
		var com = $('comments input:visible');
		var sel = $('comments select:visible');	
		var lat = $('latitude input:visible');
		var lon = $('longitude input:visible');
		var pheight = $('plume_height input:visible');
		var mtdheight = $('method_to_determine_height input:visible');
		var stime = $('sampling_time input:visible');
		var windata = $('wind_data input:visible');
		var conf_but = $('.confirm_but:visible');
		var location = $('location input:visible');
		var image = $('image_file input:visible');
		var interf = $('interference_sources input:visible');
		
		//stime.eq(0).val(date_now());
		//stime.eq(1).val(time_now());
		//com.eq(2).val(date_now()+" "+time_now());
		
		table_tr.find('td:nth-child(4), gas_emission table tr th:nth-child(4)').hide();
		add_value_in_select_if_not_exist(sel.eq(1), "Select Observatory");
		add_value_in_select_if_not_exist(sel.eq(2), "Select Observatory");
		add_value_in_select_if_not_exist(sel.eq(3), "Select Bibliography");
		
		//table_tr.eq(1).find('td').eq(4).find('input[type=checkbox]:checked').wru();
	    	conf_but.click(		
			function(){				
				var gas_with_conc = with_gas_conc(table_tr);
				var len_gwc = gas_with_conc.length;	
				if(type_of_data.val()=="Satellite-based data"){
					uploadFiles();
				}
				for (var ih=0; ih<len_gwc;ih++){						
					$.post('helpers/process_gd_plu_data.php',{
						type_of_data            : type_of_data.val(),
						gs_code                 : stations.val(),
						vd_id					: volcanoes.find('option:selected').attr('my_id'),
						vd_cavw                 : volcanoes.find('option:selected').attr('my_id2'),
						gd_plu_volc1			: volcanoes.eq(1).val(),
						gd_plu_volc2			: volcanoes.eq(2).val(),
						cs_id					: stations.find('option:selected').attr('cs_id'),
						gs_id					: stations.find('option:selected').attr('gs_id'),
						gi_id			        : instruments.find('option:selected').attr('gi_id'),
						gd_plu_lat			    : lat.val(),
						gd_plu_lon			    : lon.val(),
						gd_plu_minboxlat		: location.eq(3).val(),
						gd_plu_maxboxlat		: location.eq(0).val(),
						gd_plu_minboxlon		: location.eq(1).val(),
						gd_plu_maxboxlon		: location.eq(2).val(),
						gd_plu_image			: File_names,
						gd_plu_inter			: interf.val(),
						gd_plu_height			: pheight.val(),
						gd_plu_hdet			    : mtdheight.val(),
						gd_plu_time			    : stime.eq(0).val()+" "+stime.eq(1).val(),
						gd_plu_species			: gas_with_conc[ih][5],
						gd_plu_units			: gas_with_conc[ih][4],
						gd_plu_emit			    : gas_with_conc[ih][0],
						gd_plu_emit_err			: gas_with_conc[ih][1],
						gd_plu_recalc			: gas_with_conc[ih][3],
						gd_plu_wind			    : windata.eq(0).val(),
						gd_plu_wsmin			: windata.eq(1).val(),
						gd_plu_wsmax			: windata.eq(2).val(),
						gd_plu_wdir			    : windata.eq(3).val(),
						gd_plu_ori			    : sel.eq(0).val(),
						gd_plu_com			    : com.eq(0).val()+"\t"+com.eq(1).val(),
						cc_id2			        : sel.eq(1).find('option:selected').attr('my_id'),
						cc_id3			        : sel.eq(2).find('option:selected').attr('my_id'),
						gd_plu_pubdate			: pub_date($('#date_time').val()),
						cb_ids                  : sel.eq(3).val().toString()
					},
					function(data){
						$('#data_happen').append(data);
						$('#data_happen').show();					 
					});
				}				
			}
		);
		
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		editable: true,
		yearRange:  parseFloat(year()-500)+":"+parseFloat(year()+100)
	});
   $( ".datepicker1:visible" ).datepicker().val();
   $( "#date_time:visible" ).datepicker().val(); 	
   
   	$('.Back_but:visible').click(function(){
		window.location="http://www.wovodat.org/populate/home_populate.php";
	});	
		
	}
	
	visible_ini();
//------------------------------------------------------------------	
	var files;
	var File_names = "";
	$('input[type=file]').on('change', prepareUpload);
	function prepareUpload(event){
	  files = event.target.files;
	  var names = $.map(files, function(val) { return val.name; });
	  File_names = names.toString();
	}

	function uploadFiles(){
		var data = new FormData();
		$.each(files, function(key, value){
			data.append(key, value);
		});

		$.ajax({
			url: 'helpers/gd_plu_upload.php?files',
			type: 'POST',
			data: data,
			cache: false,
			dataType: 'json',
			processData: false, 
			contentType: false
		});	
	}
//------------------------------------------------------------------
	
		
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
		input[type="checkbox"] {
			width: 18px;
			height: 18px;
		}
		select {
			width: 150px;
			height: 25px;
		}
		ground_based_plume_data label, 
		airplane_based_plume_data label, 
		satellite_based_plume_data label, wind_data label {
			width: 210px;
		}
		#gas_emi th, #gas_conc tr{
			text-align:center;
		}
		#data_happen{
			width: 600px;
			min-height: 200px;
		}
		#com input{
			width: 400px;
		}
		#com select{
			width: 200px;
		}
		location label {
			width: 50px;
		}
		gas_emission th, gas_emission tr {
			text-align:center;
		}
	</style>
</head>
<body>
<h3 align='center' class='text-success'>INPUT FORM FOR PLUME DATA</h3><br/><br/>
<div class="gd_plu">
	<div align="center">
		<type_of_data class="col-sm-12">
			<label><sup>*</sup>Type of data</label>: &nbsp <select><option>Ground-based data</option><option>Airplane-based data</option><option>Satellite-based data</option></select>
		</type_of_data>
	</div>
	<br/><br/>
	<ground_based_plume_data>
	<h4 class='text-success'>GROUND-BASED PLUME DATA</h4>
	<br/>
		<volcano class="col-sm-2 text_center">		    
			<label><sup>*</sup>Volcano:</label><br/><br/>
			<?php create_dropdown_from_rows(query_mysql("SELECT vd_name, vd_id, vd_cavw FROM vd ORDER by vd_name")); ?> 
		</volcano>
		<station class="col-sm-2 text_center">		    
			<label><sup>*</sup>Station:</label><br/><br/>
			<select></select>
		</station>
		<instrument class="col-sm-2 text_center">		    
			<label><sup>*</sup>Instrument:</label><br/><br/>
			<select></select>
		</instrument>
		<latitude class="col-sm-2 text_center">
			<label>Latitude of plume vent (<sup>o</sup>)</label><input type="text" placeholder="XXX.XXXX"><br/>
		</latitude>
		<longitude class="col-sm-2 text_center">
			<label>Longitude of plume vent (<sup>o</sup>)</label><input type="text" placeholder="XXX.XXXX"><br/>
		</longitude>
		<plume_height class="col-sm-2 text_center">		    
			<label>Plume height (Km)</label><br/><br/><input type="text" placeholder="XXX.XXXX">		
		</plume_height>
		<br/><br/><br/><br/><br/><br/>
		<space_holder class="col-sm-1 text_center"></space_holder>
		<method_to_determine_height class="col-sm-5 text_center">	
			<label>Method to determine height:</label><br/>
			<input type="text" placeholder="Max. 255 characters" style="width:400px;"><br/><br/>
		</method_to_determine_height>
		<sampling_time class="col-sm-5 text_center">
			<label>Measurement time:</label><br/>
			<input type="text" placeholder="YYYY-MM-DD" class="datepicker1">
			<input type="text" placeholder="HH:MM:SS">
		</sampling_time>
		<br/><br/><br/><br/><br/>
		<gas_emission class="col-sm-12">
			<table class="table table-hover table-condensed" id="gas_emi">   
				<tr><th>Gas <br/>species:</th><th>Gas <br/>emission rate:</th><th>Emission rate<br/>uncertainty:</th><th>Source of data<br/>D=digitized<br/>O=original</th><th>Recalculated</th><th>Reported Unit</th></tr><br/>
				<tr>
				     <td>SO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td>
					 <td><input type="checkbox" value="R">Yes &nbsp <input type="checkbox" value="O">No</td>
					 <td><input type="text" placeholder="T/d; kg/s,kT,etc."></td>
				</tr>
				<tr>
				     <td>CO<sub>2</sub></td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td>
					 <td><input type="checkbox" value="R">Yes &nbsp <input type="checkbox" value="O">No</td>
					 <td><input type="text" placeholder="T/d; kg/s,kT,etc."></td>
				</tr>
				<tr>
				     <td>H<sub>2</sub>S</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td>
					 <td><input type="checkbox" value="R">Yes &nbsp <input type="checkbox" value="O">No</td>
					 <td><input type="text" placeholder="T/d; kg/s,kT,etc."></td>
				</tr>
				<tr>
				     <td>HF</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td>
					 <td><input type="checkbox" value="R">Yes &nbsp <input type="checkbox" value="O">No</td>
					 <td><input type="text" placeholder="T/d; kg/s,kT,etc."></td>
				</tr>
				<tr>
				     <td>CO</td>
				     <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="text" placeholder="XXX.XX"></td>
					 <td><input type="checkbox" value="D">D &nbsp <input type="checkbox" value="O">O</td>
					 <td><input type="checkbox" value="R">Yes &nbsp <input type="checkbox" value="O">No</td>
					 <td><input type="text" placeholder="T/d; kg/s,kT,etc."></td>
				</tr>				
			</table>
			<br/><br/>
		</gas_emission>
		<wind_data>
			<label>Wind speed (m/s)</label>:&nbsp <input type="text" placeholder="XXX.XX"><br/>
			<label>Maximum Wind speed (m/s)</label>:&nbsp <input type="text" placeholder="XXX.XX"><br/>
			<label>Minimum Wind speed (m/s)</label>:&nbsp <input type="text" placeholder="XXX.XX"><br/>
			<label>Wind direction(<sup>o</sup>)</label>:&nbsp <input type="text" placeholder="XXX.XX"><br/>
		</wind_data>
		<br/>
		<br/>
		<h4 class='text-success'>Comments:</h4><br/>
		<comments id="com">
			<label>Weather notes</label>:&nbsp <input type="text" placeholder="Max255 characters"><br/>
			<label>General comments</label>:&nbsp <input type="text" placeholder="Max255 characters"><br/>
			<label><sup>*</sup>Source of data</label>:&nbsp <select><option>Select the source of data</option><option value="D">Digitized/Bibliography</option><option value="O">Original from Observatory</option></select><br/>
			<br/><br/>
			<?php $rs = query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code REGEXP '[a-zA-Z]' ORDER BY cc_obs"); ?>
			<label>Second Institution/Observatory</label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Third Institution/Observatory</label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Publish Date</label>:&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" id="date_time" class="datepicker1" style="width:200px;height:25px;"><br/>
			<label>Bibliography</label>:&nbsp <?php create_multiselect_from_rows(query_mysql("SELECT cb_id, cb_auth, cb_year, cb_title FROM cb ORDER by cb_auth")); ?>
			<br/><br/>
		</comments>		
		 <button type="button" class="Back_but">Back to previous page</button>  <button type="button" class="confirm_but">Confirm</button> 
		<br/><br/>
	</ground_based_plume_data>
	<airplane_based_plume_data>	
	</airplane_based_plume_data>
	<satellite_based_plume_data>	
	</satellite_based_plume_data>
	<textarea id="data_happen"></textarea>
</div>
</body>	
</html>