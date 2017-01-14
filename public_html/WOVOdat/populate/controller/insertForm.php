<?php
if (!isset($_SESSION))
    session_start(); 

	
//include "../view/commonInsert_v.php";
include "../view/insertForm_v2.php";

if(!isset($_GET['type'])){    
header('Location: '.$url_root.'../home_populate.php');
exit();
}

showUpdateTableList();




?>