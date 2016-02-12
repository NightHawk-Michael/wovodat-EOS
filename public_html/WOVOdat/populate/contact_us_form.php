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

// If 1st time access
if (!isset($_SESSION['contact'])) {
	// Blank fields
	$subject="";
	$message="";
	$name="";
	$email="";
}
// 2nd time access
else {
	// Get fields
	$subject=$_SESSION['contact']['subject'];
	$message=$_SESSION['contact']['message'];
	$name=$_SESSION['contact']['name'];
	$email=$_SESSION['contact']['email'];
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
        <link href="/css/index.css" rel="stylesheet" />
        <link href="/css/normalize.css" rel="stylesheet" />
		<script type="text/javascript" src="/js/scripts.js"></script>
		<script src="/js/jquery-1.4.2.min.js"></script>                            
		<script type="text/javascript" src="/js/jquery.validate.js"></script>        
		<script type="text/javascript" src="/js/formValidation.js"></script>       

	<style type="text/css">
		label.error {font-size:12px; display:block; float: none; color: red;}
	</style>	
	</head>

    <body>
	<!-- Nhat changed 1 June 2015 -->
        <div class="body">
            <!-- Header -->
            <?php include 'php/include/header.php'; ?>  
 		
		<!-- Content -->
		<div class = "container" >

				<!-- Left -->
				<div class="content"><br><br>
					<table width="400" border="0" cellpadding="3" cellspacing="1">
						<tr>
							<td><strong><span style="font-size:16px;">Contact Form </span></strong></td>
						</tr>
						<tr>
							<td>(All fields * are required)</td> <td></td>
						</tr>	
						
					</table>
					<table class="formtable" id="formtable">
						<tr>
							<td>
								<form id="contactUsform" name="contactUsform" method="post" action="/populate/contact_us.php">
									<table width="100%" border="0" cellspacing="1" cellpadding="3">
										<tr>
											<td>*Subject</td>
											<td>:</td>
											<td><input id="subject" name="subject" type="text" id="subject" size="50" maxlength="255" value="<?php echo $subject; ?>" /></td>
										</tr>
										<tr>
											<td>*Message</td>
											<td>:</td>
											<td><textarea id="message" name="message" cols="50" rows="6" id="message"><?php echo $message; ?></textarea></td>
										</tr>
										<tr>
											<td>*Name</td>
											<td>:</td>
											<td><input id="name" name="name" type="text" id="name" size="50" maxlength="255" value="<?php echo $name; ?>" /></td>
										</tr>
										<tr>
											<td>*Email</td>
											<td>:</td>
											<td><input id="email" name="email" type="text" id="email" size="50" maxlength="255" value="<?php echo $email; ?>" /></td>
										</tr>
 <!-- Nang added -->
  										<tr>
										<td></td><td></td>
											<td><img id="siimage" src="../securecheck/securimage_show.php" alt="CAPTCHA Image" />
											<img id="refreshbutton" src="../securecheck/images/refresh.gif" alt="Reload Image" onclick="secureimage();" title="Reload Image">
											</td>
										</tr>
										
 										<tr>
											<td>*Type the above security code</td>
											<td>:</td>
											<td><input type="text" id="code" name="code" /></td>
										</tr>
 										
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<input type="submit" name="Submit" value="Submit" />
												<input type="reset" name="Submit2" value="Reset" />
											</td>
										</tr>
									</table>
								</form>
							</td>
						</tr>
					</table>
				</div>  <!-- end of content-->
            </div> <!-- end of container -->  
        </div> <!-- end of body -->  
    <!-- Footer -->
    <?php include 'php/include/footer.php'; ?>  
    </body>
</html>