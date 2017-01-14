<?php
include "php/include/db_connect.php";
if (!isset($_SESSION))
	session_start();

//$pagename=$_SERVER["REQUEST_URI"];
$ipaddress= $_SERVER['REMOTE_ADDR'];
$dateTime= date('Y-m-d h:i:s');
$ccId=$_SESSION['login']['cc_id']; 


function ip_details($ip) {
    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details;
}

$details = ip_details($ipaddress);

global $link;
$sql="insert into cou (cc_id,cou_ip,cou_time,cou_country,cou_city) values ('$ccId','$ipaddress','$dateTime','$details->country','$details->city')";

$result=mysql_query($sql,$link);	

	
?>