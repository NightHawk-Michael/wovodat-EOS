<?php

// Start session
session_start();

// Get root url
require_once "php/include/get_root.php";

// If session was already started
if (isset($_SESSION['login'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home_populate.php');
	exit();
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
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
</head>
   <body>
        <div class="body">
            <!-- Header -->
            <?php include 'php/include/header.php'; ?>               
 			<div class="container">
				<div id="content"><br/>
					<br>
					<br>
					<p><blockquote>Please <a href="/populate/index.php"><b>LOGIN</b></a> first.</blockquote></p>
				</div>  <!-- end of content-->
 			</div> <!-- end of container -->  
        </div> <!-- end of body -->  
    <!-- Footer -->
    <?php include 'php/include/footer.php'; ?>  
    </body>
</html>