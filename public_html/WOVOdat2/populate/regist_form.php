<?php

// Start session
session_start();

// Regenerate session ID
session_regenerate_id(true);

// If session already started
if (isset($_SESSION['HTTP_USER_AGENT'])) {
	if ($_SESSION['HTTP_USER_AGENT']!=md5($_SERVER['HTTP_USER_AGENT'])) {
		// Destroy session variables
		session_destroy();
	}
}

// Else
$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['HTTP_USER_AGENT']);

if (isset($_SESSION['register'])) {
	unset($_SESSION['register']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script type="text/javascript" src="/js/scripts.js"></script>
	<script language="javascript" src="/js/jquery-1.4.2.min.js"></script>    <!-- Nang added -->
	<script type="text/javascript" src="/js/jquery.validate.js"></script>	 <!-- Nang added -->	 
	<script type="text/javascript" src="/js/formValidation.js"></script>     <!-- Nang added -->      

	<style type="text/css">                             
		label.error { float: none; color: red; }
	</style>	
	
 <!-- Nang added on 21-Nov-2013 -->	
	<script>

		$(document).ready(function(){

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
 <!-- Nang added on 21-Nov-2013 -->
 
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->

		<div id="content">
		<!-- Page content -->
		
		<h2>User registration form <span style='color:red;font-size:12px;'> (the fields preceded by * are required)</h2></span>
		<p>Welcome to the registration form for WOVOdat! For detailed information about how to register, please see  
		<a href='/doc/system/CreateNewWOVOdatAccount.pdf' target='_blank'>here</a>.</p>
		<br/>

		<!-- Form -->
		<form method="post" action="regist_check.php" name="form1" id="form1">
			<table class="formtable" id="formtable">
				<tr>
					<th>*Username:</th>
					<td>
						<input type="text" maxlength="30" id="unameReg" name="uname" value=""/></span>
					</td>
				</tr>
				<tr>
					<th>*Password (&ge; 6 characters):</th>
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
						<input type="text" maxlength="320" id="email" name="email" value=""/>
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
 <!-- Nang added -->
 
				<tr>
					<th>*Observatory:</th>

					<td>
						<select name='obs' id='obs' style='width:165px;'>
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
						
					</td>
					<!-- Nang added on 21-Nov-2013 -->
					<td>If you belong to one of the observatories or institutions listed <br/>in the pull-down menu, please click on that affiliation.<br/> If not, please click on "Other" and fill in your affiliation.</td>	
					
				</tr>
				
 <!-- Nang added on 21-Nov-2013 -->		
				<tr id="otherObsId" >
					<th>*Affiliation:</th>
					<td>
						<input type="text" maxlength="255" name="otherObs" value="" />
					</td>
				</tr>		
 <!-- Nang added on 21-Nov-2013 -->
				
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
 <!-- Nang added -->
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
				<td align="right"><input type="checkbox" name="agree" value="T&C" id="agree"></td>
				<td align="left"><a href="dataPolicy.php" target="_blank"> I agree to WOVOdat Data Policy</a></td>
				</tr>				
			</table>
			
			<div style="padding:20px 140px;" >
			<input type="submit" name="confirm" value="Register" />
			</div>
		</form>
	
		</div>  <!-- end page content div -->
		<br/><br/><br/>
		
		<!-- Footer -->
	
		<div class="wrapborder_x">
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>			
		
	</div>
	</div>
</body>
</html>