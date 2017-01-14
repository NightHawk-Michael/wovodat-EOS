<?php
require_once('php/include/db_connect.php');

$Volcano = "\"%Helens%\"";
$radius = 100;
$stime = "\"'1980-01-01'\"";
$etime = "\"'2016-04-17'\"";
$smag = -5;
$emag = 9;
$sdep = -15;
$edep = 20;
$eqtypes = "\"'X','VT'\"";

$rs = mysqli_query($mysqli_link,"CALL GetVolcanoZone($Volcano,$radius,$stime,$etime,$smag,$emag,$sdep,$edep,$eqtypes)");
    while ($row = mysqli_fetch_row($rs)) {
       print_r($row);
    }

?>