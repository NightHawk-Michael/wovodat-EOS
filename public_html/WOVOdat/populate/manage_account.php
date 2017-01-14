<?php

// Check login
require_once("php/include/login_check.php");

// Local variable
$update_error="";

// Did an error occurred?
if (isset($_GET['attempt'])) {
	$attempt=$_GET['attempt'];
	if ($attempt==1) {
		// Password change unsuccessful
		$update_error="Password change unsuccessful! Please try again:";
	}
}


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'>Account</a> > Manage account</div>";

?>

</div>  <!-- header-menu -->  
	
	<div class="body">

		<div class="widecontent">

		
			<div class="form">
				<table>
					<tr>
						<td><h2>Manage account</h2></td>
					</tr>

					<tr>
						<td><span style="color:red;"><?php print $update_error; ?></span></td> <td></td>
					</tr>
		
					<tr>
						<td>   
								
							<form method="post" action="update_account.php" name="update_cr">
								<table class="formtable" id="formtable">
									<tr>
										<th>*Old password:</th>
										<td>
											<input type="password" maxlength="30" name="old_password" />
										</td>
									</tr>
									<tr>
										<th>*New password (&ge; 6 characters):</th>
										<td>
											<input type="password" maxlength="30" name="new_password" />
										</td>
									</tr>
									<tr>
										<th>*Confirm new password:</th>
										<td>
											<input type="password" maxlength="30" name="conf_new_password" />
										</td>
									</tr>
									
									<tr>
										<td>&nbsp;</td>
										<td>
											<input type="submit" name="confirm" value="Confirm" />
										</td>
									</tr>	
								</table>
							</form>
						</td>
					</tr>
				</table>		
		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->