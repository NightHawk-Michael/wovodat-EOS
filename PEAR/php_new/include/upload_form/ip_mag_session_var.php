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
$deepsupp=$_SESSION['upload_form'][$datatype]['deepsupp'];
$asc=$_SESSION['upload_form'][$datatype]['asc'];
$convb=$_SESSION['upload_form'][$datatype]['convb'];
$conva=$_SESSION['upload_form'][$datatype]['conva'];
$mix=$_SESSION['upload_form'][$datatype]['mix'];
$dike=$_SESSION['upload_form'][$datatype]['dike'];
$pipe=$_SESSION['upload_form'][$datatype]['pipe'];
$sill=$_SESSION['upload_form'][$datatype]['sill'];
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
$deepsupp_has_error=$_SESSION['upload_form'][$datatype]['deepsupp_has_error'];
$asc_has_error=$_SESSION['upload_form'][$datatype]['asc_has_error'];
$convb_has_error=$_SESSION['upload_form'][$datatype]['convb_has_error'];
$conva_has_error=$_SESSION['upload_form'][$datatype]['conva_has_error'];
$mix_has_error=$_SESSION['upload_form'][$datatype]['mix_has_error'];
$dike_has_error=$_SESSION['upload_form'][$datatype]['dike_has_error'];
$pipe_has_error=$_SESSION['upload_form'][$datatype]['pipe_has_error'];
$sill_has_error=$_SESSION['upload_form'][$datatype]['sill_has_error'];
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
$deepsupp_error=$_SESSION['upload_form'][$datatype]['deepsupp_error'];
$asc_error=$_SESSION['upload_form'][$datatype]['asc_error'];
$convb_error=$_SESSION['upload_form'][$datatype]['convb_error'];
$conva_error=$_SESSION['upload_form'][$datatype]['conva_error'];
$mix_error=$_SESSION['upload_form'][$datatype]['mix_error'];
$dike_error=$_SESSION['upload_form'][$datatype]['dike_error'];
$pipe_error=$_SESSION['upload_form'][$datatype]['pipe_error'];
$sill_error=$_SESSION['upload_form'][$datatype]['sill_error'];
$comments_error=$_SESSION['upload_form'][$datatype]['comments_error'];
$interpreter_error=$_SESSION['upload_form'][$datatype]['interpreter_error'];
$publish_date_error=$_SESSION['upload_form'][$datatype]['publish_date_error'];

?>