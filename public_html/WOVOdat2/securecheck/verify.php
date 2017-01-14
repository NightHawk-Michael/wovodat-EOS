<?php
session_start();
include "securimage.php";

  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == false) {
	$secure ="false";
  } else {
	$secure = "true";
 }
 
print ("$secure");
?>