<?php
require_once('query_database.php');
$data_type = $_GET['data_type'];
$volcano_id = $_GET['volcano_id'];
$res = get_stations_list($data_type, $volcano_id);
echo json_encode($res);
?>