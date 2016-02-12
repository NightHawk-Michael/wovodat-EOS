<?php

// Get fields
$code=$_SESSION['upload_form'][$datatype]['code'];
$volcano_code=$_SESSION['upload_form'][$datatype]['volcano_code'];
$evn_code=$_SESSION['upload_form'][$datatype]['evn_code'];
$evs_code=$_SESSION['upload_form'][$datatype]['evs_code'];
$time=$_SESSION['upload_form'][$datatype]['time'];
$time_unc=$_SESSION['upload_form'][$datatype]['time_unc'];
$city=$_SESSION['upload_form'][$datatype]['city'];
$maxdist=$_SESSION['upload_form'][$datatype]['maxdist'];
$maxrint=$_SESSION['upload_form'][$datatype]['maxrint'];
$maxrint_dist=$_SESSION['upload_form'][$datatype]['maxrint_dist'];
$collector=$_SESSION['upload_form'][$datatype]['collector'];
$publish_date=$_SESSION['upload_form'][$datatype]['publish_date'];

// Get error booleans
$code_has_error=$_SESSION['upload_form'][$datatype]['code_has_error'];
$volcano_code_has_error=$_SESSION['upload_form'][$datatype]['volcano_code_has_error'];
$evn_code_has_error=$_SESSION['upload_form'][$datatype]['evn_code_has_error'];
$evs_code_has_error=$_SESSION['upload_form'][$datatype]['evs_code_has_error'];
$time_has_error=$_SESSION['upload_form'][$datatype]['time_has_error'];
$time_unc_has_error=$_SESSION['upload_form'][$datatype]['time_unc_has_error'];
$city_has_error=$_SESSION['upload_form'][$datatype]['city_has_error'];
$maxdist_has_error=$_SESSION['upload_form'][$datatype]['maxdist_has_error'];
$maxrint_has_error=$_SESSION['upload_form'][$datatype]['maxrint_has_error'];
$maxrint_dist_has_error=$_SESSION['upload_form'][$datatype]['maxrint_dist_has_error'];
$collector_has_error=$_SESSION['upload_form'][$datatype]['collector_has_error'];
$publish_date_has_error=$_SESSION['upload_form'][$datatype]['publish_date_has_error'];
$has_error=$_SESSION['upload_form'][$datatype]['has_error'];

// Get error messages
$code_error=$_SESSION['upload_form'][$datatype]['code_error'];
$volcano_code_error=$_SESSION['upload_form'][$datatype]['volcano_code_error'];
$evn_code_error=$_SESSION['upload_form'][$datatype]['evn_code_error'];
$evs_code_error=$_SESSION['upload_form'][$datatype]['evs_code_error'];
$time_error=$_SESSION['upload_form'][$datatype]['time_error'];
$time_unc_error=$_SESSION['upload_form'][$datatype]['time_unc_error'];
$city_error=$_SESSION['upload_form'][$datatype]['city_error'];
$maxdist_error=$_SESSION['upload_form'][$datatype]['maxdist_error'];
$maxrint_error=$_SESSION['upload_form'][$datatype]['maxrint_error'];
$maxrint_dist_error=$_SESSION['upload_form'][$datatype]['maxrint_dist_error'];
$collector_error=$_SESSION['upload_form'][$datatype]['collector_error'];
$publish_date_error=$_SESSION['upload_form'][$datatype]['publish_date_error'];

?>