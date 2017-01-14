<?php
include 'php/include/db_connect.php';

function insertDownloadDataUserInfo($dataType,$trackPoint){  
	global $link;
	
	$vdName  = $_SESSION['bolParameter'][$trackPoint]['0'];
	$ipaddress= $_SERVER['REMOTE_ADDR'];
	
	$dateTime= date('Y-m-d h:i:s');
	
	$json = file_get_contents("http://ipinfo.io/$ipaddress");
	$details = json_decode($json);

	
	$sql = "select distinct cc_id from vd where vd_name='$vdName'";  // Get data owner id
	$result = mysql_query($sql, $link);
	$row = mysql_fetch_array($result);
		
	if(isset($_SESSION['downloadDataUsername'])){  
		
		$sql = "INSERT INTO ddu (ddu_name,ddu_email,ddu_obs,ddu_ip,ddu_time,ddu_country,ddu_city,vd_name,cc_id,ddu_dataType,ddu_dataStartTime,ddu_dataEndTIme) values ('{$_SESSION['downloadDataUsername']}','{$_SESSION['downloadDataUseremail']  }','{$_SESSION['downloadDataUserobs']}','$ipaddress','$dateTime','$details->country','$details->city','$vdName','{$row['cc_id']}','{$_SESSION['bolParameter'][$trackPoint][6]}','{$_SESSION['bolParameter'][$trackPoint][7]}','{$_SESSION['bolParameter'][$trackPoint][8]}')"; 
	    
	//	echo $sql;
		
		$result = mysql_query($sql, $link);
		
	}
	else if (isset($_SESSION['login'])) {
	
		$ccId = $_SESSION['login']['cc_id']; 
		$sql = "select distinct cr_id from cr where cc_id= $ccId ";      // Get registered user id
		$result = mysql_query($sql, $link);
		$row1 = mysql_fetch_array($result);

		$sql="insert into ddu (cr_id,ddu_ip,ddu_time,ddu_country,ddu_city,vd_name,cc_id,ddu_dataType,ddu_dataStartTime,ddu_dataEndTIme) values ({$row1['cr_id']},'$ipaddress','$dateTime','$details->country','$details->city','$vdName','{$row ['cc_id']}','{$_SESSION['bolParameter'][$trackPoint][6]}','{$_SESSION['bolParameter'][$trackPoint][7]}','{$_SESSION['bolParameter'][$trackPoint][8]}')";  
		
	//	echo $sql; 
		
		$result = mysql_query($sql, $link);

	}	
	
}

