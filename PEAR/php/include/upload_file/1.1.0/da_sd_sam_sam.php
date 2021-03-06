<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($da_sd_sam_sam_obj, "CODE");

// Get owners
$owners=$da_sd_sam_sam_obj['results']['owners'];

// Prepare link to sn_id
if (substr($da_sd_sam_sam_obj['results']['sn_id'], 0, 1)=="@") {
	$sn_id=$db_ids[substr($da_sd_sam_sam_obj['results']['sn_id'], 1)];
}
else {
	$sn_id=$da_sd_sam_sam_obj['results']['sn_id'];
}

// Prepare link to ss_id
if (substr($da_sd_sam_sam_obj['results']['ss_id'], 0, 1)=="@") {
	$ss_id=$db_ids[substr($da_sd_sam_sam_obj['results']['ss_id'], 1)];
}
else {
	$ss_id=$da_sd_sam_sam_obj['results']['ss_id'];
}

// INSERT or UPDATE?
$id=v1_get_id("sd_sam", $code, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="sd_sam";
	$field_name=array();
	$field_name[0]="sd_sam_code";
	$field_name[1]="sd_sam_int";
	$field_name[2]="sd_sam_int_unc";
	$field_name[3]="sd_sam_stime";
	$field_name[4]="sd_sam_stime_unc";
	$field_name[5]="sd_sam_etime";
	$field_name[6]="sd_sam_etime_unc";
	$field_name[7]="sd_sam_ori";         // Nang added on 19-Sep-2012
	$field_name[8]="sd_sam_com";         // Nang added on 19-Sep-2012
	$field_name[9]="ss_id";
	$field_name[10]="cc_id";
	$field_name[11]="cc_id2";
	$field_name[12]="cc_id3";
	$field_name[13]="sd_sam_pubdate";
	$field_name[14]="cc_id_load";
	$field_name[15]="sd_sam_loaddate";
	$field_name[16]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($da_sd_sam_sam_obj, "CNTINTERVAL");
	$field_value[2]=xml_get_ele($da_sd_sam_sam_obj, "CNTINTERVALUNC");
	$field_value[3]=xml_get_ele($da_sd_sam_sam_obj, "STARTTIME");
	$field_value[4]=xml_get_ele($da_sd_sam_sam_obj, "STARTTIMEUNC");
	$field_value[5]=xml_get_ele($da_sd_sam_sam_obj, "ENDTIME");
	$field_value[6]=xml_get_ele($da_sd_sam_sam_obj, "ENDTIMEUNC");
	$field_value[7]=xml_get_ele($da_sd_sam_sam_obj, "ORGDIGITIZE");           // Nang added on 19-Sep-2012	
	$field_value[8]=xml_get_ele($da_sd_sam_sam_obj, "COMMENTS");	          // Nang added on 19-Sep-2012	
	$field_value[9]=$ss_id;
	$field_value[10]=$da_sd_sam_sam_obj['results']['owners'][0]['id'];
	$field_value[11]=$da_sd_sam_sam_obj['results']['owners'][1]['id'];
	$field_value[12]=$da_sd_sam_sam_obj['results']['owners'][2]['id'];
	$field_value[13]=$da_sd_sam_sam_obj['results']['pubdate'];
	$field_value[14]=$cc_id_load;
	$field_value[15]=$current_time;
	$field_value[16]=$cb_ids;
	
	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_sd_sam_sam_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="sd_sam";
	$field_name=array();
	$field_name[0]="sd_sam_pubdate";
	$field_name[1]="sd_sam_int";
	$field_name[2]="sd_sam_int_unc";
	$field_name[3]="sd_sam_stime";
	$field_name[4]="sd_sam_stime_unc";
	$field_name[5]="sd_sam_etime";
	$field_name[6]="sd_sam_etime_unc";
	$field_name[7]="sd_sam_ori";         // Nang added on 19-Sep-2012
	$field_name[8]="sd_sam_com";         // Nang added on 19-Sep-2012	
	$field_name[9]="ss_id";
	$field_name[10]="cc_id";
	$field_name[11]="cc_id2";
	$field_name[12]="cc_id3";
	$field_name[13]="cb_ids";
	$field_value=array();
	$field_value[0]=$da_sd_sam_sam_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($da_sd_sam_sam_obj, "CNTINTERVAL");
	$field_value[2]=xml_get_ele($da_sd_sam_sam_obj, "CNTINTERVALUNC");
	$field_value[3]=xml_get_ele($da_sd_sam_sam_obj, "STARTTIME");
	$field_value[4]=xml_get_ele($da_sd_sam_sam_obj, "STARTTIMEUNC");
	$field_value[5]=xml_get_ele($da_sd_sam_sam_obj, "ENDTIME");
	$field_value[6]=xml_get_ele($da_sd_sam_sam_obj, "ENDTIMEUNC");
	$field_value[7]=xml_get_ele($da_sd_sam_sam_obj, "ORGDIGITIZE");           // Nang added on 19-Sep-2012	
	$field_value[8]=xml_get_ele($da_sd_sam_sam_obj, "COMMENTS");	          // Nang added on 19-Sep-2012		
	$field_value[9]=$ss_id;
	$field_value[10]=$da_sd_sam_sam_obj['results']['owners'][0]['id'];
	$field_value[11]=$da_sd_sam_sam_obj['results']['owners'][1]['id'];
	$field_value[12]=$da_sd_sam_sam_obj['results']['owners'][2]['id'];
	$field_value[13]=$cb_ids;
	$where_field_name=array();
	$where_field_name[0]="sd_sam_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_sd_sam_sam_obj['id']=$id;
	array_push($db_ids, $id);
}

// Upload children
foreach ($da_sd_sam_sam_obj['value'] as &$da_sd_sam_sam_ele) {
	switch ($da_sd_sam_sam_ele['tag']) {
		case "RSAM":
			$da_sd_rsm_obj=&$da_sd_sam_sam_ele;
			include "da_sd_rsm.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "SSAM":
			$da_sd_ssm_obj=&$da_sd_sam_sam_ele;
			include "da_sd_ssm.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
	}
}

?>