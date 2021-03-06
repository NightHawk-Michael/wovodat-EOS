<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($da_dd_gpv_gpv_obj, "CODE");

// Get owners
$owners=$da_dd_gpv_gpv_obj['results']['owners'];

// Prepare link to ds_id
if (substr($da_dd_gpv_gpv_obj['results']['ds_id'], 0, 1)=="@") {
	$ds_id=$db_ids[substr($da_dd_gpv_gpv_obj['results']['ds_id'], 1)];
}
else {
	$ds_id=$da_dd_gpv_gpv_obj['results']['ds_id'];
}

// Prepare link to di_gen_id
if (substr($da_dd_gpv_gpv_obj['results']['di_gen_id'], 0, 1)=="@") {
	$di_gen_id=$db_ids[substr($da_dd_gpv_gpv_obj['results']['di_gen_id'], 1)];
}
else {
	$di_gen_id=$da_dd_gpv_gpv_obj['results']['di_gen_id'];
}

// INSERT or UPDATE?
$id=v1_get_id("dd_gpv", $code, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="dd_gpv";
	$field_name=array();
	$field_name[0]="dd_gpv_code";
	$field_name[1]="dd_gpv_stime";
	$field_name[2]="dd_gpv_stime_unc";
	$field_name[3]="dd_gpv_etime";
	$field_name[4]="dd_gpv_etime_unc";
	$field_name[5]="dd_gpv_dmag";
	$field_name[6]="dd_gpv_daz";
	$field_name[7]="dd_gpv_vincl";
	$field_name[8]="dd_gpv_N";
	$field_name[9]="dd_gpv_dnerr";
	$field_name[10]="dd_gpv_E";
	$field_name[11]="dd_gpv_deerr";
	$field_name[12]="dd_gpv_vert";
	$field_name[13]="dd_gpv_dverr";
	$field_name[14]="dd_gpv_refFrame";        //Nang added on 11-Nov-2013	
	$field_name[15]="dd_gpv_projection";      //Nang added on 11-Nov-2013	
	$field_name[16]="dd_gpv_ellipsoid";       //Nang added on 11-Nov-2013		
	$field_name[17]="dd_gpv_datum";          //Nang added on 11-Nov-2013		
	$field_name[18]="dd_gpv_refPosLat";       //Nang added on 11-Nov-2013	
	$field_name[19]="dd_gpv_refPosLon";       //Nang added on 11-Nov-2013		
	$field_name[20]="dd_gpv_refPosElev";      //Nang added on 11-Nov-2013	
	$field_name[21]="dd_gpv_staVelNorth";     //Nang added on 11-Nov-2013	
	$field_name[22]="dd_gpv_staVelNorthErr";  //Nang added on 11-Nov-2013
	$field_name[23]="dd_gpv_staVelEast";      //Nang added on 11-Nov-2013	
	$field_name[24]="dd_gpv_staVelEastErr";   //Nang added on 11-Nov-2013
	$field_name[25]="dd_gpv_staVelVert";      //Nang added on 11-Nov-2013	
	$field_name[26]="dd_gpv_staVelVertErr";   //Nang added on 11-Nov-2013
	$field_name[27]="dd_gpv_dataType";        //Nang added on 11-Nov-2013	
	$field_name[28]="dd_gpv_arch";            //Nang added on 11-Nov-2013
	$field_name[29]="dd_gpv_software";        //Nang added on 11-Nov-2013	
	$field_name[30]="dd_gpv_ori";             //Nang added on 11-Sep-2012	
	$field_name[31]="dd_gpv_com";
	$field_name[32]="ds_id";
	$field_name[33]="di_gen_id";
	$field_name[34]="cc_id";
	$field_name[35]="cc_id2";
	$field_name[36]="cc_id3";
	$field_name[37]="dd_gpv_pubdate";
	$field_name[38]="cc_id_load";
	$field_name[39]="dd_gpv_loaddate";
	$field_name[40]="dd_gpv_dherr";
	$field_name[41]="cb_ids";	

	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($da_dd_gpv_gpv_obj, "STARTTIME");
	$field_value[2]=xml_get_ele($da_dd_gpv_gpv_obj, "STARTTIMEUNC");
	$field_value[3]=xml_get_ele($da_dd_gpv_gpv_obj, "ENDTIME");
	$field_value[4]=xml_get_ele($da_dd_gpv_gpv_obj, "ENDTIMEUNC");
	$field_value[5]=xml_get_ele($da_dd_gpv_gpv_obj, "MAGNITUDE");
	$field_value[6]=xml_get_ele($da_dd_gpv_gpv_obj, "AZIMUTH");
	$field_value[7]=xml_get_ele($da_dd_gpv_gpv_obj, "INCLINATION");
	$field_value[8]=xml_get_ele($da_dd_gpv_gpv_obj, "NORTHDISPL");
	$field_value[9]=xml_get_ele($da_dd_gpv_gpv_obj, "NORTHDISPLERR");
	$field_value[10]=xml_get_ele($da_dd_gpv_gpv_obj, "EASTDISPL");
	$field_value[11]=xml_get_ele($da_dd_gpv_gpv_obj, "EASTDISPLERR");
	$field_value[12]=xml_get_ele($da_dd_gpv_gpv_obj, "VERTDISPL");
	$field_value[13]=xml_get_ele($da_dd_gpv_gpv_obj, "VERTDISPLERR");
	$field_value[14]=xml_get_ele($da_dd_gpv_gpv_obj, "REFFRAME");      		//Nang added on 11-Nov-2013
	$field_value[15]=xml_get_ele($da_dd_gpv_gpv_obj, "PROJECTION");     	//Nang added on 11-Nov-2013
	$field_value[16]=xml_get_ele($da_dd_gpv_gpv_obj, "ELLIPSOID");      	//Nang added on 11-Nov-2013
	$field_value[17]=xml_get_ele($da_dd_gpv_gpv_obj, "DATUM");         	//Nang added on 11-Nov-2013
	$field_value[18]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSLAT");      	//Nang added on 11-Nov-2013
	$field_value[19]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSLON");      	//Nang added on 11-Nov-2013
	$field_value[20]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSELEV");        	//Nang added on 11-Nov-2013
	$field_value[21]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELNORTH");       	//Nang added on 11-Nov-2013
	$field_value[22]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELNORTHERR");    	//Nang added on 11-Nov-2013
	$field_value[23]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELEAST");         //Nang added on 11-Nov-2013
	$field_value[24]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELEASTERR");      //Nang added on 11-Nov-2013
	$field_value[25]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELVERT");	        //Nang added on 11-Nov-2013
	$field_value[26]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELVERTERR");	    //Nang added on 11-Nov-2013 
	$field_value[27]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVDATATYPE");	    //Nang added on 11-Nov-2013 
	$field_value[28]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVARCHIVE");		    //Nang added on 11-Nov-2013
	$field_value[29]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVSOFTWARE");	    //Nang added on 11-Nov-2013 
	$field_value[30]=xml_get_ele($da_dd_gpv_gpv_obj, "ORGDIGITIZE");        //Nang added on 11-Sep-2012	
	$field_value[31]=xml_get_ele($da_dd_gpv_gpv_obj, "COMMENTS");
	$field_value[32]=$ds_id;
	$field_value[33]=$di_gen_id;
	$field_value[34]=$da_dd_gpv_gpv_obj['results']['owners'][0]['id'];
	$field_value[35]=$da_dd_gpv_gpv_obj['results']['owners'][1]['id'];
	$field_value[36]=$da_dd_gpv_gpv_obj['results']['owners'][2]['id'];
	$field_value[37]=$da_dd_gpv_gpv_obj['results']['pubdate'];
	$field_value[38]=$cc_id_load;
	$field_value[39]=$current_time;
	$field_value[40]=xml_get_ele($da_dd_gpv_gpv_obj, "MAGNITUDEERR");
	$field_value[41]=$cb_ids;	

	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_dd_gpv_gpv_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="dd_gpv";
	$field_name=array();
	$field_name[0]="dd_gpv_pubdate";
	$field_name[1]="dd_gpv_stime";
	$field_name[2]="dd_gpv_stime_unc";
	$field_name[3]="dd_gpv_etime";
	$field_name[4]="dd_gpv_etime_unc";
	$field_name[5]="dd_gpv_dmag";
	$field_name[6]="dd_gpv_daz";
	$field_name[7]="dd_gpv_vincl";
	$field_name[8]="dd_gpv_N";
	$field_name[9]="dd_gpv_dnerr";
	$field_name[10]="dd_gpv_E";
	$field_name[11]="dd_gpv_deerr";
	$field_name[12]="dd_gpv_vert";
	$field_name[13]="dd_gpv_dverr";
	$field_name[14]="dd_gpv_refFrame";        //Nang added on 11-Nov-2013	
	$field_name[15]="dd_gpv_projection";      //Nang added on 11-Nov-2013	
	$field_name[16]="dd_gpv_ellipsoid";       //Nang added on 11-Nov-2013		
	$field_name[17]="dd_gpv_datum";          //Nang added on 11-Nov-2013		
	$field_name[18]="dd_gpv_refPosLat";       //Nang added on 11-Nov-2013	
	$field_name[19]="dd_gpv_refPosLon";       //Nang added on 11-Nov-2013		
	$field_name[20]="dd_gpv_refPosElev";      //Nang added on 11-Nov-2013	
	$field_name[21]="dd_gpv_staVelNorth";     //Nang added on 11-Nov-2013	
	$field_name[22]="dd_gpv_staVelNorthErr";  //Nang added on 11-Nov-2013
	$field_name[23]="dd_gpv_staVelEast";      //Nang added on 11-Nov-2013	
	$field_name[24]="dd_gpv_staVelEastErr";   //Nang added on 11-Nov-2013
	$field_name[25]="dd_gpv_staVelVert";      //Nang added on 11-Nov-2013	
	$field_name[26]="dd_gpv_staVelVertErr";   //Nang added on 11-Nov-2013
	$field_name[27]="dd_gpv_dataType";        //Nang added on 11-Nov-2013	
	$field_name[28]="dd_gpv_arch";            //Nang added on 11-Nov-2013
	$field_name[29]="dd_gpv_software";        //Nang added on 11-Nov-2013		
	$field_name[30]="dd_gpv_ori";             //Nang added on 11-Sep-2012		
	$field_name[31]="dd_gpv_com";
	$field_name[32]="ds_id";
	$field_name[33]="di_gen_id";
	$field_name[34]="cc_id";
	$field_name[35]="cc_id2";
	$field_name[36]="cc_id3";
	$field_name[37]="dd_gpv_dherr";
	$field_name[38]="cb_ids";	

	$field_value=array();
	$field_value[0]=$da_dd_gpv_gpv_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($da_dd_gpv_gpv_obj, "STARTTIME");
	$field_value[2]=xml_get_ele($da_dd_gpv_gpv_obj, "STARTTIMEUNC");
	$field_value[3]=xml_get_ele($da_dd_gpv_gpv_obj, "ENDTIME");
	$field_value[4]=xml_get_ele($da_dd_gpv_gpv_obj, "ENDTIMEUNC");
	$field_value[5]=xml_get_ele($da_dd_gpv_gpv_obj, "MAGNITUDE");
	$field_value[6]=xml_get_ele($da_dd_gpv_gpv_obj, "AZIMUTH");
	$field_value[7]=xml_get_ele($da_dd_gpv_gpv_obj, "INCLINATION");
	$field_value[8]=xml_get_ele($da_dd_gpv_gpv_obj, "NORTHDISPL");
	$field_value[9]=xml_get_ele($da_dd_gpv_gpv_obj, "NORTHDISPLERR");
	$field_value[10]=xml_get_ele($da_dd_gpv_gpv_obj, "EASTDISPL");
	$field_value[11]=xml_get_ele($da_dd_gpv_gpv_obj, "EASTDISPLERR");
	$field_value[12]=xml_get_ele($da_dd_gpv_gpv_obj, "VERTDISPL");
	$field_value[13]=xml_get_ele($da_dd_gpv_gpv_obj, "VERTDISPLERR");
	$field_value[14]=xml_get_ele($da_dd_gpv_gpv_obj, "REFFRAME");      		//Nang added on 11-Nov-2013
	$field_value[15]=xml_get_ele($da_dd_gpv_gpv_obj, "PROJECTION");     	//Nang added on 11-Nov-2013
	$field_value[16]=xml_get_ele($da_dd_gpv_gpv_obj, "ELLIPSOID");      	//Nang added on 11-Nov-2013
	$field_value[17]=xml_get_ele($da_dd_gpv_gpv_obj, "DATUM");         	//Nang added on 11-Nov-2013
	$field_value[18]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSLAT");      	//Nang added on 11-Nov-2013
	$field_value[19]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSLON");      	//Nang added on 11-Nov-2013
	$field_value[20]=xml_get_ele($da_dd_gpv_gpv_obj, "REFPOSELEV");        	//Nang added on 11-Nov-2013
	$field_value[21]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELNORTH");       	//Nang added on 11-Nov-2013
	$field_value[22]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELNORTHERR");    	//Nang added on 11-Nov-2013
	$field_value[23]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELEAST");         //Nang added on 11-Nov-2013
	$field_value[24]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELEASTERR");      //Nang added on 11-Nov-2013
	$field_value[25]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELVERT");	        //Nang added on 11-Nov-2013
	$field_value[26]=xml_get_ele($da_dd_gpv_gpv_obj, "STAVELVERTERR");	    //Nang added on 11-Nov-2013 
	$field_value[27]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVDATATYPE");	    //Nang added on 11-Nov-2013 
	$field_value[28]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVARCHIVE");		    //Nang added on 11-Nov-2013
	$field_value[29]=xml_get_ele($da_dd_gpv_gpv_obj, "GPVSOFTWARE");	    //Nang added on 11-Nov-2013 	
	$field_value[30]=xml_get_ele($da_dd_gpv_gpv_obj, "ORGDIGITIZE");        //Nang added on 11-Sep-2012		
	$field_value[31]=xml_get_ele($da_dd_gpv_gpv_obj, "COMMENTS");
	$field_value[32]=$ds_id;
	$field_value[33]=$di_gen_id;
	$field_value[34]=$da_dd_gpv_gpv_obj['results']['owners'][0]['id'];
	$field_value[35]=$da_dd_gpv_gpv_obj['results']['owners'][1]['id'];
	$field_value[36]=$da_dd_gpv_gpv_obj['results']['owners'][2]['id'];
	$field_value[37]=xml_get_ele($da_dd_gpv_gpv_obj, "MAGNITUDEERR");
	$field_value[38]=$cb_ids;	
	$where_field_name=array();
	$where_field_name[0]="dd_gpv_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_dd_gpv_gpv_obj['id']=$id;
	array_push($db_ids, $id);
}

?>