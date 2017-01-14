<?php

/**********************************

This page displays a small message to confirm to users that their password was successfully changed.

**********************************/

include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'>Account</a></div>";
?>

</div>  <!-- header-menu -->

	<div class="body">

		<div class="widecontent">

			<!-- Page content -->
			<h2>Update Successful!</h2>
			
			<p>You may now go back to the <a href="home_populate.php">home page</a> to do any other operation.</p>

		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->