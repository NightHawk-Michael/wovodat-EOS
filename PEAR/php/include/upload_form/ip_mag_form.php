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

// Deep supply
$field_name="Deep supply";
$is_required=FALSE;
$field_has_error=$deepsupp_has_error;
$field_error=$deepsupp_error;
$input_type="radio";
$field_input=array();
$field_input['name']='deepsupp';
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
$field_desc="New or renewed supply of magma from depth";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Ascent
$field_name="Ascent";
$is_required=FALSE;
$field_has_error=$asc_has_error;
$field_error=$asc_error;
$input_type="radio";
$field_input=array();
$field_input['name']='asc';
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
$field_desc="Magma ascent, up from reservoir";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Convection below
$field_name="Convection below";
$is_required=FALSE;
$field_has_error=$convb_has_error;
$field_error=$convb_error;
$input_type="radio";
$field_input=array();
$field_input['name']='convb';
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
$field_desc="Magma convection induced from below by an intrusion at the base";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Convection above
$field_name="Convection above";
$is_required=FALSE;
$field_has_error=$conva_has_error;
$field_error=$conva_error;
$input_type="radio";
$field_input=array();
$field_input['name']='conva';
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
$field_desc="Magma convection induced from above, by settling of a dense crystal-rich mass";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Magma mixing
$field_name="Magma mixing";
$is_required=FALSE;
$field_has_error=$mix_has_error;
$field_error=$mix_error;
$input_type="radio";
$field_input=array();
$field_input['name']='mix';
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
$field_desc="Magma mixing";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Dike intrusion
$field_name="Dike intrusion";
$is_required=FALSE;
$field_has_error=$dike_has_error;
$field_error=$dike_error;
$input_type="radio";
$field_input=array();
$field_input['name']='dike';
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
$field_desc="Dike intrusion";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Pipe intrusion
$field_name="Pipe intrusion";
$is_required=FALSE;
$field_has_error=$pipe_has_error;
$field_error=$pipe_error;
$input_type="radio";
$field_input=array();
$field_input['name']='pipe';
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
$field_desc="Intrusion through a pipe-like cylindrical conduit";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Sill intrusion
$field_name="Sill intrusion";
$is_required=FALSE;
$field_has_error=$sill_has_error;
$field_error=$sill_error;
$input_type="radio";
$field_input=array();
$field_input['name']='sill';
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
$field_desc="Sill intrusion";
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