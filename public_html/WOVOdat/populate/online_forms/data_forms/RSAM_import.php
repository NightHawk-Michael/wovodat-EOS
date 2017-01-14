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
	var instruments = $('instrument select');
	
	volcanos.prepend("<option>Select Volcano</option>");
	volcanos.val("Select Volcano");
	volcanos.change(function(){
		$.post('helpers/ss_stations.php',{vd_name : volcanos.val()},function(data){
			stations.html(data);
		});
	});
	
	var columns_available = $('select[name=col_ava]');
	columns_available.eq(1).hide();

	columns_available.eq(0).click(function(e){
		$(this).hide();
		columns_available.eq(1).show();
	});
	
	columns_available.eq(1).mouseleave(function(e){
		e.preventDefault();
		columns_available.eq(1).hide();
		columns_available.eq(0).show();
	});
	
	$('#Upload').click(function() {
		var files;
		$('input[type=file]').on('change', prepareUpload);
		function prepareUpload(event){
		  files = event.target.files;
		  var names = $.map(files, function(val) { return val.name; });
		  
		  uploadFiles();
		}

		function uploadFiles(){
			var data = new FormData();
			$.each(files, function(key, value){
				data.append(key, value);
			});

			$.ajax({
				url: 'helpers/multiple_file_upload.php?files&upload_dir=Data_to_upload&upload_code=RSAM',
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false, 
				contentType: false
			});	
		}
		$('input[type=file]').trigger('click');		
	});

	var delete_sel = $('#delete_sel');
	var delete_but = $('#Delete');
	delete_sel.hide();
	delete_but.click(function(){	
		delete_sel.show();
		delete_sel.change(function(){
			var expression = delete_sel.val();
			switch(expression) {
				case "Uploaded files":
					$.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/RSAM'});
					break;
				case "Synchronized files":
					$.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/RSAM_synchronize'});
					break;
				case "Import files":
					$.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/for_import'});
					break;
				case "All files":
				    $.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/for_import'});
					$.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/RSAM_synchronize'});
					$.post('helpers/clean_dir.php',{File_dir_to_clean : 'Data_to_upload/RSAM'});
					break;
				default:
					break;
			}
			delete_sel.hide();
		});	

		$('which').parent().mouseleave(function(){setTimeout(function(){delete_sel.hide()},5000);});
	});

	var delimiter = $('delimiter select');
	var preview_table = $('#file_preview table');
	var preview_pre = $('#file_preview');
	var synchronize = $('#Syc_format');
	var insert_now = $('#Insert_now');
	var custom_delimiter = $('#custom_delimiter');
	var available_col = $('available_columns');
	var track_data = $('#track_data');
	var com = $('comments input');
	var sel = $('comments select');	
	
	sel.eq(0).prepend("<option>Select Observatory</option>");
	sel.eq(0).val("Select Observatory");
	sel.eq(1).prepend("<option>Select Observatory</option>");
	sel.eq(1).val("Select Observatory");
	sel.eq(2).prepend("<option value='-1'>Select Bibliography</option>");
	sel.eq(2).val("-1");
	
	preview_pre.hide();
	synchronize.hide();
	insert_now.hide();
	custom_delimiter.hide();
	available_col.hide();
	track_data.hide();
	
	delimiter.change(
	function(){
		if(delimiter.val()=="Custom Delimiter"){
			custom_delimiter.show();
			delimiter.hide();
			custom_delimiter.val("");
		}
	});
	
	custom_delimiter.mouseout(function(){
		var sel = custom_delimiter.val();
			if(sel!=""){
				delimiter.prepend("<option>"+sel+"</option>");
				delimiter.val(sel);
			}
			custom_delimiter.hide();
			delimiter.show();
	});
	
	$('#Preview').click(
	function(){
		$.post('helpers/file_preview.php',{
			delimiter : delimiter.val(),
			directory : "./Data_to_upload/RSAM/"
		},function(data){
			preview_table.append(data);
			preview_pre.show();
		});
		
		$.post('helpers/see_files.php',
		function(data){			
			available_col.find('table').append(data);			
		}).done(
		function(){
			synch_col();
		});
		
		synchronize.show();
		insert_now.show();
		available_col.show();		
	});
	
	preview_pre.dblclick(
	function(){
		preview_pre.hide();
		preview_table.empty();
		synchronize.hide();
		insert_now.hide();
		available_col.hide();
		available_col.find('tr').not(':eq(0)').empty();
	});
	
	$('#Syc_format').click(
	function(){	
		var table_tr = available_col.find('table tr');	
		var thfield = table_tr.parent().find('th');
		var file_column = table_tr.find('td:nth-child(1)');
		var len_row = file_column.length;
		//alert(len_row);
		for(var ih=0;ih<len_row;ih++){
			var fields = "";
			var col_nums = "";		
			var table_td = table_tr.eq(ih+1).find('td');
			var len_col = table_td.length-1;	
			for (var ij =1;ij<len_col;ij++){
				var input = table_td.eq(ij).find('input').val();
				if(input!=""){
					fields = fields + thfield.eq(ij).text() + ",";					
					col_nums = col_nums + input +",";	
				}
			}
			//alert(fields);
			//alert(col_nums);	
			;
			
			$.post('helpers/synchronize.php',{
				File      : file_column.eq(ih).text(),
				columns   : col_nums,
				fields    : fields,
				delimeter : delimiter.val()
			},function(data){
				//alert(data);
			}).done(
			function(){
				$.post('helpers/file_preview.php',{
					delimiter : "\t",
					directory : "./Data_to_upload/RSAM_synchronize/"
				},function(data){
					preview_table.empty();
					preview_table.append(data);
					preview_pre.show();
				});
			});			
				
		}
	});
	
	function synch_col(){
		var table_tr = available_col.find('tr:not(:eq(0))');	
		var table_td = table_tr.find('td');
		table_td.dblclick(
		function(){
			var cell_val = $(this).find('input').val();
			var this_index = $(this).index()+1;
			var	td_col =  table_tr.find('td:nth-child('+this_index+')');
			var td_col_len = td_col.length;
			for(var ig=0;ig<td_col_len;ig++){
				td_col.eq(ig).find('input').val(cell_val);
			}
		})
	}
	
	insert_now.click(
	function(){
		var table_tr = available_col.find('table tr');	
		var file_column = table_tr.find('td:nth-child(1)');
		var file_origin = table_tr.find('td:nth-child(11)');
		var len_row = file_column.length; 
		var files = [];
		var origi = [];
		for(var ih=0;ih<len_row;ih++){
			files[ih] = file_column.eq(ih).text();
			origi[ih] = file_origin.eq(ih).find('input[type=checkbox]:checked').val();
		}
		
		$('#track_data').show();
		$('#track_data').append("Processing files: after all files are done a report will be flag:"+"\n");
		
		$.post('helpers/process_sd_rsm_data.php',{
			Files           : files,
			vd_num          : volcanos.find('option:selected').attr('my_id'),
			ss_code         : stations.val(),
			ss_id           : stations.find('option:selected').attr('ss_id'),			
			sd_sam_ori      : origi,
			sd_sam_com      : com.eq(0).val(),
			cc_id2 		    : sel.eq(0).find('option:selected').attr('my_id'),
			cc_id3 			: sel.eq(1).find('option:selected').attr('my_id'),		
			sd_sam_pubdate  : pub_date($('#pub_date').val()),
			cb_ids          : sel.eq(2).val().toString()
		},
		function(data){
			$('#track_data').append(data);
		});
		
		
	});
	
	$('#Back').click(function(){
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
		input[type="submit"] {
			width: 100px;
		}
		select {
			width: 150px;
			height: 25px;
		}
		#com select{
			min-width: 250px;
		}
		input[type=file]{
			display:block;
			height:0;
			width:0;
		}
		p input{
			position: relative;
			left: 335px;	
		}		
		p#selects {
			position: relative;
			left: 120px;
		}
		p#selects input {
			position: relative;
			left:0px;
		}
		table#available_columns {
			width : 985px;
		}
		table#available_columns input{
			width : 50px;
		}
		table#available_columns input[type=checkbox]{
			width : 30px;
			height: 20px;
		}
		pre {
			width : 1000px;
			height: 500px;
		}
		th.rotate {
			writing-mode: vertical-rl;
			transform: rotate(-180deg);
		}
		#delete_sel {
			width: 99px;
			position: relative;
			left: 536px;
		}
		#track_data{
			width :990px;
		}
		#com label{
			width: 250px;
		}
		#com input{
			width: 600px;
		}
		#com select{
			min-width: 250px;
		}
	</style>
