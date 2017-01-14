<?php
ini_set("memory_limit", "-1");
set_time_limit(0);
require_once("query_database.php");
session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
$uname="";
$ccd="";
if(isset($_SESSION['login'])) {
	$uname=$_SESSION['login']['cr_uname'];
	$ccd=$_SESSION['login']['cc_id'];
}
else{
header('Location: '.$url_root.'login_required.php');// Session was not yet started.... Redirect to login required page
exit();
}

if(!isset($_GET['obs'])){
header('Location: '.$url_root.'home_populate.php');
exit();
}

?>
<html>
<script src="/js/jquery-1.9.1.js"></script>
<script language='javascript' type='text/javascript'>
	$.fn.wru = function(color) {
		color = color || '#d6393d';
		console.log( this );
		return this.css('outline', '2px solid ' + color);
	};	

	$(function(){
			
		var load_result = $('#load_track');
		load_result.hide();
		//var observatory = $("#observatory").val();
		$('#file_input').hide();
		//$('#submit_button').wru();
		$('#submit_button').click(function(e){
			e.preventDefault();
		var data_type = $("#data_type").val();
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
				url: 'convertie/AVO/multiple_file_upload.php?files&upload_dir='+data_type+'&upload_code=original_observatory_files',
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false, 
				contentType: false
			})
			.done(function(){
				if(data_type == "Seismic_Event"){
					var from = data_type+"/original_observatory_files";
					$.post('convertie/AVO/move_out.php',{
						source			: from,
						dest			: from+"/data_out",
						match			: ".out"
					})
					.done(function(){
						$.post('convertie/AVO/move_out.php',{
							source			: from,
							dest			: from+"/data_t",
							match			: ".t"
						})
						.done(function(){
							load_result.show();
							$.post('convertie/AVO/sd_evn_avo.php',function(data_load){load_result.append(data_load+"<br/>");})
							.done(function(){
								window.location.replace("convertie/AVO/"+from+"/sd_evn_avo_file.zip");
							})
							.done(function(){
								$.post('convertie/AVO/clean_dir.php',{dir_to_clean : from});
							});
						})
					});					
				}
			});

		}
		$('input[type=file]').trigger('click');		
	
		});
	
	});	
	</script>

<div id = "whole_div">

	<h2>Conversion of Customary-format Data </h2>
	<p><blockquote>Input: monitoring data, following a specific format which already listed in the WOVOdat </blockquote></p>
	<br/>	
	<form name = "submit_form" id = "submit_form" action = "" method = "post" enctype = "multipart/form-data">
	
        <div class = "field_data">
            <p>Observatory (data owner): </p>
            <select name='owner1' id='observatory' class = "dropdown_list">
            	<option selected="selected" value="ANSS">USA, AVO</option>
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
				<option value="Seismic_Event">Seismic Event</option>
			</select>
			<br/><br/>		
		</div>

		<div style="float:left;">
			<div style="padding-left:20px;">
				Browse files to convert:<br/>
				<input name="file[]" id="file_input" type="file" multiple="multiple"/>
				<br/><br/>
				<input type="submit" name="submit" id="submit_button" value="Select files"/>
			</div>
		</div>  
				
	</form> 	
</div>
<br/><br/><br/><br/><br/><br/>
<pre id="load_track"></pre>

</html>
