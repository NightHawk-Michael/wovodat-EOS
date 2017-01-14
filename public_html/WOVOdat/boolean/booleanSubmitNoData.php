<html>
	<head>
		<script src="/js/pace.min.js"></script>
		<link rel="stylesheet" href="/css/pace.css">
	</head>

</html>

<?php
include 'view/booleanSubmitNoData_v.php';
include 'model/booleanSubmitNoData_m.php';
include 'php/include/header.php';

include 'php/include/menu.php';

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Data Download > <a href='http://{$_SERVER['SERVER_NAME']}/boolean/booleanIndex.php'>WOVOdat Boolean Search Form</a> </div>";

echo "</div>";   /*** header-menu  ***/

echo"<div class='body'>";
	echo"<div class='widecontent'>";
	
	
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
	$nav  = '';
		
		
	for($page = 1; $page <= $maxPage; $page++){
 
		if ($page == $pageNum) {
			$nav .= "<span class='pager thispage' >$page</span> ";        // no need to create a link to current page
		}else{                                                                                    
			$nav .= " <a href=\"$self?page=$page\" class='pager'>$page</a> ";  // using Above filter in URL link..
		}                                                                                   	
	}
	 
	  
			  
   if ($pageNum > 1){
		$page  = $pageNum - 1;
		
		if($pageNum == 2){
			$prev = '';
		}else{
			$prev  = "<a href=\"$self?page=$page\" id='backnext'> < Previous </a> ";
		
		}
		
		$first = " <a href=\"$self?page=1\"> << First</a> ";
	}else{
		$prev  = '&nbsp;'; 							// we're on page one, don't print previous link
		$first = '&nbsp;'; 						    // nor the first page link
	}
	
	if ($pageNum < $maxPage){
		$page = $pageNum + 1;
		
		if(($maxPage-1) == $pageNum){ 
			$next ='';
		}else{
			$next = " <a href=\"$self?page=$page\" id='backnext'> Next > </a>";
		}
		
		$last = " <a href=\"$self?page=$maxPage\"> Last >> </a> ";
	}
	else{
		$next = '&nbsp;';					      // we're on the last page, don't print next link
		$last = '&nbsp;';                         // nor the last page link
	}
	
	$count= $first.$prev.$nav.$next.$last;

	if($totalItems > 100){
		showcount($count);              			// print the navigation link
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