<?php
if(!isset($_SESSION))
	session_start();
	
require_once "php/include/login_check.php";
require_once "php/include/get_root.php";
include "php/include/header.php";  
	
// Get information stored
$user_admin=$_SESSION['permissions']['user_admin'];
$l_user_admin=$_SESSION['permissions']['l_user_admin'];
$cc_id=$_SESSION['login']['cc_id'];      

include 'php/include/menu.php'; 
 
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Account</div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
			
			
			<!-- Page content -->
			
			<div>
			
				<?php
					echo "<h2>".$_SESSION['login']['cr_uname']."'s Account Summary</h2>";
				
				?>
			
				<ul>
					<li>
						<p><a href="manage_account.php">Change my password</a></p>
					</li>
					<li>
<?php

// If user has no admin permission for other users
if ($l_user_admin==0) {
	print <<<STRING
					<p><a href="manage_contact_info.php">Change my contact information</a></p>
STRING;
}
else {
	print <<<STRING
					<form action="manage_contact_info.php" enctype="multipart/form-data" method="post">
						<p>Change contact information for:
							<select name="select_user_ccinfo" style='width:375px;'>
								<option value="$cc_id"> Myself ($user_name) </option>\n
STRING;
	for ($i=0; $i<$l_user_admin; $i++) {
		$user_id=$user_admin['id'][$i];
		$username=$user_admin['name'][$i];
		print <<<STRING
								<option value="$user_id"> $username </option>\n
STRING;
	}
	print <<<STRING
							</select>
						</p>
						<p><input type="submit" name="manage_contact_info_ok" value="OK" /></p>
					</form>
STRING;
}

?>
				</li>
				<li>
<?php

// If user has no admin permission for other users
if ($l_user_admin==0) {
	print <<<STRING
					<p><a href="search_granted_user.php">Grant permissions to other users</a></p>
STRING;
}
else {
	print <<<STRING
					<form action="search_granted_user.php" enctype="multipart/form-data" method="post">
						<p>Grant permissions to other users</p>
						<p>Select granting user:
							<select name="select_user_perm" style='width:375px;'>
								<option value="$cc_id"> Myself ($user_name) </option>\n
STRING;
	for ($i=0; $i<$l_user_admin; $i++) {
		$user_id=$user_admin['id'][$i];
		$username=$user_admin['name'][$i];
		print <<<STRING
								<option value="$user_id"> $username </option>\n
STRING;
	}
	print <<<STRING
							</select>
						</p>
						<p><input type="submit" name="manage_permissions_ok" value="OK" /></p>
					</form>
STRING;
}

?>
				</li>
			</ul>
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