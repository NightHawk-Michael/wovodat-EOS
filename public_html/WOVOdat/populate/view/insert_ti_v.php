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
				
				data:'type=Thermal&commonNetworkListByJson='+val,  
				
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
			$("#ts_id").html("<option value=''>Select station</option>");
			
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
		$('#ts_id').css("display","block");
		
		$("#ts_id").html("<option value=''>Select station</option>");
		
		var val = $("select#cn_id").val();
		
		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'table1=cn&table2=ts&stationListByJson='+val,  
			
			success: function(data){  
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#ts_id").append("<option value='"+result.ts_id+"'>"+result.ts_name+"</option>");
					});	
				}else{
					$("#ts_id").html("<option value=''>No station found</option>");
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
		$("#ts_id").html("<option value=''>Select station</option>");
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
		$('#ts_id').css("display","none");	
	
	}

	
</script>

		<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for thermal instrument (Table Name: ti) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>	
		
		<form method="post" action="insertSwitch.php" name="form_ti" id="form_ti">
			
			<table class="formtable" id="formtable">

				<tr>
					<td><span class="formFont">*Institution/Observatory:</span></td>
					<td>
						<select id="cc_id" name="cc_id" style='width:200px;color:black;'>
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
					<td><span id="station_airborne" class="formFont">*Instrument from ground based (or) satellite:</span></td>  
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
						<select id="ts_id" name="ts_id" style="display:none;width:200px;color:black;">
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
						<input type="text" maxlength="30" id="ti_code" name="ti_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">Instrument type:</span></td>
					<td> 
						<input type="text" maxlength="255" id="ti_type" name="ti_type" value="" />
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">*Instrument Name:</span></td>
					<td>
						<input type="text" maxlength="255" id="ti_name" name="ti_name" value="" />
					</td>
				</tr>				
				
		

				<tr>
					<td><span class="formFont">Measured units:</span></td>
					<td>
						<input type="text" maxlength="50" id="ti_units" name="ti_units" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Resolution:</span></td>
					<td>
						<input type="text" id="ti_pres" name="ti_pres" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Signal to noise:</span></td>
					<td>
						<input type="text" id="ti_stn" name="ti_stn" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="ti_stime" name="ti_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="ti_stime_unc" name="ti_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="ti_etime" name="ti_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="ti_etime_unc" name="ti_etime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="ti_ori" name="ti_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="ti_com" name="ti_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="ti_loaddate" name="ti_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="ti_pubdate" name="ti_pubdate" value="" />
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