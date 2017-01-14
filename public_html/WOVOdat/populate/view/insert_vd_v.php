<?php
function showUpdateTableList($vol,$obs){

$i="";

echo <<<HTMLBLOCK
		<!-- Page content -->
		
		<div class="form">
			
			<h3>Upload online form for Volcano Information (Table Name: vd) </h3>

			<span> (All fields * are required) </span>
		
			<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>

			<form method="post" action="insertSwitch.php" name="form_vd" id="form_vd">
			
				<table class="formtable" id="formtable">
		
					<tr>
						<th>*Volcano Name:</th>
						<td>
							<input type="text" maxlength="255" id="vd_name" name="vd_name" value="" />
						</td>
					</tr>
					
					<tr>
						<th>Volcano Second Name:</th>
						<td>
							<input type="text" maxlength="255" id="vd_name2" name="vd_name2" value="" />
						</td>
					</tr>
					
					<tr>
						<th>*Volcano CAVW:</th>
						<td>
							<input type="text" maxlength="15" id="vd_cavw" name="vd_cavw" value=""/></span>
						</td>
					</tr>
					
					<tr>
						<th>*Volcano Number:</th>
						<td>
							<input type="text" maxlength="6" id="vd_num" name="vd_num" value="" />
						</td>
					</tr>
					<tr>
						<th>Volcano Time Zone:</th>
						<td>
							<input type="text" id="vd_tzone" name="vd_tzone" value="" />
						</td>
					</tr>
		
					<tr>
						<th>Multiple contacts for this volcano:</th>
						<td>
							<input type="text" id="vd_mcont" name="vd_mcont" value="" maxlength="1"/>
						</td>
					</tr>
					<tr>
						<th>Comment:</th>
						<td>
							<textarea id="vd_com" name="vd_com" cols="30" rows="2" maxlength="255"></textarea>
						</td>
					</tr>
					<tr>
						<th>*Institution/Observatory:</th>
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
					
					<tr>
						<th>Second Institution/Observatory:</th>
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
						<th>Third Institution/Observatory:</th>
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
				
					<tr>
						<th>Fourth Institution/Observatory:</th>
						<td>
							<select id="cc_id4" name="cc_id4" style='width:200px;color:black;'>
								<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
								for($i=0; $i<sizeof($obs); $i++){
									echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]} </option>";
								}
echo <<<HTMLBLOCK
							</select>					
						</td>
					</tr>		
				
					<tr> 
						<th>Fifth Institution/Observatory:</th>
						<td>
							<select id="cc_id5" name="cc_id5" style='width:200px;color:black;'>
								<option value="">Select Institution/Obs.</option>
HTMLBLOCK;
								for($i=0; $i<sizeof($obs); $i++){
									echo"<option value=\"{$obs[$i][0]}\"> {$obs[$i][1]} - {$obs[$i][2]} </option>";
								}
echo <<<HTMLBLOCK
							</select>					
						</td>
					</tr>				
				
					<input type="hidden" id="vd_loaddate" name="vd_loaddate" value="" />
				
					<tr>
						<th>Publish Date:</th>
						<td>
							<input type="text" id="vd_pubdate" name="vd_pubdate" value="" />
						</td>
					</tr>
		
				</table>
			
				<div style="padding:20px 200px;" >
					<input type="hidden" name="cc_id_load" value="{$_SESSION['login']['cc_id']}" />
					<input type="button" id="back" name="back" value="Back to previous page" />
					<input type="submit" name="confirm" value="Confirm" />
				</div>
		
		</form>
		 
		</div>  <!-- end page content div -->
HTMLBLOCK;
}

?>