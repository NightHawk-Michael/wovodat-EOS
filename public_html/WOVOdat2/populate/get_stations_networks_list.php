<?php
require_once('query_database.php');
$volcano_name = $_GET["volcano"];
$data_type = $_GET["data_type"];
$station_network = $_GET["station_network"];
$res = array();

if ($station_network == 'station') {
	$res = get_stations_list($data_type, $volcano_name);
} else if ($station_network == 'network') $res = get_networks_list($data_type, $volcano_name);

echo json_encode($res);
?>