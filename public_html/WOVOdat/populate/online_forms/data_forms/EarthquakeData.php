<html>
<?php 
if (!isset($_SESSION)) { session_start(); }
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
	
	function eq_types_and_number(selected){
	var values = Array();
	var len = selected.length;	
	for (ih=0;ih<len;ih++){
		var sel = selected.eq(ih).val();
		var lab = selected.parent().find('label').eq(ih).attr('eq_type');
		var fel = selected.parent().find("input[placeholder='Felt']").eq(ih).val();
	   if(sel){
			values.push(new Array(sel,lab,fel));
	   }
	}
	return values;	
	}
	
	function date_now(){
		var d = new Date();
        var now = d.getFullYear()+"-"+d.getMonth()+"-"+d.getDay()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(); 
		return now;
	}
	
	$(function(){
		
		var inputs_eq_type = $('earthquake_type').find("input[placeholder='Number']");
		var inputs_eq_felt = $('earthquake_type').find("input[placeholder='Felt']"); 
		var inputs_date_time = $('div.sd_ivl').find('input').slice(0,4);  
		var inputs_comments = $('remarks').find('input'); 
		var submit_button = $('#sd_ivl_submit');
		
		var volcano_select = $('volcano select');	
		var station_select = $('station');
		volcano_select.prepend("<option>Select Volcano</option>");
		volcano_select.val("Select Volcano");
		inputs_date_time.eq(1).val("00:00:00");
		inputs_date_time.eq(3).val("00:00:00");
		$('#data_track').hide();
		volcano_select.change(		
			function(){				
				$.post("helpers/ss_stations.php",{vd_name : volcano_select.val()},
					function(ss_data){
						station_select.html("<label>Station:</label><br/>"+ss_data);		
						station_select.find('select').prepend("<option>Select Station</option>");
						station_select.find('select').val("Select Station");
						submit_button.click(						
							function(){
								var eq_types = eq_types_and_number(inputs_eq_type);
								for(im=0;im<eq_types.length;im++){
									$.post("helpers/process_sd_ivl_data.php",{
										ss_code         : station_select.find("select").val(),
										sn_id			: station_select.find("select").find('option:selected').attr('sn_id'),
										ss_id           : station_select.find("select").find('option:selected').attr('ss_id'),
										sd_ivl_eqtype   : eq_types[im][1],
										sd_ivl_stime    : inputs_date_time.eq(0).val()+" "+inputs_date_time.eq(1).val(),
										sd_ivl_etime    : inputs_date_time.eq(2).val()+" "+inputs_date_time.eq(3).val(),
										sd_ivl_nrec     : eq_types[im][0],
										sd_ivl_nfelt    : eq_types[im][2],
										sd_ivl_com      : inputs_comments.val(),
										cc_id           : station_select.find("select").find('option:selected').attr('cc_id'), 
										sd_ivl_loaddate : date_now,
										sd_ivl_pubdate  : date_now
									},	function(sd_ivl_data){
											$('#data_track').append(sd_ivl_data);
										}
									);
								}	
								$('#data_track').show();
							}
						);
					}
				);
			}
		);	
				
		
	$( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
	inputs_eq_felt.hide();
	inputs_eq_type.mouseover(
	function(){
		inputs_eq_felt.hide();
		$(this).next().show();
	}
	);

	inputs_eq_type.parent().mouseleave(
		function(){
			inputs_eq_felt.hide();
		}
	);
	
	function year(){
		var d = new Date();
        var now = d.getFullYear();
		return now;
	} 
	
	$.datepicker.setDefaults({
		  dateFormat: 'yy-mm-dd',
		  changeMonth: true,
		  changeYear: true,
		  yearRange:  parseFloat(year()-500)+":"+parseFloat(year()+100)
	});
   $( "#datepicker1" ).datepicker().val();
   $( "#datepicker2" ).datepicker().val(); 
   
    $('#Back_but').click(function(){
		window.location="http://www.wovodat.org/populate/home_populate.php";
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
		earthquake_type input {
			width: 100px;
			display: inline-block;
		}
		remarks input {
			width: 500px;
			margin-left:auto;
			margin-right:auto;
		}
		#sd_ivl_submit {
			position : relative;
			left : 800px;
		}
		#Back_but {
			position : relative;
			left : 810px;
		}
		#data_track {
			width: 1000px;
			min-height : 100px;
		}
		#quakes tr {
			  width: 1000px;
			  text-align: center;
		}
		#quakes td {
			  width: 1000px;
			  text-align: right;
		}
	</style>
