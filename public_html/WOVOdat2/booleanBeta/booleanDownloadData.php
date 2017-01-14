<html>
	<head>
		<script src="/js/pace.min.js"></script>
		<link rel="stylesheet" href="/css/pace.css">
	</head>
</html>

<?php 
ini_set('max_execution_time', 7200);
session_start();

include "view/common_v.php";
include 'view/booleanDownloadData_v.php';
include 'model/booleanDownloadData_m.php';

showExternallink();
showHeader();
include "php/include/header_beta.php"; 

/********* Add Loading Bar ******************/

echo "<script>
		Pace.restart();
	</script>";

flush();

/********************************************/

	if(isset($_SESSION['bolParameter']) && $_GET['i'] != ""){
		
		$trackPoint = $_GET['i']; 
		$dataType = $_GET['data']; 
		
		if(isset($_GET['downloadDataUsername'])) {
			$_SESSION['downloadDataUsername'] = $_GET['downloadDataUsername'];	
			$_SESSION['downloadDataUseremail'] = $_GET['downloadDataUseremail'];	
			$_SESSION['downloadDataUserobs'] = $_GET['downloadDataUserobs'];	
		}
		
		insertDownloadDataUserInfo($dataType,$trackPoint);
		
		
		if($dataType == 'sdEvn' || $dataType == 'Tremor' || $dataType == 'Sampled Gas Events'){
			$length = 9;
		}else if($dataType == 'sdEvs'){
			$length = 10 ;
		}else if($dataType == 'Intensity' || $dataType == 'SSAM' || $dataType == 'Tilt' || $dataType == 'Tilt Vector'){
			$length = 7 ;
		}else if($dataType == 'Interval' || $dataType == 'Hydrologic'){
			$length = 17 ;
		}else if($dataType == 'RSAM' || $dataType == 'Gravity' || $dataType == 'EDM' || $dataType == 'Leveling'){
			$length = 5 ;
		}else if($dataType == 'Plume from groud based' || $dataType == 'Plume from Satellite' || $dataType == 'Soil Effux'|| $dataType == 'Thermal' || $dataType == 'Electric fields' || $dataType == 'Magnetic fields' || $dataType == 'Angle' || $dataType == 'GPS'){	
			$length = 8 ;
		}else if($dataType == 'Meteo' || $dataType == 'GPV') {  
			$length = 14 ;
		}else if($dataType == 'Magnetic Vector'){
			$length = 6 ;
		}else if($dataType == 'Strain'){
			$length = 20;
		}
	
		$Detaildata = getDetailData($dataType,$trackPoint);
	
	
/*		
		if(isset($_SESSION['sdEvnType'])) {
			$flag="sd_evn";
			$data = getDetailData($trackPoint,$flag);
		}
		
		if(isset($_SESSION['sdEvsType'])) {
			$flag="sd_evs";
			$data = getDetailData($trackPoint,$flag);
		}
*/		
			
		showMonitorDetailData($Detaildata,$trackPoint,$length,$dataType); 
		
	}
	
showFooter1();
include "php/include/footer_main_beta.php"; 
showFooter2();	   
	
?>