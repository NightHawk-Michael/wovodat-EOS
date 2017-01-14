<?php
require_once('query_database.php');
$station = $_GET["station"];
$data_type = $_GET["data_type"];
$res = get_instruments_list($station, $data_type);
echo json_encode($res);
?>
