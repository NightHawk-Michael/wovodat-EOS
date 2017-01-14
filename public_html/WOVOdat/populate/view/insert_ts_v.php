<?php
function showUpdateTableList($obs,$cbs){

echo <<<HTMLBLOCK
<script language='javascript' type='text/javascript'>

	function getVol(val) {

		$("#vd_id").html("<option value=''>Select Volcano</option>");
		$("#cn_id").html("<option value=''>Select Network</option>");

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
	}
	
	
	function getNetwork(val) {

		$("#cn_id").html("<option value=''>Select Network</option>");
		
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
	}	
	
	
</script>

	<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for thermal station (Table Name: ts) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>	
		
		<form method="post" action="insertSwitch.php" name="form_ts" id="form_ts">
			
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
						<select id="vd_id" name="vd_id" onChange="getNetwork(this.value);" style='width:200px;color:black;'>
							<option value="">Select Volcano</option>
						</select>	
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Network Name:</span></td>
					<td>
						<select id="cn_id" name="cn_id" style='width:200px;color:black;'>
							<option value="">Select Network</option>
						</select>	
					</td>
				</tr>

	
				<tr>
					<td><span class="formFont">*Unique Code:</span></td>
					<td>
						<input type="text" maxlength="30" id="ts_code" name="ts_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Station Name:</span></td>
					<td>
						<input type="text" maxlength="30" id="ts_name" name="ts_name" value="" />
					</td>
				</tr>				
						
				<tr>
					<td><span class="formFont">Type of thermal feature:</span></td>
					<td>
						<input type="text" maxlength="255" id="ts_type" name="ts_type" value="" />
					</td>
				</tr>	

				<tr>
					<td><span class="formFont">Soil or ground type:</span></td>
					<td>
						<input type="text" maxlength="255" id="ts_ground" name="ts_ground" value="" />
					</td>
				</tr>					
						
				<tr>
					<td><span class="formFont">Latitude:</span></td>
					<td>
						<input type="text" id="ts_lat" name="ts_lat" value="" />
					</td>
				</tr>	
				
				
				<tr>
					<td><span class="formFont">Longitude:</span></td>
					<td>
						<input type="text" id="ts_lon" name="ts_lon" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Elevation:</span></td>
					<td>
						<input type="text" id="ts_elev" name="ts_elev" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">List of permanent instruments:</span></td>
					<td>
						<input type="text" maxlength="255" id="ts_perm" name="ts_perm" value="" />
					</td>
				</tr>		 
				
				<tr>
					<td><span class="formFont">UTC:</span></td>
					<td>
						<input type="text" id="ts_utc" name="ts_utc" value="" />
					</td>
				</tr>	
				
				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="ts_stime" name="ts_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="ts_stime_unc" name="ts_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="ts_etime" name="ts_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="ts_etime_unc" name="ts_etime_unc" value="" />
					</td>
				</tr>

			
				<tr>
					<td><span class="formFont">Description:</span></td>
					<td>
						<textarea id="ts_desc" name="ts_desc" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>

				
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="ts_ori" name="ts_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="ts_com" name="ts_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="ts_loaddate" name="ts_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="ts_pubdate" name="ts_pubdate" value="" />
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