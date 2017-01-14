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
	
	function time_now_notutc(){
		var d = new Date();
		var now = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(); 
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
	
	function choose_lat_lon(lat_lon1,lat_lon2){
		if(lat_lon1){
			return lat_lon1;
		}
		else{ 
			return lat_lon2;
		}
	}
	
	$(function(){
	
	var volcano = $('volcano select');
	volcano.prepend("<option>Select volcano</option>");
	volcano.val("Select Volcano");
	
	var station = $('station select');
	station.prepend("<option value='no_station' my_id=''>Select station</option>");
	station.val("Select station");
	
	var station_folder = station.val();
	station.change(function(){
		station_folder = station.val();
	});
	
	var cavw = 0;
	var cc_id = 0;
	var vd_id = 0;
	volcano.change(function(){
		cavw = volcano.find('option:selected').attr('my_id');
		
		var dir_upload = "../../../../../region/"+cavw.substring(0, 2)+"/"+cavw.substring(2, 4)+"/cm";
		var up1 = $('#up1');
		var up2 = $('#up2');
		var us1 = $('#us1');
		var us2 = $('#us2');
		
		function up1call(){
			var latlon = station.find('option:selected').attr('my_id');
			var lat_lon1 = latlon.split(":");
			latlon = volcano.find('option:selected').attr('my_id2');
			var lat_lon2 = latlon.split(":");
			cc_id = lat_lon2[3];
			vd_id = lat_lon2[2];
		
			var x = document.getElementById("myFile2");
			if ('files' in x) {
				for (var i = 0; i < x.files.length; i++) {
					var file = x.files[i];
					var date = new Date(file.lastModified);
					date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
						vol_input_one.eq(1).val(date);
						vol_input_one.eq(2).val(choose_lat_lon(lat_lon1[0],lat_lon2[0]));
						vol_input_one.eq(3).val(choose_lat_lon(lat_lon1[1],lat_lon2[1]));
				}
				$( ".timestamp" ).datepicker().val();
			}				
		}

		function up2call(){
			var latlon = station.find('option:selected').attr('my_id');
			var lat_lon1 = latlon.split(":");
			latlon = volcano.find('option:selected').attr('my_id2');
			var lat_lon2 = latlon.split(":");
			cc_id = lat_lon2[3];
			vd_id = lat_lon2[2];
			
			var x = document.getElementById("myFile");
			if ('files' in x) {
				for (var i = 0; i < x.files.length; i++) {
					var file = x.files[i];
					var date = new Date(file.lastModified);
					date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
					multiple_image_table.append(
						"<tr>"+
						"<td><input class='timestamp' type='text' value='"+date+"'/></td>"+
						"<td><input type='text' value='"+choose_lat_lon(lat_lon1[0],lat_lon2[0])+"'/></td>"+
						"<td><input type='text' value='"+choose_lat_lon(lat_lon1[1],lat_lon2[1])+"'/></td>"+
						"<td><input type='text' /></td>"+
						"<td><input type='text' /></td>"+
						"<td><input type='text' /></td>"+
						"<td><input type='text' value='"+file.name+"' readonly/></td>"+
						"</tr>"
					);
				}
				$( ".timestamp" ).datepicker().val();
			}				
		}
		
		//upload(up1,us1,browse.eq(0),dir_upload,up1call);
		upload(up2,us2,browse.eq(1),dir_upload,up2call);
		
	});
	
	function upload(upload_button,submit_button,input_type_file,directory,callback){
		upload_button.click(function() {
			var files;
			input_type_file.on('change', prepareUpload);
			function prepareUpload(event){
			  files = event.target.files;
			  var names = $.map(files, function(val) { return val.name; });	
			  callback();			  
			}
			
			submit_button.on('click',uploadFiles);

			function uploadFiles(){
				var data = new FormData();
				$.each(files, function(key, value){
					data.append(key, value);
				});

				$.ajax({
					url: "helpers/multiple_file_upload.php?files&upload_dir="+directory,
					type: 'POST',
					data: data,
					cache: false,
					success : moves,
					dataType: 'json',
					processData: false, 
					contentType: false
				})
				
				function moves(){					
					var file_names = [];
					var file_dates = [];
					var	Latitudes = []; 	
					var	Longitudes = [];
					var	Usages = [];	
					var	Descriptions	= [];
					var	Keywordss = [];
					var table_tr = multiple_image_table.find('tr');	
					var file_date = table_tr.find('td:nth-child(1)').find('input');
					var file_name = table_tr.find('td:nth-child(7)').find('input');
					var	Latitude = table_tr.find('td:nth-child(2)').find('input');	
					var	Longitude = table_tr.find('td:nth-child(3)').find('input');
					var	Usage = table_tr.find('td:nth-child(4)').find('input');	
					var	Description = table_tr.find('td:nth-child(5)').find('input');
					var	Keywords = table_tr.find('td:nth-child(6)').find('input');
					
					var len_row = file_date.length; 
					for(var ik=0;ik<len_row;ik++){
						file_dates[ik] = file_date.eq(ik).val();
						file_names[ik] = file_name.eq(ik).val();
						Latitudes[ik] = Latitude.eq(ik).val();
						Longitudes[ik] = Longitude.eq(ik).val();
						Usages[ik] = Usage.eq(ik).val();	
						Descriptions[ik]	= Description.eq(ik).val();
						Keywordss[ik] = Keywords.eq(ik).val();
					}					
					$.post('helpers/move_image_data.php',{
						source			  : directory,
						file_names		  : file_names,
						file_dates		  : file_dates,
						station			  : station_folder,
						Latitudes		  : Latitudes,
						Longitudes		  : Longitudes,
						Usages			  : Usages,
						Descriptions	  : Descriptions,
						Keywordss		  : Keywordss,
						vd_id			  : vd_id,
						volcano			  : volcano.val(),
						cc_id			  : cc_id,
						cavw			  : cavw,
						source2			  : cavw.substring(0, 2)+"/"+cavw.substring(2, 4)+"/cm",
						cm_loaddate 	  : date_now(),
						cm_pubdate 		  : date_now()						
					},function(feedback){
						alert(feedback);
					})					
				};

			}
			input_type_file.trigger('click');							
		});		
	}
	
	$('#Back').click(function(){
		window.location="http://www.wovodat.org/populate/home_populate.php?back_to_previous=yes";
	});
	
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd '+time_now_notutc(),
		changeMonth: true,
		changeYear: true,
		yearRange:  parseFloat(year()-500)+":"+parseFloat(year()+100)
	});
   $( "#time1" ).datepicker().val();
   
   var vol_input_one = $('#single_volcano input');
   //vol_input_one.wru();
   var volcano_div = $('.single_volcano, .multiple_volcano');
   volcano_div.eq(0).hide();
   var upload_mode = $('#upload_mode');
   var browse = $('input[type=file]');
   browse.hide();
   var multiple_image_table = $('.multiple_volcano table');
   //multiple_image_table.wru();
   
   //upload_mode.find('input[type=radio]').change(function(){
	   //var this_now = upload_mode.find('input[type=radio]');
	   //volcano_div.hide();
	   //volcano_div.eq(this_now.index($(this))).show();
   //}); 

   
	});
	</script>
	<style>
	volcano select, station select {
		width : 150px;
	}
	volcano label, station label {
		width : 80px;
	}
	#single_volcano input {
		width : 200px;
	}
	#single_volcano td:nth-child(1) {
		width : 200px;
	}
	.multiple_volcano input{
		width : 145px;
	}
	</style>
