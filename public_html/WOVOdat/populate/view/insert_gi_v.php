<?php
function showUpdateTableList($obs,$cbs){

echo <<<HTMLBLOCK
<script language='javascript' type='text/javascript'>

$(document).ready(function(){

	$("#sta_borne_select").change(function(){
	
		var instrType = $("select#sta_borne_select").val();
		
		reset();

		$('#satelliteSpan').css("display","none");
		$('#cs_id').css("display","none");
			
		if(instrType == 'g'){
			$('#satelliteSpan').css("display","none");
		    $('#cs_id').css("display","none");
			$("#cs_id").html("<option value=''>Select Airborne</option>");
			
			<!-- Enable network first -->
			$('#networkSpan').css("display","block");
			$('#cn_id').css("display","block");
			$("#cn_id").html("<option value=''>Select Network</option>");
						
			var val = $("select#vd_id").val();
		
			$.ajax({
				type: "POST",
				url: "../convertie/model/commonInsertForm_m.php",
				
				data:'type=Gas&commonNetworkListByJson='+val,  
				
				success: function(data){
					var results = $.parseJSON(data);
					
					if(results != ""){
					
						$.each(results, function(i, result) {
							$("#cn_id").append("<option value='"+result.cn_id+"'>"+result.cn_name+"</option>");
						});	
					}else{
						$("#cn_id").html("<option value=''>No Network found</option>");
					}	
				}  
			}); 

		}else if(instrType == 's'){
		
			reset();
			$("#cn_id").html("<option value=''>Select Network</option>");
			$("#gs_id").html("<option value=''>Select station</option>");
			
			<!-- Enable satellite -->
			$('#satelliteSpan').css("display","block");
		    $('#cs_id').css("display","block");
			$("#cs_id").html("<option value=''>Select Airborne</option>");

			$.ajax({
				type: "POST",
				url: "../convertie/model/commonInsertForm_m.php",
				
				data:'satelliteListByJson=flag',  
				
				success: function(data){  
					var results = $.parseJSON(data);
					
					if(results != ""){
					
						$.each(results, function(i, result) {
							$("#cs_id").append("<option value='"+result.cs_id+"'>"+result.cs_name+"</option>");
						});	
					}else{
						$("#cs_id").html("<option value=''>No airborne found</option>");
					}	
				}  
			}); 
		}
		
	});	
		
		
	$("#cn_id").change(function(){
		
		<!-- Enable station -->
		$('#stationSpan').css("display","block");
		$('#gs_id').css("display","block");
		
		$("#gs_id").html("<option value=''>Select station</option>");
		
		var val = $("select#cn_id").val();
		
		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'table1=cn&table2=gs&stationListByJson='+val,  
			
			success: function(data){  
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#gs_id").append("<option value='"+result.gs_id+"'>"+result.gs_name+"</option>");
					});	
				}else{
					$("#gs_id").html("<option value=''>No station found</option>");
				}	
			}  
		});
		
	});	
	
	$("#vd_id").change(function(){
		
		reset();
		$('#satelliteSpan').css("display","none");
		$('#cs_id').css("display","none");
		
		$('select option[value="sta_borne_default"]').attr("selected",true);
		$("#cn_id").html("<option value=''>Select Network</option>");
		$("#gs_id").html("<option value=''>Select station</option>");
		$("#cs_id").html("<option value=''>Select Airborne</option>");
	
	});	
	
	
	$("#cc_id").change(function(){
	
		var val = $("select#cc_id").val();

		reset();
		$('#satelliteSpan').css("display","none");
		$('#cs_id').css("display","none");
		$("#vd_id").html("<option value=''>Select Volcano</option>");
		$('select option[value="sta_borne_default"]').attr("selected",true);
		
		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'volListByJson='+val,
			
			success: function(data){
				var results = $.parseJSON(data);
				
				if(results != ""){
					$.each(results, function(i, result) {
						$("#vd_id").append("<option value='"+result.vd_id+"'>"+result.vd_name+"</option>");
					});	
				}else{
					$("#vd_id").html("<option value=''>No Volcano</option>");
				}	
			}  
		});  
		
	});	
	
});	
	
	function reset(){
		$('#networkSpan').css("display","none");
		$('#cn_id').css("display","none");
		$('#stationSpan').css("display","none");
		$('#gs_id').css("display","none");	
	
	}
</script>

	<!-- Page content -->
	<div class="form">
		
		<h3>Upload online form for gas instrument (Table Name: gi) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>
		
		<form method="post" action="insertSwitch.php" name="form_gi" id="form_gi">
			
			<table class="formtable" id="formtable">

				<tr>
					<td><span class="formFont">*Institution/Observatory:</span></td>
					<td>
						<select id="cc_id" name="cc_id" onChange="getVol(this.value);" style='width:200px;color:black;'>
							<option value="">Select Institution/Obs.</option>
HTMLBLOCK;

							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]},{$obs[$i][2]} </option>";
							}	
