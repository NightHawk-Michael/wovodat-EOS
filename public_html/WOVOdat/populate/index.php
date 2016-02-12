<?php

// Start session
session_start();

// Regenerate session ID
session_regenerate_id(true);

// Get root url
require_once "php/include/get_root.php";

// If session was already started
if (isset($_SESSION['login'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home_populate.php');
	exit();
}

// Local variable
$login_error="";

// Get attempt URL attribute
if (isset($_GET['attempt']) == 1) {
	$login_error="Wrong username or password";
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
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
    </head>

    <body>
        <div class="body">
            <!-- Header -->
            <?php include 'php/include/header.php'; ?>               
 			<div class="container">
				<div id="content"><br/>
					<p>For new user, please <a href="regist_form.php">register</a> first.</p>
					<!-- Registration / Login -->
					<table id="regisLogin">
						<!-- Steps -->
						<tr>
							<!-- Registration -->
							<td rowspan="5" id="regisLoginC1"><a href="regist_form.php">Register</a></td>
							<!-- Login -->
							<td colspan="3" id="regisLoginC2">Log in</td>
						</tr>
						
						<!-- Login form -->

						
					<form method="post" action="home_populate.php" name="form1"> 
							<!-- Username -->
							<tr>
								<th id="regisLoginUname">&nbsp;Username:</th>
								<td>
									<input type="text" name="uname" />
								</td>
							</tr>
							<!-- Password -->
							<tr>
								<th id="regisLoginpw">&nbsp;Password:</th>
								<td id="regisLoginpw">
									<input type="password" name="password" />
								</td>
								<td colspan="2" id="regisLoginSubmitButton">
									<input type="submit" name="login_submit" value="Log In" />
								</td>
							</tr>
						</form>
						
						
						<!-- Login errors -->
						<tr>
							<td colspan="3" id="regisLoginError">
								<span><?php	print $login_error; ?></span>
							</td>
						</tr>
						<!-- Forgot password -->
						<tr>
							<td colspan="3" id="forgotPW"><a href="forgot_password.php">Forgot password</a></td>
						</tr>
					</table>

				</div>  <!-- end of content-->
 			</div> <!-- end of container -->  
        </div> <!-- end of body -->  
    <!-- Footer -->
    <?php include 'php/include/footer.php'; ?>  
    </body>
</html>