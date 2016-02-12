<?php

// Start session
session_start();
// Regenerate session ID
session_regenerate_id(true);
$uname="";
$ccd="";
ini_set('display_errors',true);
if (isset($_SESSION['login'])) {
    $uname=$_SESSION['login']['cr_uname'];
    $ccd=$_SESSION['login']['cc_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
        <link href="/css/styles_beta.css" rel="stylesheet">
        <!--[if IE]><script src="../../js/flot/excanvas.min.js" language="javascript" type="text/javascript"></script><![endif]-->
    </head>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
    </script>
    <style type="text/css">
        table tr td:first-child
        {
            font-weight: bold;
            text-align: left;
        }

    </style>
    <body>

        <div id="wrapborder">
            <div id="wrap">
                <?php include 'php/include/header_beta.php'; ?>
                <?php
                if(isset($_POST['observ'])) {
                    // use thin client view
                    $_POST["owner1"] = $_POST["observ"];
                    $_POST['client'] = 'thin';
                    $_POST['convertType'] = 'specific';
                    include 'switch.php';
                }
                ?>
			</div> <!--end of wrap-->	
                
			<!-- Footer -->
				<?php include 'php/include/footer_main_beta.php'; ?>
            
        </div> <!--end of wrapborder-->

    </body>
</html>
