<?php	
	// Start session
	session_start();

	// Regenerate session ID
	session_regenerate_id(true);

	// Get root url
	require_once "php/include/get_root.php";

	if(!isset($_SESSION['login'])) {
		header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
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
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">	
	<script src="/js/jquery-1.4.2.min.js"></script>
	<script language='javascript' type='text/javascript'>	
		var file_to_direct = <?php echo '"' . $_GET['data_type'] . '.php"'?>;
		$(document).ready(function() {
			$.get(file_to_direct, function change_content_online_form(content){
				$("#content_online_form").html(content);
			});
		});

	</script>
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->
		<div id = "content_online_form">
		</div>

	<div>
		<?php include 'php/include/footer_main_beta.php'; ?>
	</div>
	</div>
	</div>

</html>