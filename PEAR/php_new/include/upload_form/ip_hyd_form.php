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

// Heated groundwater
$field_name="Heated groundwater";
$is_required=FALSE;
$field_has_error=$gwater_has_error;
$field_error=$gwater_error;
$input_type="radio";
$field_input=array();
$field_input['name']='gwater';
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
$field_desc="Convective heating of groundwater";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Pore destabilization
$field_name="Pore destabilization";
$is_required=FALSE;
$field_has_error=$ipor_has_error;
$field_error=$ipor_error;
$input_type="radio";
$field_input=array();
$field_input['name']='ipor';
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
$field_desc="Destabilization of edifice by pore pressure increase";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Pore deformation
$field_name="Pore deformation";
$is_required=FALSE;
$field_has_error=$edef_has_error;
$field_error=$edef_error;
$input_type="radio";
$field_input=array();
$field_input['name']='edef';
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
$field_desc="Elastic deformation induced by pore pressure change";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Hydrofracturing
$field_name="Hydrofracturing";
$is_required=FALSE;
$field_has_error=$hfrac_has_error;
$field_error=$hfrac_error;
$input_type="radio";
$field_input=array();
$field_input['name']='hfrac';
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
$field_desc="Hydrofracturing";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Boiling-induced tremor
$field_name="Boiling-induced tremor";
$is_required=FALSE;
$field_has_error=$btrem_has_error;
$field_error=$btrem_error;
$input_type="radio";
$field_input=array();
$field_input['name']='btrem';
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
$field_desc="Boiling-induced tremor";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Soluble gases
$field_name="Soluble gases";
$is_required=FALSE;
$field_has_error=$abgas_has_error;
$field_error=$abgas_error;
$input_type="radio";
$field_input=array();
$field_input['name']='abgas';
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
$field_desc="Absorption of soluble gases";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Change in the equilibrium species
$field_name="Equilibrium species";
$is_required=FALSE;
$field_has_error=$species_has_error;
$field_error=$species_error;
$input_type="radio";
$field_input=array();
$field_input['name']='species';
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
$field_desc="Change in the equilibrium species";
html_write_form_line($field_name, $is_required, $field_has_error, $field_error, $input_type, $field_input, $field_desc);

// Boiling until dry chimneys are formed
$field_name="Boiling until dry";
$is_required=FALSE;
$field_has_error=$chim_has_error;
$field_error=$chim_error;
$input_type="radio";
$field_input=array();
$field_input['name']='chim';
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
$field_desc="Boiling until dry chimneys are formed";
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