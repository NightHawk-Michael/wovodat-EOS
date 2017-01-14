<?php
session_start();
	
include "../view/commonInsert_v.php";
include "../convertie/model/commonInsertForm_m.php";
require_once "php/include/get_root.php";


if(!isset($_SESSION['login'])) {
	header('Location: '.$url_root.'login_required.php');
}


$i="";
$field_value = array();



if(isset($_POST['vd_inf_cavw'])){

	if($_POST['vd_inf_etime'] == "" || $_POST['vd_inf_etime'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['vd_inf_etime'] = getEndTime($_POST['vd_inf_etime']);
	}
	
	if($_POST['vd_inf_pubdate'] == "" || $_POST['vd_inf_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['vd_inf_pubdate'] = getPubDate($_POST['vd_inf_pubdate'],$_POST['vd_inf_stime']);
	}

	if($_POST['vd_inf_loaddate'] == ""){
		$_POST['vd_inf_loaddate'] = getTodayDate();
	}
	
	$field_name= array('vd_id','vd_inf_cavw','vd_inf_status','vd_inf_desc','vd_inf_slat','vd_inf_slon','vd_inf_selev','vd_inf_type','vd_inf_country','vd_inf_subreg','vd_inf_loc','vd_inf_rtype','vd_inf_evol','vd_inf_numcald','vd_inf_lcald_dia','vd_inf_ycald_lat','vd_inf_ycald_lon','vd_inf_stime','vd_inf_stime_unc','vd_inf_etime','vd_inf_etime_unc','vd_inf_com','cc_id','vd_inf_loaddate','vd_inf_pubdate','cc_id_load');

	//Old vd_inf table columns 
    //$field_name= array('vd_id','vd_inf_cavw','vd_inf_status','vd_inf_desc','vd_inf_slat','vd_inf_slon','vd_inf_selev','vd_inf_type','vd_inf_loc','vd_inf_rtype','vd_inf_evol','vd_inf_numcald','vd_inf_lcald_dia','vd_inf_ycald_lat','vd_inf_ycald_lon','vd_inf_stime','vd_inf_stime_unc','vd_inf_etime','vd_inf_etime_unc','vd_inf_com','cc_id','vd_inf_loaddate','vd_inf_pubdate','cc_id_load');
	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='vd_inf',$field_name,$field_value);
}


if(isset($_POST['vd_cavw']) || isset($_POST['vd_num'])){
	
	if($_POST['vd_pubdate'] == "" || $_POST['vd_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['vd_pubdate'] = "0000-00-00 00:00:00";
	}

	if($_POST['vd_loaddate'] == ""){
		$_POST['vd_loaddate'] = getTodayDate();
	}
	
	$field_name= array('vd_name','vd_name2','vd_cavw','vd_num','vd_tzone','vd_mcont','vd_com','cc_id','cc_id2','cc_id3','cc_id4','cc_id5','vd_loaddate','vd_pubdate','cc_id_load');
	
	//Old vd_inf table columns 
	//$field_name= array('vd_cavw','vd_name','vd_name2','vd_tzone','vd_mcont','vd_com','cc_id','cc_id2','cc_id3','cc_id4','cc_id5','vd_loaddate','vd_pubdate','cc_id_load');

	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result =insertTable($table_name='vd',$field_name,$field_value);
}


if(isset($_POST['vd_mag_loaddate'])){


	if($_POST['vd_mag_pubdate'] == "" || $_POST['vd_mag_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['vd_mag_pubdate'] = "0000-00-00 00:00:00";
	}

	if($_POST['vd_mag_loaddate'] == ""){
		$_POST['vd_mag_loaddate'] = getTodayDate();
	}
	
	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	
	$field_name= array('vd_id','vd_mag_lvz_dia','vd_mag_lvz_vol','vd_mag_tlvz','vd_mag_lerup_vol','vd_mag_drock','vd_mag_orock','vd_mag_orock2','vd_mag_orock3','vd_mag_minsio2','vd_mag_maxsio2','vd_mag_com','cc_id','vd_mag_loaddate','vd_mag_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='vd_mag',$field_name,$field_value);
}



if(isset($_POST['vd_tec_loaddate'])){

	if($_POST['vd_tec_pubdate'] == "" || $_POST['vd_tec_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['vd_tec_pubdate'] = "0000-00-00 00:00:00";
	}

	if($_POST['vd_tec_loaddate'] == ""){
		$_POST['vd_tec_loaddate'] = getTodayDate();
	}
	
	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	
	$field_name= array('vd_id','vd_tec_desc','vd_tec_strslip','vd_tec_ext','vd_tec_conv','vd_tec_travhs','vd_tec_com','cc_id','vd_tec_loaddate','vd_tec_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){
		
		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='vd_tec',$field_name,$field_value);
}



if(isset($_POST['cc_code'])){

	if($_POST['cc_loaddate'] == ""){
		$_POST['cc_loaddate'] = getTodayDate();
	}
	
	
	$field_name= array('cc_code','cc_code2','cc_fname','cc_lname','cc_obs','cc_add1','cc_add2','cc_city','cc_state','cc_country','cc_post','cc_url','cc_email','cc_phone','cc_phone2','cc_fax','cc_com','cc_loaddate');

	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result =insertTable($table_name='cc',$field_name,$field_value);
}



if(isset($_POST['cb_auth'])){

	if($_POST['cb_loaddate'] == ""){
		$_POST['cb_loaddate'] = getTodayDate();
	}
	
	
	$field_name= array('cb_auth','cb_year','cb_title','cb_journ','cb_vol','cb_pub','cb_page','cb_doi','cb_isbn','cb_url','cb_labadr','cb_keywords','cb_com','cb_loaddate','cc_id_load');

	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result =insertTable($table_name='cb',$field_name,$field_value);
}


if(isset($_POST['co_code'])){

	if($_POST['co_etime'] == "" ||  $_POST['co_etime']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['co_etime'] = getEndTime($_POST['co_etime']);
	}
	
	if($_POST['co_pubdate'] == "" ||  $_POST['co_pubdate']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['co_pubdate'] = getPubDate($_POST['co_pubdate'],$_POST['co_stime']);
	}
	
	if($_POST['co_loaddate'] == ""){
		$_POST['co_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('co_code','vd_id','co_observe','co_stime','co_stime_unc','co_etime','co_etime_unc','co_com','cc_id','cc_id2','cc_id3','co_loaddate','co_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='co',$field_name,$field_value);
}


if(isset($_POST['ip_hyd_code'])){
	
	
	if($_POST['ip_hyd_end'] == "" || $_POST['ip_hyd_end'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_hyd_end'] = getEndTime($_POST['ip_hyd_end']);
	}
	
	if($_POST['ip_hyd_pubdate'] == "" || $_POST['ip_hyd_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_hyd_pubdate'] = getPubDate($_POST['ip_hyd_pubdate'],$_POST['ip_hyd_start']);
	}
	
	if($_POST['ip_hyd_loaddate'] == ""){
		$_POST['ip_hyd_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('ip_hyd_code','vd_id','ip_hyd_time','ip_hyd_time_unc','ip_hyd_start','ip_hyd_start_unc','ip_hyd_end','ip_hyd_end_unc','ip_hyd_gwater','ip_hyd_ipor','ip_hyd_edef','ip_hyd_hfrac','ip_hyd_btrem','ip_hyd_abgas','ip_hyd_species','ip_hyd_chim','ip_hyd_ori','ip_hyd_com','cc_id','cc_id2','cc_id3','ip_hyd_loaddate','ip_hyd_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='ip_hyd',$field_name,$field_value);
}


if(isset($_POST['ip_mag_code'])){
	
	
	if($_POST['ip_mag_end'] == "" || $_POST['ip_mag_end'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_mag_end'] = getEndTime($_POST['ip_mag_end']);
	}
	
	if($_POST['ip_mag_pubdate'] == "" || $_POST['ip_mag_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_mag_pubdate'] = getPubDate($_POST['ip_mag_pubdate'],$_POST['ip_mag_start']);
	}
	
	if($_POST['ip_mag_loaddate'] == ""){
		$_POST['ip_mag_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('ip_mag_code','vd_id','ip_mag_time','ip_mag_time_unc','ip_mag_start','ip_mag_start_unc','ip_mag_end','ip_mag_end_unc','ip_mag_deepsupp','ip_mag_asc','ip_mag_convb','ip_mag_conva','ip_mag_mix','ip_mag_dike','ip_mag_pipe','ip_mag_sill','ip_mag_ori','ip_mag_com','cc_id','cc_id2','cc_id3','ip_mag_loaddate','ip_mag_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='ip_mag',$field_name,$field_value);
}


if(isset($_POST['ip_pres_code'])){
	
	
	if($_POST['ip_pres_end'] == "" || $_POST['ip_pres_end'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_pres_end'] = getEndTime($_POST['ip_pres_end']);
	}
	
	if($_POST['ip_pres_pubdate'] == "" || $_POST['ip_pres_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_pres_pubdate'] = getPubDate($_POST['ip_pres_pubdate'],$_POST['ip_pres_start']);
	}
	
	if($_POST['ip_pres_loaddate'] == ""){
		$_POST['ip_pres_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('ip_pres_code','vd_id','ip_pres_time','ip_pres_time_unc','ip_pres_start','ip_pres_start_unc','ip_pres_end','ip_pres_end_unc','ip_pres_gas','ip_pres_tec','ip_pres_ori','ip_pres_com','cc_id','cc_id2','cc_id3','ip_pres_loaddate','ip_pres_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='ip_pres',$field_name,$field_value);
}


if(isset($_POST['ip_sat_code'])){
	
	
	if($_POST['ip_sat_end'] == "" || $_POST['ip_sat_end'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_sat_end'] = getEndTime($_POST['ip_sat_end']);
	}
	
	if($_POST['ip_sat_pubdate'] == "" || $_POST['ip_sat_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_sat_pubdate'] = getPubDate($_POST['ip_sat_pubdate'],$_POST['ip_sat_start']);
	}
	
	if($_POST['ip_sat_loaddate'] == ""){
		$_POST['ip_sat_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('ip_sat_code','vd_id','ip_sat_time','ip_sat_time_unc','ip_sat_start','ip_sat_start_unc','ip_sat_end','ip_sat_end_unc','ip_sat_co2','ip_sat_h2o','ip_sat_decomp','ip_sat_dfo2','ip_sat_add','ip_sat_xtl','ip_sat_ves','ip_sat_deves','ip_sat_degas','ip_sat_ori','ip_sat_com','cc_id','cc_id2','cc_id3','ip_sat_loaddate','ip_sat_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='ip_sat',$field_name,$field_value);
}


if(isset($_POST['ip_tec_code'])){
	
	
	if($_POST['ip_tec_end'] == "" || $_POST['ip_tec_end'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_tec_end'] = getEndTime($_POST['ip_tec_end']);
	}
	
	if($_POST['ip_tec_pubdate'] == "" || $_POST['ip_tec_pubdate'] == "YYYY-MM-DD HH:MM:SS" ){
		$_POST['ip_tec_pubdate'] = getPubDate($_POST['ip_tec_pubdate'],$_POST['ip_tec_start']);
	}
	
	if($_POST['ip_tec_loaddate'] == ""){
		$_POST['ip_tec_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}
	

	$field_name= array('ip_tec_code','vd_id','ip_tec_time','ip_tec_time_unc','ip_tec_start','ip_tec_start_unc','ip_tec_end','ip_tec_end_unc','ip_tec_change','ip_tec_sstress','ip_tec_dstrain','ip_tec_fault','ip_tec_seq','ip_tec_press','ip_tec_depress','ip_tec_hppress','ip_tec_etide','ip_tec_atmp','ip_tec_ori','ip_tec_com','cc_id','cc_id2','cc_id3','ip_tec_loaddate','ip_tec_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	$result = insertTable($table_name='ip_tec',$field_name,$field_value);
}


if(isset($_POST['sn_code'])){  

	if($_POST['sn_etime'] == "" ||  $_POST['sn_etime']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['sn_etime'] = getEndTime($_POST['sn_etime']);
	}
	
	if($_POST['sn_pubdate'] == "" ||  $_POST['sn_pubdate']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['sn_pubdate'] = getPubDate($_POST['sn_pubdate'],$_POST['sn_stime']);
	}
	
	if($_POST['sn_loaddate'] == ""){
		$_POST['sn_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','vd_id','sn_code','sn_name','sn_vmodel','sn_vmodel_detail','sn_zerokm','sn_fdepth_flag','sn_fdepth','sn_stime','sn_stime_unc','sn_etime','sn_etime_unc','sn_tot','sn_bb','sn_smp','sn_digital','sn_analog','sn_tcomp','sn_micro','sn_desc','sn_utc','sn_ori','sn_com','cc_id2','cc_id3','sn_loaddate','sn_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($_POST)-1) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	
	$result = insertTable($table_name='sn',$field_name,$field_value);
}

if(isset($_POST['ss_code'])){  

	if($_POST['ss_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ss_etime'] == ""){
		$_POST['ss_etime'] = getEndTime($_POST['ss_etime']);
	}
	
	if($_POST['ss_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ss_pubdate'] == ""){
		$_POST['ss_pubdate'] = getPubDate($_POST['ss_pubdate'],$_POST['ss_stime']);
	}
	
	if($_POST['ss_loaddate'] == ""){
		$_POST['ss_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','sn_id','ss_code','ss_name','ss_lat','ss_lon','ss_elev','ss_depth','ss_stime','ss_stime_unc','ss_etime','ss_etime_unc','ss_utc','ss_instr_type','ss_sgain','ss_desc','ss_ori','ss_com','cc_id2','cc_id3','ss_loaddate','ss_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='ss',$field_name,$field_value);
	
	
	
}

if(isset($_POST['si_code'])){  

	if($_POST['si_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['si_etime'] == ""){
		$_POST['si_etime'] = getEndTime($_POST['si_etime']);
	}
	
	if($_POST['si_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['si_pubdate'] == ""){
		$_POST['si_pubdate'] = getPubDate($_POST['si_pubdate'],$_POST['si_stime']);
	}
	
	if($_POST['si_loaddate'] == ""){
		$_POST['si_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','ss_id','si_code','si_name','si_type','si_range','si_igain','si_filter','si_ncomp','si_resp','si_resp_file','si_stime','si_stime_unc','si_etime','si_etime_unc','si_ori','si_com','cc_id2','cc_id3','si_loaddate','si_pubdate','cc_id_load','cb_ids');

	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result = insertTable($table_name='si',$field_name,$field_value);
	
	
}


if(isset($_POST['si_cmp_code'])){  

	if($_POST['si_cmp_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['si_cmp_etime'] == ""){
		$_POST['si_cmp_etime'] = getEndTime($_POST['si_cmp_etime']);
	}
	
	if($_POST['si_cmp_loaddate'] == ""){
		$_POST['si_cmp_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','si_id','si_cmp_code','si_cmp_name','si_cmp_type','si_cmp_resp','si_cmp_band','si_cmp_samp','si_cmp_icode','si_cmp_orient','si_cmp_sens','si_cmp_depth','si_cmp_ori','si_cmp_com','cc_id2','cc_id3','si_cmp_loaddate','si_cmp_pubdate','cc_id_load','cb_ids');

	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result = insertTable($table_name='si_cmp',$field_name,$field_value);
	
	
}

if(isset($_POST['cn_code'])){  

	if($_POST['cn_etime'] == "" ||  $_POST['cn_etime']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['cn_etime'] = getEndTime($_POST['cn_etime']);
	}
	
	if($_POST['cn_pubdate'] == "" ||  $_POST['cn_pubdate']== "YYYY-MM-DD HH:MM:SS"){
		$_POST['cn_pubdate'] = getPubDate($_POST['cn_pubdate'],$_POST['cn_stime']);
	}
	
	if($_POST['cn_loaddate'] == ""){
		$_POST['cn_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','vd_id','cn_code','cn_name','cn_type','cn_area','cn_map','cn_stime','cn_stime_unc','cn_etime','cn_etime_unc','cn_utc','cn_desc','cn_ori','cn_com','cc_id2','cc_id3','cn_loaddate','cn_pubdate',
	'cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){

		$field_value[$i] = trim($_POST[$field_name[$i]]); 

	}

	
	$result = insertTable($table_name='cn',$field_name,$field_value);
}


if(isset($_POST['ds_code'])){  

	if($_POST['ds_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ds_etime'] == ""){
		$_POST['ds_etime'] = getEndTime($_POST['ds_etime']);
	}
	
	if($_POST['ds_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ds_pubdate'] == ""){
		$_POST['ds_pubdate'] = getPubDate($_POST['ds_pubdate'],$_POST['ds_stime']);
	}
	
	if($_POST['ds_loaddate'] == "" ){
		$_POST['ds_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','ds_code','ds_name','ds_perm','ds_nlat','ds_nlon','ds_nelev','ds_herr_loc','ds_stime','ds_stime_unc','ds_etime','ds_etime_unc','ds_utc','ds_rflag','ds_desc','ds_ori','ds_com','cc_id2','cc_id3','ds_loaddate','ds_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='ds',$field_name,$field_value);
	
	
	
}


if(isset($_POST['di_gen_code'])){  

	if($_POST['di_gen_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['di_gen_etime'] == ""){
		$_POST['di_gen_etime'] = getEndTime($_POST['di_gen_etime']);
	}
	
	if($_POST['di_gen_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['di_gen_pubdate'] == ""){
		$_POST['di_gen_pubdate'] = getPubDate($_POST['di_gen_pubdate'],$_POST['di_gen_stime']);
	}
	
	if($_POST['di_gen_loaddate'] == ""){
		$_POST['di_gen_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}


	$field_name= array('cc_id','ds_id','cs_id','di_gen_code','di_gen_name','di_gen_type','di_gen_units','di_gen_res','di_gen_stn','di_gen_stime','di_gen_stime_unc','di_gen_etime','di_gen_etime_unc','di_gen_ori','di_gen_com','cc_id2','cc_id3','di_gen_loaddate','di_gen_pubdate','cc_id_load','cb_ids');

	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result = insertTable($table_name='di_gen',$field_name,$field_value);
	
	
}


if(isset($_POST['di_tlt_code'])){  

	if($_POST['di_tlt_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['di_tlt_etime'] == ""){
		$_POST['di_tlt_etime'] = getEndTime($_POST['di_tlt_etime']);
	}
	
	if($_POST['di_tlt_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['di_tlt_pubdate'] == ""){
		$_POST['di_tlt_pubdate'] = getPubDate($_POST['di_tlt_pubdate'],$_POST['di_tlt_stime']);
	}
	
	if($_POST['di_tlt_loaddate'] == ""){
		$_POST['di_tlt_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}


	$field_name= array('cc_id','ds_id','di_tlt_code','di_tlt_name','di_tlt_type','di_tlt_depth','di_tlt_units','di_tlt_res','di_tlt_dir1','di_tlt_dir2','di_tlt_dir3','di_tlt_dir4','di_tlt_econv1','di_tlt_econv2','di_tlt_econv3','di_tlt_econv4','di_tlt_stime','di_tlt_stime_unc','di_tlt_etime','di_tlt_etime_unc','di_tlt_ori','di_tlt_com','cc_id2','cc_id3','di_tlt_loaddate','di_tlt_pubdate','cc_id_load','cb_ids');
	

	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	$result = insertTable($table_name='di_tlt',$field_name,$field_value);
	
}


if(isset($_POST['fs_code'])){  

	if($_POST['fs_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['fs_etime'] == ""){
		$_POST['fs_etime'] = getEndTime($_POST['fs_etime']);
	}
	
	if($_POST['fs_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['fs_pubdate'] == ""){
		$_POST['fs_pubdate'] = getPubDate($_POST['fs_pubdate'],$_POST['fs_stime']);
	}
	
	if($_POST['fs_loaddate'] == "" ){
		$_POST['fs_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','fs_code','fs_name','fs_lat','fs_lon','fs_elev','fs_inst','fs_utc','fs_stime','fs_stime_unc','fs_etime','fs_etime_unc','fs_desc','fs_ori','fs_com','cc_id2','cc_id3','fs_loaddate','fs_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='fs',$field_name,$field_value);
	
}


if(isset($_POST['fi_code'])){  

	if($_POST['fi_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['fi_etime'] == ""){
		$_POST['fi_etime'] = getEndTime($_POST['fi_etime']);
	}
	
	if($_POST['fi_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['fi_pubdate'] == ""){
		$_POST['fi_pubdate'] = getPubDate($_POST['fi_pubdate'],$_POST['fi_stime']);
	}
	
	if($_POST['fi_loaddate'] == "" ){
		$_POST['fi_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','fs_id','fi_code','fi_name','fi_type','fi_res','fi_units','fi_rate','fi_filter','fi_orient','fi_calc','fi_stime','fi_stime_unc','fi_etime','fi_etime_unc','fi_ori','fi_com','cc_id2','cc_id3','fi_loaddate','fi_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='fi',$field_name,$field_value);
	
}


if(isset($_POST['gs_code'])){  

	if($_POST['gs_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['gs_etime'] == ""){
		$_POST['gs_etime'] = getEndTime($_POST['gs_etime']);
	}
	
	if($_POST['gs_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['gs_pubdate'] == ""){
		$_POST['gs_pubdate'] = getPubDate($_POST['gs_pubdate'],$_POST['gs_stime']);
	}
	
	if($_POST['gs_loaddate'] == "" ){
		$_POST['gs_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','gs_code','gs_name','gs_lat','gs_lon','gs_elev','gs_inst','gs_type','gs_utc','gs_stime','gs_stime_unc','gs_etime','gs_etime_unc','gs_desc','gs_ori','gs_com','cc_id2','cc_id3','gs_loaddate','gs_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='gs',$field_name,$field_value);
	
}

if(isset($_POST['gi_code'])){  

	if($_POST['gi_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['gi_etime'] == ""){
		$_POST['gi_etime'] = getEndTime($_POST['gi_etime']);
	}
	
	if($_POST['gi_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['gi_pubdate'] == ""){
		$_POST['gi_pubdate'] = getPubDate($_POST['gi_pubdate'],$_POST['gi_stime']);
	}
	
	if($_POST['gi_loaddate'] == "" ){
		$_POST['gi_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','gs_id','cs_id','gi_code','gi_name','gi_type','gi_units','gi_pres','gi_stn','gi_calib','gi_stime','gi_stime_unc','gi_etime','gi_etime_unc','gi_spatres','gi_ctsize','gi_atsize','gi_swidth','gi_tempres','gi_rtime','gi_vangle','gi_ori','gi_com','cc_id2','cc_id3','gi_loaddate','gi_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}
	
	$result = insertTable($table_name='gi',$field_name,$field_value);
	
}

if(isset($_POST['hs_code'])){  

	if($_POST['hs_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['hs_etime'] == ""){
		$_POST['hs_etime'] = getEndTime($_POST['hs_etime']);
	}
	
	if($_POST['hs_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['hs_pubdate'] == ""){
		$_POST['hs_pubdate'] = getPubDate($_POST['hs_pubdate'],$_POST['hs_stime']);
	}
	
	if($_POST['hs_loaddate'] == "" ){
		$_POST['hs_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','hs_code','hs_name','hs_lat','hs_lon','hs_elev','hs_perm','hs_type','hs_utc','hs_tscr','hs_bscr','hs_tdepth','hs_stime','hs_stime_unc','hs_etime','hs_etime_unc','hs_desc','hs_ori','hs_com','cc_id2','cc_id3','hs_loaddate','hs_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='hs',$field_name,$field_value);
	
}


if(isset($_POST['hi_code'])){  

	if($_POST['hi_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['hi_etime'] == ""){
		$_POST['hi_etime'] = getEndTime($_POST['hi_etime']);
	}
	
	if($_POST['hi_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['hi_pubdate'] == ""){
		$_POST['hi_pubdate'] = getPubDate($_POST['hi_pubdate'],$_POST['hi_stime']);
	}
	
	if($_POST['hi_loaddate'] == "" ){
		$_POST['hi_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','hs_id','hi_code','hi_name','hi_type','hi_meas','hi_units','hi_res','hi_stime','hi_stime_unc','hi_etime','hi_etime_unc','hi_desc','hi_ori','hi_com','cc_id2','cc_id3','hi_loaddate','hi_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='hi',$field_name,$field_value);
	
}


if(isset($_POST['ms_code'])){  

	if($_POST['ms_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ms_etime'] == ""){
		$_POST['ms_etime'] = getEndTime($_POST['ms_etime']);
	}
	
	if($_POST['ms_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ms_pubdate'] == ""){
		$_POST['ms_pubdate'] = getPubDate($_POST['ms_pubdate'],$_POST['ms_stime']);
	}
	
	if($_POST['ms_loaddate'] == "" ){
		$_POST['ms_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','ms_code','ms_name','ms_lat','ms_lon','ms_elev','ms_perm','ms_type','ms_stime','ms_stime_unc','ms_etime','ms_etime_unc','ms_utc','ms_desc','ms_ori','ms_com','cc_id2','cc_id3','ms_loaddate','ms_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='ms',$field_name,$field_value);
	
}


if(isset($_POST['mi_code'])){  

	if($_POST['mi_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['mi_etime'] == ""){
		$_POST['mi_etime'] = getEndTime($_POST['mi_etime']);
	}
	
	if($_POST['mi_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['mi_pubdate'] == ""){
		$_POST['mi_pubdate'] = getPubDate($_POST['mi_pubdate'],$_POST['mi_stime']);
	}
	
	if($_POST['mi_loaddate'] == "" ){
		$_POST['mi_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','ms_id','mi_code','mi_name','mi_type','mi_units','mi_res','mi_stime','mi_stime_unc','mi_etime','mi_etime_unc','mi_desc','mi_ori','mi_com','cc_id2','cc_id3','mi_loaddate','mi_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='mi',$field_name,$field_value);
	
}


if(isset($_POST['ts_code'])){  

	if($_POST['ts_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ts_etime'] == ""){
		$_POST['ts_etime'] = getEndTime($_POST['ts_etime']);
	}
	
	if($_POST['ts_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ts_pubdate'] == ""){
		$_POST['ts_pubdate'] = getPubDate($_POST['ts_pubdate'],$_POST['ts_stime']);
	}
	
	if($_POST['ts_loaddate'] == "" ){
		$_POST['ts_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','cn_id','ts_code','ts_name','ts_type','ts_ground','ts_lat','ts_lon','ts_elev','ts_perm','ts_utc','ts_stime','ts_stime_unc','ts_etime','ts_etime_unc','ts_desc','ts_ori','ts_com','cc_id2','cc_id3','ts_loaddate','ts_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}

	
	$result = insertTable($table_name='ts',$field_name,$field_value);
	
}


if(isset($_POST['ti_code'])){  

	if($_POST['ti_etime'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ti_etime'] == ""){
		$_POST['ti_etime'] = getEndTime($_POST['ti_etime']);
	}
	
	if($_POST['ti_pubdate'] == "YYYY-MM-DD HH:MM:SS" || $_POST['ti_pubdate'] == ""){
		$_POST['ti_pubdate'] = getPubDate($_POST['ti_pubdate'],$_POST['ti_stime']);
	}
	
	if($_POST['ti_loaddate'] == "" ){
		$_POST['ti_loaddate'] = getTodayDate();
	}


	if(isset($_POST['cb_ids'])){
		$totalSize = sizeof($_POST['cb_ids']);
		$cbId = "";
		for($i=0; $i< $totalSize ;$i++){
			$cbId  .= $_POST['cb_ids'][$i];
			if ($i < ($totalSize-1))	
				$cbId .= ",";
		}
		$_POST['cb_ids'] = $cbId;
	}else{
		$_POST['cb_ids'] = "";
	
	}

	$field_name= array('cc_id','ts_id','cs_id','ti_code','ti_name','ti_type','ti_units','ti_pres','ti_stn','ti_stime','ti_stime_unc','ti_etime','ti_etime_unc','ti_ori','ti_com','cc_id2','cc_id3','ti_loaddate','ti_pubdate','cc_id_load','cb_ids');

	
	for ($i=0; $i < (sizeof($field_name)) ; $i++){
		$field_value[$i] = trim($_POST[$field_name[$i]]); 
	}
	
	$result = insertTable($table_name='ti',$field_name,$field_value);
	
}

if($result){
	header("Location:insertMessage.php?result=".$result);	   //Show sucessful message
	exit();
}else{
	header("Location:insertMessage.php?result=false");	   //Show sucessful message
	exit();
}









?>