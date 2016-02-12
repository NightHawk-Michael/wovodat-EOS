<?php
require_once('query_database.php');
$res = get_owners_list();
echo json_encode($res);
?>