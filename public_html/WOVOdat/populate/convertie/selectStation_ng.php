<?php
//require_once "php/include/login_check.php";  // Check login    Commented on 25-Feb-2013
require_once "php/include/get_root.php";    // Get root url
include "php/include/db_connect.php";        // Changed on 29-feb-2012

	
// Added on 1-june-2012  for gi and ti 

	$airplane_sate=trim($_GET['airplane_sate']); 

	$sql="select cs_name from cs where cs.cs_type='$airplane_sate'";
	
	$result = mysql_query($sql);

	$data=array('...'); // create array with value first

	if($result){	     // To avoid showing mysql error on webpage if no result

		while($row=mysql_fetch_array($result))
			$data[]=$row[0]; // Note:  $row[0]
	}

	echo"<div style='width:10%;padding-top:10px;'></div>";


	if(isset($data[1])){ 	
		
		if($airplane_sate == 'A'){
			echo "<span id='id_air_sat_select'>Choose Airplane: </span>";
			echo"<select name='airplane' id='airplane' style='width:180px;' class='required'>";			
		}else if($airplane_sate == 'S'){
			echo "<span id='id_air_sat_select'>Choose Satellite: </span>";
			echo"<select name='satellite' id='satellite' style='width:180px;' class='required'>";
		}	
	
		for($i=0;$i<sizeof($data);$i++){
			if($data[$i] == '...'){
				$selected = " selected='true' ";
			}else{	
				$selected ="";
			}	

			if($i == 0){	 // Added on 3-May-2012
				echo "<option value='' $selected > {$data[$i]}  </option>";
			}
			else{
				echo "<option value='{$data[$i]}' $selected > {$data[$i]}  </option>";
			}

		}	
		echo "</select>";

	}
	else{
		
		echo "<h1 class='nosatelliteerror' style='width:300px;color: #777777;font-size:12px;font-weight: bold;font-family: lucida, sans-serif;'>No Airborne for this volcano you have chosen!<br/> Please create an airborne first!</h1>";	
	}	
		
?>