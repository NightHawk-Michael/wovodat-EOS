<?php

// Get fields
$code=$_SESSION['upload_form'][$datatype]['code'];
$volcano_code=$_SESSION['upload_form'][$datatype]['volcano_code'];
$time=$_SESSION['upload_form'][$datatype]['time'];
$time_unc=$_SESSION['upload_form'][$datatype]['time_unc'];
$start_time=$_SESSION['upload_form'][$datatype]['start_time'];
$start_time_unc=$_SESSION['upload_form'][$datatype]['start_time_unc'];
$end_time=$_SESSION['upload_form'][$datatype]['end_time'];
$end_time_unc=$_SESSION['upload_form'][$datatype]['end_time_unc'];
$gas=$_SESSION['upload_form'][$datatype]['gas'];
$tec=$_SESSION['upload_form'][$datatype]['tec'];
$comments=$_SESSION['upload_form'][$datatype]['comments'];
$interpreter=$_SESSION['upload_form'][$datatype]['interpreter'];
$publish_date=$_SESSION['upload_form'][$datatype]['publish_date'];

// Get error booleans
$code_has_error=$_SESSION['upload_form'][$datatype]['code_has_error'];
$volcano_code_has_error=$_SESSION['upload_form'][$datatype]['volcano_code_has_error'];
$time_has_error=$_SESSION['upload_form'][$datatype]['time_has_error'];
$time_unc_has_error=$_SESSION['upload_form'][$datatype]['time_unc_has_error'];
$start_time_has_error=$_SESSION['upload_form'][$datatype]['start_time_has_error'];
$start_time_unc_has_error=$_SESSION['upload_form'][$datatype]['start_time_unc_has_error'];
$end_time_has_error=$_SESSION['upload_form'][$datatype]['end_time_has_error'];
$end_time_unc_has_error=$_SESSION['upload_form'][$datatype]['end_time_unc_has_error'];
$gas_has_error=$_SESSION['upload_form'][$datatype]['gas_has_error'];
$tec_has_error=$_SESSION['upload_form'][$datatype]['tec_has_error'];
$comments_has_error=$_SESSION['upload_form'][$datatype]['comments_has_error'];
$interpreter_has_error=$_SESSION['upload_form'][$datatype]['interpreter_has_error'];
$publish_date_has_error=$_SESSION['upload_form'][$datatype]['publish_date_has_error'];
$has_error=$_SESSION['upload_form'][$datatype]['has_error'];

// Get error messages
$code_error=$_SESSION['upload_form'][$datatype]['code_error'];
$volcano_code_error=$_SESSION['upload_form'][$datatype]['volcano_code_error'];
$time_error=$_SESSION['upload_form'][$datatype]['time_error'];
$time_unc_error=$_SESSION['upload_form'][$datatype]['time_unc_error'];
$start_time_error=$_SESSION['upload_form'][$datatype]['start_time_error'];
$start_time_unc_error=$_SESSION['upload_form'][$datatype]['start_time_unc_error'];
$end_time_error=$_SESSION['upload_form'][$datatype]['end_time_error'];
$end_time_unc_error=$_SESSION['upload_form'][$datatype]['end_time_unc_error'];
$gas_error=$_SESSION['upload_form'][$datatype]['gas_error'];
$tec_error=$_SESSION['upload_form'][$datatype]['tec_error'];
$comments_error=$_SESSION['upload_form'][$datatype]['comments_error'];
$interpreter_error=$_SESSION['upload_form'][$datatype]['interpreter_error'];
$publish_date_error=$_SESSION['upload_form'][$datatype]['publish_date_error'];

?>