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
	}	
	
	
</script>

		<!-- Page content -->
		<div class="form">
		
		<h3>Upload online form for gas station (Table Name: gs) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>
		
		<form method="post" action="insertSwitch.php" name="form_gs" id="form_gs">
			
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
						<input type="text" maxlength="30" id="gs_code" name="gs_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Station Name:</span></td>
					<td>
						<input type="text" maxlength="50" id="gs_name" name="gs_name" value="" />
					</td>
				</tr>				
						

				<tr>
					<td><span class="formFont">Latitude:</span></td>
					<td>
						<input type="text" id="gs_lat" name="gs_lat" value="" />
					</td>
				</tr>	
				
				
				<tr>
					<td><span class="formFont">Longitude:</span></td>
					<td>
						<input type="text" id="gs_lon" name="gs_lon" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Elevation:</span></td>
					<td>
						<input type="text" id="gs_elev" name="gs_elev" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Permanent instruments list:</span></td>
					<td>
						<input type="text" maxlength="255" id="gs_inst" name="gs_inst" value="" />
					</td>
				</tr>		 
				<tr>
					<td><span class="formFont">Type of gas body:</span></td>
					<td>
						<input type="text" maxlength="255" id="gs_type" name="gs_type" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">UTC:</span></td>
					<td>
						<input type="text" id="gs_utc" name="gs_utc" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="gs_stime" name="gs_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="gs_stime_unc" name="gs_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="gs_etime" name="gs_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="gs_etime_unc" name="gs_etime_unc" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">Description:</span></td>
					<td>
						<textarea id="gs_desc" name="gs_desc" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>

				
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="gs_ori" name="gs_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="gs_com" name="gs_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="gs_loaddate" name="gs_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="gs_pubdate" name="gs_pubdate" value="" />
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