<?php
session_start();
// Regenerate session ID
session_regenerate_id(true);

// Get root url
require_once "php/include/get_root.php";
$webpage_link="http://{$_SERVER['SERVER_NAME']}/populate";

if(isset($_SESSION['login'])){	
	header('Location:download_installable.php');
}
else{

echo <<<HTMLBLOCK
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/js2/navig.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	
	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>
	
		$(document).ready(function(){

			$('#installpackage').validate();

			$("form#installpackage").submit(function() {	
				if($('#error').css("display") == 'block'){
					$('#error').css('display','none');	
				}
			});

		});	
	</script>


<style type="text/css">
label.error {font-size:9px; float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>	
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
HTMLBLOCK;

include 'php/include/header_beta.php';
echo <<<HTMLBLOCK

		<!-- Content -->
		<div id="content">	
			<div id="disablecontent" style="display:none;">
				echo"Download successful";  
			</div>
			<div id="contentl">
HTMLBLOCK;

				echo"<div style='color:red;text-align:center;'>";					
					if (isset($_GET['nopost'])== 1) {
						echo"<h3>Warning! For accessing this page, please login first.</h3>"; 
					}
				echo"</div>";
			
echo <<<HTMLBLOCK

				<div><br/>
				
				<p><b>Please log in to download an installabe tool. </b></p>
				
			
				<!-- Registration / Login -->
			

				
					<!-- Login form -->
					<form name="installpackage" id="installpackage" method="post" action="install_check.php">
				
					<table id="regisLogin">	
					<tr>
						<!-- Registration -->
						<td rowspan="10" id="regisLoginC1">
									
							<a href="$webpage_link/regist_form.php">Register</a>
						</td>
					</tr>
					
					
						<!-- Login -->
					
						<tr>
							<td colspan="3" id="regisLoginC2">Existing Users</td>
						</tr>
	
						<!-- Username -->
						<tr>
							<th id="regisLoginUname">&nbsp;&nbsp;Username:</th>
							<td>
								<input type="text" name="uname" class="required"/>
							</td>
						</tr>
								
						<!-- Password -->
						<tr>
							<th id="regisLoginpw">&nbsp;&nbsp;Password:</th>
							<td id="regisLoginpw">
								<input type="password" name="password" class="required" minlength="6"/>
							</td>
							<td colspan="2" id="regisLoginSubmitButton">
								<input type="submit" name="login_submit" value="Log In" />
							</td>
						</tr>

					
					<!-- Login errors -->
						<tr>
							<td colspan="3" id="regisLoginError">
				
HTMLBLOCK;
								if (isset($_GET['attempt'])== 1) {
									echo"<p id=\"error\">Wrong username and password.</p>"; 
								}
echo <<<HTMLBLOCK
								
							</td>
						</tr>			

					<!-- Forgot password -->
						<tr>
							<td colspan="3" id="forgotPW"><a href="$webpage_link/forgot_password.php">Forgot password</a></td>
						</tr>
					</table>	
					</form>	
				</div>
HTMLBLOCK;
		echo"</div>";	
		
		echo"<div id=\"contentr\">";
		echo"</div>";

	echo"</div>";

	echo"<div>";
	include "php/include/footer_main_beta.php"; 
	echo"</div>";
	
echo"</div>";
	
echo"</body>";
echo"</html>";	
	
}      //end Else statement
?>
