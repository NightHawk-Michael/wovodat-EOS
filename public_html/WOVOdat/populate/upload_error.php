<?php
if(!isset($_SESSION))
	session_start();

include "php/include/header.php";  

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>Submit Data</a> > Upload WOVOml File </div>";
?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
		<!-- Page content -->
		<h1>Error during data upload</h1>
		<p>The following errors occurred during the data upload:</p>
		<ul>
<?php

// Print errors
for ($i=0; $i<$_SESSION['l_errors']; $i++) {
	// Limit display to 20 errors
	if ($i==20) {
		break;
	}
	
	// Get error
	$error=$_SESSION['errors'][$i];
	switch ($error['code']) {
		case 1:
			// Missing information
			print "\n\t\t\t<li>Missing information - ".$error['message']."</li>";
			break;
		case 2:
			// Dirty data
			print "\n\t\t\t<li>Dirty data - ".$error['message']."</li>";
			break;
		case 3:
			// Loader doesn't have the right to upload for this owner
			print "\n\t\t\t<li>No upload permission - ".$error['message']."</li>";
			break;
		case 4:
			// Wrong file format
			print "\n\t\t\t<li>Unknown file type - ".$error['message']."</li>";
			break;
		case 5:
			// Not well-formed WOVOML error
			print "\n\t\t\t<li>WOVOML not well-formed - ".$error['message']."</li>";
			break;
		case 6:
			// Unvalid WOVOML error
			print "\n\t\t\t<li>Unvalid WOVOML - ".$error['message']."</li>";
			break;
		case 7:
			// Duplicated data error
			print "\n\t\t\t<li>Duplicated data - ".$error['message']."</li>";
			break;
		case 8:
			// Data already existing error
			print "\n\t\t\t<li>Data already exists in DB - ".$error['message']."</li>";
			break;
		case 9:
			// Links error
			print "\n\t\t\t<li>Incorrect reference - ".$error['message']."</li>";
			break;
		default:
			// Nothing
	}
}

?>
		</ul>
		<p>Please make necessary changes and <a href="home.php">try again</a>.</p>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->