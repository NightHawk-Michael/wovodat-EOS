<?php
require_once "php/include/get_root.php";	 // Get root url
include "php/include/db_connect.php";        // Changed on 29-feb-2012

$dataType=trim($_GET["dataType"]);    
$edIdValue=trim($_GET["edId"]); 

	if($dataType == 'ed_for' || $dataType == 'ed_vid'){
	
		$sql="select ed_phs.ed_phs_id,ed_phs.ed_phs_stime from ed,ed_phs where ed.ed_id=ed_phs.ed_id and ed.ed_id='$edIdValue' and ed_phs.ed_phs_stime <> '0000-00-00 00:00:00' order by ed_phs.ed_phs_stime DESC";
	}
	
//echo $sql;

	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;

//	var_dump($data);
	
	if(isset($data)){
	
		echo "<span id='pedPhs'>Eruption Phase start time: </span>";
		echo "<select name='edPhsStime' id='edPhsStime' style='width:180px' class='required'>";
		echo "<option value='' $selected >Choose eruption Phase start time</option>";
	
		for($i=0;$i<sizeof($data);$i++){
			echo "<option value='{$data[$i][0]}'> {$data[$i][1]}  </option>";
		}	
		echo "</select>";
	}
	else{
	
		echo "<h1 class='noeruptionphserror' style='width:300px;color: #777777;font-size:12px;font-weight: bold;font-family: lucida, sans-serif;'>No eruption phase time for this volcano!<br/> Please create an eruption phase data first!</h1>";
	}
	
?>