</head>
<body>
<h3 align='center' class='text-success'>UPLOAD VOLCANO PHOTOS</h3><br/><br/>
	<div>
		<volcano>
			<label><sup>*</sup>Volcano :</label>
			<?php 
				create_dropdown_from_rows(query_mysql("SELECT vd_name, vd_cavw, CONCAT(vd_inf_slat,':',vd_inf_slon,':',vd.vd_id,':',vd.cc_id) 
													   FROM vd, vd_inf 
													   WHERE vd.vd_id = vd_inf.vd_id ORDER BY vd_name"));
			?> 
		</volcano>
		<br/><br/>
		<station>
			<label><sup>*</sup>Station :</label>
			<?php 
				create_dropdown_from_rows(query_mysql("
				SELECT * FROM (
					 (SELECT ds_code as code, CONCAT(ds_nlat,':',ds_nlon) FROM ds)
						UNION ALL
					 (SELECT ss_code as code, CONCAT(ss_lat,':',ss_lon) FROM ss)
						UNION ALL
					 (SELECT ms_code as code, CONCAT(ms_lat,':',ms_lon) FROM ms)
						UNION ALL
					 (SELECT hs_code as code, CONCAT(hs_lat,':',hs_lon) FROM hs)
						UNION ALL
					 (SELECT gs_code as code, CONCAT(gs_lat,':',gs_lon) FROM gs)
						UNION ALL
					 (SELECT fs_code as code, CONCAT(fs_lat,':',fs_lon) FROM fs)
				) data
				ORDER BY code
				"));
			?> 
		</station>
		<br/><br/>
		<!--<ul id="upload_mode" style="list-style-type: none">
			<li><input type="radio" name="una"/>&nbsp Single photo/image upload</li>
			<li><input type="radio" name="una"/>&nbsp Multiple photos/images upload</li>
		</ul>-->
	</div>
	<br/>
	<div class="single_volcano">
		<label>Single photo/image upload</label><br/><br/>
		<ul>
			<table id="single_volcano">
				<tr><td>Browse image</td><td>:&nbsp <input id="up1" type="Submit" value="Browse"/></td></tr>
				<tr><td>Time</td><td>:&nbsp <input id="time1" type="text" placeholder="YYYY-MM-DD HH:MM:SS"/></td></tr>
				<tr><td>Geographic position - latitude </td><td>:&nbsp <input type="text" placeholder="XXX.XXXX"/></td></tr>
				<tr><td>Geographic position - longitude </td><td>:&nbsp <input type="text" placeholder="XXX.XXXX"/></td></tr>
				<tr><td>Usage </td><td>:&nbsp <input type="text" placeholder="Max 255 characters"/></td></tr>
				<tr><td>Description </td><td>:&nbsp <input type="text" placeholder="Max 255 characters"/></td></tr>
				<tr><td>Keywords </td><td>:&nbsp <input type="text" placeholder="comma separated words"/></td></tr>
				<tr><td>Comments </td><td>:&nbsp <input type="text" placeholder="comma separated words"/></td></tr>
			
			</table>
		</ul>
		<br/><br/>
		<input id="us1" type="submit" value="Submit" />
	</div>
	<div class="multiple_volcano">
		<label>Multiple photo/image upload</label>
		<br/><br/>
		<label>Browse image :</label><input id="up2" type="Submit" value="Browse"/>
		<br/><br/>
		<table id="multiple_volcano" class="table table-condensed" style="width:1100px;table-layout: fixed;">
			<tr><th>Time</th><th>Latitude</th><th>Longitude</th><th>Usage</th><th>Description</th><th>Keywords</th><th>Filename</th></tr>				
		</table>
		<br/><br/>
		<input id="us2" type="submit" value="Submit" />
	</div>
	<input id="myFile2" type="file" name="file1" />
	<input id="myFile" type="file" multiple="multiple" name="file2" />
</body>	
</html>

