<html>
	<head>
		<script src="/js/pace.min.js"></script>
		<link rel="stylesheet" href="/css/pace.css">
	</head>
</html>

<?php
if(!isset($_SESSION))
	session_start();
	
ini_set('max_execution_time', 7200);
include 'view/booleanSubmitData_v.php';
include 'model/booleanSubmitData_m.php';
include 'php/include/header.php';
include 'php/include/menu.php';

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Data Download > <a href='http://{$_SERVER['SERVER_NAME']}/boolean/booleanIndex.php'>WOVOdat Boolean Search Form</a> </div>";

echo "</div>";   /*** header-menu  ***/

/********* Add Loading Bar ******************/

echo "<script>
		Pace.restart();
	</script>";

flush();

/********************************************/
echo "<div class='body'>";
	echo "<div class='widecontent'>";

		$data= getAllResult();

		if(sizeof($data)!=0){
			showMonitorData($data);
		}else{
			showNoResult();
		}


?>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->