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
		<script src="/js/jquery-1.4.2.min.js"></script>

<style type="text/css">
	table.table-style-two {
	

		color: #333333;
		border-width: 1px;
		border-color: #3A3A3A;
		border-collapse: collapse;
	}
 
	table.table-style-two th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #517994;
		background-color: #B2CFD8;
	}
 
	table.table-style-two tr:hover td {
		background-color: #DFEBF1;
	}
 
	table.table-style-two td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #517994;
		background-color: #ffffff;
	}
</style>		
    </head>
HTMLBLOCK;
}

function showHeader() {
echo <<<HTMLBLOCK
<body>
<div id="wrapborder_x">
HTMLBLOCK;
}
	
		
function showFooter1() {
echo <<<HTMLBLOCK

			<div class="reservedSpace">
            </div>
		</div> <!-- wrapborder _x-->
		
		<div class="wrapborder_x">
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