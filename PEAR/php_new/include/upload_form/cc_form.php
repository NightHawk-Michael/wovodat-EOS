<?php

// Function to write upload form
require_once "php/funcs/upload_form_funcs.php";

//Code
$field_name="Code";
$is_required=TRUE;
$has_error=$code_has_error;
$field_error=$code_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='code';
$field_input['value']=$code;
$field_desc="The code of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

/*
//Firstname
$field_name="Firstname";
$is_required=FALSE;
$has_error=$firstname_has_error;
$field_error=$firstname_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='firstname';
$field_input['value']=$firstname;
$field_desc="The firstname of staff in the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Lastname
$field_name="Lastname";
$is_required=FALSE;
$has_error=$lastname_has_error;
$field_error=$lastname_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='lastname';
$field_input['value']=$lastname;
$field_desc="The lastname of staff in the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);
*/

//Observatory
$field_name="Observatory";
$is_required=TRUE;
$has_error=$observatory_has_error;
$field_error=$observatory_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=128;
$field_input['name']='observatory';
$field_input['value']=$observatory;
$field_desc="The observatory name";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Address1
$field_name="Address";
$is_required=FALSE;
$has_error=$address1_has_error;
$field_error=$address1_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=256;
$field_input['name']='address1';
$field_input['value']=$address1;
$field_desc="The address1 of  the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//City
$field_name="City";
$is_required=FALSE;
$has_error=$city_has_error;
$field_error=$city_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='city';
$field_input['value']=$city;
$field_desc="The city where the observatory located";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//State
$field_name="State";
$is_required=FALSE;
$has_error=$state_has_error;
$field_error=$state_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='state';
$field_input['value']=$state;
$field_desc="The state where the observatory located";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Country
$field_name="Country";
$is_required=TRUE;
$has_error=$country_has_error;
$field_error=$country_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=19;
$field_input['name']='country';
$field_input['value']=$country;
$field_desc="The country where the observatory located";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Post
$field_name="Post";
$is_required=FALSE;
$has_error=$post_has_error;
$field_error=$post_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=12;
$field_input['name']='post';
$field_input['value']=$post;
$field_desc="The post of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Url
$field_name="Url";
$is_required=FALSE;
$has_error=$url_has_error;
$field_error=$url_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=128;
$field_input['name']='url';
$field_input['value']=$url;
$field_desc="The url of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//email
$field_name="Email";
$is_required=FALSE;
$has_error=$email_has_error;
$field_error=$email_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=36;
$field_input['name']='email';
$field_input['value']=$email;
$field_desc="The email of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Phone
$field_name="Phone";
$is_required=FALSE;
$has_error=$phone_has_error;
$field_error=$phone_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='phone';
$field_input['value']=$phone;
$field_desc="The phone of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Fax
$field_name="Fax";
$is_required=FALSE;
$has_error=$fax_has_error;
$field_error=$fax_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='fax';
$field_input['value']=$fax;
$field_desc="The fax number of the observatory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Code2
$field_name="Code2";
$is_required=FALSE;
$has_error=$code2_has_error;
$field_error=$code2_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='code2';
$field_input['value']=$code2;
$field_desc="The code2 of the observatory (if available)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Address2
$field_name="Address2";
$is_required=FALSE;
$has_error=$address2_has_error;
$field_error=$address2_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=256;
$field_input['name']='address2';
$field_input['value']=$address2;
$field_desc="The address2 of the observatory (if available)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

//Phone2
$field_name="Phone2";
$is_required=FALSE;
$has_error=$phone2_has_error;
$field_error=$phone2_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=24;
$field_input['name']='phone2';
$field_input['value']=$phone2;
$field_desc="The second phone number of the observatory (if available)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

?>