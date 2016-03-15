<?php

// Function to write upload form
require_once "php/funcs/upload_form_funcs.php";

// Code
$field_name="Code";
$is_required=TRUE;
$has_error=$code_has_error;
$field_error=$code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='code';
$field_input['value']=$code;
$field_desc="A unique ID which you can use for finding these data in the future";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Volcano code
$field_name="Volcano CAVW";
$is_required=FALSE;
$has_error=$volcano_code_has_error;
$field_error=$volcano_code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=12;
$field_input['name']='volcano_code';
$field_input['value']=$volcano_code;
$field_desc="The CAVW number of the volcano";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Description
$field_name="Description";
$is_required=FALSE;
$has_error=$description_has_error;
$field_error=$description_error;
$input_type="textarea";
$field_input=array();
$field_input['maxlength']=0;
$field_input['name']='description';
$field_input['value']=$description;
$field_desc="A description of the observation";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Start time
$field_name="Start time";
$is_required=FALSE;
$has_error=$start_time_has_error;
$field_error=$start_time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='start_time';
$field_input['value']=$start_time;
$field_desc="The time the observation was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Start time uncertainty
$field_name="Start time uncertainty";
$is_required=FALSE;
$has_error=$start_time_unc_has_error;
$field_error=$start_time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='start_time_unc';
$field_input['value']=$start_time_unc;
$field_desc="The uncertainty in the time the observation was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// End time
$field_name="End time";
$is_required=FALSE;
$has_error=$end_time_has_error;
$field_error=$end_time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='end_time';
$field_input['value']=$end_time;
$field_desc="The end time the observation was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// End time uncertainty
$field_name="End time uncertainty";
$is_required=FALSE;
$has_error=$end_time_unc_has_error;
$field_error=$end_time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='end_time_unc';
$field_input['value']=$end_time_unc;
$field_desc="The uncertainty in the end time the observation was made (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Observer
$field_name="Observer";
$is_required=TRUE;
$has_error=$observer_has_error;
$field_error=$observer_error;
$input_type="select";
$field_input=array();
$field_input['name']='observer';
$field_input['options']=$_SESSION['permissions']['user_upload'];
$field_input['n_options']=$_SESSION['permissions']['l_user_upload'];
$field_desc="The observer";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Publish date
$field_name="Publish date";
$is_required=FALSE;
$has_error=$publish_date_has_error;
$field_error=$publish_date_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='publish_date';
$field_input['value']=$publish_date;
$field_desc="The date these data can become public (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

?>