</head>
<body>
<h3 align='center' class='text-success'>UPLOAD FORM FOR EARTHQUAKE COUNT</h3><br/><br/>
<div class="sd_ivl">
<volcano class="col-sm-2 text_center">
    <label>Volcano:</label><br/>
	<?php 
		create_dropdown_from_column_data("vd","vd_name"); 
	?> 
</volcano>
<station class="col-sm-2 text_center">
	<label>Station:</label><br/>
	<select></select>
</station>
<start_time class="col-sm-4 text_center">
	 <label>Start time:</label><br/>
	<input type="text" placeholder="YYYY-MM-DD" id="datepicker1">
	<input type="text" placeholder="HH:MM:SS">
</start_time>
<end_time class="col-sm-4 text_center">
	<label>End time:</label><br/>
	<input type="text" placeholder="YYYY-MM-DD" id="datepicker2">
	<input type="text" placeholder="HH:MM:SS">
</end_time>
<br/><br/><br/><br/>
<h4 align='center' class='text-success'>Earthquake type</h4><br/>
<earthquake_type>
	<table id="quakes">
		<tr><td>
			<span class="col-sm-2 text_center">
				<label eq_type="R">Regional<br/>Tectonic</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="Q">Query<br/>Blast</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="V">Generic Volcano<br/>Quake</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="VT">Volcano<br/>Techtonics</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="VT_D"><br/>Deep VT</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="VT_S"><br/>Shallow VT</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
		</td></tr>
		<tr><td>
			<span class="col-sm-2 text_center">
				<label eq_type="H"><br/><br/>Hybrid</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="H_HLF"><br/>High to Low<br/>Freq. H</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="H_LHF"><br/>Low to high<br/>Freq. H</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="LF"><br/>Low<br/>Frequency</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="LF_LP"><br/>Long<br/>Period LF</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="LF_T"><br/><br/>Tornillo</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
		</td></tr>
		<tr><td>
			<span class="col-sm-2 text_center">
				<label eq_type="LF_ILF"><br/>Intermediate<br/>LF</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="VLP"><br/>Very Long<br/>Period</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="E"><br/><br/>Explosion</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="U"><br/>Unknown<br/>Origin</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="O"><br/>Other, non<br/>volcanic origin</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="X"><br/><br/>Undefined</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
		</td></tr>
		<tr><td>
			<span class="col-sm-3 text_center"></span>
			<span class="col-sm-2 text_center">
				<label eq_type="RF"><br/>Rock Fall</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="G"><br/>Gas Burst</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
			<span class="col-sm-2 text_center">
				<label eq_type="PF"><br/>Pyroclastic Flow</label><br/>
				<input type="text" placeholder='Number'>
				<input type='text' placeholder='Felt'>
			</span>
		</td></tr>
	</table>
</earthquake_type>
<br/><br/><br/><br/>
<remarks class="text_center col-sm-12">
	    <label class='text-success'>Remarks/Comments</label><br/><br/>
		<input type="text">
</remarks>
<br/><br/><br/><br/>
<input id="sd_ivl_submit" type="submit" value="Submit"><input id="Back_but" type="submit" value="Back">
<br/><br/><br/><br/>
<textarea id="data_track"></textarea>
</div>
</body>	
</html>