<?php
session_start();  // Start session
session_regenerate_id(true);// Regenerate session ID
if(!isset($_SESSION['login'])) {
	header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
	exit();
} else {	
	$observatory = $_SESSION['observatory'];// = $_POST['owner1'];
	$data_type = $_SESSION['data_type'];// = $_POST['data_type'];
	$volcano = $_SESSION['volcano'];// = $_POST['volcano'];
	$station_network = ucfirst($_SESSION['station_network']);// = $_POST['station_network'];
	$station = $_SESSION['station'];// = $_POST['station'];
	$network = $_SESSION['network'];// = $_POST['network'];
	$file_name = $_SESSION['file_name'];// = $_FILES['file_input']['name'];
	$file_size = $_SESSION['file_size'];// = $_FILES['file_input']['size'];
}
?>

<html>
	<?php 
		echo "Successfully converted CSV file <br/><br/>";
		echo "Time: " . date("Y-m-d H:i:s") . "<br/><br/>";
		echo "Observatory name: " . $observatory . "<br/><br/>";
		echo "Conversion data type: " . $data_type . "_" . $station_network . "<br/><br/>";
		echo "Volcano Name: " . $volcano . "<br/><br/>";
		echo $station_network . " name: " . $station . $network . "<br/><br/>";
		echo "File name: " . $file_name . "<br/><br/>";
		echo "File size: " . $file_size . " bytes <br/><br/>";
	?>
	<a href = "download_converted_file.php"> Download converted file </a> 
	<br/><br/>
	<a href = "/populate"> Go back </a> 
</html>