<?php

// Function to write upload form
require_once "php/funcs/upload_form_funcs.php";

// Authors
$field_name="Authors";
$is_required=FALSE;
$has_error=$authors_has_error;
$field_error=$authors_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='authors';
$field_input['value']=$authors;
$field_desc="The authors or editors of the paper or article";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Publication year
$field_name="Publication year";
$is_required=FALSE;
$has_error=$pub_year_has_error;
$field_error=$pub_year_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=4;
$field_input['name']='pub_year';
$field_input['value']=$pub_year;
$field_input['onkeydown']="numbersOnly(this)";
$field_desc="The year this paper or article was published";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Title
$field_name="Title";
$is_required=FALSE;
$has_error=$title_has_error;
$field_error=$title_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='title';
$field_input['value']=$title;
$field_desc="The title of this paper";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Journal
$field_name="Journal";
$is_required=FALSE;
$has_error=$journal_has_error;
$field_error=$journal_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='journal';
$field_input['value']=$journal;
$field_desc="The name of the journal";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Volume
$field_name="Volume";
$is_required=FALSE;
$has_error=$volume_has_error;
$field_error=$volume_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=20;
$field_input['name']='volume';
$field_input['value']=$volume;
$field_desc="The journal volume";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Publisher
$field_name="Publisher";
$is_required=FALSE;
$has_error=$publisher_has_error;
$field_error=$publisher_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=50;
$field_input['name']='publisher';
$field_input['value']=$publisher;
$field_desc="The name of the publisher (if book)";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Pages
$field_name="Pages";
$is_required=FALSE;
$has_error=$page_has_error;
$field_error=$page_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=30;
$field_input['name']='page';
$field_input['value']=$page;
$field_desc="The page numbers";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// DOI
$field_name="DOI";
$is_required=FALSE;
$has_error=$doi_has_error;
$field_error=$doi_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=20;
$field_input['name']='doi';
$field_input['value']=$doi;
$field_desc="The Digital Object Identifier";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// ISBN
$field_name="ISBN";
$is_required=FALSE;
$has_error=$isbn_has_error;
$field_error=$isbn_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=13;
$field_input['name']='isbn';
$field_input['value']=$isbn;
$field_desc="The International Standard Book Number";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// URL
$field_name="Web info";
$is_required=FALSE;
$has_error=$url_has_error;
$field_error=$url_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='url';
$field_input['value']=$url;
$field_desc="Information about this article on the web";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Laboratory email address
$field_name="Laboratory email address";
$is_required=FALSE;
$has_error=$labadr_has_error;
$field_error=$labadr_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=320;
$field_input['name']='labadr';
$field_input['value']=$labadr;
$field_desc="Email address of observatory or laboratory";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

// Keywords
$field_name="Keywords";
$is_required=FALSE;
$has_error=$keywords_has_error;
$field_error=$keywords_error;
$input_type="text";
$field_input=array();
$field_input['maxlength']=255;
$field_input['name']='keywords';
$field_input['value']=$keywords;
$field_desc="Please separate each group of keywords with a comma";
html_write_form_line($field_name, $is_required, $has_error, $field_error, $input_type, $field_input, $field_desc);

?>