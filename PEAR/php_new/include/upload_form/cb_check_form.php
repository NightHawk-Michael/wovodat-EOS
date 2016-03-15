<?php

// Get posted fields
$authors=trim($_POST['authors']);
$pub_year=trim($_POST['pub_year']);
$title=trim($_POST['title']);
$journal=trim($_POST['journal']);
$volume=trim($_POST['volume']);
$publisher=trim($_POST['publisher']);
$page=trim($_POST['page']);
$doi=trim($_POST['doi']);
$isbn=trim($_POST['isbn']);
$url=trim($_POST['url']);
$labadr=trim($_POST['labadr']);
$keywords=trim($_POST['keywords']);

// Store fields
$_SESSION['upload_form'][$datatype]=array();
$_SESSION['upload_form'][$datatype]['authors']=$_POST['authors'];
$_SESSION['upload_form'][$datatype]['pub_year']=$_POST['pub_year'];
$_SESSION['upload_form'][$datatype]['title']=$_POST['title'];
$_SESSION['upload_form'][$datatype]['journal']=$_POST['journal'];
$_SESSION['upload_form'][$datatype]['volume']=$_POST['volume'];
$_SESSION['upload_form'][$datatype]['publisher']=$_POST['publisher'];
$_SESSION['upload_form'][$datatype]['page']=$_POST['page'];
$_SESSION['upload_form'][$datatype]['doi']=$_POST['doi'];
$_SESSION['upload_form'][$datatype]['isbn']=$_POST['isbn'];
$_SESSION['upload_form'][$datatype]['url']=$_POST['url'];
$_SESSION['upload_form'][$datatype]['labadr']=$_POST['labadr'];
$_SESSION['upload_form'][$datatype]['keywords']=$_POST['keywords'];

// Check errors
$authors_has_error=FALSE;
$pub_year_has_error=FALSE;
$title_has_error=FALSE;
$journal_has_error=FALSE;
$volume_has_error=FALSE;
$publisher_has_error=FALSE;
$page_has_error=FALSE;
$doi_has_error=FALSE;
$isbn_has_error=FALSE;
$url_has_error=FALSE;
$labadr_has_error=FALSE;
$keywords_has_error=FALSE;
$has_error=FALSE;
$authors_error="";
$pub_year_error="";
$title_error="";
$journal_error="";
$volume_error="";
$publisher_error="";
$page_error="";
$doi_error="";
$isbn_error="";
$url_error="";
$labadr_error="";
$keywords_error="";

// Database functions
require_once "php/funcs/db_funcs.php";
// Datetime functions
require_once "php/funcs/datetime_funcs.php";

// Check authors: nothing

// Check publication year: is number
if ($pub_year!="") {
	if (!ctype_digit($pub_year)) {
		$has_error=TRUE;
		$pub_year_has_error=TRUE;
		$pub_year_error="Possible range is from 0000 to 9999";
	}
}

// Check title: nothing

// Check journal: nothing

// Check volume: nothing

// Check publisher: nothing

// Check pages: nothing

// Check doi: nothing

// Check isbn: nothing

// Check url (web info): nothing

// Check laboratory email address: nothing

// Check keywords: nothing

// Get current time (= load date)
$load_date=date("Y-m-d H:i:s", (time()-date("Z")));

// Store errors
$_SESSION['upload_form'][$datatype]['authors_has_error']=$authors_has_error;
$_SESSION['upload_form'][$datatype]['pub_year_has_error']=$pub_year_has_error;
$_SESSION['upload_form'][$datatype]['title_has_error']=$title_has_error;
$_SESSION['upload_form'][$datatype]['journal_has_error']=$journal_has_error;
$_SESSION['upload_form'][$datatype]['volume_has_error']=$volume_has_error;
$_SESSION['upload_form'][$datatype]['publisher_has_error']=$publisher_has_error;
$_SESSION['upload_form'][$datatype]['page_has_error']=$page_has_error;
$_SESSION['upload_form'][$datatype]['doi_has_error']=$doi_has_error;
$_SESSION['upload_form'][$datatype]['isbn_has_error']=$isbn_has_error;
$_SESSION['upload_form'][$datatype]['url_has_error']=$url_has_error;
$_SESSION['upload_form'][$datatype]['labadr_has_error']=$labadr_has_error;
$_SESSION['upload_form'][$datatype]['keywords_has_error']=$keywords_has_error;
$_SESSION['upload_form'][$datatype]['has_error']=$has_error;
$_SESSION['upload_form'][$datatype]['authors_error']=$authors_error;
$_SESSION['upload_form'][$datatype]['pub_year_error']=$pub_year_error;
$_SESSION['upload_form'][$datatype]['title_error']=$title_error;
$_SESSION['upload_form'][$datatype]['journal_error']=$journal_error;
$_SESSION['upload_form'][$datatype]['volume_error']=$volume_error;
$_SESSION['upload_form'][$datatype]['publisher_error']=$publisher_error;
$_SESSION['upload_form'][$datatype]['page_error']=$page_error;
$_SESSION['upload_form'][$datatype]['doi_error']=$doi_error;
$_SESSION['upload_form'][$datatype]['isbn_error']=$isbn_error;
$_SESSION['upload_form'][$datatype]['url_error']=$url_error;
$_SESSION['upload_form'][$datatype]['labadr_error']=$labadr_error;
$_SESSION['upload_form'][$datatype]['keywords_error']=$keywords_error;

?>