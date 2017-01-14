<?php
if(!isset($_SESSION))
	session_start();

// Get root url
require_once "php/include/get_root.php";
$webpage_link="http://{$_SERVER['SERVER_NAME']}/populate";


if(isset($_SESSION['login'])){	
	header('Location:download_installable.php');
}
else{

	// Local variable
	$login_error="";

	// Get attempt URL attribute
	if (isset($_GET['attempt']) == 1) {
		$login_error="Wrong username or password. Please try again.";
	}

	if(isset($_GET['nopost']) == 1) {
		$login_error="Warning! For accessing this page, please login first."; 
	} 
	
	include 'php/include/header.php'; 
?>

	<script language='javascript' type='text/javascript'>
	
		$(document).ready(function(){

			$('#installpackage').validate();

			$("form#installpackage").submit(function() {	
				if($('#error').css("display") == 'block'){
					$('#error').css('display','none');	
				}
			});

		});	
	</script>


	<style type="text/css">
	label.error {font-size:9px; float: none; color: red; padding-left: .5em; vertical-align: top; }
	</style>	
		
<?php	
	include 'php/include/menu.php';  
	
	echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/doc/index.php'>Documentation </a> > Login</div>";

?>
	
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
		<div class="form width50" style="margin-bottom: 0;">
			<!-- Registration / Login -->
			
			<div id="disablecontent" style="display:none;">
				echo"Download successful";  
			</div>
				
				<!-- Registration / Login -->
				<table>
				
					<tr>
						<!-- Login -->
						<td colspan="3" id="regisLoginC2"><h2>Log In</h2></td>
					</tr>
				
					
					<!-- Login form -->
					<form name="installpackage" id="installpackage" method="post" action="install_check.php">
				
						<!-- Login errors -->
						<tr>
							<td colspan="3" id="regisLoginError">
								<span style='color:red;text-align:center;'><?php print $login_error; ?></span>
							</td>
						</tr>
					
						<!-- Username -->
						<tr>
							<th id="regisLoginUname" class="label">Username:</th>
							<td>
								<input type="text" name="uname" />
							</td>
						</tr>
						
						<!-- Password -->
						<tr>
							<th id="regisLoginpw" class="label">Password:</th>
							<td id="regisLoginpw">
								<input type="password" name="password" />
							</td>
							<td colspan="2" id="regisLoginSubmitButton">
								<input type="submit" name="login_submit" value="log in" id="submit" />
							</td>
						</tr>
					</form>

					<!-- Forgot password -->
					<tr> 
						<td colspan="3" id="forgotPW"><a href="<?php echo $webpage_link ?>/forgot_password.php">Forgot Your Password?</a></td>
					</tr>
			</table>
		</div>
		
		<div class="grey width50">
			<h2>New User?</h2>
			<!-- Registration -->
			<a href="<?php echo $webpage_link ?>/regist_form.php">Register Here</a>
		</div>

					
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->	

<?php	
	}      //end Else statement
?>
