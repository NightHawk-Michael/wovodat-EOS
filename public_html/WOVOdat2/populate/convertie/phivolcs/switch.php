<?php
ini_set("display_errors",true);
if(isset($_POST['convertType'])){
    $convertType = $_POST['convertType'];
    switch ($convertType){
        case 'specific':
            include_once dirname(__FILE__) . '/controller/SpecificConversionController.php';
            $controller = new SpecificConversionController();
            $controller->setOwner($_POST['owner1']);
            $controller->setClientType($_POST['client']);
            $controller->setDataType($_POST['conv']); 
            $controller->setFileLinks($_POST['fileLinks']);
            $controller->invoke();
            break;
        default:
            break;
    }
}
if(isset($_REQUEST['download'])){
    $link = $_REQUEST['download'];
    include_once dirname(__FILE__).'/model/Downloader.php';
    $downloader = new Downloader();
    $downloader->download($link);
    exit();
}

?>