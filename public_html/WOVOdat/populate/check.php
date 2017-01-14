<?php
// Allow unlimited capacity and time
ini_set("memory_limit","-1");
set_time_limit(0);

// Check login
require_once "php/include/login_check.php";

// Get root url
require_once "php/include/get_root.php";

// Check direct access
if (!isset($_POST['check_select_table_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get posted information
$checked_tables=$_POST['select_table'];

// Initialize messages
$messages=array();

// Loop on tables and check (using include)
foreach ($checked_tables as $check_table) {
	// Initialize table messages
	$msgs=array();
	// Include fonction to do
	include "php/include/check/".$check_table.".php";
	$messages[$check_table]=$msgs;
}


include 'php/include/header.php'; 

include 'php/include/menu.php'; 

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php'>Submit Data</a> > Tabel Check </div>";

?>


</div>  <!-- header-menu -->

	<div class="body">

		<div class="widecontent">
				
				<!-- Page content -->
				<h1>Check tables result</h1>
<?php

if (empty($checked_tables)) {
	print <<<STRING
				<p>No table was selected.</p>
STRING;
}
else {
	// Start list
	print <<<STRING
				<p>Here is a list of messages returned for each table checked:</p>
				<ul>
STRING;
	foreach ($messages as $table => $table_messages) {
		print <<<STRING
					<li>Table $table:</li>
STRING;
		if (empty($table_messages)) {
		print <<<STRING
					<p>No error found.</p>
STRING;
		}
		else {
			print <<<STRING
					<ul>
STRING;
			foreach ($table_messages as $message) {
				print <<<STRING
						<li>$message</li>
STRING;
			}
			print <<<STRING
					</ul>
STRING;
		}
	}
	print <<<STRING
				</ul>
STRING;
}
?>

			<p><a href="/populate/home.php">Go to homepage</a> or <a href="/populate/check_select_table.php">go to table selection page</a></p>

		</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->