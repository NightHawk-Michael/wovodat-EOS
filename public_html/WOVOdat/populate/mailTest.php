<?php
$subject="Hi There!!";
$to="nangthinzarwin2@gmail.com";
$body="This is my demo email sent using PHP on XAMPP Lite version 1.7.3?";

if (mail($to,$subject,$body))
echo "Mail sent successfully!";
else
echo "Mail not sent!";
?>