<?php
function showUpdateTableList($obs,$cbs){

echo <<<HTMLBLOCK
<script language='javascript' type='text/javascript'>

	function getVol(val) {

		$("#vd_id").html("<option value=''>Select Volcano</option>");
		$("#sn_id").html("<option value=''>Select Network</option>");
		$("#ss_id").html("<option value=''>Select Station</option>");
		
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

		$("#sn_id").html("<option value=''>Select Network</option>");
		$("#ss_id").html("<option value=''>Select Station</option>");

		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'networkListByJson='+val,  
			
			success: function(data){
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#sn_id").append("<option value='"+result.sn_id+"'>"+result.sn_name+"</option>");
					});	
				}else{
					$("#sn_id").html("<option value=''>No Network found</option>");
				}	
			}  
		});   
	}	
	
	function getStation(val) {

		$("#ss_id").html("<option value=''>Select Station</option>");

		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'table1=sn&table2=ss&stationListByJson='+val,  

			success: function(data){  
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#ss_id").append("<option value='"+result.ss_id+"'>"+result.ss_name+"</option>");
					});	
				}else{
					$("#ss_id").html("<option value=''>No station found</option>");
				}	
			}  
		});  
	}	


	function getInstrument(val) {

		$("#si_id").html("<option value=''>Select Instrument</option>");

		$.ajax({
			type: "POST",
			url: "../convertie/model/commonInsertForm_m.php",
			
			data:'instrumentListByJson='+val,  

			success: function(data){  
				var results = $.parseJSON(data);
				
				if(results != ""){
				
					$.each(results, function(i, result) {
						$("#si_id").append("<option value='"+result.si_id+"'>"+result.si_name+"</option>");
					});	
				}else{
					$("#si_id").html("<option value=''>No instrument found</option>");
				}	
			}  
		});  
	}	
	
</script>

		<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for seismic Component (Table Name: si_cmp) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>	
		
		<form method="post" action="insertSwitch.php" name="form_si_cmp" id="form_si_cmp">
			
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
						<select id="sn_id" name="sn_id" onChange="getStation(this.value);" style='width:200px;color:black;'>
							<option value="">Select Network</option>
						</select>	
					</td>
				</tr>

				
				<tr>
					<td><span class="formFont">*Station Name:</span></td>  
					<td>
						<select id="ss_id" name="ss_id" onChange="getInstrument(this.value);" style='width:200px;color:black;'>
							<option value="">Select Station</option>
						</select>	
					</td>
				</tr>				

				<tr>
					<td><span class="formFont">*Instrument Name:</span></td>  
					<td>
						<select id="si_id" name="si_id" style='width:200px;color:black;'>
							<option value="">Select Instrument</option>
						</select>	
					</td>
				</tr>	
				
				<tr>
					<td><span class="formFont">*Unique Code:</span></td>
					<td>
						<input type="text" maxlength="30" id="si_cmp_code" name="si_cmp_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Instrument Component Name:</span></td>
					<td>
						<input type="text" maxlength="255" id="si_cmp_name" name="si_cmp_name" value="" />
					</td>
				</tr>				
				
				<tr>
					<td><span class="formFont">Instrument type:</span></td>
					<td>
						<input type="text" maxlength="255" id="si_cmp_type" name="si_cmp_type" value="" />
					</td>
				</tr>			


				<tr>
					<td><span class="formFont">Description of response:</span></td>
					<td>
						<input type="text" maxlength="255" id="si_cmp_resp" name="si_cmp_resp" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Band type (SEED convention):</span></td>
					<td>
						<input type="text" maxlength="255" id="si_cmp_band" name="si_cmp_band" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Sampling rate:</span></td>
					<td>
						<input type="text" id="si_cmp_samp" name="si_cmp_samp" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Instrument code (SEED convention):</span></td>
					<td>
						<input type="text" maxlength="30" id="si_cmp_icode" name="si_cmp_icode" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Orientation code (SEED convention):</span></td>
					<td>
						<input type="text" maxlength="30" id="si_cmp_orient" name="si_cmp_orient" value="" />
					</td>
				</tr>					
			
			
				<tr>
					<td><span class="formFont">Sensitivity:</span></td>
					<td>
						<input type="text" maxlength="255" id="si_cmp_sens" name="si_cmp_sens" value="" />
					</td>
				</tr>				

				<tr>
					<td><span class="formFont">Depth:</span></td>
					<td>
						<input type="text" id="si_cmp_depth" name="si_cmp_depth" value="" />
					</td>
				</tr>	

				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="si_cmp_ori" name="si_cmp_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="si_cmp_com" name="si_cmp_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="si_cmp_loaddate" name="si_cmp_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">*Publish Date:</span></td>
					<td>
						<input type="text" id="si_cmp_pubdate" name="si_cmp_pubdate" value="" />
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