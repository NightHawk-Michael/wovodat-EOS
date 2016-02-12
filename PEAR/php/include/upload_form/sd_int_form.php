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

// Collector
$field_name="Collector";
$is_required=TRUE;
$has_error=$collector_has_error;
$field_error=$collector_error;
$input_type="select";
$field_input=array();
$field_input['name']='collector';
$field_input['options']=$_SESSION['permissions']['user_upload'];
$field_input['n_options']=$_SESSION['permissions']['l_user_upload'];
$field_desc="The data collector";
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

// Network event code
$field_name="Network event code";
$is_required=FALSE;
$has_error=$evn_code_has_error;
$field_error=$evn_code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='evn_code';
$field_input['value']=$evn_code;
$field_desc="The probable network event";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Single station event code
$field_name="Single station event code";
$is_required=FALSE;
$has_error=$evs_code_has_error;
$field_error=$evs_code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='evs_code';
$field_input['value']=$evs_code;
$field_desc="The probable single station event";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Time
$field_name="Time";
$is_required=FALSE;
$has_error=$time_has_error;
$field_error=$time_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='time';
$field_input['value']=$time;
$field_desc="Approximate time of event in UTC (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Time uncertainty
$field_name="Time uncertainty";
$is_required=FALSE;
$has_error=$time_unc_has_error;
$field_error=$time_unc_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='time_unc';
$field_input['value']=$time_unc;
$field_desc="Uncertainty in the approximate time of event (format: YYYY-MM-DD hh:mm:ss)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// City
$field_name="City";
$is_required=FALSE;
$has_error=$city_has_error;
$field_error=$city_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='city';
$field_input['value']=$city;
$field_desc="The name of the city or town where the event was felt";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Maximum distance felt
$field_name="Maximum distance felt";
$is_required=FALSE;
$has_error=$maxdist_has_error;
$field_error=$maxdist_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=20;
$field_input['name']='maxdist';
$field_input['value']=$maxdist;
$field_desc="The maximum distance at which the earthquake was felt, measured from the volcano summit in km";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Maximum reported intensity
$field_name="Maximum reported intensity";
$is_required=FALSE;
$has_error=$maxrint_has_error;
$field_error=$maxrint_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=20;
$field_input['name']='maxrint';
$field_input['value']=$maxrint;
$field_desc="The maximum reported intensity (modified Mercalli intensity)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Distance at maximum reported intensity
$field_name="Distance at maximum reported intensity";
$is_required=FALSE;
$has_error=$maxrint_dist_has_error;
$field_error=$maxrint_dist_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=20;
$field_input['name']='maxrint_dist';
$field_input['value']=$maxrint_dist;
$field_desc="The distance from the volcano’s summit to where the maximum intensity was reported in km";
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