function getDetailData($dataType,$trackPoint){  
	global $link;
	$sql = "";
	$vdName  = $_SESSION['bolParameter'][$trackPoint]['0'];
	$edStatTime= $_SESSION['bolParameter'][$trackPoint]['3'];
	$edEndTime= $_SESSION['bolParameter'][$trackPoint]['4'];	

	if($dataType == 'sdEvn') {  
		
		$sql = "select distinct vd_inf.vd_inf_slat,vd_inf.vd_inf_slon from vd,vd_inf where vd.vd_id=vd_inf.vd_id and vd.vd_name='$vdName'"; 
		$result = mysql_query($sql, $link);
		$row = mysql_fetch_array($result);	
		
	 	$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 
		
		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		
//		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',concat('$edEndTime') as 'Eruption End Time',a.sd_evn_time as Time,a.sd_evn_edep as Depth,a.sd_evn_pmag as Magnitude,a.sd_evn_eqtype as Type,a.sd_evn_elat as Lat,a.sd_evn_elon as Lon, a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_evn as a where a.sd_evn_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_evn_eqtype='$type' and a.sn_id='{$_SESSION['bolParameter'][$trackPoint][10]}'";	
		
	$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',concat('$edEndTime') as 'Eruption End Time',a.sd_evn_time as Time,a.sd_evn_edep as Depth,a.sd_evn_pmag as Magnitude,a.sd_evn_eqtype as Type,truncate(a.sd_evn_elat,2) as Lat,truncate(a.sd_evn_elon,2) as Lon, a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_evn as a where a.sd_evn_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_evn_eqtype='$type' and a.sn_id='{$_SESSION['bolParameter'][$trackPoint][10]}' and ABS( '{$row['vd_inf_slat']}' - a.sd_evn_elat) < 1 AND ABS('{$row['vd_inf_slon']}' - a.sd_evn_elon) < 6 AND (6371*2*ATAN2(SQRT(SIN((RADIANS(a.sd_evn_elat)-RADIANS( '{$row['vd_inf_slat']}'))/2)*SIN((RADIANS(a.sd_evn_elat)-RADIANS( '{$row['vd_inf_slat']}'))/2)+SIN((RADIANS(a.sd_evn_elon)-RADIANS('{$row['vd_inf_slon']}'))/2)*SIN((RADIANS(a.sd_evn_elon)-RADIANS('{$row['vd_inf_slon']}'))/2)*COS(RADIANS( '{$row['vd_inf_slat']}'))*COS(RADIANS(a.sd_evn_elat))),SQRT(1-(SIN((RADIANS(a.sd_evn_elat)-RADIANS( '{$row['vd_inf_slat']}'))/2)*SIN((RADIANS(a.sd_evn_elat)-RADIANS('{$row['vd_inf_slat']}'))/2)+SIN((RADIANS(a.sd_evn_elon)-RADIANS( '{$row['vd_inf_slon']}'))/2)*SIN((RADIANS(a.sd_evn_elon)-RADIANS('{$row['vd_inf_slon']}'))/2)*COS(RADIANS( '{$row['vd_inf_slat']}'))*COS(RADIANS(a.sd_evn_elat)))))) < 100 and (a.sd_evn_edep BETWEEN -10 AND 40)";		

	}

	if($dataType == 'sdEvs') {  
		
	 	$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 
		
		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',concat('$edEndTime') as 'Eruption End Time',a.sd_evs_time as Time,a.sd_evs_spint as 'S-P arrival times',a.sd_evs_dist_actven as 'Epicenter from event',a.sd_evs_maxamptrac as 'Earthquake max-amplitude',a.sd_evs_domFre as 'Earthquake dominant frequency', a.sd_evs_mag as 'Earthquake magnitude',a.sd_evs_energy as 'Earthquake energy', a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_evs as a,sn as b, ss as c
		where a.sd_evs_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_evs_eqtype='$type' and
		a.ss_id=c.ss_id and b.sn_id=c.sn_id and c.sn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	}

	if($dataType == 'Intensity') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.sd_int_time as 'Intensity Time',a.sd_int_maxdist as 'Max-distance felt',a.sd_int_maxrint as 'Max-intensity',a.sd_int_maxrint_dist as 'Distance at max-intensity',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_int as a, vd as b where a.sd_int_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.vd_id=b.vd_id and b.vd_name='$vdName'";
	
	}
	
	
	if($dataType == 'Tremor') {  

		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
	
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time', a.sd_trm_stime as 'Tremor Start Time',a.sd_trm_etime as 'Tremor End Time', a.sd_trm_domfreq1 as 'Tremor dominant freq-1', a.sd_trm_domfreq2 as 'Tremor dominant freq-2',a.sd_trm_maxamp as 'Tremor max-amplitude', a.sd_trm_reddis as 'Reduced displacement',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_trm as a,sn as b, ss as c where a.sd_trm_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_trm_type='$type' and a.ss_id=c.ss_id and b.sn_id=c.sn_id and c.sn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}	
	
	if($dataType == 'Interval') {  

		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
	
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.sd_ivl_stime as 'Interval Start Time',a.sd_ivl_etime as 'Interval End Time',a.sd_ivl_hdist as 'Swarm distance',a.sd_ivl_avgdepth as 'Swarm mean depth',a.sd_ivl_vdispers as 'Swarm vertical dispersion',a.sd_ivl_hmigr_hyp as 'Hypocenter horiz-migration',a.sd_ivl_vmigr_hyp as 'Hypocenter vert-migration',a.sd_ivl_nrec as 'Earthquake counts',a.sd_ivl_nfelt as 'Total seismic energy', a.sd_ivl_etot as 'Felt earthquake counts', a.sd_ivl_fmin as 'Earthquake min-frequency',a.sd_ivl_fmax as 'Earthquake max-frequency',a.sd_ivl_amin as 'Earthquake min-amplitude',a.sd_ivl_amax as 'Earthquake max-amplitude',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from sd_ivl as a,sn as b, ss as c where a.sd_ivl_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_ivl_eqtype='$type' and a.ss_id=c.ss_id and b.sn_id=c.sn_id and c.sn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}


	if($dataType == 'RSAM') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.sd_rsm_stime as 'RSAM Time',a.sd_rsm_count as 'RSAM count',d.cc_id as 'First owner',d.cc_id2 as 'Second owner',d.cc_id3 as 'Third owner',d.cb_ids as Bibliographic from sd_rsm as a, sn as b, ss as c,sd_sam as d where a.sd_rsm_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_sam_id=d.sd_sam_id and c.ss_id=d.ss_id and b.sn_id=c.sn_id and b.sn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	if($dataType == 'SSAM') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.sd_ssm_stime as 'SSAM Time', a.sd_ssm_lowf as 'SSAM low-freq limit', a.sd_ssm_highf as 'SSAM high-freq limit',a.sd_ssm_count as 'SSAM counts',d.cc_id as 'First owner',d.cc_id2 as 'Second owner',d.cc_id3 as 'Third owner',d.cb_ids as Bibliographic from sd_ssm as a, sn as b, ss as c,sd_sam as d where a.sd_ssm_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.sd_sam_id=d.sd_sam_id and c.ss_id=d.ss_id and b.sn_id=c.sn_id and b.sn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
/*** Deformation ***/  	
	
	if($dataType == 'Tilt') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_tlt_time as 'Electronic tilt Time', a.dd_tlt1 as 'Radial/X-axis tilt',
		a.dd_tlt2 as 'Tangential/Y-axis tilt', a.dd_tlt_temp as 'Tilt temperature',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from dd_tlt as a, cn as b, ds as c where a.dd_tlt_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ds_id=c.ds_id and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'Tilt Vector') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_tlv_stime as 'Tilt vector start time',a.dd_tlv_etime as 'Tilt vector end time',a.dd_tlv_mag as 'Tilt vector', a.dd_tlv_azi as 'Tilt azimuth',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from dd_tlv as a, cn as b, ds as c where a.dd_tlv_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ds_id=c.ds_id and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'Strain') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_str_time as 'Strain time', a.dd_str_comp1 as 'Strain comp-1',a.dd_str_comp2 as 'Strain comp-2',a.dd_str_comp3 as 'Strain comp-3',a.dd_str_comp4 as 'Strain comp-4',a.dd_str_vdstr as 'Volumentric strain change', a.dd_str_sstr_ax1 as 'Shear strain axis-1',a.dd_str_sstr_ax2 as 'Shear strain axis-2',a.dd_str_sstr_ax3 as 'Shear strain axis-3',a.dd_str_azi_ax1 as 'Strain azimuth axis-1',a.dd_str_azi_ax2 as 'Strain azimuth axis-2',a.dd_str_azi_ax3 as 'Strain azimuth axis-3',a.dd_str_pmax as 'Max strain', a.dd_str_pmin as 'Min strain', a.dd_str_pmax_dir as 'Max strain direction',a.dd_str_pmin_dir as 'Min strain direction', a.dd_str_bpres as 'Barometric pressure', a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from dd_str as a, cn as b, ds as c where a.dd_str_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ds_id=c.ds_id and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	if($dataType == 'EDM') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_edm_time as 'EDM time', a.dd_edm_line as 'EDM line length',		a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic	
		from dd_edm as a, cn as b, ds as c where a.dd_edm_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.ds_id1=c.ds_id || a.ds_id2=c.ds_id) and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'Angle') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_ang_time as 'Angle Time', a.dd_ang_hort1 as 'Horizontal angle target-1',a.dd_ang_hort2 as 'Horizontal angle target-2', a.dd_ang_vert1 as 'Vertical angle target-1',a.dd_ang_vert2 as 'Vertical angle target-2',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic	from dd_ang as a, cn as b, ds as c where a.dd_ang_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.ds_id=c.ds_id || a.ds_id1=c.ds_id || a.ds_id2=c.ds_id) and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'GPS') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_gps_time as 'GPS time', a.dd_gps_lat as 'GPS latitude', a.dd_gps_lon as 'GPS longitude',a.dd_gps_elev as 'GPS elevation', a.dd_gps_slope as 'GPS baseline/slope',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from dd_gps as a, cn as b, ds as c where a.dd_gps_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.ds_id=c.ds_id || a.ds_id_ref1=c.ds_id || a.ds_id_ref2=c.ds_id) and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	if($dataType == 'GPV') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_gpv_stime as 'GPS vector start time', a.dd_gpv_etime as 'GPS vector end time', a.dd_gpv_dmag as 'GPS displacement',a.dd_gpv_daz as 'GPS displ-azimuth', a.dd_gpv_vincl as 'GPS displ-inclination', a.dd_gpv_N as 'GPS N-S displ.',a.dd_gpv_E as 'GPS E-W displ.', a.dd_gpv_vert as 'GPS vertical displ.', a.dd_gpv_staVelNorth as 'GPS N-S velocity',a.dd_gpv_staVelEast as 'GPS E-W velocity', a.dd_gpv_staVelVert as 'GPS vertical velocity',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic	from dd_gpv as a, cn as b, ds as c where a.dd_gpv_stime between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ds_id=c.ds_id and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	if($dataType == 'Leveling') {  

		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.dd_lev_time as 'Leveling time', a.dd_lev_delev as 'Elevation change',	
		a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic	
		from dd_lev as a, cn as b, ds as c where a.dd_lev_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.ds_id_ref=c.ds_id || a.ds_id1=c.ds_id || a.ds_id2=c.ds_id) and b.cn_id=c.cn_id and b.cn_type='Deformation' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	
	
