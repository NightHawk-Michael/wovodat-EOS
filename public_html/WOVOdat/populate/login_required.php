<?php 

include 'php/include/header.php'; 
include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>LOGIN</a></div>";
?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
		<h3> You must <a href="/populate/index.php">login</a> first to be able to access WOVOdata tools and submit data. </h3> 
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->