<?php
session_start();

require_once "php/include/get_root.php";

if(!isset($_SESSION['login'])) {
	header('Location: '.$url_root.'login_required.php');
}

include "../view/commonInsert_v.php";
include "../view/insert_vd_inf_v.php";
include "../convertie/model/commonInsertForm_m.php";
include "../../boolean/model/booleanIndex_m.php";

showCommonHeader();   			    //Show html header 
showCssExternalJs();				//Get Css and external js link 

$vol=getVolList();    			    //Get volcano list
$obs=getCcList();      			 	//Get observatory list
$type=getFeatureType();             //Get Volcano Feature Type  (function from booleanIndex_m.php)
$rtype=getRockType();               //Get Volcano Rock Type     (function from booleanIndex_m.php)
$status=getVolInfStatus();          //Get Volcano Info Status  (function from booleanIndex_m.php)

showUpdateTableList($vol,$obs,$type,$rtype,$status);     //Show vd_inf form

showCommonFooter();            		//Show html footer


?>