</head>
<body>
<h3 align='center' class='text-success'>IMPORT RSAM DATA FROM FILE</h3><br/><br/>
<div class="gd container">
		<p id="selects">
		<observatory class="col-sm-2 text_center">
			<label>Observatory:</label><br/>
			<?php 
				create_dropdown_from_rows(query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code NOT REGEXP '[0-9]' ORDER BY cc_code"));
			?> 
		</observatory>
		<volcano class="col-sm-2 text_center">
			<label>Volcano:</label><br/>
			<?php 
				create_dropdown_from_rows(query_mysql("SELECT vd_name, vd_num FROM vd ORDER BY vd_name"));
			?> 
		</volcano>
		<station class="col-sm-2 text_center">
			<label>Station:</label><br/>
			<select><option>Select Station</option></select>
		</station>
		<delimiter class="col-sm-2 text_center">
			<label>Delimiter:</label><br/>
			<select>
				<option value=",">Comma</option>
				<option value="\t">Tab</option>
				<option>Custom Delimiter</option>
			</select>
			<input type="text" id="custom_delimiter">
		</delimiter>
		</p>
		<br/><br/><br/><br/><br/>
		<contols class="col-sm-12">
		<p><input type="submit" value="Upload Files" id="Upload"/><input type="submit" value="Preview Files" id="Preview"/><which><input type="submit" value="Delete Files" id="Delete"/><br/>
		<select id="delete_sel">
			<option>Select to delete</option>
			<option>Uploaded files</option>
			<option>Synchronized files</option>
			<option>Import files</option>
			<option>All files</option>
		</select>
		</which>
		<input type="file" multiple="multiple" name="file[]" /></p>	
		</contols>
		<br/><br/><br/><br/>
		<pre id="file_preview"><table class="table table-bordered table-condensed"></table></pre>		
		<available_columns>
		<br/>
		<label>Type the corresponding column number from the table above to the right fields it should be</label><br/>
		Note: columns are indexed from zero:
		<br/><br/>
		<table class="table table-bordered table-condensed" id="available_columns">
			<tr>
				<th class="text_center"><br/><br/><br/>Files</th>
				<th class="rotate">sd_rsm_id</th>
				<th class="rotate">sd_sam_id</th>
				<th class="rotate">sd_rsm_stime</th>	
				<th class="rotate">sd_rsm_stime_unc</th>	
				<th class="rotate">sd_rsm_count</th>	
				<th class="rotate">sd_rsm_calib</th>	
				<th class="rotate">sd_rsm_com</th>	
				<th class="rotate">sd_rsm_loaddate</th>	
				<th class="rotate">cc_id_load</th>
				<th class="text_center"><br/><br/>Origin<br/>D=Digitized<br/>O=Original</th>
			</tr>
		</table>
		</available_columns>
		<input type="submit" value="Synchronize" id="Syc_format"><br/><br/>
		<h4 class='text-success'>Comments:</h4><br/>
		<comments id="com">
			<label>General comments</label>:&nbsp <input type="text" placeholder="Max255 characters"><br/>
			<?php $rs = query_mysql("SELECT DISTINCT cc_code, cc_id FROM cc WHERE cc_code REGEXP '[a-zA-Z]' ORDER BY cc_obs"); ?>
			<label>Second Institution/Observatory</label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Third Institution/Observatory </label>:&nbsp <?php create_dropdown_from_rows($rs);?> <br/>
			<label>Publish Date</label>:&nbsp <input type="text" placeholder="YYYY-MM-DD HH:MM:SS" id="pub_date" style="width:150px;height:25px;"><br/>
			<label>Bibliography</label>:&nbsp <?php create_multiselect_from_rows(query_mysql("SELECT cb_id, cb_auth, cb_year, cb_title FROM cb ORDER by cb_auth")); ?> 
			<br/><br/>
		</comments>		
		 <button type="button" id="Back">Back to previous page</button><button id="Insert_now">Insert RSAM data</button>
		 <br/>
		 <br/>
		<pre id="track_data"></pre>
</div>
</body>	
</html>