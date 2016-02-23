<?php
require_once "php/include/get_root.php";	 // Get root url
include "php/include/db_connect.php";        // Changed on 29-feb-2012


$volcanoName=trim($_GET["volcan"]);      				   // get valcano name
$dataType=trim($_GET["dataType"]);    

	if($dataType == 'ed_phs' || $dataType == 'ed_for'  || $dataType == 'ed_vid'){
		
		$sql="select distinct ed.ed_id,ed.ed_stime from ed,vd where ed.vd_id=vd.vd_id and vd.vd_name='$volcanoName' and ed_stime <> '0000-00-00 00:00:00' order by ed.ed_stime DESC";
		
	}
	
//echo $sql;

	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;

//	var_dump($data);
	
	if(isset($data)){
	
		echo "<span id='ped'>Eruption start time: </span>";
		echo "<select name='edStime' id='edStime' style='width:180px' class='required'>";
		echo "<option value='' $selected >Choose eruption start time</option>";
	
		for($i=0;$i<sizeof($data);$i++){
			echo "<option value='{$data[$i][0]}'> {$data[$i][1]}  </option>";
		}	
		echo "</select>";
	}
	else{
	
		echo "<h1 class='noeruptionerror' style='width:300px;color: #777777;font-size:12px;font-weight: bold;font-family: lucida, sans-serif;'>No eruption time for this volcano!<br/> Please create an eruption data first!</h1>";
	}
	
?>