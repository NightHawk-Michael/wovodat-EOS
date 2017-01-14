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

if(!isset($_SESSION['login'])){       // can't proceed without log in
//	header('Location: '.$url_root.'login_required.php');
}

showExternallink();
showHeader();
include "php/include/header.php"; 
showContent();
/********* Add Loading Bar ******************/

echo "<script>
		Pace.restart();
	</script>";

flush();

/********************************************/

	$data= getAllResult();

	if(sizeof($data)!=0){
		showMonitorData($data);
	}else{
		showNoResult();
	}



showFooter1();
include "php/include/footer.php"; 
showFooter2();	   


		

?>
