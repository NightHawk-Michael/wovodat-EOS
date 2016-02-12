<?php
include 'php/include/db_connect_view.php';

	
function getAllResult(){	
	global $link;

	
	$sql = "select * from (";  


	if(isset($_SESSION['sdEvnType'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Network Events(', TempV1.sd_evn_eqtype, ')'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
		(SELECT sn_id, sd_evn_eqtype, MIN(sd_evn_time) as MinTime, MAX(sd_evn_time) as MaxTime FROM sd_evn 
		WHERE". $_SESSION['sqlWhereEvn'].$_SESSION['sdEvnType']." group by sn_id, sd_evn_eqtype) AS TempV1,
		
		(SELECT vjn.* FROM vol_jj_sn as vjn".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData'].") AS TempV2 WHERE TempV1.sn_id = TempV2.sn_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, TempV1.sd_evn_eqtype union ";
	}
	
	if(isset($_SESSION['sdEvsType'])) {  

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Single Station Events'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
		(SELECT ss_id,sd_evs_eqtype,MIN(sd_evs_time) as MinTime, MAX(sd_evs_time) as MaxTime WHERE". $_SESSION['sqlWhereEvs'].$_SESSION['sdEvsType']." group by ss_id, sd_evs_eqtype) AS TempV1,
		
		(SELECT vjn.*,ss.ss_id FROM vol_jj_sn as vjn,ss".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id) AS TempV2 
		
		WHERE TempV1.ss_id = TempV2.ss_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, TempV1.sd_evs_eqtype union ";
	
	}
	
	if(isset($_SESSION['sqlWhereInt'])) {

	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Intensity'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
		(SELECT sd_evn_id,sd_evs_id, MIN(sd_int_time) as MinTime, MAX(sd_int_time) as MaxTime FROM sd_int) AS TempV1,
		(SELECT vjn.*,ss.ss_id,sd_evn.sd_evn_id,sd_evs.sd_evs_id FROM vol_jj_sn as vjn,ss,sd_evn,sd_evs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id and vjn.sn_id=sd_evn.sn_id and ss.ss_id=sd_evs.ss_id) AS TempV2 
		WHERE TempV1.sd_evn_id = TempV2.sd_evn_id and TempV1.sd_evs_id = TempV2.sd_evs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union ";
	
/*	
SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype,
TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Single Station Events'),TempV1.MinTime, 
TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime) 
FROM 
(SELECT sd_evn_id,sd_evs_id, MIN(sd_int_time) as MinTime, MAX(sd_int_time) as MaxTime FROM sd_int) AS TempV1, 

(SELECT vjn.*,ss.ss_id,sd_evn.sd_evn_id,sd_evs.sd_evs_id FROM vol_jj_sn as vjn,ss,sd_evn,sd_evs 
WHERE (vjn.ed_stime between '1999-04-07 00:00:00' and '2008-04-07 00:00:00') 
and vjn.vd_inf_type='Stratovolcano' 
and vjn.vd_inf_rtype='Basalt/Picro-Basalt' 
and vjn.sn_id=ss.sn_id and vjn.sn_id=sd_evn.sn_id and ss.ss_id=sd_evs.ss_id) AS TempV2 

WHERE TempV1.sd_evn_id = TempV2.sd_evn_id and TempV1.sd_evs_id = TempV2.sd_evs_id 	
*/	
	} 
	
	if(isset($_SESSION['sdIvlType'])) {
	
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Interval( ',TempV1.sd_ivl_eqtype,')'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
		
		(SELECT ss_id, sd_ivl_eqtype, MIN(sd_ivl_stime) as MinTime, MAX(sd_ivl_stime) as MaxTime FROM sd_ivl 	WHERE". $_SESSION['sqlWhereIvl'].$_SESSION['sdIvlType']." group by ss_id, sd_ivl_eqtype) AS TempV1,
		
		(SELECT vjn.*,ss.ss_id FROM vol_jj_sn as vjn,ss".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id) AS TempV2 
		
		WHERE TempV1.ss_id = TempV2.ss_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, TempV1.sd_ivl_eqtype union ";
		
		
	}	
	
	
	if(isset($_SESSION['sdTrmType'])) {
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Tremor( ',TempV1.sd_trm_type,')'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
		
		(SELECT ss_id, sd_trm_type, MIN(sd_trm_stime) as MinTime, MAX(sd_trm_stime) as MaxTime FROM sd_trm
		WHERE". $_SESSION['sqlWhereTrm'].$_SESSION['sdTrmType']." group by ss_id,sd_trm_type) AS TempV1,
		
		(SELECT vjn.*,ss.ss_id FROM vol_jj_sn as vjn,ss".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id ) AS TempV2 
		
		WHERE TempV1.ss_id = TempV2.ss_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, TempV1.sd_trm_type union "; 			
	
	
	
	}



	if(isset($_SESSION['sqlWhereRsm'])) {
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('RSAM'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 
	
		(SELECT sd_sam.ss_id, MIN(sd_rsm_stime) as MinTime, MAX(sd_rsm_stime) as MaxTime FROM sd_rsm,sd_sam
		WHERE". $_SESSION['sqlWhereRsm']." and sd_rsm.sd_sam_id=sd_sam.sd_sam_id) AS TempV1,
		
		(SELECT vjn.*,ss.ss_id FROM vol_jj_sn as vjn,ss".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id ) AS TempV2 
		
		WHERE TempV1.ss_id = TempV2.ss_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
		
	}

	if(isset($_SESSION['sqlWhereSsm'])) {
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('SSAM'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime) FROM (SELECT sd_sam.ss_id, MIN(sd_ssm_stime) as MinTime, MAX(sd_ssm_stime) as MaxTime FROM sd_ssm,sd_sam WHERE". $_SESSION['sqlWhereSsm']." and sd_ssm.sd_sam_id=sd_sam.sd_sam_id) AS TempV1,(SELECT vjn.*,ss.ss_id FROM vol_jj_sn as vjn,ss".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdPhaseData']." and vjn.sn_id=ss.sn_id ) AS TempV2 WHERE TempV1.ss_id = TempV2.ss_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	}
	
	
	if(isset($_SESSION['sqlWhereAng'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Angle'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,ds_id1,ds_id2, MIN(dd_ang_time) as MinTime, MAX(dd_ang_time) as MaxTime FROM dd_ang
		WHERE". $_SESSION['sqlWhereAng']." group by ds_id,ds_id1,ds_id2) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.ds_id = TempV2.ds_id || TempV1.ds_id1 = TempV2.ds_id || TempV1.ds_id2 = TempV2.ds_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 		
				

	}	
	
 

	if(isset($_SESSION['sqlWhereEdm'])) {


		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('EDM'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id1,ds_id2, MIN(dd_edm_time) as MinTime, MAX(dd_edm_time) as MaxTime FROM dd_edm
		WHERE". $_SESSION['sqlWhereEdm']." group by ds_id1,ds_id2) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.ds_id1 = TempV2.ds_id || TempV1.ds_id2 = TempV2.ds_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	

	}

	if(isset($_SESSION['sqlWhereGps'])) {
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('GPS'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,ds_id_ref1,ds_id_ref2, MIN(dd_gps_time) as MinTime, MAX(dd_gps_time) as MaxTime FROM dd_gps WHERE". $_SESSION['sqlWhereGps']." group by ds_id,ds_id_ref1,ds_id_ref2) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.ds_id = TempV2.ds_id || TempV1.ds_id_ref1 = TempV2.ds_id || TempV1.ds_id_ref2 = TempV2.ds_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	}
	
	if(isset($_SESSION['sqlWhereGpv'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('GPV'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,MIN(dd_gpv_stime) as MinTime, MAX(dd_gpv_stime) as MaxTime FROM dd_gpv WHERE". $_SESSION['sqlWhereGpv']." group by ds_id) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ds_id = TempV2.ds_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union ";	
	
	}
	
	if(isset($_SESSION['sqlWhereLev'])) {
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Leveling'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id_ref,ds_id1,ds_id2, MIN(dd_lev_time) as MinTime, MAX(dd_lev_time) as MaxTime FROM dd_lev WHERE". $_SESSION['sqlWhereLev']." group by ds_id_ref,ds_id1,ds_id2) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.ds_id_ref = TempV2.ds_id || TempV1.ds_id1 = TempV2.ds_id || TempV1.ds_id2= TempV2.ds_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	}		
	
	
	if(isset($_SESSION['sqlWhereStr'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Strain'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,MIN(dd_str_time) as MinTime, MAX(dd_str_time) as MaxTime FROM dd_str WHERE". $_SESSION['sqlWhereStr']." group by ds_id) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ds_id = TempV2.ds_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union ";	
	}


	if(isset($_SESSION['sqlWhereTlt'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Strain'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,MIN(dd_tlt_time) as MinTime, MAX(dd_tlt_time) as MaxTime FROM dd_tlt WHERE". $_SESSION['sqlWhereTlt']." group by ds_id) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ds_id = TempV2.ds_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union ";		
	
	}	
		

	if(isset($_SESSION['sqlWhereTlv'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Strain'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ds_id,MIN(dd_tlv_stime) as MinTime, MAX(dd_tlv_stime) as MaxTime FROM dd_tlv WHERE". $_SESSION['sqlWhereTlv']." group by ds_id) AS TempV1,
		
		(SELECT vjn.*,ds.ds_id FROM vol_jj_cn as vjn,ds".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ds.cn_id and (vjn.cn_type='Deformation' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ds_id = TempV2.ds_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union ";		
	}

	
	if(isset($_SESSION['sqlWhereEle'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Electricity(SP)'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct fs_id1,fs_id2, MIN(fd_ele_time) as MinTime, MAX(fd_ele_time) as MaxTime FROM fd_ele
		WHERE". $_SESSION['sqlWhereEle']." group by fs_id1,fs_id2) AS TempV1,
		
		(SELECT vjn.*,fs.fs_id FROM vol_jj_cn as vjn,fs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=fs.cn_id and (vjn.cn_type='Fields' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.fs_id1 = TempV2.fs_id || TempV1.fs_id2 = TempV2.fs_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	}

	
	if(isset($_SESSION['sqlWhereGra'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Gravity'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct fs_id,fs_id_ref, MIN(fd_gra_time) as MinTime, MAX(fd_gra_time) as MaxTime FROM fd_gra
		WHERE". $_SESSION['sqlWhereGra']." group by fs_id,fs_id_ref) AS TempV1,
		
		(SELECT vjn.*,fs.fs_id FROM vol_jj_cn as vjn,fs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=fs.cn_id and (vjn.cn_type='Fields' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.fs_id = TempV2.fs_id || TempV1.fs_id_ref = TempV2.fs_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	}
	

	if(isset($_SESSION['sqlWhereMag'])) {
		
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Magnetic fields'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct fs_id,fs_id_ref, MIN(fd_mag_time) as MinTime, MAX(fd_mag_time) as MaxTime FROM fd_mag
		WHERE". $_SESSION['sqlWhereMag']." group by fs_id,fs_id_ref) AS TempV1,
		
		(SELECT vjn.*,fs.fs_id FROM vol_jj_cn as vjn,fs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=fs.cn_id and (vjn.cn_type='Fields' || vjn.cn_type='C')) AS TempV2 
		
		WHERE (TempV1.fs_id = TempV2.fs_id || TempV1.fs_id_ref = TempV2.fs_id) GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	
	
	}
	
	if(isset($_SESSION['sqlWhereMgv'])) {
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Magnetic Vector'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct fs_id,MIN(fd_mgv_time) as MinTime, MAX(fd_mgv_time) as MaxTime FROM fd_mgv
		WHERE". $_SESSION['sqlWhereMgv']." group by fs_id) AS TempV1,
		
		(SELECT vjn.*,fs.fs_id FROM vol_jj_cn as vjn,fs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=fs.cn_id and (vjn.cn_type='Fields' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.fs_id = TempV2.fs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 

	}		
	
	
	if(isset($_SESSION['gdSpecies'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, 	concat('Sampled Gas Events(', TempV1.gd_species, ')'),
		TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct gs_id,gd_species, MIN(gd_time) as MinTime, MAX(gd_time) as MaxTime FROM gd
		WHERE".$_SESSION['sqlWhereGd'].$_SESSION['gdSpecies']." group by gs_id) AS TempV1,
		
		(SELECT vjn.*,gs.gs_id FROM vol_jj_cn as vjn,gs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=gs.cn_id and (vjn.cn_type='Gas' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.gs_id = TempV2.gs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	

	}

	if(isset($_SESSION['gdPluSpecies'])) {
	
	/* Ground based plume & Satellite plume   */
	
		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei,concat('Plume from groud based (', TempV1.gd_plu_species, ')'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct gs_id,gd_plu_species, MIN(gd_plu_time) as MinTime, MAX(gd_plu_time) as MaxTime FROM gd_plu
		WHERE".$_SESSION['sqlWherePlu'].$_SESSION['gdPluSpecies']." group by gs_id) AS TempV1,
		
		(SELECT vjn.*,gs.gs_id FROM vol_jj_cn as vjn,gs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=gs.cn_id and (vjn.cn_type='Gas' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.gs_id = TempV2.gs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union 
		
		/* cs table  */
		SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei,concat('Plume from Satellite(', TempV1.gd_plu_species, ')'),
		TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct vd_id,gd_plu_species, MIN(gd_plu_time) as MinTime, MAX(gd_plu_time) as MaxTime FROM gd_plu,cs WHERE".$_SESSION['sqlWherePlu'].$_SESSION['gdPluSpecies']." and gd_plu.cs_id=cs.cs_id group by vd_id) AS TempV1,
		
		(SELECT vjn.* FROM vol_jj_cn as vjn,gs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and (vjn.cn_type='Gas' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.vd_id = TempV2.vd_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 			

	}	
	
	
	if(isset($_SESSION['gdSolSpecies'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Soil Effux(', TempV1.gd_sol_species, ')'),
		TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct gs_id,gd_sol_species, MIN(gd_sol_time) as MinTime, MAX(gd_sol_time) as MaxTime FROM gd_sol
		WHERE".$_SESSION['sqlWhereSol'].$_SESSION['gdSolSpecies']." group by gs_id) AS TempV1,
		
		(SELECT vjn.*,gs.gs_id FROM vol_jj_cn as vjn,gs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=gs.cn_id and (vjn.cn_type='Gas' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.gs_id = TempV2.gs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 			
		
	}
	
	
	
	if(isset($_SESSION['hdSpecies'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Hydrologic(', TempV1.hd_comp_species, ')'),
		TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct hs_id,hd_comp_species, MIN(hd_time) as MinTime, MAX(hd_time) as MaxTime FROM hd
		WHERE".$_SESSION['sqlWherehd'].$_SESSION['hdSpecies']." group by hs_id) AS TempV1,
		
		(SELECT vjn.*,hs.hs_id FROM vol_jj_cn as vjn,hs".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=hs.cn_id and (vjn.cn_type='Hydrologic' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.hs_id = TempV2.hs_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 			
	}
	
	if(isset($_SESSION['sqlWhereTd'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Thermal'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ts_id, MIN(td_time) as MinTime, MAX(td_time) as MaxTime FROM td
		WHERE".$_SESSION['sqlWhereTd']." group by ts_id) AS TempV1,
		
		(SELECT vjn.*,ts.ts_id FROM vol_jj_cn as vjn,ts".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ts.cn_id and (vjn.cn_type='Thermal' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ts_id = TempV2.ts_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 	

	}		

	if(isset($_SESSION['sqlWhereMed'])) {

		$sql .= "SELECT distinct TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Meteo'),TempV1.MinTime, TempV1.MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
		FROM 

		(SELECT distinct ms_id, MIN(med_time) as MinTime, MAX(med_time) as MaxTime FROM med
		WHERE".$_SESSION['sqlWhereMed']." group by ms_id) AS TempV1,
		
		(SELECT vjn.*,ms.ms_id FROM vol_jj_cn as vjn,ms".$_SESSION['sqlFromData']." WHERE". $_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].
		$_SESSION['sqlWhereEdPhaseData']." and vjn.cn_id=ms.cn_id and (vjn.cn_type='Meteo' || vjn.cn_type='C')) AS TempV2 
		
		WHERE TempV1.ms_id = TempV2.ms_id GROUP BY TempV2.vd_name, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei union "; 			
		
	}	
	
	$sql =substr($sql,0,-7);

	$sql .= ") a order by vdName";    

//	echo $sql;

	$result = mysql_query($sql, $link);
	while($row=mysql_fetch_array($result)){
			$data[]=$row;		
	}
	
	return $data;
}


?>