echo <<<HTMLBLOCK
						</select>
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Volcano Name:</span></td>
					<td>
						<select id="vd_id" name="vd_id" style='width:200px;color:black;'>
							<option value="">Select Volcano</option>
						</select>	
					</td>
				</tr>

				<tr>
					<td><span class="formFont">*Instrument from ground based (or) satellite:</span></td>  
					<td>
						<select id="sta_borne_select" name="sta_borne_select" style='width:200px;color:black;'>
							<option value="sta_borne_default">Select one the options</option>
							<option value="g">Ground based instrument</option>
							<option value="s">Airborne instrument</option>
						</select>	
					</td>
				</tr>	
				             
				<tr>
					<td><span id="networkSpan" class="formFont" style="display:none;">*Network Name:</span></td>
					<td>
						<select id="cn_id" name="cn_id" style="display:none;width:200px;color:black;">
							<option value="">Select Network</option>
						</select>	
					</td>
				</tr>

			
				<tr>
					<td><span id="stationSpan" class="formFont" style="display:none;">*Station Name:</span></td>  
					<td>
						<select id="gs_id" name="gs_id" style="display:none;width:200px;color:black;">
							<option value="">Select Station</option>
						</select>	
					</td>
				</tr>				
	
				<tr>
					<td><span id="satelliteSpan" class="formFont" style="display:none;">*Satellite Name:</span></td>  
					<td>
						<select id="cs_id" name="cs_id" style="display:none;width:200px;color:black;">
							<option value="">Select Satellite</option>
						</select>	
					</td>
				</tr>	
				
				<tr>
					<td><span class="formFont">*Unique Code:</span></td>
					<td>
						<input type="text" maxlength="30" id="gi_code" name="gi_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">Instrument type:</span></td>
					<td> 
						<input type="text" maxlength="255" id="gi_type" name="gi_type" value="" />
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">*Instrument Name:</span></td>
					<td>
						<input type="text" maxlength="255" id="gi_name" name="gi_name" value="" />
					</td>
				</tr>				
				
				<tr>
					<td><span class="formFont">Measured units:</span></td>
					<td>
						<input type="text" maxlength="50" id="gi_units" name="gi_units" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Resolution:</span></td>
					<td>
						<input type="text" id="gi_pres" name="gi_pres" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Signal to noise:</span></td>
					<td>
						<input type="text" id="gi_stn" name="gi_stn" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Calibration:</span></td>
					<td>
						<input type="text" maxlength="255" id="gi_calib" name="gi_calib" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="gi_stime" name="gi_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="gi_stime_unc" name="gi_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="gi_etime" name="gi_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="gi_etime_unc" name="gi_etime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Spatial resolution (km):</span></td>
					<td>
						<input type="text" maxlength="30" id="gi_spatres" name="gi_spatres" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Cross track size (km):</span></td>
					<td>
						<input type="text" id="gi_ctsize" name="gi_ctsize" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">Along track size (km):</span></td>
					<td>
						<input type="text" id="gi_atsize" name="gi_atsize" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">Swath width (ground projection) [km]:</span></td>
					<td>
						<input type="text" id="gi_swidth" name="gi_swidth" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Temporal resolution:</span></td>
					<td>
						<input type="text" maxlength="30" id="gi_tempres" name="gi_tempres" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Return time to the exact spot with the same viewing angle:</span></td>
					<td>
						<input type="text" maxlength="30" id="gi_rtime" name="gi_rtime" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Angle of view from nadir :</span></td>
					<td>
						<input type="text" id="gi_vangle" name="gi_vangle" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="gi_ori" name="gi_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="gi_com" name="gi_com" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>				
				
				
				<tr>
					<td><span class="formFont">Second Institution/Observatory:</span></td>
					<td>
						<select id="cc_id2" name="cc_id2" style='width:200px;color:black;'>
							<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]},{$obs[$i][2]}</option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>	
				<tr>
					<td><span class="formFont">Third Institution/Observatory:</span></td>
					<td>
						<select id="cc_id3" name="cc_id3" style='width:200px;color:black;'>
							<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]},{$obs[$i][2]} </option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>
		
				<input type="hidden" id="gi_loaddate" name="gi_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="gi_pubdate" name="gi_pubdate" value="" />
					</td>
				</tr>
				<input type="hidden" name="cc_id_load" value="{$_SESSION['login']['cc_id']}" />
				
				<tr>
					<td>
						<p class="formFont">Bibliographic:</p> 
						<p style="font-size:.7em;width:210px;">(Hold down the Ctrl to select multiple options)</p>  
					</td>
					<td>
						<select class="bibliographic" id="cb_ids" name="cb_ids[]" multiple style='color:black;'>
							<option value="">Select bibliographic</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($cbs); $i++){
							
								echo"<option value=\"{$cbs[$i][0]}\" title=\"{$cbs[$i][1]} ({$cbs[$i][2]}) {$cbs[$i][3]}\"> {$cbs[$i][1]} ({$cbs[$i][2]}) {$cbs[$i][3]}  </option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>
			</table>
			
			<div style="padding:20px 200px;" >
				<input type="button" id="back" name="back" value="Back to previous page" />
				<input type="submit" name="confirm" value="Confirm" />
			</div>
		</form>
		 
		</div>  <!-- end page content div -->

HTMLBLOCK;
}

?>