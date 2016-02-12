<?php
	// Start session
	session_start();
	// Regenerate session ID
	session_regenerate_id(true);
	$uname="";
	$ccd="";
?>

<?php
	if (isset($_SESSION['login'])) {
		$uname=$_SESSION['login']['cr_uname'];
		$ccd=$_SESSION['login']['cc_id'];
	}
?>

<html>

<style type="text/css">
label.error {font-size:12px; display:block; float: none; color: red;}
</style>

	<script src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>
	
	$(document).ready(function(){

		$("#observs").change(function(){
			update_volcanos();
		});	
		
		function update_volcanos(){  
			
			var institute=$('#observs').attr('value');
			$.get('./convertie/selectVolOfInstitute2_ng.php?orgObsFormat=orgObsFormat&kode='+institute, show_gunung);
		}
		
		function show_gunung(res){
			$('#volanos').html(res);
		}
		
	});
</script>

	<div style="padding:5px 0px 0px 5px;">
	<h2>Sending File</h2>
	<p>This page is for sending a file to the WOVOdat team.</p><br/>

	<!-- Form -->
	<form method="post" action="submit_file_check.php" name="upload_form" enctype="multipart/form-data">
		<table>
			<tr>
				<th>Observatory (data owner) : </th>
				<td>
					<div id='observos' style="float:left">
						<select name='observs' id='observs' style="width:160px">
						<option value="observatory">...</option>
<?php
							include 'php/include/db_connect_view.php';
							
							$result = mysql_query("select cc_code, cc_country, cc_obs, cc_id from cc order by cc_country");


							while ($v_arr = mysql_fetch_array($result)) {
								if(!is_numeric($v_arr[0])){
									$titles=htmlentities($v_arr[2], ENT_COMPAT, "cp1252");
									if($v_arr[1]==""){
										if($v_arr[3]==$ccd){
											echo "<option value=\"$v_arr[0]\" title=\"$titles\" selected=\"selected\">".htmlentities($v_arr[0], ENT_COMPAT, "cp1252")."</option>";
										}else{
											echo "<option value=\"$v_arr[0]\" title=\"$titles\">".htmlentities($v_arr[0], ENT_COMPAT, "cp1252")."</option>";
										}
									}else{
										if($v_arr[3]==$ccd){
											echo "<option value=\"$v_arr[0]\" title=\"$titles\" selected=\"selected\">".htmlentities($v_arr[1].",".$v_arr[0], ENT_COMPAT, "cp1252")."</option>";
										}else{
											echo "<option value=\"$v_arr[0]\" title=\"$titles\">".htmlentities($v_arr[1].",".$v_arr[0], ENT_COMPAT, "cp1252")."</option>";
										}
									}
								}
							} 
?>
						</select>
					</div>
				</td>
			<tr/>
			<tr>	
				<th>Volcano: </th>
				<td>
					<div id="volanos">
						<select name="vol" id="vol"  style="width:160px"><option value="volcano">.....</option></select>
					</div>
				</td>
			</tr>
		</table><br>			
		<table class="formtable" id="formtable">
			<tr>
				<th>Select file (max size 2M):</th>
				<td>
					<input type="file" name="submit_file_inputfile" size="25" />
				</td>
			</tr>
			<tr></tr>
			<tr>
				<th>Description/ comments:</th>
				<td>
					<textarea name="com" cols="40" rows="8" onkeydown="limitText(this, 1024)"><?php print $com; ?></textarea>
				</td>
			</tr>
		</table>
		<input type="submit" name="submit_file_form_ok" value="OK" />
	</form>
	<div>
</html>