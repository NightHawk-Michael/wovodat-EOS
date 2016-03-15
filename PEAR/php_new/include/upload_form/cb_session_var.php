<?php

// Get fields
$authors=$_SESSION['upload_form'][$datatype]['authors'];
$pub_year=$_SESSION['upload_form'][$datatype]['pub_year'];
$title=$_SESSION['upload_form'][$datatype]['title'];
$journal=$_SESSION['upload_form'][$datatype]['journal'];
$volume=$_SESSION['upload_form'][$datatype]['volume'];
$publisher=$_SESSION['upload_form'][$datatype]['publisher'];
$page=$_SESSION['upload_form'][$datatype]['page'];
$doi=$_SESSION['upload_form'][$datatype]['doi'];
$isbn=$_SESSION['upload_form'][$datatype]['isbn'];
$url=$_SESSION['upload_form'][$datatype]['url'];
$labadr=$_SESSION['upload_form'][$datatype]['labadr'];
$keywords=$_SESSION['upload_form'][$datatype]['keywords'];

// Get error booleans
$authors_has_error=$_SESSION['upload_form'][$datatype]['authors_has_error'];
$pub_year_has_error=$_SESSION['upload_form'][$datatype]['pub_year_has_error'];
$title_has_error=$_SESSION['upload_form'][$datatype]['title_has_error'];
$journal_has_error=$_SESSION['upload_form'][$datatype]['journal_has_error'];
$volume_has_error=$_SESSION['upload_form'][$datatype]['volume_has_error'];
$publisher_has_error=$_SESSION['upload_form'][$datatype]['publisher_has_error'];
$page_has_error=$_SESSION['upload_form'][$datatype]['page_has_error'];
$doi_has_error=$_SESSION['upload_form'][$datatype]['doi_has_error'];
$isbn_has_error=$_SESSION['upload_form'][$datatype]['isbn_has_error'];
$url_has_error=$_SESSION['upload_form'][$datatype]['url_has_error'];
$labadr_has_error=$_SESSION['upload_form'][$datatype]['labadr_has_error'];
$keywords_has_error=$_SESSION['upload_form'][$datatype]['keywords_has_error'];

// Get error messages
$authors_error=$_SESSION['upload_form'][$datatype]['authors_error'];
$pub_year_error=$_SESSION['upload_form'][$datatype]['pub_year_error'];
$title_error=$_SESSION['upload_form'][$datatype]['title_error'];
$journal_error=$_SESSION['upload_form'][$datatype]['journal_error'];
$volume_error=$_SESSION['upload_form'][$datatype]['volume_error'];
$publisher_error=$_SESSION['upload_form'][$datatype]['publisher_error'];
$page_error=$_SESSION['upload_form'][$datatype]['page_error'];
$doi_error=$_SESSION['upload_form'][$datatype]['doi_error'];
$isbn_error=$_SESSION['upload_form'][$datatype]['isbn_error'];
$url_error=$_SESSION['upload_form'][$datatype]['url_error'];
$labadr_error=$_SESSION['upload_form'][$datatype]['labadr_error'];
$keywords_error=$_SESSION['upload_form'][$datatype]['keywords_error'];

?>