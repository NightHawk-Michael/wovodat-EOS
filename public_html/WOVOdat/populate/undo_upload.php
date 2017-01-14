<?php

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Get upload history for this user

// Import necessary scripts
require_once "php/funcs/db_funcs.php";

// Get user ID
$user_id=$_SESSION['login']['cc_id'];

// Get current time
$current_year=date("Y");
$current_month=date("m");
$current_day=date("d");
$current_time=date("H:i:s");

/*For 199 user, $limitday variable is not using anymore becaue directly give permission in MySQL statment. 
Nang added on 22-Feb-2013
*/
if ($user_id==199){
	$limitday=60;
}elseif($user_id==200){
	$limitday=56;
}else{
	$limitday=7;
}

// Undo is allowed up to 7 days after upload date
if ((int)($current_day)<$limitday) {
	// Depending on month
	switch ($current_month) {
		case "01":
			// January
			$year=(string)((int)($current_year)-1); // e.g.: 2009 -> 2008
			$month="12";
			$day=(string)(24+(int)($current_day)); // e.g.: 01 -> 25 ... 07 -> 31
			break;
		case "02":
		case "04":
		case "06":
		case "08":
		case "09":
		case "11":
			// February, April, June, August, September, November
			$year=$current_year;
			$month=(string)((int)($current_month)-1); // e.g.: 06 -> 05
			if (strlen($month)==1) {
				$month="0".$month;
			}
			$day=(string)(24+(int)($current_day)); // e.g.: 01 -> 25 ... 07 -> 31
			break;
		case "03":
			// March
			$year=$current_year;
			$month="02";
			$day=(string)(21+(int)($current_day)); // e.g.: 01 -> 22 ... 07 -> 28
			break;
		case "05":
		case "07":
		case "10":
		case "12":
			// May, July, October, December
			$year=$current_year;
			$month=(string)((int)($current_month)-1); // e.g.: 10 -> 09
			if (strlen($month)==1) {
				$month="0".$month;
			}
			$day=(string)(23+(int)($current_day)); // e.g.: 01 -> 24 ... 07 -> 30
			break;
	}
}
else {
	$year=$current_year;
	$month=$current_month;
	$day=(string)((int)($current_day)-7); // e.g.: 08 -> 01 ... 31 -> 24
	if (strlen($day)==1) {
		$day="0".$day;
	}
}
$limit_date=$year."-".$month."-".$day." ".$current_time;
//$limit_date="1000-01-01 00:00:00";

if($user_id==200){
	// SELECT cu_id, cu_file, cu_loaddate FROM cu WHERE cu_loaddate > '$limit_date' 
	$select_table="cu";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="cu_id";
	$select_field_name[1]="cu_file";
	$select_field_name[2]="cu_loaddate";
	$select_where_field_name=array();
	$select_where_field_comp=array();
	$select_where_field_value=array();
	$select_where_logical=array();
	$select_where_field_name[0]="cu_loaddate";
	$select_where_field_comp[0]=">";
	$select_where_field_value[0]=$limit_date;

	$select_where_logical[0]='AND';
	$select_where_field_name[1]="cu_type";
	$select_where_field_comp[1]="=";
	$select_where_field_value[1]="P";
	$select_errors="";
}else if($user_id==199){   //Nang added on 22-Feb-2013 

	//SELECT cu_id, cu_file, cu_loaddate FROM cu WHERE cu_loaddate > date_sub(now(), interval 5 month) AND cu_type= 'P' AND cc_id_load = '199'
	$select_table="cu";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="cu_id";
	$select_field_name[1]="cu_file";
	$select_field_name[2]="cu_loaddate";
	$select_where_field_name=array();
	$select_where_field_comp=array();
	$select_where_field_value=array();
	$select_where_logical=array();
	$select_where_field_name[0]="cu_loaddate";
	$select_where_field_comp[0]="> date_sub(now(), interval 3 month) AND cu_type=";
	$select_where_field_value[0]="P";

	$select_where_logical[0]='AND';
	$select_where_field_name[1]="cc_id_load";
	$select_where_field_comp[1]="=";
	$select_where_field_value[1]=$user_id;

	$select_errors="";

}else{
	// SELECT cu_id, cu_file, cu_loaddate FROM cu WHERE cu_loaddate > '$limit_date' AND cc_id_load = '$user_id'
	$select_table="cu";
	$select_field_name=array();
	$select_field_value=array();
	$select_field_name[0]="cu_id";
	$select_field_name[1]="cu_file";
	$select_field_name[2]="cu_loaddate";
	$select_where_field_name=array();
	$select_where_field_comp=array();
	$select_where_field_value=array();
	$select_where_logical=array();
	$select_where_field_name[0]="cu_loaddate";
	$select_where_field_comp[0]=">";
	$select_where_field_value[0]=$limit_date;

	$select_where_logical[0]='AND';
	$select_where_field_name[1]="cc_id_load";
	$select_where_field_comp[1]="=";
	$select_where_field_value[1]=$user_id;

	$select_where_logical[1]='AND';
	$select_where_field_name[2]="cu_type";
	$select_where_field_comp[2]="=";
	$select_where_field_value[2]="P";
	$select_errors="";
}

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
	for ($i=0; $i<$num_files; $i++) {
		$ids[$i]=$select_field_value[$i][0];
		$files[$i]=$select_field_value[$i][1];
		$loaddates[$i]=$select_field_value[$i][2];
	}
	
	// Sort arrays according to loaddate
	if (!array_multisort($loaddates, $files, $ids)) {
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


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'> Undo upload (Direct Access) </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
			
			<!-- Page content -->
			<h2>Undo upload</h2>
			
				<?php

				if ($num_files==0) {
					echo "<p>You did not upload any file in the last $limitday days. <a href=\"home.php\">Go back to home page</a></p>";
					
					
				}else {

				?>
					<p>Select file for which you want to undo upload:</p>
					<form method="post" action="undo_upload_confirm.php" name="select_users">
						<table id="select_users">
							<tr>
								<th></th>
								<th>File name</th>
								<th>Upload date</th>
							</tr>
					<?php

						// For each file
						for ($i=0; $i<$num_files; $i++) {
							if ($i==0) {
								print "\t\t\t\t<tr>\n".
								"\t\t\t\t\t<td><input type=\"radio\" checked=\"true\" name=\"file\" value=\"".$ids[0]."\" /></td>\n".
								"\t\t\t\t\t<td>".$files[0]."</td>\n".
								"\t\t\t\t\t<td>".$loaddates[0]."</td>\n".
								"\t\t\t\t</tr>\n";
							}
							else {
								print "\t\t\t\t<tr>\n".
								"\t\t\t\t\t<td><input type=\"radio\" name=\"file\" value=\"".$ids[$i]."\" /></td>\n".
								"\t\t\t\t\t<td>".$files[$i]."</td>\n".
								"\t\t\t\t\t<td>".$loaddates[$i]."</td>\n".
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