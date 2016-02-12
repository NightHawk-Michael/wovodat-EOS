<?php
require_once "php/include/get_root.php";    // Get root url
include "php/include/db_connect.php";  

	
$volca=trim($_GET['volcan']);  			    	   // Get valcano name
$stationdisplay=trim($_GET['stationdisplay']);    //get SeismicStation or GasStation etc
$kilometer=trim($_GET['kilometer']);   		        // get kilo meter value


	
if($stationdisplay=="IntervalSwarmData" || $stationdisplay == "RSAM" ){  

	
	if($kilometer == "nokilometer"){
		$result = mysql_query("select distinct s.ss_name,s.ss_code from ss as s,sn as n,vd where s.sn_id = n.sn_id and n.vd_id = vd.vd_id and vd.vd_name='$volca'") or die(mysql_error());
	}
	else{
		if($kilometer != "all"){
	
			$result= mysql_query("select distinct ss.ss_name,ss.ss_code FROM jj_volnet as j, ss, cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = ss.sn_id and cc.cc_id=ss.cc_id and vd.vd_id=vf.vd_id and vd.vd_name= '$volca' and j.jj_net_flag = 'S'  and (sqrt(power(vf.vd_inf_slat - ss.ss_lat, 2) + power(vf.vd_inf_slon - ss.ss_lon, 2))*100)<= '$kilometer'") or die(mysql_error());
		}
		else{
			$result= mysql_query("select distinct ss.ss_name,ss.ss_code FROM jj_volnet as j, ss, cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = ss.sn_id and cc.cc_id=ss.cc_id and vd.vd_id=vf.vd_id and vd.vd_name= '$volca' and j.jj_net_flag = 'S'") or die(mysql_error());
		}
	}	
	
}  
else if($stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData" || $stationdisplay == "TiltVectorData" || $stationdisplay == "StrainMeterData" ){ 

	
	if($kilometer == "nokilometer"){
	
		if($stationdisplay == "TiltVectorData" || $stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"){   // di_tlt_type='TILT' 
		$sql ="select distinct s.ds_name,s.ds_code from ds as s, cn, vd, di_tlt as di where s.cn_id = cn.cn_id and cn.vd_id = vd.vd_id and s.ds_id= di.ds_id and cn.cn_type='Deformation' and di.di_tlt_type='TILT' and vd.vd_name = '$volca'";	

		$result = mysql_query($sql);		
		}else if($stationdisplay == "StrainMeterData"){    //di.di_tlt_type='Strain'
			$sql ="select distinct s.ds_name,s.ds_code from ds as s, cn, vd, di_tlt as di where s.cn_id = cn.cn_id and cn.vd_id = vd.vd_id and s.ds_id= di.ds_id and cn.cn_type='Deformation' and di.di_tlt_type='Strain' and vd.vd_name = '$volca'";		
			$result = mysql_query($sql);		
		}
	}
	else{
		if($kilometer != "all"){
			if($stationdisplay == "TiltVectorData" || $stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"){ // di_tlt_type='TILT' 
	
				$result= mysql_query("select distinct s.ds_name,s.ds_code FROM jj_volnet as j, ds as s,di_tlt as di,cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = s.cn_id and cc.cc_id= s.cc_id and vd.vd_id=vf.vd_id and s.ds_id= di.ds_id and vd.vd_name='$volca' and j.jj_net_flag = 'C' and di.di_tlt_type='TILT' and (sqrt(power(vf.vd_inf_slat - s.ds_nlat, 2) + power(vf.vd_inf_slon - s.ds_nlon, 2))*100)< '$kilometer'") or die(mysql_error());
				
			}else if($stationdisplay == "StrainMeterData"){    //di.di_tlt_type='Strain'
				
				$result= mysql_query("select distinct s.ds_name,s.ds_code FROM jj_volnet as j, ds as s,di_tlt as di,cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = s.cn_id and cc.cc_id= s.cc_id and vd.vd_id=vf.vd_id and s.ds_id= di.ds_id and vd.vd_name='$volca' and j.jj_net_flag = 'C' and di.di_tlt_type='Strain' and (sqrt(power(vf.vd_inf_slat - s.ds_nlat, 2) + power(vf.vd_inf_slon - s.ds_nlon, 2))*100)< '$kilometer'") or die(mysql_error());			
			
			}
		}
		else{
		
			if($stationdisplay == "TiltVectorData" || $stationdisplay == "ElectronicTiltData" || $stationdisplay == "PostElectronicTiltData"){ // di_tlt_type='TILT'
			
				$result= mysql_query("select distinct s.ds_name,s.ds_code FROM jj_volnet as j, ds as s,di_tlt as di,cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = s.cn_id and cc.cc_id= s.cc_id and vd.vd_id=vf.vd_id and s.ds_id= di.ds_id and vd.vd_name='$volca' and j.jj_net_flag = 'C' and di.di_tlt_type='TILT'") or die(mysql_error());		
		
			}else if($stationdisplay == "StrainMeterData"){    //di.di_tlt_type='Strain'
				$result= mysql_query("select distinct s.ds_name,s.ds_code FROM jj_volnet as j, ds as s,di_tlt as di,cc, vd_inf as vf, vd WHERE j.vd_id =vf.vd_id and j.jj_net_id = s.cn_id and cc.cc_id= s.cc_id and vd.vd_id=vf.vd_id and s.ds_id= di.ds_id and vd.vd_name='$volca' and j.jj_net_flag = 'C' and di.di_tlt_type='Strain'") or die(mysql_error());

			}
		}
	}	
}




	$data=array('Choose Station'); // creat array with value first

	if($result){	     // To avoid showing mysql error on webpage if no result

		while($row=mysql_fetch_array($result)){
			$data[]=$row;

		}	
	}
	
	if($kilometer != 'nokilometer'){
		echo"<div style='width:10%;margin-top:-15px;'></div>";
		echo"<div style='width:10%;padding-top:25px;'></div>";
	}
	
	if(isset($data[1])){ 
	

		if($kilometer == 'nokilometer'){
			echo"<div style='width:10%;padding-top:15px;'></div>";
		}	
		echo "<span id='id_net_stat_text'>Station: </span>";
		echo"<select name='station' id='station' style='width:180px;'>";
		


		for($i=0;$i<sizeof($data);$i++){
			if($data[$i] == 'Choose Station'){
				$selected = " selected='true' ";
			}else{	
				$selected ="";
			}	

			if($i == 0){	
				echo "<option value='' $selected > {$data[$i]}  </option>";
			}
			else{
				echo "<option value='{$data[$i][1]}_sflag_{$data[$i][0]}' $selected >{$data[$i][0]}</option>";
			}
			

		}	
		echo "</select>";

	}
	else{
		echo "<h1 id='nostation' class='nostationerror' style='text-align: left;color: #777777;font-size:12px;font-weight: bold;'>No station for this volcano!<br/> Please create a station first!</h1>";	
	}
	
	

?>