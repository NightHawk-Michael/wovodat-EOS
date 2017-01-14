<?php
function showUpdateTableList($obs,$cbs){

echo <<<HTMLBLOCK
<script language='javascript' type='text/javascript'>

	function getVol(val) {

		$("#vd_id").html("<option value=''>Select Volcano</option>");
		$("#cn_id").html("<option value=''>Select Network</option>");
		$("#ms_id").html("<option value=''>Select Station</option>");
		
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
		$("#ms_id").html("<option value=''>Select Station</option>");
		
		$.ajax({
				type: "POST",
				url: "../convertie/model/commonInsertForm_m.php",
				
				data:'type=Meteo&commonNetworkListByJson='+val,  
				
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
	
	function getStation(val) {

		$("#ms_id").html("<option value=''>Select Station</option>");

		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'table1=cn&table2=ms&stationListByJson='+val,  
			
			success: function(data){  
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#ms_id").append("<option value='"+result.ms_id+"'>"+result.ms_name+"</option>");
					});	
				}else{
					$("#ms_id").html("<option value=''>No station found</option>");
				}	
			}  
		});  
	}	
	
</script>

		<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for meteo instrument (Table Name: mi) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>		
		
		<form method="post" action="insertSwitch.php" name="form_mi" id="form_mi">
			
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
						<select id="cn_id" name="cn_id" onChange="getStation(this.value);" style='width:200px;color:black;'>
							<option value="">Select Network</option>
						</select>	
					</td>
				</tr>

			
				<tr>
					<td><span class="formFont">*Station Name:</span></td>  
					<td>
						<select id="ms_id" name="ms_id" style='width:200px;color:black;'>
							<option value="">Select Station</option>
						</select>	
					</td>
				</tr>				

				<tr>
					<td><span class="formFont">*Unique Code:</span></td>
					<td>
						<input type="text" maxlength="30" id="mi_code" name="mi_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Instrument Name:</span></td>
					<td>
						<input type="text" maxlength="255" id="mi_name" name="mi_name" value="" />
					</td>
				</tr>				
				
				<tr>
					<td><span class="formFont">Instrument type:</span></td>
					<td> 
						<input type="text" maxlength="50" id="mi_type" name="mi_type" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Measured units:</span></td>
					<td>
						<input type="text" maxlength="50" id="mi_units" name="mi_units" value="" />
					</td>
				</tr>				
				
				<tr>
					<td><span class="formFont">Resolution:</span></td>
					<td>
						<input type="text" id="mi_res" name="mi_res" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="mi_stime" name="mi_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="mi_stime_unc" name="mi_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="mi_etime" name="mi_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="mi_etime_unc" name="mi_etime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Description:</span></td>
					<td>
						<textarea id="mi_desc" name="mi_desc" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>				
				
				
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="mi_ori" name="mi_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="mi_com" name="mi_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="mi_loaddate" name="mi_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="mi_pubdate" name="mi_pubdate" value="" />
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