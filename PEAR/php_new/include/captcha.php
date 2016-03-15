<?php

// JPGraph library
require_once 'php/lib/jpgraph/jpgraph_antispam.php';

// New instance of AntiSpam
$anti_spam=new AntiSpam();

// Generate new random string of 6 characters
$chars=$anti_spam->Rand(6);

// Output image
if ($anti_spam->Stroke()===FALSE) {
	echo "Error with captcha generation... Please reload page...";
	$_SESSION['register']['captcha']=NULL;
}
else {
	$_SESSION['register']['captcha']=$chars;
}

?>