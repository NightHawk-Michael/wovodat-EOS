<?php

/**********************************

This script is part of the permissions granting system.
The page displays a small form with fields for searching a user in the database. Submitting the form launches select_granted_user.php.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// 1st access
if (!isset($_SESSION['mng_perm'])) {
	// If direct access
	if (!isset($_POST['manage_permissions_ok'])) {
		// Default user: themselves
		$_SESSION['mng_perm']['granting_user_id']=$_SESSION['login']['cc_id'];
	}
	else {
		// Get selected granting user
		$_SESSION['mng_perm']['granting_user_id']=$_POST['select_user_perm'];
	}
	
	// Local variables
	$error="";
	$search_code="";
	$search_lname="";
	$search_fname="";
	$search_obs="";
	$search_email="";
}
// 2nd access
else {
	// Get information
	if (isset($_SESSION['mng_perm']['search_code'])) {
		$search_code=$_SESSION['mng_perm']['search_code'];
	}
	else {
		$search_code="";
	}
	if (isset($_SESSION['mng_perm']['search_lname'])) {
		$search_lname=$_SESSION['mng_perm']['search_lname'];
	}
	else {
		$search_lname="";
	}
	if (isset($_SESSION['mng_perm']['search_fname'])) {
		$search_fname=$_SESSION['mng_perm']['search_fname'];
	}
	else {
		$search_fname="";
	}
	if (isset($_SESSION['mng_perm']['search_obs'])) {
		$search_obs=$_SESSION['mng_perm']['search_obs'];
	}
	else {
		$search_obs="";
	}
	if (isset($_SESSION['mng_perm']['search_email'])) {
		$search_email=$_SESSION['mng_perm']['search_email'];
	}
	else {
		$search_email="";
	}
	if (isset($_SESSION['mng_perm']['search_error'])) {
		// Get error
		switch ($_SESSION['mng_perm']['search_error']) {
			case 0:
				// No error
				$error="";
				break;
			case 1:
				// All NULL fields
				$error="Please fill at least one field.";
				break;
			case 2:
				// No user correspond to these search criterias
				$error="No user found. Check your spelling or try other criteria.";
				break;
			default:
				// Internal error
				$_SESSION['errors'][0]=array();
				$_SESSION['errors'][0]['code']=1119;
				$_SESSION['errors'][0]['message']="Unknown error given in variable";
				$_SESSION['l_errors']=1;
				// Redirect to system error page
				header('Location: '.$url_root.'system_error.php');
				exit();
		}
	}
	else {
		$error="";
	}
}


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'>Account</a> > Manage contact information </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
	
			<div class="form">
				<!-- Page content -->
				<h2>Granted user selection</h2>
	
				<p class="redtext"><?php print $error; ?></p>
				<p>Select user for whom you wish to grant permissions:</p>
				<p>Search user by:</p>
				
				<form method="post" action="select_granted_user.php" name="form_sgu">
					<table id="table_sgu">
						<tr>
							<th>Contact code:</th>
							<td>
								<input type="text" maxlength="30" name="search_code" value="<?php print $search_code; ?>" />
							</td>
						</tr>
						<tr>
							<th>First name:</th>
							<td>
								<input type="text" maxlength="30" name="search_fname" value="<?php print $search_fname; ?>" />
							</td>
						</tr>
						<tr>
							<th>Last name:</th>
							<td>
								<input type="text" maxlength="30" name="search_lname" value="<?php print $search_lname; ?>" />
							</td>
						</tr>
						<tr>
							<th>Observatory:</th>
							<td>
								<input type="text" maxlength="150" name="search_obs" value="<?php print $search_obs; ?>" />
							</td>
						</tr>
						<tr>
							<th>E-mail address:</th>
							<td>
								<input type="text" maxlength="255" name="search_email" value="<?php print $search_email; ?>" />
							</td>
						</tr>
					</table>
					<br />
					
					<div style="padding:20px 150px;" >
						<input type="submit" name="search_granted_user_ok" value="submit" id="submit" />
					</div>

				</form>

		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->