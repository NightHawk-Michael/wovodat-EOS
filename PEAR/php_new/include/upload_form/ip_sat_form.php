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

// CO2 saturation
$field_name="CO<sub>2</sub> saturation";
$is_required=FALSE;
$field_has_error=$co2_has_error;
$field_error=$co2_error;
$input_type="radio";
$field_input=array();
$field_input['name']='co2';
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
$field_desc="Magma became saturated with CO<sub>2</sub> before an eruption and contributed to preeruption unrest. Saturation induced by any cause";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// H2O saturation
$field_name="H<sub>2</sub>O saturation";
$is_required=FALSE;
$field_has_error=$h2o_has_error;
$field_error=$h2o_error;
$input_type="radio";
$field_input=array();
$field_input['name']='h2o';
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
$field_desc="Magma became saturated with H<sub>2</sub>O before an eruption and contributed to preeruption unrest. Saturation induced by any cause";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Decompression
$field_name="Decompression";
$is_required=FALSE;
$field_has_error=$decomp_has_error;
$field_error=$decomp_error;
$input_type="radio";
$field_input=array();
$field_input['name']='decomp';
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
$field_desc="Volatile saturation by decompression";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Fugacity
$field_name="Fugacity";
$is_required=FALSE;
$field_has_error=$dfo2_has_error;
$field_error=$dfo2_error;
$input_type="radio";
$field_input=array();
$field_input['name']='dfo2';
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
$field_desc="Volatile saturation by change in fO<sub>2</sub>";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Volatile addition
$field_name="Volatile addition";
$is_required=FALSE;
$field_has_error=$add_has_error;
$field_error=$add_error;
$input_type="radio";
$field_input=array();
$field_input['name']='add';
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
$field_desc="Volatile saturation by volatile addition";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Crystallization or 2nd boiling
$field_name="Crystallization or 2nd boiling";
$is_required=FALSE;
$field_has_error=$xtl_has_error;
$field_error=$xtl_error;
$input_type="radio";
$field_input=array();
$field_input['name']='xtl';
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
$field_desc="Volatile saturation by crystallization or second boiling";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Vesiculation
$field_name="Vesiculation";
$is_required=FALSE;
$field_has_error=$ves_has_error;
$field_error=$ves_error;
$input_type="radio";
$field_input=array();
$field_input['name']='ves';
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
$field_desc="Subsurface, preeruptive increases in vesiculation, thereby decreasing density. This would include extreme vesiculation to permeable foam";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Devesiculation
$field_name="Devesiculation";
$is_required=FALSE;
$field_has_error=$deves_has_error;
$field_error=$deves_error;
$input_type="radio";
$field_input=array();
$field_input['name']='deves';
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
$field_desc="Subsurface, preeruptive decreases in vesiculation, thereby increasing density. This would include collapse of newly-degassed foam";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Degassing
$field_name="Degassing";
$is_required=FALSE;
$field_has_error=$degas_has_error;
$field_error=$degas_error;
$input_type="radio";
$field_input=array();
$field_input['name']='degas';
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
$field_desc="Deep and near-surface degassing including gas explosion events";
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