<?php

function showExternallink(){
echo <<<HTMLBLOCK

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
 	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/normalize.css" rel="stylesheet" type="text/css">
        <script src="/js/jquery-1.4.2.min.js"></script>
    </head>
HTMLBLOCK;
}

function showHeader() {
echo <<<HTMLBLOCK
<body>
<div class = "body">
<!--Header-->
HTMLBLOCK;
}
	
		
//Nhat added 1 June 2015
function showContent(){
echo <<<HTMLBLOCK
<!-- Content -->
<div class  = "container">
<div class = "content">
HTMLBLOCK;
}		
//Nhat added 1 June 2015 - end


function showFooter1() {
echo <<<HTMLBLOCK
</div>
</div><!-- end of content -->
<div class="push" style="height:85px;clear:both"></div>;
<!-- Footer -->
HTMLBLOCK;
}

function showFooter2() {
echo <<<HTMLBLOCK
</div>
</body>
</html>
HTMLBLOCK;
}
	
?>
