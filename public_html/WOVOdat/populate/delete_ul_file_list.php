<?php

// Import necessary scripts
require_once("php/funcs/db_funcs.php");

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Check that user is a developper
if ($_SESSION['permissions']['access']!=0) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get message from redirection
$message=NULL;
if (isset($_SESSION['delete_ul_file_check'])) {
	if (isset($_SESSION['delete_ul_file_check']['message'])) {
		$message=$_SESSION['delete_ul_file_check']['message'];
		unset($_SESSION['delete_ul_file_check']);
	}
}

// Get list of records stored cu table
$query_sql="SELECT cu_id, cu_file, cu_type, cu_com, cu_loaddate, cc_id_load FROM cu ORDER BY cu_loaddate ASC";
$query_results=array();
$query_error="";
if (!db_sql($query_sql, $query_results, $query_error)) {
	// Database error
	$_SESSION['errors'][0]=array();
	$_SESSION['errors'][0]['code']=1120;
	$_SESSION['errors'][0]['message']=$query_error." [delete_ul_file_list.php -> db_sql(query_sql=$query_sql)]";
	$_SESSION['l_errors']=1;
	// Redirect user to system error page
	header('Location: '.$url_root.'system_error.php');
	exit();
}

// Get number of results
$cnt_results=count($query_results);


include 'php/include/header.php'; 
?>

<style type="text/css">
table#table_slgu {
    text-align: left;
    font-size: 12pt;
    border-spacing: 0px;
    border-width: 1px;
    border-color: #505050;
    border-style: solid;
    border-collapse: collapse;
}

table#table_slgu th {
    text-align: center;
    font-size: 8pt;
    border-width: 1px;
    border-color: #505050;
    border-style: solid;
    padding: 2px;
    background-color: #ccc;
}

table#table_slgu td {
    font-size: 7pt;
    border-width: 1px;
    border-color: #505050;
    border-style: solid;
    padding: 2px;
}
</style>
<?
include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php'>Submit Data</a> > Incoming File </div>";

?>

</div>  <!-- header-menu -->  

	<div class="body">

		<div class="widecontent">
		
			<!-- Page content -->
			<h2>Submitted files, listed in "cu" table, with processing status</h2>
			<span class="redtext"><?php print $message; ?></span>
<?php

if ($cnt_results==0) {
	print <<<STRING
		<p>There is no record in cu table.</p>
STRING;
}
else {
	print <<<STRING
		<p>Type of upload: P=Processed, PE=Process Error, TBP=To Be Processed, T=Translated, TE=Translation Error, TBT=To Be Translated, U=Undone, O=Others</p>
		<p>Select file that you wish to delete permanently (from database and server):</p>
		<form method="post" action="delete_ul_file_confirm.php" name="form_slgu">
			<div id="div_slgu">
				<table id="table_slgu">
					<tr>
						<th></th>
						<th>ID</th>
						<th>File name</th>
						<th>Type of upload</th>
						<th>Comments</th>
						<th>Load date</th>
						<th>Loader ID</th>
					</tr>
STRING;
	
	// Display list of uploaded files
	for ($i=0; $i<$cnt_results; $i++) {
		print "\n\t\t\t\t\t<tr>".
			"\n\t\t\t\t\t\t<td><input type=\"radio\" name=\"select_file\" value=\"".htmlentities($query_results[$i]['cu_id'], ENT_COMPAT, "cp1252")."\" /></td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cu_id'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cu_file'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cu_type'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cu_com'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cu_loaddate'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t\t<td>".htmlentities($query_results[$i]['cc_id_load'], ENT_COMPAT, "cp1252")."</td>".
			"\n\t\t\t\t\t</tr>";
	}

	print <<<STRING
				</table>
				<br />
				<input type="submit" name="select_file_ok" value="OK" />
			</div>
		</form>
STRING;
} 

?>
		</div>
	</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->	