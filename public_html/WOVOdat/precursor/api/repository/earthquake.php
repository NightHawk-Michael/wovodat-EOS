<?php
	
	include 'config/database.php';
	
	/* 
		Author: Nguyen Hoang Son
	*/

	class Earthquake{

		private $_db;

		// Make sure database will be set up before hand
		function __construct(){
			$this->_db = new Database();
		}
 
		// Get all earthquakes that satisfi the parameters condition from database
    	public function getEarthquakes($quantity, $cavw, $lat, $lon, $startDate, $endDate, $startDepth, $endDepth, $elev, $width) {

	        // Array of earthquakes returned
	        $earthquakes = array();

	        // Each earthquake of earthquakes array
	        $earthquake = array(
	        	"id" => "",
	        	"type" => "",
	        	"date" => "",
	        	"depth" => "",
	        	"primaryMagnitude" => "",
	        	"lattitude" => "",
	        	"longitude" => "",
	        );

	        // Get earthquakes from database
	       	$earthquakeQuery = $this->refineEarthquakeQuery($quantity, $lat, $lon, $startDate, $endDate, $startDepth, $endDepth, "", $width);
	        $getEarthquakes = mysql_query($earthquakeQuery) or die(mysql_error());

	        while ($row = mysql_fetch_array($getEarthquakes)){
	        	$earthquake["id"] = $row["sn_id"];
	        	$earthquake["type"] = $row["sd_evn_eqtype"];
	        	$earthquake["date"] = $row["sd_evn_time"];
	        	$earthquake["depth"] = $row["sd_evn_edep"];
	        	$earthquake["primaryMagnitude"] = $row["sd_evn_pmag"];
	        	$earthquake["lattitude"] = $row["sd_evn_elat"];
	        	$earthquake["longitude"] = $row["sd_evn_elon"];
	        	array_push($earthquakes, $earthquake);
	        };

	        return $earthquakes;
    	}

		/*
		 	Helper methods which provide reusable services across Earthquake class
		*/

		// Refine query string for earthquake 
		private function refineEarthquakeQuery($quantity, $latitude, $longitude, $startDate, $endDate, $startDepth, $endDepth, $eqtype, $wkm){

			if (is_numeric($startDepth) && is_numeric($endDepth)) {
	            
	        } else {
	            $startDepth = -40;
	            $endDepth = 40;
	        }
	        
	        $earthquakeQuery = "SELECT ";

	        $earthquakeQuery .= " sd_evn_elat, sd_evn_elon, sd_evn_edep, sd_evn_pmag, sd_evn_time, sd_evn_eqtype, sn_id, (0.15 * (unix_timestamp(sd_evn_time)/unix_timestamp(now())) + 0.2 * (rand() * sd_evn_edep/$endDepth)  + 0.65 * rand()) as id FROM sd_evn ";
	        $earthquakeQuery .= " WHERE ABS($latitude - sd_evn_elat) < 1 AND ABS($longitude - sd_evn_elon) < 6 ";

	        if ($wkm == "")
	            $wkm = 60;

	        $earthquakeQuery .= " AND SQRT(POW(($latitude - sd_evn_elat)*110, 2) + POW(($longitude - sd_evn_elon) * 111.32 * COS($latitude/57.32), 2))<  " . $wkm / 2;

	        $earthquakeQuery .= " AND sd_evn_pubdate <= now() ";

	        if ($startDate && $endDate) {
	            // $startDate = preg_split('/\//', $startDate);
	            // $endDate = preg_split('/\//', $endDate);
	            // $dates = " and sd_evn_time BETWEEN '$startDate[2]/$startDate[0]/$startDate[1]' AND '$endDate[2]/$endDate[0]/$endDate[1]' ";
	            $dates = " and sd_evn_time BETWEEN '$startDate' AND '$endDate' ";
	            $earthquakeQuery .= $dates;
	        }

	            $depth = " and sd_evn_edep BETWEEN $startDepth AND $endDepth ";
	            $earthquakeQuery .= $depth;
	            
	        if ($eqtype) {
	            $quaketype = " and sd_evn_eqtype = $eqtype ";
	            $earthquakeQuery .= $quaketype;
	        }

	        $earthquakeQuery .= " order by id desc ";

	        if ($quantity) {
	            $limit = " limit $quantity ";
	            $earthquakeQuery .= $limit;
	        }

	        return $earthquakeQuery;
		}
	}
?>