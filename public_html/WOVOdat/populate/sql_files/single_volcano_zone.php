<?php

$Volcano = "\"%Helens%\"";
$radius = 100;
$stime = "\"'1980-01-01'\"";
$etime = "\"'2016-04-17'\"";
$smag = -5;
$emag = 9;
$sdep = -15;
$edep = 20;
$eqtypes = "\"'X','VT'\"";

$con = mysqli_connect("localhost","root","1234567","wovodat");
//$rs = mysqli_query($con,'CALL Get_vd_inf_slat_slon("Akutan",@latitude,@longitude)');
//$rs = mysqli_query($con,'SELECT @latitude, @longitude');
//$rs = mysqli_query($con,"CALL GetVolcanoZone(\"%Akutan%\",100,\"'1980-01-01'\",\"'2016-04-17'\",-5,9,-15,20,\"'X','VT'\")");
$rs = mysqli_query($con,"CALL GetVolcanoZone($Volcano,$radius,$stime,$etime,$smag,$emag,$sdep,$edep,$eqtypes)");
    while ($row = mysqli_fetch_row($rs)) {
       print_r($row);
    }
mysqli_close($con);

?>