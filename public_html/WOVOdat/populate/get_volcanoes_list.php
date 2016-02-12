<?php
require_once('query_database.php');
$observatory = $_GET['observatory'];
$res = get_volcanoes_list($observatory);
echo json_encode($res);
?>