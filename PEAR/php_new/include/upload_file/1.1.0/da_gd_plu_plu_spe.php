<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get type
$type=xml_get_att($da_gd_plu_plu_spe_obj, "TYPE");

// INSERT or UPDATE?
$id=v1_get_id_species("gd_plu", $code, $type, NULL, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="gd_plu";
	$field_name=array();
	$field_name[0]="gd_plu_code";
	$field_name[1]="gd_plu_volc1";   // Nang added on 03-Dec-2014    
	$field_name[2]="gd_plu_volc2";   // Nang added on 03-Dec-2014     
	$field_name[3]="gd_plu_lat";
	$field_name[4]="gd_plu_lon";
	$field_name[5]="gd_plu_minboxlat";    // Nang added on 03-Dec-2014    
	$field_name[6]="gd_plu_maxboxlat";    // Nang added on 03-Dec-2014    
	$field_name[7]="gd_plu_minboxlon";    // Nang added on 03-Dec-2014    
	$field_name[8]="gd_plu_maxboxlon";	  // Nang added on 03-Dec-2014    
	$field_name[9]="gd_plu_image";        // Nang added on 03-Dec-2014    
	$field_name[10]="gd_plu_image_path";  // Nang added on 18-Dec-2014    
	$field_name[11]="gd_plu_inter";   // Nang added on 03-Dec-2014    
	$field_name[12]="gd_plu_height";
	$field_name[13]="gd_plu_hdet";
	$field_name[14]="gd_plu_colheight";	    // Nang added on 03-Dec-2014    
	$field_name[15]="gd_plu_time";
	$field_name[16]="gd_plu_time_unc";
	$field_name[17]="gd_plu_species";
	$field_name[18]="gd_plu_units";
	$field_name[19]="gd_plu_emit";
	$field_name[20]="gd_plu_mass";             // Nang added on 03-Dec-2014    
	$field_name[21]="gd_plu_ventmass";          // Nang added on 03-Dec-2014    
	$field_name[22]="gd_plu_maxmass";	   // Nang added on 03-Dec-2014    
	$field_name[23]="gd_plu_emit_err";     
	$field_name[24]="gd_plu_recalc"; 
	$field_name[25]="gd_plu_area";       // Nang added on 03-Dec-2014    
	$field_name[26]="gd_plu_dist";       // Nang added on 03-Dec-2014    
	$field_name[27]="gd_plu_dir";        // Nang added on 03-Dec-2014    
	$field_name[28]="gd_plu_minwave";    // Nang added on 03-Dec-2014    
	$field_name[29]="gd_plu_maxwave";	 // Nang added on 03-Dec-2014    
	$field_name[30]="gd_plu_spect";	     // Nang added on 03-Dec-2014    
	$field_name[31]="gd_plu_tech";		 // Nang added on 03-Dec-2014    
	$field_name[32]="gd_plu_wind";
	$field_name[33]="gd_plu_wsmin";	  // Nang added on 17-Sep-2012     
	$field_name[34]="gd_plu_wsmax";	  // Nang added on 17-Sep-2012   
	$field_name[35]="gd_plu_wdir";	  // Nang added on 08-May-2012         
	$field_name[36]="gd_plu_weth";
	$field_name[37]="gd_plu_ori";	  // Nang added on 08-May-2012 
	$field_name[38]="gd_plu_com";
	$field_name[39]="cs_id";	      // Nang added on 31-May-2012  
	$field_name[40]="gs_id";
	$field_name[41]="gi_id";
	$field_name[42]="vd_id";
	$field_name[43]="cc_id";
	$field_name[44]="cc_id2";
	$field_name[45]="cc_id3";
	$field_name[46]="gd_plu_pubdate";
	$field_name[47]="cc_id_load";
	$field_name[48]="gd_plu_loaddate";
	$field_name[49]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($da_gd_plu_plu_obj, "VOLC1");	        /* Nang added on 03-Dec-2014  */
	$field_value[2]=xml_get_ele($da_gd_plu_plu_obj, "VOLC2");           /* Nang added on 03-Dec-2014  */
	$field_value[3]=xml_get_ele($da_gd_plu_plu_obj, "LAT");    
	$field_value[4]=xml_get_ele($da_gd_plu_plu_obj, "LON");            /* Nang added on 03-Dec-2014  */
	$field_value[5]=xml_get_ele($da_gd_plu_plu_obj, "MINBOXLAT");	  /* Nang added on 03-Dec-2014  */
	$field_value[6]=xml_get_ele($da_gd_plu_plu_obj, "MAXBOXLAT");         /* Nang added on 03-Dec-2014  */
	$field_value[7]=xml_get_ele($da_gd_plu_plu_obj, "MINBOXLON");           /* Nang added on 03-Dec-2014  */
	$field_value[8]=xml_get_ele($da_gd_plu_plu_obj, "MAXBOXLON");           /* Nang added on 03-Dec-2014  */
	$field_value[9]=xml_get_ele($da_gd_plu_plu_obj, "IMAGE");           /* Nang added on 03-Dec-2014  */
	$field_value[10]=xml_get_ele($da_gd_plu_plu_obj, "IMAGEPATH");           /* Nang added on 18-Dec-2014  */
	$field_value[11]=xml_get_ele($da_gd_plu_plu_obj, "INTERFERENCE");           /* Nang added on 03-Dec-2014  */
	$field_value[12]=xml_get_ele($da_gd_plu_plu_obj, "HEIGHT");
	$field_value[13]=xml_get_ele($da_gd_plu_plu_obj, "HEIGHTDETERMINATION");	
	$field_value[14]=xml_get_ele($da_gd_plu_plu_obj, "COLHEIGHT");           /* Nang added on 03-Dec-2014  */
	$field_value[15]=xml_get_ele($da_gd_plu_plu_obj, "MEASTIME");
	$field_value[16]=xml_get_ele($da_gd_plu_plu_obj, "MEASTIMEUNC");	
	$field_value[17]=$type;
	$field_value[18]=xml_get_ele($da_gd_plu_plu_spe_obj, "UNITS");
	$field_value[19]=xml_get_ele($da_gd_plu_plu_spe_obj, "EMISSIONRATE");	
	$field_value[20]=xml_get_ele($da_gd_plu_plu_spe_obj, "MASS");       /* Nang added on 03-Dec-2014  */
	$field_value[21]=xml_get_ele($da_gd_plu_plu_spe_obj, "VENTMASS");	/* Nang added on 03-Dec-2014  */ 
	$field_value[22]=xml_get_ele($da_gd_plu_plu_spe_obj, "MAXMASS");	/* Nang added on 03-Dec-2014  */
	$field_value[23]=xml_get_ele($da_gd_plu_plu_spe_obj, "EMISSIONRATEUNC");
	$field_value[24]=xml_get_ele($da_gd_plu_plu_spe_obj, "RECALCULATED");	
	$field_value[25]=xml_get_ele($da_gd_plu_plu_obj, "COVERAGEAREA");           /* Nang added on 03-Dec-2014  */
	$field_value[26]=xml_get_ele($da_gd_plu_plu_obj, "MAXDISTANCE");           /* Nang added on 03-Dec-2014  */
	$field_value[27]=xml_get_ele($da_gd_plu_plu_obj, "MAXDIRECTION");           /* Nang added on 03-Dec-2014  */
	$field_value[28]=xml_get_ele($da_gd_plu_plu_obj, "MINWAVELENGTH");           /* Nang added on 03-Dec-2014  */
	$field_value[29]=xml_get_ele($da_gd_plu_plu_obj, "MAXWAVELENGTH");           /* Nang added on 03-Dec-2014  */
	$field_value[30]=xml_get_ele($da_gd_plu_plu_obj, "SPECTRAL");           /* Nang added on 03-Dec-2014  */
	$field_value[31]=xml_get_ele($da_gd_plu_plu_obj, "TECHNIQUE");           /* Nang added on 03-Dec-2014  */
	$field_value[32]=xml_get_ele($da_gd_plu_plu_obj, "WINDSPEED");
	$field_value[33]=xml_get_ele($da_gd_plu_plu_obj, "MINWINDSPEED");	 // Nang added on 17-Sep-2012 
	$field_value[34]=xml_get_ele($da_gd_plu_plu_obj, "MAXWINDSPEED");	 // Nang added on 17-Sep-2012 	
	$field_value[35]=xml_get_ele($da_gd_plu_plu_obj, "WINDDIRECTION");	 // Nang added on 08-May-2012 
	$field_value[36]=xml_get_ele($da_gd_plu_plu_obj, "WEATHERNOTES");
	$field_value[37]=xml_get_ele($da_gd_plu_plu_obj, "ORGDIGITIZE");	 // Nang added on 08-May-2012 
	$field_value[38]=xml_get_ele($da_gd_plu_plu_obj, "COMMENTS");
	$field_value[39]=$cs_id;	                                         // Nang added on 31-May-2012  
	$field_value[40]=$gs_id;
	$field_value[41]=$gi_id;
	$field_value[42]=$da_gd_plu_plu_obj['results']['vd_id'];
	$field_value[43]=$da_gd_plu_plu_obj['results']['owners'][0]['id'];
	$field_value[44]=$da_gd_plu_plu_obj['results']['owners'][1]['id'];
	$field_value[45]=$da_gd_plu_plu_obj['results']['owners'][2]['id'];
	$field_value[46]=$da_gd_plu_plu_obj['results']['pubdate'];
	$field_value[47]=$cc_id_load;
	$field_value[48]=$current_time;
	$field_value[49]=$cb_ids;	

	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_gd_plu_plu_spe_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="gd_plu";
	$field_name=array();
	$field_name[0]="gd_plu_pubdate";
	$field_name[1]="gd_plu_volc1";   // Nang added on 03-Dec-2014    
	$field_name[2]="gd_plu_volc2";   // Nang added on 03-Dec-2014     
	$field_name[3]="gd_plu_lat";
	$field_name[4]="gd_plu_lon";
	$field_name[5]="gd_plu_minboxlat";    // Nang added on 03-Dec-2014    
	$field_name[6]="gd_plu_maxboxlat";    // Nang added on 03-Dec-2014    
	$field_name[7]="gd_plu_minboxlon";   // Nang added on 03-Dec-2014    
	$field_name[8]="gd_plu_maxboxlon";	  // Nang added on 03-Dec-2014    
	$field_name[9]="gd_plu_image";    // Nang added on 03-Dec-2014    
	$field_name[10]="gd_plu_image_path";  // Nang added on 18-Dec-2014    
	$field_name[11]="gd_plu_inter";   // Nang added on 03-Dec-2014    
	$field_name[12]="gd_plu_height";
	$field_name[13]="gd_plu_hdet";
	$field_name[14]="gd_plu_colheight";	    // Nang added on 03-Dec-2014    
	$field_name[15]="gd_plu_time";
	$field_name[16]="gd_plu_time_unc";	
	$field_name[17]="gd_plu_units";
	$field_name[18]="gd_plu_emit";
	$field_name[19]="gd_plu_mass";             // Nang added on 03-Dec-2014    
	$field_name[20]="gd_plu_ventmass";          // Nang added on 03-Dec-2014    
	$field_name[21]="gd_plu_maxmass";	   // Nang added on 03-Dec-2014 
	$field_name[22]="gd_plu_emit_err";     
	$field_name[23]="gd_plu_recalc"; 
	$field_name[24]="gd_plu_area";          // Nang added on 03-Dec-2014    
	$field_name[25]="gd_plu_dist";      // Nang added on 03-Dec-2014    
	$field_name[26]="gd_plu_dir";          // Nang added on 03-Dec-2014    
	$field_name[27]="gd_plu_minwave";       // Nang added on 03-Dec-2014    
	$field_name[28]="gd_plu_maxwave";	     // Nang added on 03-Dec-2014    
	$field_name[29]="gd_plu_spect";	     // Nang added on 03-Dec-2014    
	$field_name[30]="gd_plu_tech";		 // Nang added on 03-Dec-2014    
	$field_name[31]="gd_plu_wind";
	$field_name[32]="gd_plu_wsmin";	  // Nang added on 17-Sep-2012     
	$field_name[33]="gd_plu_wsmax";	  // Nang added on 17-Sep-2012  	
	$field_name[34]="gd_plu_wdir";	 // Nang added on 08-May-2012 
	$field_name[35]="gd_plu_weth";
	$field_name[36]="gd_plu_ori";	 // Nang added on 08-May-2012 
	$field_name[37]="gd_plu_com";
	$field_name[38]="cs_id";	     // Nang added on 31-May-2012  
	$field_name[39]="gs_id";
	$field_name[40]="gi_id";
	$field_name[41]="vd_id";
	$field_name[42]="cc_id";
	$field_name[43]="cc_id2";
	$field_name[44]="cc_id3";
	$field_name[45]="cb_ids";
	$field_value=array();
	$field_value[0]=$da_gd_plu_plu_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($da_gd_plu_plu_obj, "VOLC1");	        /* Nang added on 03-Dec-2014  */
	$field_value[2]=xml_get_ele($da_gd_plu_plu_obj, "VOLC2");           /* Nang added on 03-Dec-2014  */
	$field_value[3]=xml_get_ele($da_gd_plu_plu_obj, "LAT");    
	$field_value[4]=xml_get_ele($da_gd_plu_plu_obj, "LON");            /* Nang added on 03-Dec-2014  */
	$field_value[5]=xml_get_ele($da_gd_plu_plu_obj, "MINBOXLAT");	  /* Nang added on 03-Dec-2014  */
	$field_value[6]=xml_get_ele($da_gd_plu_plu_obj, "MAXBOXLAT");         /* Nang added on 03-Dec-2014  */
	$field_value[7]=xml_get_ele($da_gd_plu_plu_obj, "MINBOXLON");           /* Nang added on 03-Dec-2014  */
	$field_value[8]=xml_get_ele($da_gd_plu_plu_obj, "MAXBOXLON");           /* Nang added on 03-Dec-2014  */
	$field_value[9]=xml_get_ele($da_gd_plu_plu_obj, "IMAGE");           /* Nang added on 03-Dec-2014  */
	$field_value[10]=xml_get_ele($da_gd_plu_plu_obj, "IMAGEPATH");           /* Nang added on 18-Dec-2014  */
	$field_value[11]=xml_get_ele($da_gd_plu_plu_obj, "INTERFERENCE");           /* Nang added on 03-Dec-2014  */
	$field_value[12]=xml_get_ele($da_gd_plu_plu_obj, "HEIGHT");
	$field_value[13]=xml_get_ele($da_gd_plu_plu_obj, "HEIGHTDETERMINATION");	
	$field_value[14]=xml_get_ele($da_gd_plu_plu_obj, "COLHEIGHT");           /* Nang added on 03-Dec-2014  */
	$field_value[15]=xml_get_ele($da_gd_plu_plu_obj, "MEASTIME");
	$field_value[16]=xml_get_ele($da_gd_plu_plu_obj, "MEASTIMEUNC");		
	$field_value[17]=xml_get_ele($da_gd_plu_plu_spe_obj, "UNITS");
	$field_value[18]=xml_get_ele($da_gd_plu_plu_spe_obj, "EMISSIONRATE");	
	$field_value[19]=xml_get_ele($da_gd_plu_plu_spe_obj, "MASS");       /* Nang added on 03-Dec-2014  */
	$field_value[20]=xml_get_ele($da_gd_plu_plu_spe_obj, "VENTMASS");	/* Nang added on 03-Dec-2014  */ 
	$field_value[21]=xml_get_ele($da_gd_plu_plu_spe_obj, "MAXMASS");	/* Nang added on 03-Dec-2014  */
	$field_value[22]=xml_get_ele($da_gd_plu_plu_spe_obj, "EMISSIONRATEUNC");
	$field_value[23]=xml_get_ele($da_gd_plu_plu_spe_obj, "RECALCULATED");	
	$field_value[24]=xml_get_ele($da_gd_plu_plu_obj, "COVERAGEAREA");           /* Nang added on 03-Dec-2014  */
	$field_value[25]=xml_get_ele($da_gd_plu_plu_obj, "MAXDISTANCE");           /* Nang added on 03-Dec-2014  */
	$field_value[26]=xml_get_ele($da_gd_plu_plu_obj, "MAXDIRECTION");           /* Nang added on 03-Dec-2014  */
	$field_value[27]=xml_get_ele($da_gd_plu_plu_obj, "MINWAVELENGTH");           /* Nang added on 03-Dec-2014  */
	$field_value[28]=xml_get_ele($da_gd_plu_plu_obj, "MAXWAVELENGTH");           /* Nang added on 03-Dec-2014  */
	$field_value[29]=xml_get_ele($da_gd_plu_plu_obj, "SPECTRAL");           /* Nang added on 03-Dec-2014  */
	$field_value[30]=xml_get_ele($da_gd_plu_plu_obj, "TECHNIQUE");           /* Nang added on 03-Dec-2014  */	
	$field_value[31]=xml_get_ele($da_gd_plu_plu_obj, "WINDSPEED");
	$field_value[32]=xml_get_ele($da_gd_plu_plu_obj, "MINWINDSPEED");	 // Nang added on 17-Sep-2012 
	$field_value[33]=xml_get_ele($da_gd_plu_plu_obj, "MAXWINDSPEED");	 // Nang added on 17-Sep-2012 	
	$field_value[34]=xml_get_ele($da_gd_plu_plu_obj, "WINDDIRECTION");	 // Nang added on 08-May-2012 
	$field_value[35]=xml_get_ele($da_gd_plu_plu_obj, "WEATHERNOTES");
	$field_value[36]=xml_get_ele($da_gd_plu_plu_obj, "ORGDIGITIZE");	 // Nang added on 08-May-2012 
	$field_value[37]=xml_get_ele($da_gd_plu_plu_obj, "COMMENTS");
	$field_value[38]=$cs_id;	                                         // Nang added on 31-May-2012  
	$field_value[39]=$gs_id;
	$field_value[40]=$gi_id;
	$field_value[41]=$da_gd_plu_plu_obj['results']['vd_id'];
	$field_value[42]=$da_gd_plu_plu_obj['results']['owners'][0]['id'];
	$field_value[43]=$da_gd_plu_plu_obj['results']['owners'][1]['id'];
	$field_value[44]=$da_gd_plu_plu_obj['results']['owners'][2]['id'];
	$field_value[45]=$cb_ids;		
	
	$where_field_name=array();
	$where_field_name[0]="gd_plu_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_gd_plu_plu_spe_obj['id']=$id;
	array_push($db_ids, $id);
}

?>