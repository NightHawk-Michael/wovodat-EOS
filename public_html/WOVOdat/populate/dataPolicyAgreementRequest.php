<?php
if (!isset($_SESSION))    
	session_start();  


echo <<<HTMLBLOCK
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/styles_beta.css" rel="stylesheet">
HTMLBLOCK;
		
if(!isset($_SESSION['login'])){ 	

$webpage_link="http://{$_SERVER['SERVER_NAME']}/populate";

echo <<<HTMLBLOCK
    <body>
        <div id="wrapborder_x">
            <!-- Header -->
            <div id="wrap_x">
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
				
				<p><b>For new user, please register first. </b></p>
				
			
				<!-- Registration / Login -->
			
					<!-- Login form -->
					<form name="policyForm" method="post" action="dataPolicyAgreementCheck.php">
				
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
	
}else{

echo <<<HTMLBLOCK

<script language='javascript' type='text/javascript'>
 function Exit() {
     var x=confirm('Thank you for visiting WOVOdat. Good Bye!');
     if(x){
		window.open('', '_self', ''); 
		window.close(); 
	}	
   }		
</script>		
	</head>

    <body>
        <div id="wrapborder_x">
            <!-- Header -->
            <div id="wrap_x">
HTMLBLOCK;
include 'php/include/header_beta.php';
echo <<<HTMLBLOCK
			
				<div>
					Data Policy Agreement: <br/>
					blur blur blur blur blur blur blur blur blur blur blur blur blur blur
				</div>
				<br/>
				
				<form action="dataPolicyAgreementAccept.php" method="post" name="policyAgree">
					
					<table style="border-collapse:separate;border-spacing:0 5px;">
						<tr>	
							<td><input type="radio" name="option" value="a" required>&nbsp;&nbsp;Freely available for searches, visualization, and download, from the time of upload</td>
						</tr>
						<tr>
							<td><input type="radio" name="option" value="b" required>&nbsp;&nbsp;Freely available for searches, visualization, and download, from a specified publish date (e.g., 2 years after data collection).</td>
						</tr>
						<tr>
							<td><input type="radio" name="option" value="c" required>&nbsp;&nbsp;Available only for searches and visualization; downloads not available from WOVOdat.</td>
						</tr> 
						
						<tr style="text-align:center;">
							<td>
								<input style="font-family: lucida,sans-serif;font-size: 11px;" type="submit" name="agree" value="Agree">
								<input style="font-family: lucida,sans-serif;font-size: 11px;" type="button" onClick="Exit()" name="notAgree" value="Don't Agree">
							</td>
						</tr>
					</table>	
				</form>
            </div>  <!-- end wrap_x -->
			
        </div>   <!-- end wrapborder_x -->
		
        <div class="wrapborder_x">
HTMLBLOCK;
		include 'php/include/footer_main_beta.php';
echo <<<HTMLBLOCK
		
        </div>
    </body>
</html>
HTMLBLOCK;
}
?>