/*** GAS ***/
	
	if($dataType == 'Sampled Gas Events') {  
	
		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.gd_time as 'Directly sampled gas time',a.gd_species as 'Species',a.gd_gtemp as 'Gas temperature', a.gd_bp as 'Atmospheric pressure',a.gd_flow as 'Gas emission',a.gd_concentration as 'Gas concentration',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from gd as a, cn as b, gs as c where a.gd_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and b.cn_type='Gas'   and a.gs_id=c.gs_id and b.cn_id=c.cn_id and a.gd_species='$type' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}

	
	if($dataType == 'Plume from groud based') {  
	
		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.gd_plu_time as 'Plume time', a.gd_plu_species as 'Species', a.gd_plu_height as 'Plume height',a.gd_plu_emit as 'Gas emission rate', a.gd_plu_etot as 'Total gas emission',
		a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic 
		from gd_plu as a, cn as b, gs as c where a.gd_plu_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}'  and a.gd_plu_species='$type' and a.gs_id=c.gs_id and b.cn_id=c.cn_id  and b.cn_type='Gas' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}	
	

	

	if($dataType == 'Plume from Satellite') {  
	
		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.gd_plu_time as 'Plume time', a.gd_plu_species as 'Species',
		a.gd_plu_emit as 'Gas emission rate', a.gd_plu_mass as 'Gas emission mass', a.gd_plu_etot as 'Total gas emission'
		,a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from gd_plu as a, cs as b where a.gd_plu_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.gd_plu_species='$type' and a.cs_id=b.cs_id  and b.cs_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}


	if($dataType == 'Soil Effux') {  
	
		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.gd_sol_time as 'Soil efflux time', a.gd_sol_species as 'Species', a.gd_sol_tflux as 'Total gas flux',a.gd_sol_high as 'Highest gas flux', a.gd_sol_htemp as 'Highest temperature',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic 
		from gd_sol as a, cn as b, gs as c where a.gd_sol_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.gd_sol_species='$type' and a.gs_id=c.gs_id and b.cn_id=c.cn_id  and b.cn_type='Gas' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}

