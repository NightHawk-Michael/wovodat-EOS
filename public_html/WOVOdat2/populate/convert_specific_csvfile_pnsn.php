<?php
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
	
	$(document).ready(function(){
			
		var observatory = $("#observatory").val();
/*		var latest_date = null;
		$.ajax({
			method: "GET",
			url: "get_latest_date.php",
			data: "observatory=" + observatory + "&data_type=Seismic_Event",
			dataType: "text",
			success: function(result) {
				console.log(result);
				latest_date = result;
			}
		});
*/
		$("#data_type").change(function() {
			reset_values(['start_date']);
			var data_type = $("#data_type").val();
			if (data_type == "Seismic_Event") {
				turn_on_display('div_start_date');
				return;
			}
		});

		function reset_values(list) {
			for(var i = 0; i < list.length; i++) {
				$("#" + list[i]).val('');
				turn_off_display('div_' + list[i]);
			}
		}

		function turn_on_display(id) {
			$('#' + id).css('display', 'block');
		}

		function turn_off_display(id) {
			$('#' + id).css('display', 'none');
		}

		$("#submit_form").submit(function() {
			var data_type = $("#data_type").val();
			if (!data_type) {
				alert("Please choose type of data to convert");
				return false;
			}
			if (data_type == 'Seismic_Event') {
/*				var start_date = $("#start_date").val();
				if (!start_date) {
					alert("Please choose a starting date");
					return false;
				}
				if (latest_date != null && start_date <= latest_date) {
					alert("The data for " + observatory + " in the database is up to " + latest_date + 
						". \n You should enter starting date after that");
					return false;
				}
*/
			}
			
			var file_name = $("#file_input").val();
			if (!file_name) {
				alert("Please choose a file to convert");

				return false;
			}

			var path = 'convertie/' + observatory + '/' + data_type + '/convert.php';
			$("#submit_form").attr('action', path);
			return true;
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
            	<option selected="selected" value="PNSN">USA, PNSN</option>
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

		<div id='uploadfile' style="float:left;">
			<div style="padding-left:20px;">
				Browse file to convert:<br/> 
				<input name="file_input" id="file_input" type="file">
				<br/><br/>
				<input type="submit" name="submit" id="submit_button" value="Select">
			</div>
		</div>  
				
	</form>  
</div>

</html>
