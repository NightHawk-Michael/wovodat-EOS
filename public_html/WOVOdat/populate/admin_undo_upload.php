<?php

/**********************************

This file displays a web page accessible ONLY by the administrator.
The page contains a form where all the processed files are displayed.
One of these files can be selected (associated radio button) and when submit is clicked, admin_undo_upload_check.php will be launched to "undo" the file process.

**********************************/

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";


// Check that user is administrator (cc_id=3 => Alex, cc_id=200 => Purbo)
if ($_SESSION['login']['cc_id']!=269 && $_SESSION['login']['cc_id']!=199 && $_SESSION['login']['cc_id']!=359) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get upload history

// Import necessary scripts
require_once "php/funcs/db_funcs.php";

// SELECT cu_id, cu_file, cu_loaddate FROM cu WHERE cu_type = 'P'
$select_table="cu";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="cu_id";
$select_field_name[1]="cu_file";
$select_field_name[2]="cu_loaddate";
$select_field_name[3]="cc_id_load";
$select_where_field_name=array();
$select_where_field_comp=array();
$select_where_field_value=array();
$select_where_logical=array();
$select_where_field_name[0]="cu_type";
$select_where_field_comp[0]="=";
$select_where_field_value[0]="P";
$select_errors="";
if (!db_select_ext($select_table, $select_field_name, $select_where_field_name, $select_where_field_comp, $select_where_field_value, $select_where_logical, $select_field_value, $select_errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1103;
			$_SESSION['errors'][0]['message']=$select_errors." to db_select_ext() // undo_upload.php";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4025;
			$_SESSION['errors'][0]['message']=$select_errors." // undo_upload.php";
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
$num_files=count($select_field_value);
if ($num_files!=0) {
	$ids=array();
	$files=array();
	$loaddates=array();
	$loader_ids=array();
	for ($i=0; $i<$num_files; $i++) {
		$ids[$i]=$select_field_value[$i][0];
		$files[$i]=$select_field_value[$i][1];
		$loaddates[$i]=$select_field_value[$i][2];
		$loader_ids[$i]=$select_field_value[$i][3];
	}
	
	// Sort arrays according to loaddate
	if (!array_multisort($loaddates, $loader_ids, $files, $ids)) {
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=3104;
		$_SESSION['errors'][0]['message']="Error when trying to sort arrays in undo_upload.php";
		$_SESSION['l_errors']=1;
		// Redirect user to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}

// Store info in SESSION
session_start();
$_SESSION['undo_upload']=array();
$_SESSION['undo_upload']['num_files']=$num_files;
$_SESSION['undo_upload']['ids']=$ids;
$_SESSION['undo_upload']['files']=$files;
$_SESSION['undo_upload']['loaddates']=$loaddates;
$_SESSION['undo_upload']['loader_ids']=$loader_ids;


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'> Undo upload (Direct Access) </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
		
			<!-- Page content -->
			<h1>Undo upload</h1>
				
				<?php

				if ($num_files==0) {
					echo "<p>You did not upload any file in the last $limitday days. <a href=\"home.php\">Go back to home page</a></p>";
					
					
				}else {

				?>		
				
					<p>Select file for which you want to undo upload:</p>
						<form method="post" action="admin_undo_upload_confirm.php" name="select_users">
							<table id="select_users">
								<tr>
									<th></th>
									<th>File name</th>
									<th>Upload date</th>
									<th>Loader ID</th>
								</tr>
					<?php

						// For each file
						for ($i=0; $i<$num_files; $i++) {
							if ($i==0) {
								print "\t\t\t\t<tr>\n".
								"\t\t\t\t\t<td><input type=\"radio\" checked=\"true\" name=\"file\" value=\"".$ids[0]."\" /></td>\n".
								"\t\t\t\t\t<td>".$files[0]."</td>\n".
								"\t\t\t\t\t<td>".$loaddates[0]."</td>\n".
								"\t\t\t\t\t<td>".$loader_ids[0]."</td>\n".
								"\t\t\t\t</tr>\n";
							}
							else {
								print "\t\t\t\t<tr>\n".
								"\t\t\t\t\t<td><input type=\"radio\" name=\"file\" value=\"".$ids[$i]."\" /></td>\n".
								"\t\t\t\t\t<td>".$files[$i]."</td>\n".
								"\t\t\t\t\t<td>".$loaddates[$i]."</td>\n".
								"\t\t\t\t\t<td>".$loader_ids[$i]."</td>\n".
								"\t\t\t\t</tr>\n";
							}
						}
					}	
					?>
				</table>
				<br />
				<input type="submit" name="undo_upload_back" value="Back" />
				<input type="submit" name="undo_upload_ok" value="OK" />
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