/*** Hydrology ***/

	if($dataType == 'Hydrologic') {  
	
		$find = strpos($_SESSION['bolParameter'][$trackPoint]['6'],"("); 
		$find = $find + 1; 
		
		$find2 = strpos($_SESSION['bolParameter'][$trackPoint]['6'],")"); 
		$find2 = $find2 - $find; 

		$type = substr($_SESSION['bolParameter'][$trackPoint]['6'],$find,$find2);
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.hd_time as 'Hydrology time', a.hd_comp_species as 'Species', a.hd_temp as 'Water temperature',a.hd_welev as 'Water elevation', a.hd_wdepth as 'Water depth', a.hd_dwlev as 'Water level changes',a.hd_bp as 'Barometric pressure',a.hd_sdisc as 'Spring discharge rate', a.hd_prec as 'Precipitation', a.hd_ph as 'Water ph',a.hd_cond as 'Conductivity',a.hd_comp_content as 'Content of compound',a.hd_atemp as 'Air temperature',a.hd_tds as 'TDS',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from hd as a, cn as b, hs as c where a.hd_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.hd_comp_species='$type' and a.hs_id=c.hs_id and b.cn_id=c.cn_id and b.cn_type='Hydrologic' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}


/*** Thermal ***/


	if($dataType == 'Thermal') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.td_time as 'Thermal time', a.td_temp as 'Temperature', a.td_flux as 'Heat flux', a.td_bkgg as 'Gethermal gradient',a.td_tcond as 'Thermal conductivity',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from td as a,cn as b, ts as c where a.td_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ts_id=c.ts_id and b.cn_id=c.cn_id and b.cn_type='Thermal' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}




