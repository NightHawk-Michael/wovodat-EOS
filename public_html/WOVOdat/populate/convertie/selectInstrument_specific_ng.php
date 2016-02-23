<?php
//require_once "php/include/login_check.php";  // Check login   Nang Commented on 25-Feb-2013
require_once "php/include/get_root.php";    // Get root url
include "php/include/db_connect.php";        // Changed on 29-feb-2012
	
	
$volca=trim($_GET['volcan']);  			    	   // Get valcano name
$stationdisplay=trim($_GET['stationdisplay']);    //Get SeismicStation or GasStation etc
$stationname=trim($_GET['staname']);               // Get station name OR satellite name

	
if($stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"  || $stationdisplay == "TiltVectorData" || $stationdisplay == "StrainMeterData" ){
	
	if($stationdisplay == "TiltVectorData" || $stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"){   // di_tlt_type='TILT' 
		
		$sql ="select distinct di.di_tlt_name,di.di_tlt_code from ds as s, cn, vd, di_tlt as di where s.cn_id = cn.cn_id and cn.vd_id = vd.vd_id and s.ds_id= di.ds_id and cn.cn_type='Deformation' and di.di_tlt_type='TILT' and vd.vd_name = '$volca' and s.ds_name ='$stationname' ";


		$result = mysql_query($sql);
	}else if($stationdisplay == "StrainMeterData"){    //di.di_tlt_type='Strain'
		
		$sql ="select distinct di.di_tlt_name,di.di_tlt_code from ds as s, cn, vd, di_tlt as di where s.cn_id = cn.cn_id and cn.vd_id = vd.vd_id and s.ds_id= di.ds_id and cn.cn_type='Deformation' and di.di_tlt_type='Strain' and vd.vd_name = '$volca' and s.ds_name ='$stationname' ";		
		$result = mysql_query($sql);
	}	
}



	$data=array('Choose Instrument'); // creat array with value first 

	if($result){	     // To avoid showing mysql error on webpage if no result

		while($row=mysql_fetch_array($result)){
			$data[]=$row;

		}	
	}


	echo"<div style='width:10%;padding-top:10px;'></div>";	

	if(isset($data[2])){   // Note: only show  instrument more than one instrument

		echo "<span id='id_inst_text'>Instrument: </span>";
		echo"<select name='instrument' id='instrument' style='width:180px;'>";
		
		for($i=0;$i<sizeof($data);$i++){
		
			if($data[$i] == 'Choose Instrument'){
				$selected = " selected='true' ";
			}else{	
				$selected ="";
			}	

			if($i == 0){	 
				echo "<option value='' $selected > {$data[$i]}  </option>";
			}
			else{
				echo "<option value='{$data[$i][1]}' $selected >{$data[$i][0]}</option>";
			}
			
		}	
		echo "</select>";
		
	}
	else if(isset($data[1])){  // don't show if only one instrument. Hide it by using "display:none" 
		echo"<select name='instrument' id='instrument' style='width:180px; display:none'>";
		echo "<option value='{$data[1][1]}' type='hidden'></option>";
		echo "</select>";
	
	}else{
		echo "<h1 class='noinstrumenterror' style='width:300px;color: #777777;font-size:12px;font-weight: bold;'>No Instrument for this station you have chosen! Please upload instrument first to upload data!</h1>";	
	}

?>