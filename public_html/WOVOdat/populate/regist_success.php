<?php
/**********************************
This page displays a short message to confirm to users that their registration was successful.
**********************************/
include 'php/include/header.php'; 

include 'php/include/menu.php'; 
 
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/regist_form.php'>Register</a> > Registration in prgress </div>";

?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">

		<!-- Page content -->
		<h1>Registration successful!</h1>
		<p>Thank you for your contribution to WOVOdat.</p>
		<p>You may now go back to the <a href="index.php">welcome page</a> and log in.</p>
	<
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->	