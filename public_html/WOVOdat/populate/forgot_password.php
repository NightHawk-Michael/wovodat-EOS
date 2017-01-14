<?php 
if(!isset($_SESSION))
	session_start();

if (!isset($_SESSION['forgot_pw'])) {   // If 1st access
	$uname="";      	               // Blank field
	$uname_error=FALSE;  	           // No error
}
else {  							  // 2nd time access
	$uname=$_SESSION['forgot_pw']['uname'];
	$uname_error=$_SESSION['forgot_pw']['uname_error'];     // Get error, if any
}

include 'php/include/header.php';

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/forgot_password.php'>Forgot Password</a></div>";

?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">

		<div class="form">
			<table>
				<tr>
					<td><h2>Forgot password</h2></td>
				</tr>

				<tr>
					<td>Please enter your contact information below:</td> <td></td>
				</tr>	

				<tr>
					<td>   
							
						<form method="post" action="forgot_password_check.php" name="login_forgot_form">
							<table class="formtable" id="formtable">
								<tr>
									<th>*Username:</th>
									<td>
										<input type="text" maxlength="30" name="uname" value="<?php print $uname; ?>" /><span style="color:red;"><?php if ($uname_error) {print " (User not registered, please check spelling)";} ?></span>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<input type="submit" name="cancel" value="Cancel" id="submit" />
										<input type="submit" name="ok" value="OK"  id="reset" />
									</td>
								</tr>	
							</table>
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->
				