/*** Meteo ***/


	if($dataType == 'Meteo') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time', a.med_time as 'Meteo time', a.med_temp as 'Air temperature', a.med_stemp as 'Soil temperature',a.med_bp as 'Barometric pressure',a.med_prec as 'Precipitation', a.med_hd as 'Humidity', a.med_wind as 'Wind speed', a.med_wsmin as 'Min wind speed',a.med_wsmax as 'Max wind speed',a.med_wdir as 'Wind direction', a.med_clc as 'Cloud coverage',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from med as a, cn as b, ms as c where a.med_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.ms_id=c.ms_id and b.cn_id=c.cn_id and b.cn_type='Meteo' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}


/*** Field ***/


	if($dataType == 'Electric fields') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.fd_ele_time as 'Electric fields Time', a.fd_ele_field as 'Electric fields', a.fd_ele_spot as 'Self Potential',a.fd_ele_ares as 'Apparent resistivity',a.fd_ele_dres as 'Direct resistivity',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic  
		from fd_ele as a, cn as b, fs as c where a.fd_ele_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.fs_id1=c.fs_id || a.fs_id2=c.fs_id) and b.cn_id=c.cn_id and b.cn_type='Fields' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'Gravity') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.fd_gra_time as 'Gravity time', a.fd_gra_fstr as 'Gravity',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic  
		from fd_gra as a, cn as b, fs as c where a.fd_gra_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.fs_id=c.fs_id || a.fs_id_ref=c.fs_id) and b.cn_id=c.cn_id and b.cn_type='Fields' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
	if($dataType == 'Magnetic fields') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.fd_mag_time as 'Magnetic fields time', a.fd_mag_f as 'Magnetic', a.fd_mag_compx as 'Magnetic component X',a.fd_mag_compy as 'Magnetic component Y', a.fd_mag_compz as 'Magnetic component Z',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic  
		from fd_mag as a, cn as b, fs as c where a.fd_mag_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and (a.fs_id=c.fs_id || a.fs_id_ref=c.fs_id) and b.cn_id=c.cn_id and b.cn_type='Fields' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	if($dataType == 'Magnetic Vector') {  
		
		$sql ="select distinct concat('$vdName') as 'Vol Name',concat('$edStatTime') as 'Eruption Start Time',
		concat('$edEndTime') as 'Eruption End Time',a.fd_mgv_time as 'Magnetic vector time', a.fd_mgv_dec as 'Magnetic declination',a.fd_mgv_incl as 'Magnetic inclination',a.cc_id as 'First owner',a.cc_id2 as 'Second owner',a.cc_id3 as 'Third owner',a.cb_ids as Bibliographic from fd_mgv as a, cn as b, fs as c where a.fd_mgv_time between '{$_SESSION['bolParameter'][$trackPoint][7]}' and '{$_SESSION['bolParameter'][$trackPoint][8]}' and a.fs_id=c.fs_id and b.cn_id=c.cn_id and b.cn_type='Fields' and b.cn_id={$_SESSION['bolParameter'][$trackPoint][10]}";
	
	}
	
	
//	echo $sql;
	
	$result = mysql_query($sql, $link);
	
	$numfields = mysql_num_fields($result);   // Get Filed Names
	for ( $i = 0; $i < $numfields; $i++ ) {
		$fieldName[0][]= mysql_field_name($result, $i);
	}
        
	while($row = mysql_fetch_row($result)) {   // Get Data
		$onlyData[]= $row;  
	}
	
	$data = array_merge($fieldName,$onlyData);              // Merge column names & data in one array
	
	return $data;

}	

	


?>