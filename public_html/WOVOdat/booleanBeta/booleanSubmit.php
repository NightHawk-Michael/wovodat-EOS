<?php
SESSION_START();

	$_SESSION['booleanPostValue']=$_POST;

//	var_dump($_POST);   echo"<br/>";	
	
	unset($_SESSION['sqlWhereFeature']);
	unset($_SESSION['sqlWhereRock']);
	
	unset($_SESSION['sqlWhereLat']);
	unset($_SESSION['sqlWhereLon']);
	unset($_SESSION['sqlWhereElev']);     
	
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
	unset($_SESSION['sdEvnPmag']);
	unset($_SESSION['sdEvnEdepth']);
	unset($_SESSION['sdEvnDistance']);	
	
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
	unset($_SESSION['gdThreshold']);
	unset($_SESSION['sqlWhereGtemp']);
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
	
	if(isset($_POST['vd_inf_slat1']) || isset($_POST['vd_inf_slat2'])){ 
	
	/**  For google map
		$_SESSION['sqlWhereLat']= " and (vjn.vd_inf_slat between {$_POST['vd_inf_slat1']} and {$_POST['vd_inf_slat2']})"; 
	**/	
		$_SESSION['sqlWhereLat']= " and vjn.vd_inf_slat like '%{$_POST['vd_inf_slat1']}%' ";
	}	
	
	if(isset($_POST['vd_inf_slon1']) || isset($_POST['vd_inf_slon2'])){ 
	/**  For google map
		$_SESSION['sqlWhereLon']= " and (vjn.vd_inf_slon between {$_POST['vd_inf_slon1']} and {$_POST['vd_inf_slon2']})"; 
	**/		
		$_SESSION['sqlWhereLon']= " and vjn.vd_inf_slon like '%{$_POST['vd_inf_slon1']}%' ";
	}
	
	if(isset($_POST['vd_inf_selev1']) || isset($_POST['vd_inf_selev2'])){ 
	/**  For google map
		$_SESSION['sqlWhereElev']= " and (vjn.vd_inf_selev between {$_POST['vd_inf_selev1']} and {$_POST['vd_inf_selev2']})"; 
	**/		
		$_SESSION['sqlWhereElev']= " and vjn.vd_inf_selev like '%{$_POST['vd_inf_selev1']}%' ";
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
	
	if($_POST['edTimeMin'] !="" && $_POST['edTimeMax'] != "") { 
	
		$sqlWhereEdTime = " and (ed.ed_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')";
		$sqlWhereEdTimeData = " and (vjn.ed_stime between '{$_POST['edTimeMin']}' and '{$_POST['edTimeMax']}')";
		
		$_SESSION['sqlWhereEdTime']=$sqlWhereEdTime;       
		$_SESSION['sqlWhereEdTimeData']=$sqlWhereEdTimeData;		 // Use it in Monitoring data filter	
		
		/* ed.ed_stime between '2012-07-13 00:00:00' and '2012-08-01 00:00:00'  */
	}
				
		
	if(isset($_POST['sd_evn_eqtype'])  || isset($_POST['sd_evn_distance']) ||  isset($_POST['sd_evn_edep_min']) ||  isset($_POST['sd_evn_edep_max']) || isset($_POST['sd_evn_pmag_min']) ||  isset($_POST['sd_evn_pmag_max'])	){ 
/*  LOOK AT IT HERE => 12 Dec 2016 before discssing with C 

		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereEvn'] = " and sd_evn.sd_evn_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvn'] = " and sd_evn.sd_evn_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvn'] = " and (sd_evn.sd_evn_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
*/

		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereEvn'] = " and sd_evn.sd_evn_time >= DATE_SUB('{$_POST['priorityTimeMin']}', INTERVAL 1 YEAR )";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvn'] = " and sd_evn.sd_evn_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvn'] = " and (sd_evn.sd_evn_time between DATE_SUB('{$_POST['priorityTimeMin']}', INTERVAL 1 YEAR ) and DATE_ADD('{$_POST['priorityTimeMax']}',INTERVAL 1 YEAR )) "; 
		}



		if(isset($_POST['sd_evn_distance'])){   /** End Map Distance  **/
			$_SESSION['sdEvnDistance'] = $_POST['sd_evn_distance']; 	
		}

		if(isset($_POST['sd_evn_edep_min']) ||  isset($_POST['sd_evn_edep_max'])){   
			
			if(isset($_POST['sd_evn_edep_min'])){  // Note use tabel name as 'TempV1' bcoz of different condition
				$_SESSION['sdEvnEdepth'] = " and TempV1.sd_evn_edep >= '{$_POST['sd_evn_edep_min']}' ";
			} 
			
			if(isset($_POST['sd_evn_edep_max'])){  // Note use tabel name as 'TempV1' bcoz of different condition
				$_SESSION['sdEvnEdepth'] = " and TempV1.sd_evn_edep <= '{$_POST['sd_evn_edep_max']}' ";
			}
		
			if(isset($_POST['sd_evn_edep_min']) && isset($_POST['sd_evn_edep_max'])){
				$_SESSION['sdEvnEdepth'] = " and (TempV1.sd_evn_edep between '{$_POST['sd_evn_edep_min']}' and '{$_POST['sd_evn_edep_max']}') ";  // Note use tabel name as 'TempV1' bcoz of different condition
			}
	
		}    /** End sd_evn_edep  **/
		
		if(isset($_POST['sd_evn_pmag_min']) ||  isset($_POST['sd_evn_pmag_max'])){
			
			if(isset($_POST['sd_evn_pmag_min'])){ // Note use tabel name as 'TempV1' bcoz of different condition
				$_SESSION['sdEvnPmag'] = " and TempV1.sd_evn_pmag >= '{$_POST['sd_evn_pmag_min']}' ";
			}
			
			if(isset($_POST['sd_evn_pmag_max'])){ // Note use tabel name as 'TempV1' bcoz of different condition
				$_SESSION['sdEvnPmag'] = " and TempV1.sd_evn_pmag <= '{$_POST['sd_evn_pmag_max']}' ";
			}
		
			if(isset($_POST['sd_evn_pmag_min']) && isset($_POST['sd_evn_pmag_max'])){
				$_SESSION['sdEvnPmag'] = " and (TempV1.sd_evn_pmag between '{$_POST['sd_evn_pmag_min']}' and '{$_POST['sd_evn_pmag_max']}') ";  // Note use tabel name as 'TempV1' bcoz of different condition
			}
	
		}    /** End sd_evn_pmag  **/

		if(isset($_POST['sd_evn_eqtype'])) {
			$sdEvnType=$_SESSION['booleanPostValue']['sd_evn_eqtype'];
			$sdEvnTotalSize=sizeof($sdEvnType);
			
			if($sdEvnTotalSize > 1){
			
				$_SESSION['sdEvnType']=" and ("; 
			
				for($i=0;$i<$sdEvnTotalSize;$i++){
					$_SESSION['sdEvnType'] .="sd_evn.sd_evn_eqtype='{$sdEvnType[$i]}'";
					
					if($i < ($sdEvnTotalSize-1)) 
						$_SESSION['sdEvnType'] .=" || "; 
				}

				$_SESSION['sdEvnType'] .=")";
					
			}else{
				if($sdEvnType != "on")    // New 
					$_SESSION['sdEvnType'] =" and sd_evn.sd_evn_eqtype='{$sdEvnType[0]}'"; 
												  
			}
		}      /** End sd_evn_eqtype  **/	
			
	}  		

	if(isset($_POST['sd_evs'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereEvs'] = " and sd_evs.sd_evs_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvs'] = " and sd_evs.sd_evs_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEvs'] = " and (sd_evs.sd_evs_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}

		$sdEvsType=$_SESSION['booleanPostValue']['sd_evs'];
		$sdEvsTotalSize=sizeof($sdEvsType);
		
		if($sdEvsTotalSize > 1){
			$_SESSION['sdEvsType']=" and ("; 
			
			for($i=0;$i<$sdEvsTotalSize;$i++){
				$_SESSION['sdEvsType'] .="sd_evs.sd_evs_eqtype='{$sdEvsType[$i]}'";
				if($i < ($sdEvsTotalSize-1)) $_SESSION['sdEvsType'] .=" || "; 
			}

			$_SESSION['sdEvsType'] .=")";
			
		}else{
			if($sdEvsType != "on")
				$_SESSION['sdEvsType'] =" and sd_evs.sd_evs_eqtype='{$sdEvsType[0]}' ";
		}
	}			
			
	if(isset($_POST['sd_int'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereInt'] = " and sd_int.sd_int_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereInt'] = " and sd_int.sd_int_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereInt'] = " and (sd_int.sd_int_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}			
			
	if(isset($_POST['sd_ivl'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereIvl'] = " and sd_ivl.sd_ivl_stime >= '{$_POST['priorityTimeMin']}' ";
		}
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereIvl'] = " and sd_ivl.sd_ivl_stime  <= '{$_POST['priorityTimeMax']}' ";
		}
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereIvl'] = " and (sd_ivl.sd_ivl_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
		
		$sdIvlType=$_SESSION['booleanPostValue']['sd_ivl'];
		$sdIvlTotalSize=sizeof($sdIvlType);
		
		if($sdIvlTotalSize > 1){
			$_SESSION['sdIvlType']=" and (";
			
			for($i=0;$i<$sdIvlTotalSize;$i++){  
				$_SESSION['sdIvlType'] .="sd_ivl.sd_ivl_eqtype='{$sdIvlType[$i]}'";
				if($i < ($sdIvlTotalSize-1)) $_SESSION['sdIvlType'] .=" || "; 
			}

			$_SESSION['sdIvlType'] .=")";
			
		}else{
			if($sdIvlType != "on")
				$_SESSION['sdIvlType'] =" and sd_ivl.sd_ivl_eqtype='{$sdIvlType[0]}' ";
		}

	}	 			

	if(isset($_POST['sd_trm'])){

		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereTrm'] = " and sd_trm.sd_trm_stime >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTrm'] = " and sd_trm.sd_trm_stime  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTrm'] = " and (sd_trm.sd_trm_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}

		$sdTrmType=$_SESSION['booleanPostValue']['sd_trm'];
		$sdTrmTotalSize=sizeof($sdTrmType);
		
		if($sdTrmTotalSize > 1){
			$_SESSION['sdTrmType']=" and (";
			
			for($i=0;$i<$sdTrmTotalSize;$i++){  
				$_SESSION['sdTrmType'] .="sd_trm.sd_trm_type='{$sdTrmType[$i]}'";
				if($i < ($sdTrmTotalSize-1)) $_SESSION['sdTrmType'] .=" || "; 
			}

			$_SESSION['sdTrmType'] .=")";
			
		}else{
			if($sdTrmType != "on")   
				$_SESSION['sdTrmType'] =" and sd_trm.sd_trm_type='{$sdTrmType[0]}' ";
		}

	}	 		
			
	if(isset($_POST['sd_rsm'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereRsm'] = " and sd_rsm.sd_rsm_stime >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereRsm'] = " and sd_rsm.sd_rsm_stime  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereRsm'] = " and (sd_rsm.sd_rsm_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}			
	
	if(isset($_POST['sd_ssm'])){

		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereSsm'] = " and sd_ssm.sd_ssm_stime >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereSsm'] = " and sd_ssm.sd_ssm_stime  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereSsm'] = " and (sd_ssm.sd_ssm_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}	
			
	if(isset($_POST['dd_ang'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereAng'] = " and dd_ang.dd_ang_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereAng'] = " and dd_ang.dd_ang_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereAng'] = " and (dd_ang.dd_ang_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}	
	}
			
	if(isset($_POST['dd_edm'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereEdm'] = " and dd_edm.dd_edm_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEdm'] = " and dd_edm.dd_edm_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEdm'] = " and (dd_edm.dd_edm_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}	
	}			

	if(isset($_POST['dd_gps'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereGps'] = " and dd_gps.dd_gps_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGps'] = " and dd_gps.dd_gps_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGps'] = " and (dd_gps.dd_gps_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}

	if(isset($_POST['dd_gpv'])){
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereGpv'] = " and dd_gpv.dd_gpv_stime >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGpv'] = " and dd_gpv.dd_gpv_stime  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGpv'] = " and (dd_gpv.dd_gpv_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}			
	
	if(isset($_POST['dd_lev'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereLev'] = " and dd_lev.dd_lev_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereLev'] = " and dd_lev.dd_lev_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereLev'] = " and (dd_lev.dd_lev_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}
		
	if(isset($_POST['dd_str'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereStr'] = " and dd_str.dd_str_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereStr'] = " and dd_str.dd_str_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereStr'] = " and (dd_str.dd_str_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}

	if(isset($_POST['dd_tlt'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereTlt'] = " and dd_tlt.dd_tlt_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTlt'] = " and dd_tlt.dd_tlt_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTlt'] = " and (dd_tlt.dd_tlt_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}
			
	if(isset($_POST['dd_tlv'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereTlv'] = " and dd_tlv.dd_tlv_stime >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTlv'] = " and dd_tlv.dd_tlv_stime  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTlv'] = " and (dd_tlv.dd_tlv_stime between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}

	if(isset($_POST['fd_ele'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereEle'] = " and fd_ele.fd_ele_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEle'] = " and fd_ele.fd_ele_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereEle'] = " and (fd_ele.fd_ele_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}

	if(isset($_POST['fd_gra'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereGra'] = " and fd_gra.fd_gra_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGra'] = " and fd_gra.fd_gra_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGra'] = " and (fd_gra.fd_gra_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}	

	}

	if(isset($_POST['fd_mag'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereMag'] = " and fd_mag.fd_mag_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMag'] = " and fd_mag.fd_mag_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMag'] = " and (fd_mag.fd_mag_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	
	}

	if(isset($_POST['fd_mgv'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereMgv'] = " and fd_mgv.fd_mgv_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMgv'] = " and fd_mgv.fd_mgv_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMgv'] = " and (fd_mgv.fd_mgv_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 
		}
	}			

	if( isset($_POST['gd_concentration']) || isset($_POST['gd_concentration_min']) || isset($_POST['gd_concentration_max']) || isset($_POST['gd_gtemp_min']) || isset($_POST['gd_gtemp_max']) || isset($_POST['gd_bp_min']) || isset($_POST['gd_bp_max']) || isset($_POST['gd_flow_min']) || isset($_POST['gd_flow_max'])) {

		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereGd'] = " and gd.gd_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGd'] = " and gd.gd_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereGd'] = " and (gd.gd_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}

		/***  gd_SO2   ...  gd_CO2      $_SESSION['gdSpecies']
 and (
 (a.gd_plu_species= 'SO2' and a.gd_concentration between 0 and 200)
OR (a.gd_plu_species= 'CO2' and a.gd_plu_emit between 0 and 200)
)
***/	 
	 
		if(isset($_POST['gd_concentration']) || isset($_POST['gd_concentration_min']) || isset($_POST['gd_concentration_max'])) {
	 
			$gdConSpecies=$_SESSION['booleanPostValue']['gd_concentration'];
			$gdConTotalSize=sizeof($gdConSpecies);	
		
			if($gdConTotalSize > 1){
			
					$gdConWithSpec = " and "; 
						
					for($i=0;$i<$gdConTotalSize;$i++){
					
						$gdConWithSpec .="(gd.gd_species='{$gdConSpecies[$i]}'";
	  
						$min = "gd_concentration_min_".$gdConSpecies[$i];
						$max = "gd_concentration_max_".$gdConSpecies[$i];
						
						if(isset($_POST[$min]) && isset ($_POST[$max])){
						
							$gdConWithSpec .= " and (gd.gd_concentration between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
						
						}
						else if(isset($_POST[$min]) || isset ($_POST[$max])){
						
							if(isset($_POST[$min])){ 
							
								$gdConWithSpec .= " and gd.gd_concentration >= '{$_POST[$min]}'";
								
							}else if(isset($_POST[$max])){
							
								$gdConWithSpec .= " and gd.gd_concentration <= '{$_POST[$max]}'";
							}	
						}
			
						if($i < ($gdConTotalSize-1)) 
						//	$gdConWithSpec .=") || ";    /** change here when having dynamic operators **/
							$gdConWithSpec .=") and ";
					}

				$gdConWithSpec .=")";            
			}
			else {
			
				$gdConWithSpec = "" ;
				
				if(!isset($_POST['gd_concentration_min']) && !isset($_POST['gd_concentration_max'])) {	
					$min = "gd_concentration_min_".$gdConSpecies[0];
					$max = "gd_concentration_max_".$gdConSpecies[0];
					
					$gdConWithSpec .= " and gd.gd_species='{$gdConSpecies[0]}' ";
				}else{
					$min = "gd_concentration_min";
					$max = "gd_concentration_max";
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
				
					$gdConWithSpec .= " and (gd.gd_concentration between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdConWithSpec.= " and gd.gd_concentration >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdConWithSpec .= " and gd.gd_concentration <= '{$_POST[$max]}'";
					}	
				}
					
			}

		}    /** End gd_concentration  **/
		
		if(isset($_POST['gd_gtemp_min']) ||  isset($_POST['gd_gtemp_max'])){
			
			if(isset($_POST['gd_gtemp_min'])){
				$gdGtemp = " and gd.gd_gtemp >= '{$_POST['gd_gtemp_min']}' ";
			}
			
			if(isset($_POST['gd_gtemp_max'])){
				$gdGtemp = " and gd.gd_gtemp <= '{$_POST['gd_gtemp_max']}' ";
			}
		
			if(isset($_POST['gd_gtemp_min']) && isset($_POST['gd_gtemp_max'])){
				$gdGtemp = " and (gd.gd_gtemp between '{$_POST['gd_gtemp_min']}' and '{$_POST['gd_gtemp_max']}') "; 
			}
	
		}    /** End gd_gtemp  **/

		if(isset($_POST['gd_bp_min']) ||  isset($_POST['gd_bp_max'])){
			
			if(isset($_POST['gd_bp_min'])){
				$gdBp = " and gd.gd_bp >= '{$_POST['gd_bp_min']}' ";
			}
			
			if(isset($_POST['gd_bp_max'])){
				$gdBp = " and gd.gd_bp <= '{$_POST['gd_bp_max']}' ";
			}
		
			if(isset($_POST['gd_bp_min']) && isset($_POST['gd_bp_max'])){
				$gdBp = " and (gd.gd_bp between '{$_POST['gd_bp_min']}' and '{$_POST['gd_bp_max']}') "; 
			}
	
		}    /** End gd_bp **/
		
		if(isset($_POST['gd_flow_min']) ||  isset($_POST['gd_flow_max'])){
			
			if(isset($_POST['gd_flow_min'])){
				$gdFlow = " and gd.gd_flow >= '{$_POST['gd_flow_min']}' ";
			}
			
			if(isset($_POST['gd_flow_max'])){
				$gdFlow = " and gd.gd_flow <= '{$_POST['gd_flow_max']}' ";
			}
		
			if(isset($_POST['gd_flow_min']) && isset($_POST['gd_flow_max'])){
				$gdFlow = " and (gd.gd_flow between '{$_POST['gd_flow_min']}' and '{$_POST['gd_flow_max']}') "; 
			}
	
		}    /** End gd_flow  **/
		
		$_SESSION['gdSpecies'] = $gdConWithSpec.$gdGtemp.$gdBp.$gdFlow;
	
	}   /** End gd  **/ 

	if(isset($_POST['gd_plu_emit']) || isset($_POST['gd_plu_emit_min']) || isset($_POST['gd_plu_emit_max']) || 
	isset($_POST['gd_plu_mass']) || isset($_POST['gd_plu_mass_min']) || isset($_POST['gd_plu_mass_max']) ||
	isset($_POST['gd_plu_etot']) || isset($_POST['gd_plu_etot_min']) || isset($_POST['gd_plu_etot_max']) ||
	isset($_POST['gd_plu_etot']) || isset($_POST['gd_plu_etot_min']) || isset($_POST['gd_plu_etot_max']) || isset($_POST['gd_plu_height_min']) ||  isset($_POST['gd_plu_height_max'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWherePlu'] = " and gd_plu.gd_plu_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWherePlu'] = " and gd_plu.gd_plu_time  <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWherePlu'] = " and (gd_plu.gd_plu_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}
	  
		if(isset($_POST['gd_plu_emit']) || isset($_POST['gd_plu_emit_min']) || isset($_POST['gd_plu_emit_max'])) {
		
			$gdPluEmitSpecies=$_SESSION['booleanPostValue']['gd_plu_emit'];
			$gdPluEmitTotalSize=sizeof($gdPluEmitSpecies);

			if($gdPluEmitTotalSize > 1){
			
					$gdPluEmitWithSpec =" and ";
						
					for($i=0;$i<$gdPluEmitTotalSize;$i++){
					
						$gdPluEmitWithSpec .="(gd_plu.gd_plu_species='{$gdPluEmitSpecies[$i]}'";
	  
						$min = "gd_plu_emit_min_".$gdPluEmitSpecies[$i];
						$max = "gd_plu_emit_max_".$gdPluEmitSpecies[$i];
						
						if(isset($_POST[$min]) && isset ($_POST[$max])){
						
							$gdPluEmitWithSpec .= " and (gd_plu.gd_plu_emit between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
						
						}
						else if(isset($_POST[$min]) || isset ($_POST[$max])){
						
							if(isset($_POST[$min])){ 
							
								$gdPluEmitWithSpec .= " and gd_plu.gd_plu_emit >= '{$_POST[$min]}'";
								
							}else if(isset($_POST[$max])){
							
								$gdPluEmitWithSpec .= " and gd_plu.gd_plu_emit <= '{$_POST[$max]}'";
							}	
						}
			
						if($i < ($gdPluEmitTotalSize-1)) 
						//	$gdPluEmitWithSpec .=") || ";    /** change here when having dynamic operators **/
					     	$gdPluEmitWithSpec .=") and ";	
					}

				$gdPluEmitWithSpec .=")";
				
			}  
			else {
			
				$gdPluEmitWithSpec = "" ;
				
				if(!isset($_POST['gd_plu_emit_min']) && !isset($_POST['gd_plu_emit_max'])) {	
					$min = "gd_plu_emit_min_".$gdPluEmitSpecies[0];
					$max = "gd_plu_emit_max_".$gdPluEmitSpecies[0];
					
					$gdPluEmitWithSpec .= " and gd_plu.gd_plu_species='{$gdPluEmitSpecies[0]}' ";
				}else{
					$min = "gd_plu_emit_min";
					$max = "gd_plu_emit_max";
				
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdPluEmitWithSpec .= " and (gd_plu.gd_plu_emit between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdPluEmitWithSpec .= " and gd_plu.gd_plu_emit >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdPluEmitWithSpec .= " and gd_plu.gd_plu_emit <= '{$_POST[$max]}'";
					}	
				}
					
			} 
					
		}  /** End gd_plu_emit  **/
		
		if(isset($_POST['gd_plu_mass']) || isset($_POST['gd_plu_mass_min']) || isset($_POST['gd_plu_mass_max'])) {
			
			$gdPluMassSpecies=$_SESSION['booleanPostValue']['gd_plu_mass'];
			$gdPluMassTotalSize=sizeof($gdPluMassSpecies);
		
			if($gdPluMassTotalSize > 1){
			
				$gdPluMassWithSpec = " and ";  
					
				for($i=0;$i<$gdPluMassTotalSize;$i++){
				
					$gdPluMassWithSpec .="(gd_plu.gd_plu_species='{$gdPluMassSpecies[$i]}'";
  
					$min = "gd_plu_mass_min_".$gdPluMassSpecies[$i];
					$max = "gd_plu_mass_max_".$gdPluMassSpecies[$i];
					
					if(isset($_POST[$min]) && isset ($_POST[$max])){
					
						$gdPluMassWithSpec .= " and (gd_plu.gd_plu_mass between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
					
					}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					
						if(isset($_POST[$min])){ 
						
							$gdPluMassWithSpec .= " and gd_plu.gd_plu_mass >= '{$_POST[$min]}'";
							
						}else if(isset($_POST[$max])){
						
							$gdPluMassWithSpec .= " and gd_plu.gd_plu_mass <= '{$_POST[$max]}'";
						}	
					}
		
					if($i < ($gdPluMassTotalSize-1)) 
				//		$gdPluMassWithSpec .=" || ";   
						$gdPluMassWithSpec .=") and ";	  /** change here when having dynamic operators **/
				}

				$gdPluMassWithSpec .=")";
				
			} 	
			else {
			
				$gdPluMassWithSpec = "" ;
				
				if(!isset($_POST['gd_plu_mass_min']) && !isset($_POST['gd_plu_mass_max'])) {	
					$min = "gd_plu_mass_min_".$gdPluMassSpecies[0];
					$max = "gd_plu_mass_max_".$gdPluMassSpecies[0];
					
					$gdPluMassWithSpec .= " and gd_plu.gd_plu_species='{$gdPluMassSpecies[0]}' ";
				}else{
					$min = "gd_plu_mass_min";
					$max = "gd_plu_mass_max";
				
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdPluMassWithSpec .= " and (gd_plu.gd_plu_mass between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdPluMassWithSpec .= " and gd_plu.gd_plu_mass >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdPluMassWithSpec .= " and gd_plu.gd_plu_mass <= '{$_POST[$max]}'";
					}	
				}
			}
		} /** End gd_plu_mass  **/
		
		if(isset($_POST['gd_plu_etot']) || isset($_POST['gd_plu_etot_min']) || isset($_POST['gd_plu_etot_max'])) {
			
			$gdPluEtotSpecies=$_SESSION['booleanPostValue']['gd_plu_etot'];
			$gdPluEtotTotalSize=sizeof($gdPluEtotSpecies);
		
			if($gdPluEtotTotalSize > 1){
			
				$gdPluEtotWithSpec =" and ";
					
				for($i=0;$i<$gdPluEtotTotalSize;$i++){
				
					$gdPluEtotWithSpec .="(gd_plu.gd_plu_species='{$gdPluEtotSpecies[$i]}'";
  
					$min = "gd_plu_etot_min_".$gdPluEtotSpecies[$i];
					$max = "gd_plu_etot_max_".$gdPluEtotSpecies[$i];
					
					if(isset($_POST[$min]) && isset ($_POST[$max])){
					
						$gdPluEtotWithSpec .= " and (gd_plu.gd_plu_etot between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
					
					}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					
						if(isset($_POST[$min])){ 
						
							$gdPluEtotWithSpec .= " and gd_plu.gd_plu_etot >= '{$_POST[$min]}'";
							
						}else if(isset($_POST[$max])){
						
							$gdPluEtotWithSpec .= " and gd_plu.gd_plu_etot <= '{$_POST[$max]}'";
						}	
					}
		
					if($i < ($gdPluEtotTotalSize-1)) 
					//	$gdPluEtotWithSpec .=") || "; 
						$gdPluEtotWithSpec .=") and ";	  /** change here when having dynamic operators **/
				}

				$gdPluEtotWithSpec .=")";		
			}
			else{   
			
				$gdPluEtotWithSpec = "" ;
				
				if(!isset($_POST['gd_plu_etot_min']) && !isset($_POST['gd_plu_etot_max'])) {	
 				
					$min = "gd_plu_etot_min_".$gdPluEtotSpecies[0];
					$max = "gd_plu_etot_max_".$gdPluEtotSpecies[0];
					
					$gdPluEtotWithSpec .= " and gd_plu.gd_plu_species='{$gdPluEtotSpecies[0]}' ";
				}else{
					$min = "gd_plu_etot_min";
					$max = "gd_plu_etot_max";
				} 
		 
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdPluEtotWithSpec .= " and (gd_plu.gd_plu_etot between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
				
					if(isset($_POST[$min])){ 
						$gdPluEtotWithSpec .= " and gd_plu.gd_plu_etot >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdPluEtotWithSpec .= " and gd_plu.gd_plu_etot <= '{$_POST[$max]}'";
					}	
				}
			}
		
		}  /** End gd_plu_etot  **/
		
		if(isset($_POST['gd_plu_height_min']) ||  isset($_POST['gd_plu_height_max'])){
			
			if(isset($_POST['gd_plu_height_min'])){
				$gdPluHeight = " and gd_plu.gd_plu_height >= '{$_POST['gd_plu_height_min']}' ";
			}
			
			if(isset($_POST['gd_plu_height_max'])){
				$gdPluHeight = " and gd_plu.gd_plu_height <= '{$_POST['gd_plu_height_max']}' ";
			}
		
			if(isset($_POST['gd_plu_height_min']) && isset($_POST['gd_plu_height_max'])){
				$gdPluHeight = " and (gd_plu.gd_plu_height between '{$_POST['gd_plu_height_min']}' and '{$_POST['gd_plu_height_max']}') "; 
			}
	
		}  /** End gd_plu_height  **/


		$_SESSION['gdPluSpecies'] = $gdPluEmitWithSpec . $gdPluMassWithSpec .$gdPluEtotWithSpec.$gdPluHeight;

	}   /** End gd_plu  **/

	
   if(isset($_POST['gd_sol_tflux']) || isset($_POST['gd_sol_tflux_min']) ||  isset($_POST['gd_sol_tflux_max']) || isset($_POST['gd_sol_high']) || isset($_POST['gd_sol_high_min']) || isset($_POST['gd_sol_high_max']) || isset($_POST['gd_sol_htemp']) || isset($_POST['gd_sol_htemp_min']) || isset($_POST['gd_sol_htemp_max'])){
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereSol'] = " and gd_sol.gd_sol_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereSol'] = " and gd_sol.gd_sol_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereSol'] = " and (gd_sol.gd_sol_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}	
	
		
		if(isset($_POST['gd_sol_tflux']) || isset($_POST['gd_sol_tflux_min']) ||  isset($_POST['gd_sol_tflux_max'])) {
		
			$gdSolTfluxSpecies=$_SESSION['booleanPostValue']['gd_sol_tflux'];
			$gdSolTfluxTotalSize=sizeof($gdSolTfluxSpecies);

			if($gdSolTfluxTotalSize > 1){
			
					$gdSolTfluxWithSpec =" and ";
						
					for($i=0;$i<$gdSolTfluxTotalSize;$i++){
					
						$gdSolTfluxWithSpec .="(gd_sol.gd_sol_species='{$gdSolTfluxSpecies[$i]}'";
	  
						$min = "gd_sol_tflux_min_".$gdSolTfluxSpecies[$i];
						$max = "gd_sol_tflux_max_".$gdSolTfluxSpecies[$i];
						
						if(isset($_POST[$min]) && isset ($_POST[$max])){
						
							$gdSolTfluxWithSpec .= " and (gd_sol.gd_sol_tflux between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
						
						}
						else if(isset($_POST[$min]) || isset ($_POST[$max])){
						
							if(isset($_POST[$min])){ 
							
								$gdSolTfluxWithSpec .= " and gd_sol.gd_sol_tflux >= '{$_POST[$min]}'";
								
							}else if(isset($_POST[$max])){
							
								$gdSolTfluxWithSpec .= " and gd_sol.gd_sol_tflux <= '{$_POST[$max]}'";
							}	
						}
			
						if($i < ($gdSolTfluxTotalSize-1)) 
						//	$gdSolTfluxWithSpec .=") || "; 
						    $gdSolTfluxWithSpec .=") and ";	  /** change here when having dynamic operators **/	
					}

				$gdSolTfluxWithSpec .=")";
				
			} 		
			else {
			
				$gdSolTfluxWithSpec = "" ;
				
				if(!isset($_POST['gd_sol_tflux_min']) && !isset($_POST['gd_sol_tflux_max'])) {	
					$min = "gd_sol_tflux_min_".$gdSolTfluxSpecies[0];
					$max = "gd_sol_tflux_max_".$gdSolTfluxSpecies[0];
					
					$gdSolTfluxWithSpec .= " and gd_sol.gd_sol_species='{$gdSolTfluxSpecies[0]}' ";
				}else{
					$min = "gd_sol_tflux_min";
					$max = "gd_sol_tflux_max";
				
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdSolTfluxWithSpec .= " and (gd_sol.gd_sol_tflux between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdSolTfluxWithSpec .= " and gd_sol.gd_sol_tflux >= '{$_POST[$min]}'";
					
					}else if(isset($_POST[$max])){
						$gdSolTfluxWithSpec .= " and gd_sol.gd_sol_tflux <= '{$_POST[$max]}'";
					}	
				}
					
			} 
					
		}  /** End gd_sol_tflux  **/
		
		
		if(isset($_POST['gd_sol_high']) || isset($_POST['gd_sol_high_min']) || isset($_POST['gd_sol_high_max'])) {
		
			$gdSolHighSpecies=$_SESSION['booleanPostValue']['gd_sol_high'];
			$gdSolHighTotalSize=sizeof($gdSolHighSpecies);

			if($gdSolHighTotalSize > 1){
			
					$gdSolHighWithSpec =" and ";
						
					for($i=0;$i<$gdSolHighTotalSize;$i++){
					
						$gdSolHighWithSpec .="(gd_sol.gd_sol_species='{$gdSolHighSpecies[$i]}'";
	  
						$min = "gd_sol_high_min_".$gdSolHighSpecies[$i];
						$max = "gd_sol_high_max_".$gdSolHighSpecies[$i];
						
						if(isset($_POST[$min]) && isset ($_POST[$max])){
						
							$gdSolHighWithSpec .= " and (gd_sol.gd_sol_high between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
						
						}
						else if(isset($_POST[$min]) || isset ($_POST[$max])){
						
							if(isset($_POST[$min])){ 
							
								$gdSolHighWithSpec .= " and gd_sol.gd_sol_high >= '{$_POST[$min]}')";
								
							}else if(isset($_POST[$max])){
							
								$gdSolHighWithSpec .= " and gd_sol.gd_sol_high <= '{$_POST[$max]}')";
							}	
						}
			
						if($i < ($gdSolHighTotalSize-1)) 
						//	$gdSolHighWithSpec .=") || "; 
						    $gdSolHighWithSpec .=") and ";	  /** change here when having dynamic operators **/	
					}

				$gdSolHighWithSpec .=")";
				
			} 		
			else{
			
				$gdSolHighWithSpec = "" ;
				
				if(!isset($_POST['gd_sol_high_min']) && !isset($_POST['gd_sol_high_max'])) {	
					$min = "gd_sol_high_min_".$gdSolHighSpecies[0];
					$max = "gd_sol_high_max_".$gdSolHighSpecies[0];
					
					$gdSolHighWithSpec .= " and gd_sol.gd_sol_species='{$gdSolHighSpecies[0]}' ";
				}else{
					$min = "gd_sol_high_min";
					$max = "gd_sol_high_max";
				
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdSolHighWithSpec .= " and (gd_sol.gd_sol_high between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdSolHighWithSpec .= " and gd_sol.gd_sol_high >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdSolHighWithSpec .= " and gd_sol.gd_sol_high <= '{$_POST[$max]}'";
					}	
				}
					
			} 
					
		}  /** End gd_sol_high  **/
		
	
		if(isset($_POST['gd_sol_htemp']) || isset($_POST['gd_sol_htemp_min']) || isset($_POST['gd_sol_htemp_max'])){
		
			$gdSolHtempSpecies=$_SESSION['booleanPostValue']['gd_sol_htemp'];
			$gdSolHtempTotalSize=sizeof($gdSolHtempSpecies);

			if($gdSolHtempTotalSize > 1){
			
				$gdSolHtempWithSpec =" and ";
					
				for($i=0;$i<$gdSolHtempTotalSize;$i++){
				
					$gdSolHtempWithSpec .="(gd_sol.gd_sol_species='{$gdSolHtempSpecies[$i]}'";
  
					$min = "gd_sol_htemp_min_".$gdSolHtempSpecies[$i];
					$max = "gd_sol_htemp_max_".$gdSolHtempSpecies[$i];
					
					if(isset($_POST[$min]) && isset ($_POST[$max])){
					
						$gdSolHtempWithSpec .= " and (gd_sol.gd_sol_htemp between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
					
					}
					else if(isset($_POST[$min]) || isset ($_POST[$max])){
					
						if(isset($_POST[$min])){ 
						
							$gdSolHtempWithSpec .= " and gd_sol.gd_sol_htemp >= '{$_POST[$min]}')";
							
						}else if(isset($_POST[$max])){
						
							$gdSolHtempWithSpec .= " and gd_sol.gd_sol_htemp <= '{$_POST[$max]}')";
						}	
					}
		
					if($i < ($gdSolHtempTotalSize-1)) 
					//	$gdSolHtempWithSpec .=") || "; 
					    $gdSolHtempWithSpec .=") and ";	  /** change here when having dynamic operators **/	
				}

				$gdSolHtempWithSpec .=")";
			} 		
		   	else{
			
				$gdSolHtempWithSpec = "" ;
				
				if(!isset($_POST['gd_sol_htemp_min']) && !isset($_POST['gd_sol_htemp_max'])) {	
					$min = "gd_sol_htemp_min_".$gdSolHtempSpecies[0];
					$max = "gd_sol_htemp_max_".$gdSolHtempSpecies[0];
					
					$gdSolHtempWithSpec .= " and gd_sol.gd_sol_species='{$gdSolHtempSpecies[0]}' ";
				}else{
					$min = "gd_sol_htemp_min";
					$max = "gd_sol_htemp_max";
				
				}
				
				if(isset($_POST[$min]) && isset ($_POST[$max])){
					$gdSolHtempWithSpec .= " and (gd_sol.gd_sol_htemp between '{$_POST[$min]}' and '{$_POST[$max]}')"; 
				}else if(isset($_POST[$min]) || isset ($_POST[$max])){
					if(isset($_POST[$min])){ 
						$gdSolHtempWithSpec .= " and gd_sol.gd_sol_htemp >= '{$_POST[$min]}'";
					}else if(isset($_POST[$max])){
						$gdSolHtempWithSpec .= " and gd_sol.gd_sol_htemp <= '{$_POST[$max]}'";
					}	
				}
			}
			
		}  /** End gd_sol_htemp  **/
		
	
		$_SESSION['gdSolSpecies'] = $gdSolTfluxWithSpec.$gdSolHighWithSpec.$gdSolHtempWithSpec;

	}	/** End gd_sol  **/		 			

	
	if(isset($_POST['hd'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWherehd'] = " and hd.hd_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWherehd'] = " and hd.hd_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWherehd'] = " and (hd.hd_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}	
	
		$hdSpecies=$_SESSION['booleanPostValue']['hd'];
		$hdTotalSize=sizeof($hdSpecies);
		
		if($hdTotalSize > 1){
			$_SESSION['hdSpecies']=" and (";
			
			for($i=0;$i<$hdTotalSize;$i++){
				$_SESSION['hdSpecies'] .="hd.hd_comp_species='{$hdSpecies[$i]}'";
				if($i < ($hdTotalSize-1)) $_SESSION['hdSpecies'] .=" || "; 
			}

			$_SESSION['hdSpecies'] .=")";
			
		}else{
			if($hdSpecies != "on")  
				$_SESSION['hdSpecies'] =" and hd.hd_comp_species='{$hdSpecies[0]}' ";
		}
	
	}
			
	if(isset($_POST['td'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereTd'] = " and td.td_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTd'] = " and td.td_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereTd'] = " and (td.td_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}	
	}	
			
	if(isset($_POST['med'])){ 
	
		if(isset($_POST['priorityTimeMin'])){
			$_SESSION['sqlWhereMed'] = " and med.med_time >= '{$_POST['priorityTimeMin']}' ";
	    }
		
		if(isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMed'] = " and med.med_time <= '{$_POST['priorityTimeMax']}' ";
	    }
		
		if(isset($_POST['priorityTimeMin']) && isset($_POST['priorityTimeMax'])){
			$_SESSION['sqlWhereMed'] = " and (med.med_time between '{$_POST['priorityTimeMin']}' and '{$_POST['priorityTimeMax']}') "; 	
		}
	}	
			

		
			
if( (isset($_POST['sd_evn_eqtype'])) || (isset($_POST['sd_evs'])) || (isset($_POST['sd_int'])) || (isset($_POST['sd_ivl'])) || (isset($_POST['sd_trm'])) || (isset($_POST['sd_rsm'])) || (isset($_POST['sd_ssm'])) || (isset($_POST['dd_ang'])) || (isset($_POST['dd_edm'])) || (isset($_POST['dd_gps'])) || (isset($_POST['dd_gpv'])) || (isset($_POST['dd_lev'])) || (isset($_POST['dd_sar'])) || (isset($_POST['dd_str'])) || (isset($_POST['dd_tlt'])) || (isset($_POST['dd_tlv'])) || (isset($_POST['fd_ele'])) ||  (isset($_POST['fd_gra'])) || (isset($_POST['fd_mag'])) || (isset($_POST['fd_mgv'])) || (isset($_POST['gd'])) || (isset($_POST['gd_plu'])) || (isset($_POST['gd_sol'])) || (isset($_POST['hd'])) || (isset($_POST['td'])) ||  (isset($_POST['med']))


|| (isset($_SESSION['booleanPostValue']['sd_evn']))   

|| (isset($_SESSION['booleanPostValue']['gd'])) ||  (isset($_SESSION['booleanPostValue']['gd_plu'])) || (isset($_SESSION['booleanPostValue']['gd_sol'])) 
 

){


	header("location: booleanSubmitData.php");
	
	
}else {  // Allow to load all vol & eruption data if the user selects nothing 

	header("location: booleanSubmitNoData.php");
}

?>
