<?php
require_once('query_database.php');
$observatory = $_GET['observatory'];
$data_type = $_GET['data_type'];
$res = get_latest_date($data_type, $observatory);
echo $res;
?>