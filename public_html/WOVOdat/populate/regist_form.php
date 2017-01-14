<?php

if(!isset($_SESSION))
session_start();

if(isset($_SESSION['register']) || isset($_SESSION['errors']) || isset($_SESSION['l_errors'])) {
unset($_SESSION['register']);
unset($_SESSION['errors']);
unset($_SESSION['l_errors']);
}

include 'php/include/header.php'; 
?>

	<script language="javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>		
	<script type="text/javascript" src="/js/formValidation.js"></script>	
	<style type="text/css">                              
		label.error {font-size:12px; display:block; float: none; color: red;}
	</style>	

	<script>

		$(document).ready(function(){
			 $('#form1')[0].reset();
			 $('#otherObsId').hide();	
			  
			 $('#obs').change(function() {
				var selectVal = $('#obs :selected').val();
				
				if(selectVal == 'other'){
					$('#otherObsId').show();
				}else{
					 $('#otherObsId').hide();	
				}
				
			});		

		});
	</script>
 
<?php 
include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
Register</a></div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">

		<div class="form">
			<h2>User registration form </h2>
			<p>For detailed information about how to register, please see  
			<a href='/doc/system/CreateNewWOVOdatAccount.pdf' target='_blank'>here</a>.</p>
			<span> (All fields * are required) </span>
			<p class="redtext"><?php if ($error) {print "Registration unsuccessful! Please correct the fields in red:";} ?></p>

			<form method="post" action="regist_check.php" name="form1" id="form1">
				<table class="formtable" id="formtable">
						<tr>
							<th>*Username:</th>
							<td>
								<input type="text" maxlength="30" id="unameReg" name="uname" value=""/></span>
							</td>
						</tr>
						<tr>
							<th>*Password (andge; 6 characters):</th>
							<td>
								<input type="password" maxlength="30" id="password" name="password" value="" />
							</td>
						</tr>
						<tr>
							<th>*Confirm password:</th>
							<td>
								<input type="password" maxlength="30" id="conf_password" name="conf_password" value="" />
							</td>
						</tr>
						<tr>
							<th>*Email address:</th>
							<td>
								<input type="text" maxlength="30" id="email" name="email" value=""/>
							</td>
						</tr>
						<tr>
							<th>First name:</th>
							<td>
								<input type="text" maxlength="30" name="fname" value=""/>
							</td>
						</tr>
						<tr>
							<th>Last name:</th>
							<td>
								<input type="text" maxlength="30" name="lname" value=""/>
							</td>
						</tr>

		 
						<tr>
							<th>*Observatory:</th>

							<td>
								<select name='obs' id='obs' style='width:200px;color:black;'>
									<option value="">...</option> 
									<option name="other" value="other">Other</option>   <!-- Nang added on 21-Nov-2013 -->
									<?php           
										include 'php/include/db_connect_view.php';
										$result = mysql_query("select cc_code,cc_obs from cc order by cc_obs ASC");
										
										while ($v_arr = mysql_fetch_array($result)) {
											if(!is_numeric($v_arr[0])){
											
												if($obs == ""){
													echo "<option value='$v_arr[1]'>$v_arr[0]-$v_arr[1]</option>";
												}else{
													if($obs == $v_arr[1]){
														$selected=" selected='true'";
													}else{
														$selected="";
													}
													echo "<option value='$v_arr[1]' $selected>$v_arr[0]-$v_arr[1]</option>";
												}
											}
										} 
									?>
								 </select>							
								
						
								<p style="font-size:.7em;width:210px;">(If you belong to one of the observatories or institutions listed in the pull-down menu, please click on that affiliation.If not, please click on "Other" and fill in your affiliation.)</p>	
							</td>
						</tr>
						
						
						
						<tr id="otherObsId" >
							<th>*Affiliation:</th>
							<td>
								<input type="text" maxlength="255" name="otherObs" value="" />
							</td>
						</tr>		
						
						<tr>
							<th>Address1:</th>
							<td>
								<input type="text" maxlength="60" name="add1" value=""/>
							</td>
						</tr>
						<tr>
							<th>Address2:</th>
							<td>
								<input type="text" maxlength="60" name="add2" value=""/>
							</td>
						</tr>
						<tr>
							<th>City:</th>
							<td>
								<input type="text" maxlength="50" name="city" value=""/>
							</td>
						</tr>
						<tr>
							<th>State, Province or Prefecture:</th>
							<td>
								<input type="text" maxlength="30" name="state" value=""/>
							</td>
						</tr>
						<tr>
							<th>Country:</th>
							<td>
								<input type="text" maxlength="50" name="country" value=""/>
							</td>
						</tr>
						<tr>
							<th>Postal code:</th>
							<td>
								<input type="text" maxlength="30" name="post" value=""/>
							</td>
						</tr>
						<tr>
							<th>Web address:</th>
							<td>
								<input type="text" maxlength="255" name="url" value=""/>
							</td>
						</tr>
						<tr>
							<th>Phone:</th>
							<td>
								<input type="text" maxlength="50" name="phone" value=""/>
							</td>
						</tr>
						<tr>
							<th>Phone 2:</th>
							<td>
								<input type="text" maxlength="50" name="phone2" value=""/>
							</td>
						</tr>
						<tr>
							<th>Fax:</th>
							<td>
								<input type="text" maxlength="60" name="fax" value=""/>
							</td>
						</tr>
						<tr>
							<th>Comments:</th>
							<td>
								<textarea name="com" cols="30" rows="2" onkeydown="limitText(this, 255)"></textarea></span>
							</td>
						</tr>

						<tr>
						<td></td>
						<td><img id="siimage" src="../securecheck/securimage_show.php" alt="CAPTCHA Image" />
						<img id="refreshbutton" src="../securecheck/images/refresh.gif" alt="Reload Image" onclick="secureimage();" title="Reload Image">
						</td>
						</tr>

						<tr>
						<th>*Type the above security code:</th>
						<td><input type="text" id="code" name="code" /></td>
						</tr>
						
						<tr>
						<td align="right"><input type="checkbox" name="agree" value="TandC" id="agree"></td>
						<td align="left"><a href="dataPolicy.php" target="_blank"> I agree to WOVOdat Data Policy</a></td>
						</tr>				
					</table>
					
					<div style="padding:20px 250px;" >
					<input type="submit" name="confirm" value="Register" />
					</div>
				</form>
	
		</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->