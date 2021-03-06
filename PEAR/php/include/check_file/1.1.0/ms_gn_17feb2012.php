<?php

// vvv Set variables
$ms_gn_key="gn";
$ms_gn_name="GasNetwork";

// ^^^ Get code  ---- getting the code of a record/object.. in this case is the network code.
$code=xml_get_att($ms_gn_obj, "CODE");
$cn_code=$code;
$pr_code="ms";
$gpr_code="wovoml";

// -- CHECK DATA --

// ^^^ Get owners
if (!v1_get_owners($ms_gn_obj, $error)) {
	$errors[$l_errors]=$error;
	$l_errors++;
	return FALSE;
}

// vvv Set owners
if (!v1_set_owners($ms_gn_obj)) {
	// Missing information
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=1;
	$errors[$l_errors]['message']="&lt;".$ms_gn_name." code=\"".$ms_gn_code."\"&gt; is missing information: please specify owner";
	$l_errors++;
	return FALSE;
}

// ^^^ Get times
$ms_gn_stime=xml_get_ele($ms_gn_obj, "STARTTIME");
$ms_gn_etime=xml_get_ele($ms_gn_obj, "ENDTIME");

// ### Check time order
if (!empty($ms_gn_stime) && !empty($ms_gn_etime)) {
	if (strcmp($ms_gn_stime, $ms_gn_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_gn_name." code=\"".$ms_gn_code."\"&gt;, start time (".$ms_gn_stime.") should be earlier than end time (".$ms_gn_etime.")";
		$l_errors++;
		return FALSE;
	}
}

// ^^^ Get publish date
v1_get_pubdate($ms_gn_obj);

// vvv Set publish date
$data_time=array($ms_gn_stime, $ms_gn_etime);
v1_set_pubdate($data_time, $current_time, $ms_gn_obj);

// -- CHECK DUPLICATION --

// ### Check duplication
$final_owners=$ms_gn_obj['results']['owners'];
if (!v1_check_dupli_timeframe($ms_gn_name, $ms_gn_key, $ms_gn_code, $ms_gn_stime, $ms_gn_etime, $final_owners, $dupli_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=7;
	$errors[$l_errors]['message']=$dupli_error;
	$l_errors++;
	return FALSE;
}

// -- CHECK DATABASE --

// ### Check existing data in database
if (!v1_check_db_cn($ms_gn_name, $ms_gn_key, $ms_gn_code, $ms_gn_stime, $ms_gn_etime, $final_owners, $check_db_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=8;
	$errors[$l_errors]['message']=$check_db_error;
	$l_errors++;
	return FALSE;
}

// -- CHECK CHILDREN --

// ### Check children
foreach ($ms_gn_obj['value'] as &$ms_gn_ele) {
	switch ($ms_gn_ele['tag']) {
		case "VOLCANOES":
			$ms_gn_vd_obj=&$ms_gn_ele;
			include "ms_gn_vd.php";
			if (!empty($errors)) {
				return FALSE;
			}
			// -- RECORD OBJECT --
			// vvv Record object
			global $xml_id_cnt;
			$ms_gn_id="@".$xml_id_cnt;
			$data=array();
			$data['owners']=$final_owners;
			$data['stime']=$ms_gn_stime;
			$data['etime']=$ms_gn_etime;
			$data['parentcode']="ms";
			$data['gparentcode']="wovoml";
			$data['vd_ids']=$ms_gn_obj['results']['vd_ids'];
			v1_record_obj($ms_gn_key, $ms_gn_code, $data);
			break;
			
		case "GASSTATION":
			$ms_gn_gs_obj=&$ms_gn_ele;
			include "ms_gn_gs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
	}
}

// -- PREPARE DISPLAY --

// Increment data count (for display)
if (!isset($data_list[$ms_gn_key])) {
	$data_list[$ms_gn_key]=array();
	$data_list[$ms_gn_key]['name']="Gas network";
	$data_list[$ms_gn_key]['number']=0;
	$data_list[$ms_gn_key]['sets']=array();
}
$data_list[$ms_gn_key]['number']++;

// -- POP OUT GENERAL INFO --

// Pop general informations
array_shift($gen_owners);
array_shift($gen_pubdates);

?>