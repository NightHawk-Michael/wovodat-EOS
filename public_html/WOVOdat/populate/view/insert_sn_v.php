<?php
function showUpdateTableList($obs,$cbs){

echo <<<HTMLBLOCK
<script language='javascript' type='text/javascript'>

	function getVol(val) {

		$("#vd_id").html("<option value=''>Select Volcano</option>");
		
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
	
</script>

		<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for seismic Network (Table Name: sn) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>	
		
		<form method="post" action="insertSwitch.php" name="form_sn" id="form_sn">
			
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
					<td><span class="formFont">*Unique Code:</span></td>
					<td>
						<input type="text" maxlength="30" id="sn_code" name="sn_code" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Network Name:</span></td>
					<td>
						<input type="text" maxlength="30" id="sn_name" name="sn_name" value="" />
					</td>
				</tr>				
				
				<tr>
					<td><span class="formFont">Description of velocity model:</span></td>
					<td>
						<input type="text" maxlength="511" id="sn_vmodel" name="sn_vmodel" value="" />
					</td>
				</tr>			


				<tr>
					<td><span class="formFont">Additional details about velocity model:</span></td>
					<td>
						<input type="text" maxlength="255" id="sn_vmodel_detail" name="sn_vmodel_detail" value="" />
					</td>
				</tr>			

				<tr>
					<td><span class="formFont">Elevation of zero km :</span></td>
					<td>
						<input type="text" maxlength="255" id="sn_zerokm" name="sn_zerokm" value="" />
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">*Is it fixed depth:</span></td>
					<td>
						<select id="sn_fdepth_flag" name="sn_fdepth_flag" style='width:200px;color:black;'>
							<option value="">Select Fixed Depth</option>
							<option value="Y">Yes</option>
							<option value="N">No</option>
							<option value="U">Unknown</option>
						</select>	
					</td>
				</tr>	
				
				<tr>
					<td><span class="formFont">Fixed depth description:</span></td>
					<td>
						<input type="text" maxlength="255" id="sn_fdepth" name="sn_fdepth" value="" />
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">*Start time:</span></td>
					<td>
						<input type="text" id="sn_stime" name="sn_stime" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Start time uncertainty:</span></td>
					<td>
						<input type="text" id="sn_stime_unc" name="sn_stime_unc" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">End time:</span></td>
					<td>
						<input type="text" id="sn_etime" name="sn_etime" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">End time uncertainty:</span></td>
					<td>
						<input type="text" id="sn_etime_unc" name="sn_etime_unc" value="" />
					</td>
				</tr>

				
				<tr>
					<td><span class="formFont">Total number of seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_tot" name="sn_tot" value="" />
					</td>
				</tr>				
								
				<tr>
					<td><span class="formFont">Number of broadband seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_bb" name="sn_bb" value="" />
					</td>
				</tr>						

				<tr>
					<td><span class="formFont">Number of short- and mid-period seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_smp" name="sn_smp" value="" />
					</td>
				</tr>		

				<tr>
					<td><span class="formFont">Number of digital seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_digital" name="sn_digital" value="" />
					</td>
				</tr>		 				

				<tr>
					<td><span class="formFont">Number of analog seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_analog" name="sn_analog" value="" />
					</td>
				</tr>


				<tr>
					<td><span class="formFont">Number of 3 component seismometers:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_tcomp" name="sn_tcomp" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Number of microphones:</span></td>
					<td>
						<input type="text" maxlength="3" id="sn_micro" name="sn_micro" value="" />
					</td>
				</tr>

				<tr>
					<td><span class="formFont">Description:</span></td>
					<td>
						<textarea id="sn_desc" name="sn_desc" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>

				<tr>
					<td><span class="formFont">UTC:</span></td>
					<td>
						<input type="text" id="sn_utc" name="sn_utc" value="" />
					</td>
				</tr>
				
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<select id="sn_ori" name="sn_ori" style='width:200px;color:black;'>
							<option value="">Select the source of data</option>
							<option value="D">Digitized/Bibliography</option>
							<option value="O">Original from observatory</option>
						</select>	
					</td>
				</tr>					
				
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<textarea id="sn_com" name="sn_com" cols="30" rows="2" maxlength="255"></textarea>
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
		
				<input type="hidden" id="sn_loaddate" name="sn_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="sn_pubdate" name="sn_pubdate" value="" />
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