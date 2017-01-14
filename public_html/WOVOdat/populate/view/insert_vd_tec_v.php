<?php
function showUpdateTableList($vol,$obs,$cbs){

$i="";


echo <<<HTMLBLOCK
	<!-- Page content -->
		<div class="form">
			
		<h3>Upload online form for volcano tectonic setting information (Table Name: vd_tec) </h3>

		<span> (All fields * are required) </span>
	
		<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>	

		<form method="post" action="insertSwitch.php" name="form_vd_tec" id="form_vd_tec">
			
			<table class="formtable" id="formtable">
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
					<td><span class="formFont">Description:</span></td>
					<td>
						<input type="text" maxlength="255" id="vd_tec_desc" name="vd_tec_desc" value="" />
					</td>
				</tr>	
				<tr>
					<td><span class="formFont">Rate of strike-slip:</span>  </td>
					<td>
						<input type="text" id="vd_tec_strslip" name="vd_tec_strslip" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">Rate of extension:</span>  </td>
					<td>
						<input type="text" id="vd_tec_ext" name="vd_tec_ext" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">Rate of convergence:</span>  </td>
					<td>
						<input type="text" id="vd_tec_conv" name="vd_tec_conv" value="" />
					</td>
				</tr>	
				<tr>
					<td><span class="formFont">Travel rate across hotspot:</span>  </td>
					<td>
						<input type="text" id="vd_tec_travhs" name="vd_tec_travhs" value="" />
					</td>
				</tr>
				<tr>
					<td><span class="formFont">Comment:</span></td>
					<td>
						<input type="text" maxlength="255" id="vd_tec_com" name="vd_tec_com" value="" />
					</td>
				</tr>				
				<tr>
					<td><span class="formFont">*Institution/Observatory:</span></td>
					<td>
						<select id="cc_id" name="cc_id" style='width:200px;color:black;'>
							<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
							for($i=0; $i<sizeof($obs); $i++){
								echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]} </option>";
							}
echo <<<HTMLBLOCK
						</select>					
					</td>
				</tr>
				<input type="hidden" name="vd_tec_loaddate" value="" />
				<tr>
					<td><span class="formFont">Publish Date:</span></td>
					<td>
						<input type="text" id="vd_tec_pubdate" name="vd_tec_pubdate" value="" />
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