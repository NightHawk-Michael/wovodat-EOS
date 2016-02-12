<?php
// Nang added on 22-Apr-2012 (The whole page)


// vvv Set variables        
$ms_cs_sate_dig_key="di_gen";
$ms_cs_sate_dig_name="DeformationInstrument";           

// ^^^ Get code
$code=xml_get_att($ms_cs_sate_dig_obj, "CODE"); 

// -- CHECK DATA --

// ^^^ Get owners
if (!v1_get_owners($ms_cs_sate_dig_obj, $error)) {
	$errors[$l_errors]=$error;
	$l_errors++;
	return FALSE;
}

// vvv Set owners
if (!v1_set_owners($ms_cs_sate_dig_obj)) {
	// Missing information
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=1;
	$errors[$l_errors]['message']="&lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt; is missing information: please specify owner";
	$l_errors++;
	return FALSE;
}

// ^^^ Get times
$ms_cs_sate_dig_stime=xml_get_ele($ms_cs_sate_dig_obj, "STARTTIME");
$ms_cs_sate_dig_etime=xml_get_ele($ms_cs_sate_dig_obj, "ENDTIME");


// ### Check time order
if (!empty($ms_cs_sate_dig_stime) && !empty($ms_cs_sate_dig_etime)) {
	if (strcmp($ms_cs_sate_dig_stime, $ms_cs_sate_dig_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt;, start time (".$ms_cs_sate_dig_stime.") should be earlier than end time (".$ms_cs_sate_dig_etime.")";
		$l_errors++;
		return FALSE;
	}
}

// ### Check inclusion (deformation instrument included in Satellite)
// Satellite start time < deformation instrument start time
if (!empty($start_time) && !empty($ms_cs_sate_dig_stime)) {
	if (strcmp($start_time, $ms_cs_sate_dig_stime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt;, start time (".$ms_cs_sate_dig_stime.") should be later than ".$ms_cs_sate_dig_name." start time (".$start_time.")";
		$l_errors++;
		return FALSE;
	}
}
// Satellite start time < deformation instrument end time
if (!empty($start_time) && !empty($ms_cs_sate_dig_etime)) {
	if (strcmp($start_time, $ms_cs_sate_dig_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt;, end time (".$ms_cs_sate_dig_etime.") should be later than ".$ms_cs_sate_dig_name." start time (".$start_time.")";
		$l_errors++;
		return FALSE;
	}
}
// Gas instrument start time < Satellite end time
if (!empty($ms_cs_sate_dig_stime) && !empty($end_time)) {
	if (strcmp($ms_cs_sate_dig_stime, $end_time)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt;, start time (".$ms_cs_sate_dig_stime.") should be earlier than ".$ms_cs_sate_dig_name." end time (".$end_time.")";
		$l_errors++;
		return FALSE;
	}
}
// deformation instrument end time < Satellite end time
if (!empty($ms_cs_sate_dig_etime) && !empty($end_time)) {
	if (strcmp($ms_cs_sate_dig_etime, $end_time)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_cs_sate_dig_name." code=\"".$code."\"&gt;, end time (".$ms_cs_sate_dig_etime.") should be earlier than ".$ms_cs_sate_dig_name." end time (".$end_time.")";
		$l_errors++;
		return FALSE;
	}
}

// ^^^ Get publish date
v1_get_pubdate($ms_cs_sate_dig_obj);

// vvv Set publish date
$data_time=array($ms_cs_sate_dig_stime, $ms_cs_sate_dig_etime);
v1_set_pubdate($data_time, $current_time, $ms_cs_sate_dig_obj);

// -- CHECK DUPLICATION --

// ### Check duplication
$final_owners=$ms_cs_sate_dig_obj['results']['owners'];
if (!v1_check_dupli_timeframe($ms_cs_sate_dig_name, $ms_cs_sate_dig_key, $code, $ms_cs_sate_dig_stime, $ms_cs_sate_dig_etime, $final_owners, $dupli_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=7;
	$errors[$l_errors]['message']=$dupli_error;
	$l_errors++;
	return FALSE;
}

// -- RECORD OBJECT --

// vvv Record object
$data=array();
$data['cs_id']=$ms_cs_sate_dig_id;
$data['owners']=$final_owners;
$data['stime']=$ms_cs_sate_dig_stime;
$data['etime']=$ms_cs_sate_dig_etime;
v1_record_obj($ms_cs_sate_dig_key, $code, $data);

// -- CHECK DATABASE --

// ### Check existing data in database
if (!v1_check_db_timeframe($ms_cs_sate_dig_name, $ms_cs_sate_dig_key, $code, $ms_cs_sate_dig_stime, $ms_cs_sate_dig_etime, $final_owners, $check_db_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=8;
	$errors[$l_errors]['message']=$check_db_error;
	$l_errors++;
	return FALSE;
}

// -- PREPARE DISPLAY --

// Increment data count (for display)
if (!isset($data_list[$ms_cs_sate_dig_key])) {
	$data_list[$ms_cs_sate_dig_key]=array();
	$data_list[$ms_cs_sate_dig_key]['name']="Deformation instrument";
	$data_list[$ms_cs_sate_dig_key]['number']=0;
	$data_list[$ms_cs_sate_dig_key]['sets']=array();
}
$data_list[$ms_cs_sate_dig_key]['number']++;

// -- POP OUT GENERAL INFO --

// Pop general informations
array_shift($gen_owners);
array_shift($gen_pubdates);

?>