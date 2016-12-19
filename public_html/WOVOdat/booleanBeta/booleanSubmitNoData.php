<html>
	<head>
		<script src="/js/pace.min.js"></script>
		<link rel="stylesheet" href="/css/pace.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
	</head>

</html>

<?php

SESSION_START();



include "view/common_v.php";
include 'view/booleanSubmitNoData_v.php';
include 'model/booleanSubmitNoData_m.php';

if(!isset($_SESSION['login'])){       // can't proceed without log in
	//header('Location: '.$url_root.'login_required.php');
}
 



showExternallink();
showHeader();
include "php/include/header_beta.php"; 

/********* Add Loading Bar ******************/

echo "<script>
		Pace.restart();
	</script>";

flush();

/********************************************/


	if(!isset($_GET['page'])) {   

		$_SESSION['noMonitorcount']=0;
		$_SESSION['noMonitorData']=array();

		$_SESSION['noMonitorData']=getNoMonitorData();
		$_SESSION['noMonitorcount']=$_SESSION['noMonitorcount']+(sizeof($_SESSION['noMonitorData']));
              			  
	}	

	$totalItems=$_SESSION['noMonitorcount'];

	// start paging for filter. 
	$rowsPerPage =100;       						    // how many rows to show per page

	if(isset($_GET['page'])) {                      // if $_GET['page'] defined, use it as page number.
		$pageNum = $_GET['page'];
	}else{
		$pageNum = 1;           					// by default we show first page
	}

	$offset = ($pageNum - 1) * $rowsPerPage;        // counting the offset


	$data=array_slice($_SESSION['noMonitorData'], $offset, $rowsPerPage);
	
	if(sizeof($data)!=0){
		showNoMonitorData($data);
	}else{
		showNoResult();
	}

			
	$maxPage = ceil($totalItems/$rowsPerPage);      //  this eg:   ceil(75-10)= 7.5= 8pages
	   
	$self = $_SERVER['PHP_SELF'];					// print the link to access each page


	$nav = "";
	for($page = 1; $page <= $maxPage; $page++){

		if ($page == $pageNum) {
			$nav .= "<li class='active' >$page</li> "; // no need to create a link to current page
		}else{                                                                                    
			$nav .= " <li class ='waves-effect' ><a href=\"$self?page=$page\"> $page</a></li> ";  // using Above filter in URL link..
		}                                                                                   	
	}
	$first = "<div class = 'col s12'><ul class = 'pagination'>";
   	if ($pageNum > 1){
		$page  = $pageNum - 1;
	   	$prev  = "<li class='waves-effect'><a href=\"$self?page=$page\"><i class ='material-icons'>chevron_left</i></a><li>";
		$first .= "<li class = 'waves-effect'><a href=\"$self?page=1\"><i class = 'material-icons'>first_page</i></a></li> ";
	}else{
		// we're on page one
		$prev  = "<li class='disabled'><i class ='material-icons'>chevron_left</i></a><li>";
		$first .= "<li class = 'disabled'><i class = 'material-icons'>first_page</i></a></li> ";
	}
	if ($pageNum < $maxPage){
		$page = $pageNum + 1;
		$next = "<li class = 'waves-effect'><a href=\"$self?page=$page\"><i class = 'material-icons'>chevron_right</i></a>";
		$last = "<li class = 'waves-effect'><a href=\"$self?page=$maxPage\"><i class = 'material-icons'>last_page</i></a>";
	}
	else{
		$next = "<li class = 'disabled'><i class = 'material-icons'>chevron_right</i></a>";
		$last = "<li class = 'disabled'><i class = 'material-icons'>last_page</i></a>";
		// we're on the last page

	}
	

	$last .= "</ul></div>";
	$count= $first.$prev.$nav.$next.$last;

	if($totalItems > 100){
		showcount($count);              			// print the navigation link
	}



   
showFooter1();
include "php/include/footer_main_beta.php"; 
showFooter2();	




?>