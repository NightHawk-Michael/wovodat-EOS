<?php

// Function to write upload form
require_once "php/funcs/upload_form_funcs.php";

// Code
$field_name="Code";
$is_required=TRUE;
$field_has_error=$code_has_error;
$field_error=$code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='code';
$field_input['value']=$code;
$field_desc="A unique ID which you can use for finding these data in the future";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Volcano code
$field_name="Volcano CAVW";
$is_required=FALSE;
$field_has_error=$volcano_code_has_error;
$field_error=$volcano_code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=12;
$field_input['name']='volcano_code';
$field_input['value']=$volcano_code;
$field_desc="The CAVW number of the volcano";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Inferrence time
$field_name="Inferrence time";
$is_required=FALSE;
$field_has_error=$time_has_error;
$field_error=$time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='time';
$field_input['value']=$time;
$field_desc="The time the inferrence was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Inferrence time uncertainty
$field_name="Inferrence time uncertainty";
$is_required=FALSE;
$field_has_error=$start_time_unc_has_error;
$field_error=$start_time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='time_unc';
$field_input['value']=$time_unc;
$field_desc="The uncertainty in the time the inferrence was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Start time
$field_name="Start time";
$is_required=FALSE;
$field_has_error=$start_time_has_error;
$field_error=$start_time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='start_time';
$field_input['value']=$start_time;
$field_desc="The time the inferred process started (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Start time uncertainty
$field_name="Start time uncertainty";
$is_required=FALSE;
$field_has_error=$start_time_unc_has_error;
$field_error=$start_time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='start_time_unc';
$field_input['value']=$start_time_unc;
$field_desc="The uncertainty in the time the inferred process started (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// End time
$field_name="End time";
$is_required=FALSE;
$field_has_error=$end_time_has_error;
$field_error=$end_time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='end_time';
$field_input['value']=$end_time;
$field_desc="The time the inferred process stopped (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// End time uncertainty
$field_name="End time uncertainty";
$is_required=FALSE;
$field_has_error=$end_time_unc_has_error;
$field_error=$end_time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='end_time_unc';
$field_input['value']=$end_time_unc;
$field_desc="The uncertainty in the end time the inferred process stopped (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Tectonic changes
$field_name="Tectonic changes";
$is_required=FALSE;
$field_has_error=$change_has_error;
$field_error=$change_error;
$input_type="radio";
$field_input=array();
$field_input['name']='change';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Tectonically induced changes in magma/hydrothermal system (any mechanism)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Static stress
$field_name="Static stress";
$is_required=FALSE;
$field_has_error=$sstress_has_error;
$field_error=$sstress_error;
$input_type="radio";
$field_input=array();
$field_input['name']='sstress';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by changes in static stress after large regional earthquakes (including viscoelastic processes)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Dynamic strain
$field_name="Dynamic strain";
$is_required=FALSE;
$field_has_error=$dstrain_has_error;
$field_error=$dstrain_error;
$input_type="radio";
$field_input=array();
$field_input['name']='dstrain';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by dynamic strain, associated with passage of earthquake waves from distal sources";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Local shear
$field_name="Local shear";
$is_required=FALSE;
$field_has_error=$fault_has_error;
$field_error=$fault_error;
$input_type="radio";
$field_input=array();
$field_input['name']='fault';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by local fault shear or other deformation of the cone";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Slow earthquake
$field_name="Slow earthquake";
$is_required=FALSE;
$field_has_error=$seq_has_error;
$field_error=$seq_error;
$input_type="radio";
$field_input=array();
$field_input['name']='seq';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by \"slow earthquake,\" as recorded in a GPS or other strain network";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Distal pressurization
$field_name="Distal pressurization";
$is_required=FALSE;
$field_has_error=$press_has_error;
$field_error=$press_error;
$input_type="radio";
$field_input=array();
$field_input['name']='press';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by pressurization of magma or hydrothermal reservoir located several kilometers or more from the apparent center of unrest. May include distal VT earthquakes";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Distal depressurization
$field_name="Distal depressurization";
$is_required=FALSE;
$field_has_error=$depress_has_error;
$field_error=$depress_error;
$input_type="radio";
$field_input=array();
$field_input['name']='depress';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by depressurization of magma or hydrothermal reservoir located several kilometers or more from the apparent center of unrest. May include distal VT earthquakes";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Hydrothermal lubrication
$field_name="Hydrothermal lubrication";
$is_required=FALSE;
$field_has_error=$hppress_has_error;
$field_error=$hppress_error;
$input_type="radio";
$field_input=array();
$field_input['name']='hppress';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Changes induced by increased hydrothermal pore pressures (\"lubrication\") along faults beneath or near the volcano";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Earth-tide
$field_name="Earth-tide";
$is_required=FALSE;
$field_has_error=$etide_has_error;
$field_error=$etide_error;
$input_type="radio";
$field_input=array();
$field_input['name']='etide';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Earth tide interaction with magma/hydrothermal systems. Typically inferred from correlations between unrest and semi-diurnal or fortnightly earth tides";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Atmospheric influence
$field_name="Atmospheric influence";
$is_required=FALSE;
$field_has_error=$atmp_has_error;
$field_error=$atmp_error;
$input_type="radio";
$field_input=array();
$field_input['name']='atmp';
$field_input['options']=array();
$field_input['options']['value']=array();
$field_input['options']['checked']=array();
$field_input['options']['display']=array();
$field_input['options']['value'][0]='Y';
$field_input['options']['checked'][0]=FALSE;
$field_input['options']['display'][0]='Yes';
$field_input['options']['value'][1]='M';
$field_input['options']['checked'][1]=FALSE;
$field_input['options']['display'][1]='Maybe';
$field_input['options']['value'][2]='N';
$field_input['options']['checked'][2]=FALSE;
$field_input['options']['display'][2]='No';
$field_input['options']['value'][3]='U';
$field_input['options']['checked'][3]=TRUE;
$field_input['options']['display'][3]='Unknown';
$field_input['n_options']=4;
$field_desc="Interaction of the volcanic system with changes in atmospheric pressure, rainfall, wind, etc.";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Comments
$field_name="Comments";
$is_required=FALSE;
$field_has_error=$comments_has_error;
$field_error=$comments_error;
$input_type="textarea";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='comments';
$field_input['value']=$comments;
$field_desc="Comments on interaction with the hydrothermal system";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Interpreter
$field_name="Interpreter";
$is_required=TRUE;
$field_has_error=$interpreter_has_error;
$field_error=$interpreter_error;
$input_type="select";
$field_input=array();
$field_input['name']='interpreter';
$field_input['options']=$_SESSION['permissions']['user_upload'];
$field_input['n_options']=$_SESSION['permissions']['l_user_upload'];
$field_desc="The interpreter";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Publish date
$field_name="Publish date";
$is_required=FALSE;
$field_has_error=$publish_date_has_error;
$field_error=$publish_date_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='publish_date';
$field_input['value']=$publish_date;
$field_desc="The date these data can become public (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

?>