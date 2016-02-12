<?php
require_once('query_database.php');
$observatory = $_GET["observatory"];
$dataType = $_GET["dataType"];
$stationCode = $_GET["stationCode"];
$res = get_station_information($observatory, $dataType, $stationCode);
echo json_encode($res);
?>
