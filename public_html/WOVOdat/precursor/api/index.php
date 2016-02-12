<?php
	
	include 'route.php';
	// include 'config/database.php';
	include 'repository/earthquake.php';
	
	/*
		Test database
	*/
	// $db = new Database();
	// $row = $db-> query("Select vd_name, vd_cavw FROM vd  ORDER BY vd_name");
	// getEarthquakes($quantity, $cavw, $lat, $lon, $startDate, $endDate, $startDepth, $endDepth, $elev, $width)
	// $working_earthquake = new Earthquake();
	// $working_earthquakes = $working_earthquake-> getEarthquakes("", "", "46", "-121", "1970/08/07", "1999/09/08", -20, 40, "", 70);

	/*
		Handle requests
	*/
	// $route = new Route();
	// $route-> add('/earthquakes');
	// $route-> add('/earthquakes/{id}');

	// Earthquake with query string
	$num = $_GET['num'];
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$startDepth = $_GET['startDepth'];
	$endDepth = $_GET['endDepth'];
	$type = $_GET['type'];
	$width = $_GET['width'];

	$earthquake = new Earthquake();
	$earthquakes = $earthquake-> getEarthquakes($num, "", "46", "-121", $startDate, $endDate, $startDepth, $endDepth, "", $width);

	// Return JSON 
	$json_object = ["numberOfEvents" => count($earthquakes), "startDate" => $startDate, "endDate" => $endDate, "startDepth" => $startDepth, "endDepth" => $endDepth, "earthquakes" => $earthquakes];

	// echo json_encode($json_object);

	echo json_encode($json_object);
?>