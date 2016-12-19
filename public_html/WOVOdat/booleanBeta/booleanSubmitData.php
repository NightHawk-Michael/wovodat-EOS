<html>
	<head>
		<script src="/js/pace.min.js"></script>
		<link rel="stylesheet" href="/css/pace.css">


	</head>
</html>

<?php
ini_set('max_execution_time', 7200);
SESSION_START();
include "view/common_v.php";
include 'view/booleanSubmitData_v.php';
include 'model/booleanSubmitData_m.php';


showExternallink();
showHeader();
include "php/include/header_beta.php"; 

/********* Add Loading Bar ******************/

echo "<script>
		Pace.restart();
	</script>";

flush();

/********************************************/

//	echo "<br/><br/>";
	//var_dump($_SESSION['booleanPostValue']);
	
	$data= getAllResult();  

	if(sizeof($data)!=0){
		showMonitorData($data);
	}else{
		showNoResult();
	}



showFooter1();
include "php/include/footer_main_beta.php"; 
showFooter2();	   

		

?>