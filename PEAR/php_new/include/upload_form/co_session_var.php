<?php

// Get fields
$code=$_SESSION['upload_form'][$datatype]['code'];
$volcano_code=$_SESSION['upload_form'][$datatype]['volcano_code'];
$description=$_SESSION['upload_form'][$datatype]['description'];
$start_time=$_SESSION['upload_form'][$datatype]['start_time'];
$start_time_unc=$_SESSION['upload_form'][$datatype]['start_time_unc'];
$end_time=$_SESSION['upload_form'][$datatype]['end_time'];
$end_time_unc=$_SESSION['upload_form'][$datatype]['end_time_unc'];
$observer=$_SESSION['upload_form'][$datatype]['observer'];
$publish_date=$_SESSION['upload_form'][$datatype]['publish_date'];

// Get error booleans
$code_has_error=$_SESSION['upload_form'][$datatype]['code_has_error'];
$volcano_code_has_error=$_SESSION['upload_form'][$datatype]['volcano_code_has_error'];
$description_has_error=$_SESSION['upload_form'][$datatype]['description_has_error'];
$start_time_has_error=$_SESSION['upload_form'][$datatype]['start_time_has_error'];
$start_time_unc_has_error=$_SESSION['upload_form'][$datatype]['start_time_unc_has_error'];
$end_time_has_error=$_SESSION['upload_form'][$datatype]['end_time_has_error'];
$end_time_unc_has_error=$_SESSION['upload_form'][$datatype]['end_time_unc_has_error'];
$observer_has_error=$_SESSION['upload_form'][$datatype]['observer_has_error'];
$publish_date_has_error=$_SESSION['upload_form'][$datatype]['publish_date_has_error'];
$has_error=$_SESSION['upload_form'][$datatype]['has_error'];

// Get error messages
$code_error=$_SESSION['upload_form'][$datatype]['code_error'];
$volcano_code_error=$_SESSION['upload_form'][$datatype]['volcano_code_error'];
$description_error=$_SESSION['upload_form'][$datatype]['description_error'];
$start_time_error=$_SESSION['upload_form'][$datatype]['start_time_error'];
$start_time_unc_error=$_SESSION['upload_form'][$datatype]['start_time_unc_error'];
$end_time_error=$_SESSION['upload_form'][$datatype]['end_time_error'];
$end_time_unc_error=$_SESSION['upload_form'][$datatype]['end_time_unc_error'];
$observer_error=$_SESSION['upload_form'][$datatype]['observer_error'];
$publish_date_error=$_SESSION['upload_form'][$datatype]['publish_date_error'];

?>