<?php
include "model/common_model_ng.php";


$obs=$_GET["kode"];
$vol=getvollist($obs);

if(isset($_GET['dataType'])){  // Use it for Monitoring system
	
	$dataType=$_GET['dataType'];
	
	if($dataType != "" && $dataType != "Airplane" && $dataType!= "Satellite"){	

		if($dataType == "SeismicStation" || $dataType == "DeformationStation" || $dataType == "GasStation"   || $dataType == "HydrologicStation" || $dataType == "ThermalStation" || $dataType == "FieldsStation" || $dataType == "MeteoStation" ){	
		
			echo "<span id='pvol'>Volcano (OR) closest volcano to the station: </span>";
			echo "<select name='vol2' id='vol2' style='width:180px' class='required'>";	
			
		}
		elseif($dataType == "SeismicInstrument" || $dataType == "DeformationInstrument_General" ||  $dataType == "DeformationInstrument_Tilt/Strain" ||  $dataType == "GasInstrument" || $dataType == "HydrologicInstrument" || $dataType == "ThermalInstrument" || $dataType == "FieldsInstrument" || $dataType == "MeteoInstrument"){
			echo "<span id='pvol'>Volcano (OR) closest volcano to the instrument: </span>";
			echo "<select name='vol2' id='vol2' style='width:180px' class='required'>";	
			
		}
		elseif($dataType == "SeismicComponent") {
			echo "<span id='pvol'>Volcano: </span>";
			echo "<select name='vol2' id='vol2' style='width:180px' class='required'>";	
		}
		else if($dataType == "SeismicNetwork" || $dataType == "DeformationNetwork" || $dataType == "GasNetwork"   || $dataType == "HydrologicNetwork" || $dataType == "ThermalNetwork" || $dataType == "FieldsNetwork" || $dataType == "MeteoNetwork" ){
		
			echo "<span id='pvol'>Volcano(Hold down the Ctrl to select multiple volcanoes): </span>";
			echo "<select name='vol2[]' id='vol2' style='width:180px' class='required' multiple='multiple'>";		
		}

		echo"<option value=''>...</option>";

		if($vol){
			for($i=0;$i<sizeof($vol);$i++){
				echo "<option value=\"{$vol[$i][0]}\">{$vol[$i][0]}</option>";
			}
		}
		
		echo "</select>";
	}
}
else{    // Use it for Monitoring data and Specific

	echo "<span id='pvol'>Volcano: </span>";
	echo "<select name='vol2' id='vol2' style='width:180px' class='required'>";	
	echo"<option value=''> ... </option>";

	if($vol){
		for($i=0;$i<sizeof($vol);$i++){
			echo "<option value=\"{$vol[$i][0]}\">{$vol[$i][0]}</option>";
		}
	}
	echo "</select>";
}
?>