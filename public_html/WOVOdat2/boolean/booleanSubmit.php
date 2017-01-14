<?php
SESSION_START();

	$_SESSION['booleanPostValue']=$_POST;
	
	unset($_SESSION['sqlWhereFeature']);
	unset($_SESSION['sqlWhereRock']);
	unset($_SESSION['sqlWhereEdPhase']);
	unset($_SESSION['sqlWhereEdPhaseData']);
	unset($_SESSION['sqlWhereVei']);
	unset($_SESSION['sqlWhereVeiData']);
	unset($_SESSION['sqlWhereEdTime']);
	unset($_SESSION['sqlWhereEdTimeData']);
	unset($_SESSION['sqlFromData']);

	
	//Seismic
	unset($_SESSION['sdEvnType']);
	unset($_SESSION['sqlWhereEvn']);
	unset($_SESSION['sdEvsType']);
	unset($_SESSION['sqlWhereEvs']);
	unset($_SESSION['sqlWhereInt']);
	unset($_SESSION['sdIvlType']);
	unset($_SESSION['sqlWhereIvl'] );	
	unset($_SESSION['sdTrmType']); 
	unset($_SESSION['sqlWhereTrm']);	
	unset($_SESSION['sqlWhereRsm']);
	unset($_SESSION['sqlWhereSsm']);
	
	
	//Deformation
	unset($_SESSION['sqlWhereAng']);
	unset($_SESSION['sqlWhereEdm']);
	unset($_SESSION['sqlWhereGps']);
	unset($_SESSION['sqlWhereGpv']);
	unset($_SESSION['sqlWhereLev']);
	unset($_SESSION['sqlWhereStr']);
	unset($_SESSION['sqlWhereTlt']);
	unset($_SESSION['sqlWhereTlv']);

	//Fields
	unset($_SESSION['sqlWhereEle']);  
	unset($_SESSION['sqlWhereGra']);	
	unset($_SESSION['sqlWhereMag']); 
	unset($_SESSION['sqlWhereMgv']);	
	
	//Gas
	unset($_SESSION['gdSpecies']);
	unset($_SESSION['sqlWhereGd']);
	unset($_SESSION['gdPluSpecies']);
	unset($_SESSION['sqlWherePlu']);
	unset($_SESSION['gdSolSpecies']);
	unset($_SESSION['sqlWhereSol']);
	
	
	//Hydrologic
	unset($_SESSION['hdSpecies']);
	unset($_SESSION['sqlWherehd']);
	
	//Thermal
	unset($_SESSION['sqlWhereTd']);
	
	//Meteo
	unset($_SESSION['sqlWhereMed']);
	
	
   if(isset($_POST['feature'])){ 
		
		if(sizeof($_POST['feature']) > 1){
			$sqlWhereFeature=" and (";
		
			for($i=0;$i<sizeof($_POST['feature']);$i++){
				$sqlWhereFeature.="vjn.vd_inf_type='{$_POST['feature'][$i]}'";
			
				if($i < (sizeof($_POST['feature'])-1)) $sqlWhereFeature.=" || ";
			}
			$sqlWhereFeature.=")";
		}else{
			$sqlWhereFeature =" and vjn.vd_inf_type='{$_POST['feature'][0]}'";
		}		
			$_SESSION['sqlWhereFeature']=$sqlWhereFeature;
		/*
		(vjn.vd_inf_type='Caldera' || vjn.vd_inf_type='Complex volcano')		
		(OR)
		vjn.vd_inf_type='Caldera'		
		*/
	}

	if(isset($_POST['rock'])){ 

		if(sizeof($_POST['rock']) > 1){
			$sqlWhereRock=" and (";
			
			for($i=0;$i<sizeof($_POST['rock']);$i++){
				$sqlWhereRock.="vjn.vd_inf_rtype='{$_POST['rock'][$i]}'";
				
				if($i < (sizeof($_POST['rock'])-1)) $sqlWhereRock.=" || ";
			}
			$sqlWhereRock.=")";
		}else{
			$sqlWhereRock =" and vjn.vd_inf_rtype='{$_POST['rock'][0]}'";
		}		
			$_SESSION['sqlWhereRock']=$sqlWhereRock;
		/*
		(vjn.vd_inf_rtype='Caldera' || vjn.vd_inf_rtype='Complex volcano')		
		(OR)
		vjn.vd_inf_rtype='Caldera'		
		*/
			
	}	
	
	if(isset($_POST['edPhase'])){ 

	
		if(sizeof($_POST['edPhase']) > 1){
			$sqlWhereEdPhases.=" and (";
			
			for($i=0;$i<sizeof($_POST['edPhase']);$i++){
				$sqlWhereEdPhases.="ed_phs.ed_phs_type='{$_POST['edPhase'][$i]}'";
				
				if($i < (sizeof($_POST['edPhase'])-1)) $sqlWhereEdPhases.=" || ";
			}
			$sqlWhereEdPhases.=")";
		}else{
			$sqlWhereEdPhases.=" and ed_phs.ed_phs_type='{$_POST['edPhase'][0]}'";
		}
			
		$sqlFromData = ",ed_phs";
		$sqlWhereEdPhase = " and ed.ed_id=ed_phs.ed_id".$sqlWhereEdPhases;	
		$sqlWhereEdPhaseData = " and vjn.ed_id=ed_phs.ed_id".$sqlWhereEdPhases;	

		$_SESSION['sqlFromData']=$sqlFromData;	
		$_SESSION['sqlWhereEdPhaseData']=$sqlWhereEdPhaseData; // Use it in Monitoring data filter
		$_SESSION['sqlWhereEdPhase']=$sqlWhereEdPhase;	
		/*
		(ed_phs.ed_phs_type='Explosive' || ed_phs.ed_phs_type='Lava flow')
		*/
			
	}

	if(isset($_POST['veiMin']) || isset($_POST['veiMax']) ){

	    if($_POST['veiMin'] !="" && $_POST['veiMax'] != "") { 
	        $sqlWhereVei = " and (ed.ed_vei between '{$_POST['veiMin']}' and '{$_POST['veiMax']}')"; 
			$sqlWhereVeiData = " and (vjn.ed_vei between '{$_POST['veiMin']}' and '{$_POST['veiMax']}')"; 
	    }   
 	    else if($_POST['veiMin'] != "" && $_POST['veiMax'] == ""){ 
	        $sqlWhereVei = " and (ed.ed_vei >= '{$_POST['veiMin']}')"; 
			$sqlWhereVeiData = " and (vjn.ed_vei >= '{$_POST['veiMin']}')"; 
	    }     
	    else if($_POST['veiMin'] == "" && $_POST['veiMax'] != ""){ 
	        $sqlWhereVei = " and (ed.ed_vei <= '{$_POST['veiMax']}')";
			$sqlWhereVeiData = " and (vjn.ed_vei <= '{$_POST['veiMax']}')";
	    }  
					
		$_SESSION['sqlWhereVei']=$sqlWhereVei;       
		$_SESSION['sqlWhereVeiData']=$sqlWhereVeiData;		 // Use it in Monitoring data filter
		/*
		ed.ed_vei >= '4'
		*/
			
	} 
	

	if(isset($_POST['edTimeMin']) || isset($_POST['edTimeMax']) ){

	    if($_POST['edTimeMin'] !="" && $_POST['edTimeMax'] != "") { 
	        $sqlWhereEdTime = " and (ed.ed_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')";
			$sqlWhereEdTimeData = " (vjn.ed_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')";
			
			if(isset($_POST['sd_evn'])){ 
				$_SESSION['sqlWhereEvn'] = " (sd_evn.sd_evn_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and"; 
				
				$sdEvnType=$_SESSION['booleanPostValue']['sd_evn'];
				$sdEvnTotalSize=sizeof($sdEvnType);
				
				if($sdEvnTotalSize > 1){
					$_SESSION['sdEvnType']=" (";
					
					for($i=0;$i<$sdEvnTotalSize;$i++){
					    $_SESSION['sdEvnType'] .="sd_evn.sd_evn_eqtype='{$sdEvnType[$i]}'";
						
						if($i < ($sdEvnTotalSize-1)) $_SESSION['sdEvnType'] .=" || "; 
					}
	
					$_SESSION['sdEvnType'] .=")";
					
				}else{
					$_SESSION['sdEvnType'] =" sd_evn.sd_evn_eqtype='{$sdEvnType[0]}' ";
				
				}
			}	 

			if(isset($_POST['sd_evs'])){ 
			
				$_SESSION['sqlWhereEvs'] = " (sd_evs.sd_evs_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and"; 
				
				$sdEvsType=$_SESSION['booleanPostValue']['sd_evs'];
				$sdEvsTotalSize=sizeof($sdEvsType);
				
				if($sdEvsTotalSize > 1){
					$_SESSION['sdEvsType']=" (";
					
					for($i=0;$i<$sdEvsTotalSize;$i++){
						$_SESSION['sdEvsType'] .="sd_evs.sd_evs_eqtype='{$sdEvsType[$i]}'";
						if($i < ($sdEvsTotalSize-1)) $_SESSION['sdEvsType'] .=" || "; 
					}
	
					$_SESSION['sdEvsType'] .=")";
					
				}else{
					$_SESSION['sdEvsType'] =" sd_evn.sd_evn_eqtype='{$sdEvsType[0]}' ";
				}
			}			
			
			if(isset($_POST['sd_int'])){ 
				$_SESSION['sqlWhereInt'] = " (sd_int.sd_int_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}			
			
			if(isset($_POST['sd_ivl'])){ 
				$_SESSION['sqlWhereIvl'] = " (sd_ivl.sd_ivl_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and"; 
				
				$sdIvlType=$_SESSION['booleanPostValue']['sd_ivl'];
				$sdIvlTotalSize=sizeof($sdIvlType);
				
				if($sdIvlTotalSize > 1){
					$_SESSION['sdIvlType']=" (";
					
					for($i=0;$i<$sdIvlTotalSize;$i++){  
						$_SESSION['sdIvlType'] .="sd_ivl.sd_ivl_eqtype='{$sdIvlType[$i]}'";
						if($i < ($sdIvlTotalSize-1)) $_SESSION['sdIvlType'] .=" || "; 
					}
	
					$_SESSION['sdIvlType'] .=")";
					
				}else{
					$_SESSION['sdIvlType'] =" sd_ivl.sd_ivl_eqtype='{$sdIvlType[0]}' ";
				}
		
			}	 			

				
			if(isset($_POST['sd_trm'])){ 
				$_SESSION['sqlWhereTrm'] = " (sd_trm.sd_trm_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and"; 
				
				$sdTrmType=$_SESSION['booleanPostValue']['sd_trm'];
				$sdTrmTotalSize=sizeof($sdTrmType);
				
				if($sdTrmTotalSize > 1){
					$_SESSION['sdTrmType']=" (";
					
					for($i=0;$i<$sdTrmTotalSize;$i++){  
						$_SESSION['sdTrmType'] .="sd_trm.sd_trm_type='{$sdTrmType[$i]}'";
						if($i < ($sdTrmTotalSize-1)) $_SESSION['sdTrmType'] .=" || "; 
					}
	
					$_SESSION['sdTrmType'] .=")";
					
				}else{
					$_SESSION['sdTrmType'] =" sd_trm.sd_trm_type='{$sdTrmType[0]}' ";
				}
		
			}	 		
			
			if(isset($_POST['sd_rsm'])){ 
				$_SESSION['sqlWhereRsm'] = " (sd_rsm.sd_rsm_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}			
			
			if(isset($_POST['sd_ssm'])){ 
				$_SESSION['sqlWhereSsm'] = " (sd_ssm.sd_ssm_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}	
			
			if(isset($_POST['dd_ang'])){ 
				$_SESSION['sqlWhereAng'] = " (dd_ang.dd_ang_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}
			
			if(isset($_POST['dd_edm'])){ 
				$_SESSION['sqlWhereEdm'] = " (dd_edm.dd_edm_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}			

			if(isset($_POST['dd_gps'])){ 
				$_SESSION['sqlWhereGps'] = " (dd_gps.dd_gps_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['dd_gpv'])){ 
				$_SESSION['sqlWhereGpv'] = " (dd_gpv.dd_gpv_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}			
	
			if(isset($_POST['dd_lev'])){ 
				$_SESSION['sqlWhereLev'] = " (dd_lev.dd_lev_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}
		
			if(isset($_POST['dd_str'])){ 
				$_SESSION['sqlWhereStr'] = " (dd_str.dd_str_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['dd_tlt'])){ 
				$_SESSION['sqlWhereTlt'] = " (dd_tlt.dd_tlt_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}
			
			if(isset($_POST['dd_tlv'])){ 
				$_SESSION['sqlWhereTlv'] = " (dd_tlv.dd_tlv_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['fd_ele'])){ 
				$_SESSION['sqlWhereEle'] = " (fd_ele.fd_ele_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['fd_gra'])){ 
				$_SESSION['sqlWhereGra'] = " (fd_gra.fd_gra_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['fd_mag'])){ 
				$_SESSION['sqlWhereMag'] = " (fd_mag.fd_mag_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}

			if(isset($_POST['fd_mgv'])){ 
				$_SESSION['sqlWhereMgv'] = " (fd_mgv.fd_mgv_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}			

			
			if(isset($_POST['gd'])){ 
				$_SESSION['sqlWhereGd']= " (gd.gd_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and"; 
				$gdSpecies=$_SESSION['booleanPostValue']['gd'];
				$gdTotalSize=sizeof($gdSpecies);
				
				if($gdTotalSize > 1){
					$_SESSION['gdSpecies']=" (";
					
					for($i=0;$i<$gdTotalSize;$i++){
						$_SESSION['gdSpecies'] .="gd.gd_species='{$gdSpecies[$i]}'";
						if($i < ($gdTotalSize-1)) $_SESSION['gdSpecies'] .=" || "; 
					}
	
					$_SESSION['gdSpecies'] .=")";
					
				}else{
					$_SESSION['gdSpecies'] =" gd.gd_species='{$gdSpecies[0]}' ";
				}

				
			}

			if(isset($_POST['gd_plu'])){ 
				$_SESSION['sqlWherePlu']= " (gd_plu.gd_plu_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and";
				$gdPluSpecies=$_SESSION['booleanPostValue']['gd_plu'];
				$gdPluTotalSize=sizeof($gdPluSpecies);
				
				if($gdPluTotalSize > 1){
					$_SESSION['gdPluSpecies']=" (";
					
					for($i=0;$i<$gdPluTotalSize;$i++){
						$_SESSION['gdPluSpecies'] .="gd_plu.gd_plu_species='{$gdPluSpecies[$i]}'";
						if($i < ($gdPluTotalSize-1)) $_SESSION['gdPluSpecies'] .=" || "; 
					}
	
					$_SESSION['gdPluSpecies'] .=")";
					
				}else{
					$_SESSION['gdPluSpecies'] =" gd_plu.gd_plu_species='{$gdPluSpecies[0]}' ";
				}
			
			}			
    			
			if(isset($_POST['gd_sol'])){ 
				$_SESSION['sqlWhereSol']= " (gd_sol.gd_sol_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and";
				$gdSolSpecies=$_SESSION['booleanPostValue']['gd_sol'];
				$gdSolTotalSize=sizeof($gdSolSpecies);
				
				if($gdSolTotalSize > 1){
					$_SESSION['gdSolSpecies']=" (";
					
					for($i=0;$i<$gdSolTotalSize;$i++){
						$_SESSION['gdSolSpecies'] .="gd_sol.gd_sol_species='{$gdSolSpecies[$i]}'";
						if($i < ($gdSolTotalSize-1)) $_SESSION['gdSolSpecies'] .=" || "; 
					}
	
					$_SESSION['gdSolSpecies'] .=")";
					
				}else{
					$_SESSION['gdSolSpecies'] =" gd_sol.gd_sol_species='{$gdSolSpecies[0]}' ";
				}
			
			}						

			if(isset($_POST['hd'])){ 
				$_SESSION['sqlWherehd']= " (hd.hd_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}') and";
				$hdSpecies=$_SESSION['booleanPostValue']['hd'];
				$hdTotalSize=sizeof($hdSpecies);
				
				if($hdTotalSize > 1){
					$_SESSION['hdSpecies']=" (";
					
					for($i=0;$i<$hdTotalSize;$i++){
						$_SESSION['hdSpecies'] .="hd.hd_comp_species='{$hdSpecies[$i]}'";
						if($i < ($hdTotalSize-1)) $_SESSION['hdSpecies'] .=" || "; 
					}
	
					$_SESSION['hdSpecies'] .=")";
					
				}else{
					$_SESSION['hdSpecies'] =" hd.hd_comp_species='{$hdSpecies[0]}' ";
				}
			
			}
			
			if(isset($_POST['td'])){ 
				$_SESSION['sqlWhereTd'] = " (td.td_time between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')"; 
			}	
			
			if(isset($_POST['med'])){ 
				$_SESSION['sqlWhereMed'] = " (med.med_time between '{$_POST['edTimeMin']}'and '{$_POST['edTimeMax']}')"; 
			}	
			
		}   

		$_SESSION['sqlWhereEdTime']=$sqlWhereEdTime;       
		$_SESSION['sqlWhereEdTimeData']=$sqlWhereEdTimeData;		 // Use it in Monitoring data filter	
		/*
		ed.ed_stime between '2012-07-13 00:00:00' and '2012-08-01 00:00:00'
		*/
			  
	}

if((isset($_POST['sd_evn'])) || (isset($_POST['sd_evs'])) || (isset($_POST['sd_int'])) || (isset($_POST['sd_ivl'])) || (isset($_POST['sd_trm'])) || (isset($_POST['sd_rsm'])) || (isset($_POST['sd_ssm'])) || (isset($_POST['dd_edm'])) || (isset($_POST['dd_gps'])) || (isset($_POST['dd_gpv'])) || (isset($_POST['dd_lev'])) || (isset($_POST['dd_sar'])) || (isset($_POST['dd_str'])) || (isset($_POST['dd_tlt'])) || (isset($_POST['dd_tlv'])) || 
(isset($_POST['fd_ele'])) ||  (isset($_POST['fd_gra'])) || (isset($_POST['fd_mag'])) || (isset($_POST['fd_mgv'])) || (isset($_POST['gd'])) || (isset($_POST['gd_plu'])) || (isset($_POST['gd_sol'])) || (isset($_POST['hd'])) || 
(isset($_POST['td'])) ||  (isset($_POST['med']))){
	header("location: booleanSubmitData.php");
}		
else if((isset($_POST['feature'])) || (isset($_POST['rock'])) || (isset($_POST['veiMin'])) || (isset($_POST['veiMax'])) || (isset($_POST['edTimeMin'])) || (isset($_POST['edTimeMax'])) || (isset($_POST['edPhase']))){      
	header("location: booleanSubmitNoData.php");
}



?>