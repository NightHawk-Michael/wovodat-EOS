<?php
include 'php/include/db_connect_view.php';

function getAllResult(){
	global $link;
	
	$sql = "select * from (";
		
	if(isset($_SESSION['sdEvnType'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Network Events(',sd_evn.sd_evn_eqtype,')'),min(sd_evn.sd_evn_time),max(sd_evn.sd_evn_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,sd_evn where vjn.sn_id=sd_evn.sn_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereEvn'].$_SESSION['sdEvnType']." and sd_evn.sd_evn_pubdate<= now() group by vdName,sd_evn.sd_evn_eqtype,vjn.ed_stime union "; 
	}	

	if(isset($_SESSION['sdEvsType'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Single Station Events(',sd_evs.sd_evs_eqtype,')'),min(sd_evs.sd_evs_time),max(sd_evs.sd_evs_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,sd_evs,ss where vjn.sn_id=ss.sn_id and sd_evs.ss_id=ss.ss_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereEvs'].$_SESSION['sdEvsType']." and sd_evs.sd_evs_pubdate<= now() group by vdName,sd_evs.sd_evs_eqtype,vjn.ed_stime union "; 

		/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('sd_evs(',sd_evs.sd_evs_eqtype,')'),min(sd_evs.sd_evs_time),max(sd_evs.sd_evs_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,sd_evs,ss where vjn.sn_id=ss.sn_id and sd_evs.ss_id=ss.ss_id and (vjn.ed_stime between '2014-11-10 00:00:00' and '2014-11-10 17:15:55') and (sd_evs.sd_evs_time between '2014-11-10 00:00:00'and '2014-11-10 17:15:55') and ( sd_evs.sd_evs_eqtype='VT_D' || sd_evs.sd_evs_eqtype='E') and sd_evs.sd_evs_pubdate<= now() group by vdName,sd_evs.sd_evs_eqtype,vjn.ed_stime) a order by vdName
		*/
	}
	
	if(isset($_SESSION['sqlWhereInt'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Intensity'),min(sd_int.sd_int_time),
		max(sd_int.sd_int_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_evs,sd_int where vjn.vd_id=sd_int.vd_id and vjn.sn_id=ss.sn_id and sd_evs.ss_id=ss.ss_id and sd_evs.sd_evs_id=sd_int.sd_evs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereInt']." and sd_int.sd_int_pubdate<= now() group by vdName,vjn.ed_stime union select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,
		concat('Intensity'),min(sd_int.sd_int_time),max(sd_int.sd_int_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime)
		from vol_jj_sn as vjn,sd_int,sd_evn where vjn.vd_id=sd_int.vd_id and sd_evn.sd_evn_id=sd_int.sd_evn_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereInt']." and sd_int.sd_int_pubdate<= now() group by vdName,vjn.ed_stime union "; 

/*
select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Null'),min(sd_int.sd_int_time),
max(sd_int.sd_int_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_evs,sd_int
where vjn.vd_id=sd_int.vd_id and vjn.sn_id=ss.sn_id and sd_evs.ss_id=ss.ss_id and sd_evs.sd_evs_id=sd_int.sd_evs_id 
group by vdName,vjn.ed_stime
union
select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,
concat('Null'),min(sd_int.sd_int_time),max(sd_int.sd_int_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime)
from vol_jj_sn as vjn,sd_int,sd_evn where vjn.vd_id=sd_int.vd_id and sd_evn.sd_evn_id=sd_int.sd_evn_id group 
by vdName,vjn.ed_stime
*/		
	}
	
	if(isset($_SESSION['sdIvlType'])) {
	
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Interval( ',sd_ivl.sd_ivl_eqtype,')'),min(sd_ivl.sd_ivl_stime),max(sd_ivl.sd_ivl_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn, ss,sd_ivl where ss.sn_id=vjn.sn_id and ss.ss_id=sd_ivl.ss_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereIvl'].$_SESSION['sdIvlType']." and sd_ivl.sd_ivl_pubdate<= now() and sd_ivl.sd_ivl_eqtype !='' group by vdName,sd_ivl.sd_ivl_eqtype,vjn.ed_stime union ";  
	}
	
	if(isset($_SESSION['sdTrmType'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Tremor (',sd_trm.sd_trm_type,')'),
		min(sd_trm.sd_trm_stime),max(sd_trm.sd_trm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,sd_trm,ss where vjn.sn_id=sd_trm.sn_id and ss.ss_id=sd_trm.ss_id ". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereTrm'].$_SESSION['sdTrmType']." and sd_trm.sd_trm_pubdate<= now() group by  vdName,sd_trm.sd_trm_type,vjn.ed_stime union "; 

/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Tremor (',sd_trm.sd_trm_type,')'), min(sd_trm.sd_trm_stime),max(sd_trm.sd_trm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,sd_trm,ss where vjn.sn_id=sd_trm.sn_id and ss.ss_id=sd_trm.ss_id and (vjn.ed_stime between '1957-11-13 00:00:00' and '2014-11-01 00:00:00') and sd_trm.sd_trm_stime between '1957-11-13 00:00:00'and '2014-11-01 00:00:00' and (sd_trm.sd_trm_type='H' || sd_trm.sd_trm_type='C') and sd_trm.sd_trm_pubdate<= now() group by vdName,sd_trm.sd_trm_type,vjn.ed_stime) a order by vdName
*/	
	}

	if(isset($_SESSION['sqlWhereRsm'])) {
	
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('RSAM'),min(sd_rsm.sd_rsm_stime),max(sd_rsm.sd_rsm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_rsm 
		where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_rsm.sd_sam_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereRsm']." and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime union ";  
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('RSAM'),min(sd_rsm.sd_rsm_stime),max(sd_rsm.sd_rsm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_rsm where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_rsm.sd_sam_id and (vjn.ed_stime between '1976-11-13 00:00:00' and '2013-11-12 00:00:00') and (sd_rsm.sd_rsm_stime between '1976-11-13 00:00:00'and '2013-11-12 00:00:00') and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/		
	}
	
	if(isset($_SESSION['sqlWhereSsm'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('SSAM'),min(sd_ssm.sd_ssm_stime),max(sd_ssm.sd_ssm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_ssm
		where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_ssm.sd_ssm_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereSsm']." and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('SSAM'),min(sd_ssm.sd_ssm_stime),max(sd_ssm.sd_ssm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_ssm where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_ssm.sd_ssm_id and (vjn.ed_stime between '1877-11-13 00:00:00' and '2014-11-01 00:00:00') and (sd_ssm.sd_ssm_stime between '1877-11-13 00:00:00'and '2014-11-01 00:00:00') and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime
*/
	}


	if(isset($_SESSION['sqlWhereSsm'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('SSAM'),min(sd_ssm.sd_ssm_stime),max(sd_ssm.sd_ssm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_ssm
		where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_ssm.sd_ssm_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereSsm']." and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('SSAM'),min(sd_ssm.sd_ssm_stime),max(sd_ssm.sd_ssm_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_sn as vjn,ss,sd_sam,sd_ssm where vjn.sn_id=ss.sn_id and sd_sam.ss_id=ss.ss_id and sd_sam.sd_sam_id=sd_ssm.sd_ssm_id and (vjn.ed_stime between '1877-11-13 00:00:00' and '2014-11-01 00:00:00') and (sd_ssm.sd_ssm_stime between '1877-11-13 00:00:00'and '2014-11-01 00:00:00') and sd_sam.sd_sam_pubdate<= now() group by vdName,vjn.ed_stime
*/
	}	
	

	if(isset($_SESSION['sqlWhereAng'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Angle'),min(dd_ang.dd_ang_time),max(dd_ang.dd_ang_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_ang
		where vjn.cn_id=ds.cn_id and dd_ang.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereAng']." and vjn.cn_type='Deformation' and dd_ang.dd_ang_pubdate<= now() group by vdName,vjn.ed_stime  union ";  	

	}		


	if(isset($_SESSION['sqlWhereEdm'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('EDM'),min(dd_edm.dd_edm_time),
		max(dd_edm.dd_edm_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_edm where vjn.cn_id=ds.cn_id and (dd_edm.ds_id1=ds.ds_id || dd_edm.ds_id2=ds.ds_id)". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereEdm']." and vjn.cn_type='Deformation' and dd_edm.dd_edm_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('EDM'),min(dd_edm.dd_edm_time), max(dd_edm.dd_edm_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_edm where vjn.cn_id=ds.cn_id and (dd_edm.ds_id1=ds.ds_id || dd_edm.ds_id2=ds.ds_id) and (vjn.ed_stime between '1815-11-25 00:00:00' and '2014-11-01 00:00:00') and (dd_edm.dd_edm_time between '1815-11-25 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Deformation' and dd_edm.dd_edm_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}
	
	
	if(isset($_SESSION['sqlWhereGps'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('GPS'),min(dd_gps.dd_gps_time),
		max(dd_gps.dd_gps_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_gps 
		where vjn.cn_id=ds.cn_id and dd_gps.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereGps']." and vjn.cn_type='Deformation' and dd_gps.dd_gps_pubdate<= now() group by vdName,vjn.ed_stime union "; 
		
/* NOTE:  did not check for ds_id_ref1 & ds_id_ref2 bcoz these two fields are always empty.

select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('GPS'),min(dd_gps.dd_gps_time), max(dd_gps.dd_gps_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_gps where vjn.cn_id=ds.cn_id and dd_gps.ds_id=ds.ds_id and (vjn.ed_stime between '1889-11-25 00:00:00' and '2014-11-01 00:00:00') and (dd_gps.dd_gps_time between '1889-11-25 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Deformation' and dd_gps.dd_gps_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/  
	}	
	
	if(isset($_SESSION['sqlWhereGpv'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('GPV'),min(dd_gpv.dd_gpv_stime),
		max(dd_gpv.dd_gpv_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_gpv 
		where vjn.cn_id=ds.cn_id and dd_gpv.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereGpv']." and vjn.cn_type='Deformation' and dd_gpv.dd_gpv_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('GPV'),min(dd_gpv.dd_gpv_stime), max(dd_gpv.dd_gpv_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_gpv where vjn.cn_id=ds.cn_id and dd_gpv.ds_id=ds.ds_id and (vjn.ed_stime between '1979-11-01 00:00:00' and '2014-11-01 00:00:00') and (dd_gpv.dd_gpv_stime between '1979-11-01 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Deformation' and dd_gpv.dd_gpv_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}	

	if(isset($_SESSION['sqlWhereLev'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Leveling'),min(dd_lev.dd_lev_time),max(dd_lev.dd_lev_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_lev where vjn.cn_id=ds.cn_id and (dd_lev.ds_id_ref=ds.ds_id || dd_lev.ds_id2=ds.ds_id)". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereLev']." and vjn.cn_type='Deformation' and dd_lev.dd_lev_pubdate<= now() group by vdName,vjn.ed_stime union ";  
		
/* NOTE:  did not check for ds_id1 because ds_id_ref & ds_id1 numbers are always the same.
 
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Leveling'),min(dd_lev.dd_lev_time),max(dd_lev.dd_lev_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_lev where vjn.cn_id=ds.cn_id and dd_lev.ds_id_ref=ds.ds_id and (vjn.ed_stime between '1941-11-25 00:00:00' and '2014-11-01 00:00:00') and (dd_lev.dd_lev_time between '1941-11-25 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Deformation' and dd_lev.dd_lev_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}	

	if(isset($_SESSION['sqlWhereStr'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Strain'),min(dd_str.dd_str_time),max(dd_str.dd_str_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_str where vjn.cn_id=ds.cn_id and dd_str.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereStr']." and vjn.cn_type='Deformation' and dd_str.dd_str_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Strain'),min(dd_str.dd_str_time),max(dd_str.dd_str_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_str where vjn.cn_id=ds.cn_id and dd_str.ds_id=ds.ds_id and (vjn.ed_stime between '1835-11-25 00:00:00' and '2014-11-01 00:00:00') and (dd_str.dd_str_time between '1835-11-25 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Deformation' and dd_str.dd_str_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	} 
 	
	if(isset($_SESSION['sqlWhereTlt'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Tilt'),min(dd_tlt.dd_tlt_time),max(dd_tlt.dd_tlt_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_tlt where vjn.cn_id=ds.cn_id and dd_tlt.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereTlt']." and vjn.cn_type='Deformation' and dd_tlt.dd_tlt_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Tilt'),min(dd_tlt.dd_tlt_time),max(dd_tlt.dd_tlt_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_tlt where vjn.cn_id=ds.cn_id and dd_tlt.ds_id=ds.ds_id and (vjn.ed_stime between '1827-11-26 00:00:00' and '2013-11-26 00:00:00') and (dd_tlt.dd_tlt_time between '1827-11-26 00:00:00'and '2013-11-26 00:00:00') and vjn.cn_type='Deformation' and dd_tlt.dd_tlt_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}

/*** Not yet lift in the boolean serach box  ***/	
	if(isset($_SESSION['sqlWhereTlv'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Tilt Vector'),min(dd_tlv.dd_tlv_stime),max(dd_tlv.dd_tlv_stime),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ds,dd_tlv where vjn.cn_id=ds.cn_id and dd_tlv.ds_id=ds.ds_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereTlv']." and vjn.cn_type='Deformation' and dd_tlv.dd_tlv_pubdate<= now() group by vdName,vjn.ed_stime union ";  	
/*

*/
	}

	if(isset($_SESSION['sqlWhereEle'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Electricity(SP)'),min(fd_ele.fd_ele_time),max(fd_ele.fd_ele_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_ele where vjn.cn_id=fs.cn_id and (fd_ele.fs_id1=fs.fs_id || fd_ele.fs_id2=fs.fs_id)". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereEle']." and vjn.cn_type='Fields' and fd_ele.fd_ele_pubdate<= now() group by vdName,vjn.ed_stime union ";  
		
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Electricity(SP)'),min(fd_ele.fd_ele_time),max(fd_ele.fd_ele_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_ele where vjn.cn_id=fs.cn_id and (fd_ele.fs_id1=fs.fs_id || fd_ele.fs_id2=fs.fs_id) and (vjn.ed_stime between '1630-02-26 00:00:00' and '2013-11-26 00:00:00') and (fd_ele.fd_ele_time between '1630-02-26 00:00:00'and '2013-11-26 00:00:00') and vjn.cn_type='Fields' and fd_ele.fd_ele_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}	 
	

	if(isset($_SESSION['sqlWhereGra'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Gravity'),min(fd_gra.fd_gra_time),max(fd_gra.fd_gra_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_gra where vjn.cn_id=fs.cn_id and fd_gra.fs_id=fs.fs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereGra']." and vjn.cn_type='Fields' and fd_gra.fd_gra_pubdate<= now() group by vdName,vjn.ed_stime union ";  
		
/*
 select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Gravity'),min(fd_gra.fd_gra_time),max(fd_gra.fd_gra_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_gra where vjn.cn_id=fs.cn_id and fd_gra.fs_id=fs.fs_id and (vjn.ed_stime between '1998-11-26 00:00:00' and '2014-11-01 00:00:00') and (fd_gra.fd_gra_time between '1998-11-26 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Fields' and fd_gra.fd_gra_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}	 
	

	if(isset($_SESSION['sqlWhereMag'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Magnetic fields'),min(fd_mag.fd_mag_time),max(fd_mag.fd_mag_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_mag where vjn.cn_id=fs.cn_id and (fd_mag.fs_id=fs.fs_id || fd_mag.fs_id_ref=fs.fs_id)". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereMag']." and vjn.cn_type='Fields' and fd_mag.fd_mag_pubdate<= now() group by vdName,vjn.ed_stime union ";  
		
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Magnetic fields'),min(fd_mag.fd_mag_time),max(fd_mag.fd_mag_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_mag where vjn.cn_id=fs.cn_id and (fd_mag.fs_id=fs.fs_id || fd_mag.fs_id_ref=fs.fs_id) and (vjn.ed_stime between '1998-11-26 00:00:00' and '2014-11-01 00:00:00') and (fd_mag.fd_mag_time between '1998-11-26 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Fields' and fd_mag.fd_mag_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}	 


	if(isset($_SESSION['sqlWhereMgv'])) {
		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Magnetic Vector'),min(fd_mgv.fd_mgv_time),max(fd_mgv.fd_mgv_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_mgv where vjn.cn_id=fs.cn_id and fd_mgv.fs_id=fs.fs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereMgv']." and vjn.cn_type='Fields' and fd_mgv.fd_mgv_pubdate<= now() group by vdName,vjn.ed_stime union ";  
		
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Magnetic Vector'),min(fd_mgv.fd_mgv_time),max(fd_mgv.fd_mgv_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,fs,fd_mgv where vjn.cn_id=fs.cn_id and fd_mgv.fs_id=fs.fs_id and (vjn.ed_stime between '2014-11-01 00:00:00' and '2014-11-02 00:00:00') and (fd_mgv.fd_mgv_time between '2014-11-01 00:00:00'and '2014-11-02 00:00:00') and vjn.cn_type='Fields' and fd_mgv.fd_mgv_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/
	}		

	
	if(isset($_SESSION['gdSpecies'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Sampled Gas(',gd.gd_species,')'),min(gd.gd_time),max(gd.gd_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,gs,gd where vjn.cn_id=gs.cn_id and gs.gs_id=gd.gs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereGd'].$_SESSION['gdSpecies']." and vjn.cn_type='Gas' and gd.gd_pubdate<= now()group by vdName,gd.gd_species,vjn.ed_stime union ";
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Sampled Gas(',gd.gd_species,')'),min(gd.gd_time),max(gd.gd_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,gs,gd where vjn.cn_id=gs.cn_id and gs.gs_id=gd.gs_id and (vjn.ed_stime between '1995-11-01 00:00:00' and '2014-11-01 00:00:00') and gd.gd_time between '1995-11-01 00:00:00'and '2014-11-01 00:00:00' and (gd.gd_species='CO2' || gd.gd_species='CO')and gd.gd_pubdate<= now()group by vdName,gd.gd_species,vjn.ed_stime) a order by vdName		
*/		
	}


	if(isset($_SESSION['gdPluSpecies'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Plume(',gd_plu.gd_plu_species,')'),min(gd_plu.gd_plu_time),max(gd_plu.gd_plu_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,gs,gd_plu where vjn.cn_id=gs.cn_id and gd_plu.gs_id=gs.gs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWherePlu'].$_SESSION['gdPluSpecies']." and vjn.cn_type='Gas' and gd_plu.gd_plu_pubdate<= now() group by vdName,gd_plu.gd_plu_species,vjn.ed_stime union ";
	}

	/* Not yet for gas airplane/satellite (Need to add A or S in sql where clause)
	if(isset($_SESSION['gdPluSpecies'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Plume(',gd_plu.gd_plu_species,')'),min(gd_plu.gd_plu_time),max(gd_plu.gd_plu_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,cs,gd_plu where vjn.vd_id=gd_plu.vd_id and gd_plu.cs_id=cs.cs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWherePlu'].$_SESSION['gdPluSpecies']."and gd_plu.gd_plu_pubdate<= now() group by vdName,gd_plu.gd_plu_species,vjn.ed_stime union ";
	}
	*/
	
	if(isset($_SESSION['gdSolSpecies'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Soil Effux(',gd_sol.gd_sol_species,')'),min(gd_sol.gd_sol_time),max(gd_sol.gd_sol_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,gs,gd_sol where vjn.cn_id=gs.cn_id and gd_sol.gs_id=gs.gs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereSol'].$_SESSION['gdSolSpecies']." and vjn.cn_type='Gas' and gd_sol.gd_sol_pubdate<= now() group by vdName,gd_sol.gd_sol_species,vjn.ed_stime union ";
		
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Soil Effux(',gd_sol.gd_sol_species,')'),min(gd_sol.gd_sol_time),max(gd_sol.gd_sol_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,gs,gd_sol where vjn.cn_id=gs.cn_id and gd_sol.gs_id=gs.gs_id and (vjn.ed_stime between '2014-11-01 00:00:00' and '2014-11-17 00:00:00') and gd_sol.gd_sol_time between '2014-11-01 00:00:00'and '2014-11-17 00:00:00' and (gd_sol.gd_sol_species='CO2' || gd_sol.gd_sol_species='SO2')and vjn.cn_type='Gas' and gd_sol.gd_sol_pubdate<= now() group by vdName,gd_sol.gd_sol_species,vjn.ed_stime) a order by vdName
*/		
	}	
	
	if(isset($_SESSION['hdSpecies'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Hydrologic (',hd.hd_comp_species,')'),min(hd.hd_time),max(hd.hd_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,hs,hd where vjn.cn_id=hs.cn_id and hd.hs_id=hs.hs_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWherehd'].$_SESSION['hdSpecies']." and vjn.cn_type='Hydrologic' and hd.hd_pubdate<= now() group by vdName,hd.hd_comp_species,vjn.ed_stime union ";

/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Hydrologic (',hd.hd_comp_species,')'),min(hd.hd_time),max(hd.hd_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,hs,hd where vjn.cn_id=hs.cn_id and hd.hs_id=hs.hs_id and (vjn.ed_stime between '2014-11-01 00:00:00' and '2014-11-17 00:00:00') and hd.hd_time between '2014-11-01 00:00:00'and '2014-11-17 00:00:00' and (hd.hd_comp_species='SO4' || hd.hd_comp_species='H2S') and vjn.cn_type='Hydrologic' and hd.hd_pubdate<= now() group by vdName,hd.hd_comp_species,vjn.ed_stime) a order by vdName
*/
	}
	
	if(isset($_SESSION['sqlWhereTd'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Thermal'),min(td.td_time),max(td.td_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ts,td where vjn.cn_id=ts.cn_id and td.ts_id=ts.ts_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereTd']." and vjn.cn_type='Thermal' and td.td_pubdate<= now() group by vdName,vjn.ed_stime union ";
/*
select * from (select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Thermal'),min(td.td_time),max(td.td_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ts,td where vjn.cn_id=ts.cn_id and td.ts_id=ts.ts_id and (vjn.ed_stime between '1940-11-21 00:00:00' and '2010-11-21 16:52:35') and (td.td_time between '1940-11-21 00:00:00'and '2010-11-21 16:52:35') and vjn.cn_type='Thermal' and td.td_pubdate<= now() group by vdName,vjn.ed_stime) a order by vdName
*/		
	}
	
	if(isset($_SESSION['sqlWhereMed'])) {

		$sql .="select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Meteo'),min(med.med_time),max(med.med_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ms,med where vjn.cn_id=ms.cn_id and med.ms_id=ms.ms_id". $_SESSION['sqlWhereEdPhaseData'].$_SESSION['sqlWhereFeature'].$_SESSION['sqlWhereRock'].$_SESSION['sqlWhereVeiData'].$_SESSION['sqlWhereEdTimeData'].$_SESSION['sqlWhereMed']." and vjn.cn_type='Meteo' and med.med_pubdate<= now() group by vdName,vjn.ed_stime union ";
		
/*
select vjn.vd_name as vdName,vjn.vd_inf_type,vjn.vd_inf_rtype,vjn.ed_stime,vjn.ed_etime,vjn.ed_vei,concat('Meteo'),min(med.med_time),max(med.med_time),concat('vd_id=',vjn.vd_id,'&stime=',vjn.ed_stime) from vol_jj_cn as vjn,ms,med where vjn.cn_id=ms.cn_id and med.ms_id=ms.ms_id and (vjn.ed_stime between '1979-11-21 00:00:00' and '2014-11-01 00:00:00') and (med.med_time between '1979-11-21 00:00:00'and '2014-11-01 00:00:00') and vjn.cn_type='Meteo' and med.med_pubdate<= now() group by vdName,vjn.ed_stime
*/		
	}		

	
	$sql2 =substr($sql,0,-7);
	
	$sql2 .= ") a order by vdName";
	
	$result = mysql_query($sql2, $link);
	while($row=mysql_fetch_array($result)){
			$data[]=$row;		
	}
	
	return $data;
}


?>