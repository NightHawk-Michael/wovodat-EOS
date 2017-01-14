<?php
function showUpdateTableList($vol,$obs,$cbs){

$i="";

echo <<<HTMLBLOCK
		<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for Buildup of magma pressure Information (Table Name: ip_pres) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>		
		
		<form method="post" action="insertSwitch.php" name="form_ip_pres" id="form_ip_pres">
			
			<table class="formtable" id="formtable">

				<tr>
					<td><span class="formFont">*Unique Code:</span> </td>
					
					<td>
						<input type="text" maxlength="30" id="ip_pres_code" name="ip_pres_code" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">*Volcano Name:</span></td>
					<td> 
					
						<select id="vd_id" name="vd_id" style='width:200px;color:black;'>
							<option value="">Select Volcano</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($vol); $i++){
								echo"<option value=\"{$vol[$i][0]}\"> {$vol[$i][1]} </option>";
							}
echo <<<HTMLBLOCK
						</select>
					</td>
				</tr>  
				<tr>
					<td><span class="formFont">Inference time:</span></td>
					<td>
						<input type="text" id="ip_pres_time" name="ip_pres_time" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">Inference time uncertainty:</span></td>
					<td>
						<input type="text" id="ip_pres_time_unc" name="ip_pres_time_unc" value="" />
					</td>
				</tr>				
				<tr>
					<td><span class="formFont">*Start Time:</span></td>
					<td>
						<input type="text" id="ip_pres_start" name="ip_pres_start" value="" />
					</td>
				</tr>
				<tr> 
					<td><span class="formFont">Start Time Uncertainty:</span></td>
					<td>
						<input type="text" id="ip_pres_start_unc" name="ip_pres_start_unc" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">End Time:</span></td>
					<td>
						<input type="text" id="ip_pres_end" name="ip_pres_end" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">End Time Uncertainty:</span></td>
					<td>
						<input type="text" id="ip_pres_end_unc" name="ip_pres_end_unc" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">*Gas-induced overpressure:</span></td>
					<td>
						<input type="radio" id="ip_pres_gas" name="ip_pres_gas" value="Y">Yes</input>
						<input type="radio" id="ip_pres_gas" name="ip_pres_gas" value="N">No</input>
						<input type="radio" id="ip_pres_gas" name="ip_pres_gas" value="M">Maybe</input>
						<input type="radio" id="ip_pres_gas" name="ip_pres_gas" checked="yes" value="U">Unknown</input>						
					</td>
				</tr>				
				<tr>
					<td><span class="formFont">*Tectonic overpressure:</span></td>
					<td>
						<input type="radio" id="ip_pres_tec" name="ip_pres_tec" value="Y">Yes</input>
						<input type="radio" id="ip_pres_tec" name="ip_pres_tec" value="N">No</input>
						<input type="radio" id="ip_pres_tec" name="ip_pres_tec" value="M">Maybe</input>
						<input type="radio" id="ip_pres_tec" name="ip_pres_tec" checked="yes" value="U">Unknown</input>						
					</td>
				</tr>					
				<tr>
					<td><span class="formFont">*Source of data:</span></td>
					<td>
						<input type="radio" id="ip_pres_ori" name="ip_pres_ori" value="D">Digitized/Bibliography</input>
						<input type="radio" id="ip_pres_ori" name="ip_pres_ori" value="O" checked="yes">Original from observatory</input>
					</td>
				</tr>				
				<tr>
					<td><span class="formFont">Comment:</span> </td>
					<td>
						<textarea id="ip_pres_com" name="ip_pres_com" cols="30" rows="2" maxlength="255"></textarea>
					</td>
				</tr>
				<tr>
					<td><span class="formFont">*Institution/Observatory:</span></td>
					<td>
						<select id="cc_id" name="cc_id" style='width:200px;color:black;'>
							<option value="">Select Observer.</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]} </option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>
				<tr>
					<td><span class="formFont">Second Institution/Observatory:</span></td>
					<td>
						<select id="cc_id2" name="cc_id2" style='width:200px;color:black;'>
							<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]}</option>";
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
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]} </option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>
		
				<input type="hidden" id="ip_pres_loaddate" name="ip_pres_loaddate" value="" />
				
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="ip_pres_pubdate" name="ip_pres_pubdate" value="" />
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