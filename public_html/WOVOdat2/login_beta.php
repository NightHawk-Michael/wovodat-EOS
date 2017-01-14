<?php
// Start session
session_start();
// Get root url
//$url_root="http://www.wovodat.org/";
$url_root="http://{$_SERVER['SERVER_NAME']}/";

// Get redirect URL
if (isset($_GET['redirect'])) {
	$redirect=$_GET['redirect'];
}
else {
	$redirect='';
}

// If session was already started
if (isset($_SESSION['dev_login'])) {
	// Redirect
	header('Location: '.$url_root.$redirect);
	exit();
}

// Local variable
$login_error="";
// Get attempt URL attribute
if ($_GET['attempt']==1) {
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
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>	
		<!-- Content -->
		<div id="content">	
			<div id="contentl">
				<!-- Introduction -->
				<h3><br>Website under development</h3>
				<!-- Text -->
				<p>This part of the website is still under development. Thank you</p>
				<!-- Login form -->
				<form method="post" action="login_check_beta.php?redirect=<?php print $redirect; ?>" name="dev_login_form">
					<!-- Username -->
					<tr>
						<th>Username:</th>
						<td>
							<input type="text" maxlength="30" name="uname" value="" />
						</td>
					</tr><br>
					<!-- Password -->
					<tr>
						<th>Password:</th>
						<td>
							<input type="password" maxlength="30" name="password" value="" />
						</td>
					</tr>
					<input type="submit" name="dev_login_ok" value="Log In" />
				</form>
				<!-- Login errors -->
				<br />
				<span class="redtext"><?php	print $login_error; ?></span>

			</div>
			<div id="contentr">
			</div>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>