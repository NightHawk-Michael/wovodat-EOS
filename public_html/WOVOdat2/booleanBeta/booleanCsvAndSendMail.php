<?php
session_start();

include 'php/include/db_connect.php';
global $link;
	
$length=$_POST['i'];
$dataType=$_POST['dataType'];
$data=unserialize($_POST['dataArray']);
 
// Create destination file name: (wovodat)_(vol num)_(YYYYMMDDhhmmiss)(.csv)

// Get vol num & data owner email(for sending email) 
$sql = "select distinct vd_num, cc.cc_email from vd, cc where vd.cc_id=cc.cc_id and vd_name='{$data[1][0]}'";
$result = mysql_query($sql, $link);
$row=mysql_fetch_row($result);

// Get current date time
$current_time=date("YmdHis", (time()-date("Z")));

// Destination file name
$file_name= "wovodat_".$row[0]."_".$current_time.".csv";

// File is uploaded to server
$ul_file_name="downloadCsv/".$file_name;         // For server link

	$file = fopen($ul_file_name,"w");

		foreach ($data as $val){ 
			  fputcsv($file, array_slice($val,0,$length));	 
		}

	fclose($file);

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition:attachment; filename=".basename($ul_file_name));
header("Content-Type: text/csv");
header("Content-Transfer-Encoding: binary");
readfile($ul_file_name);
unlink($ul_file_name);


// Include PEAR Mail package
require_once "Mail-1.2.0/Mail.php";

// New mail object
$mail=Mail::factory("mail");

//$email = $row[1];   //Data owner email

$email = "CWidiwijayanti@ntu.edu.sg";   //Data owner email
$user_name = "Data owner"; 
$to=$user_name." <".$email.">";

$from="noreply@wovodat.org";
$cc = "CC:  CWidiwijayanti@ntu.edu.sg , nangthinzarwin1@gmail.com";
$subject="Summary of downloaded data list from WOVOdat <NOT SPAM>";
$headers=array("From"=>$from,"CC"=>$cc,"Subject"=>$subject);

$body="Hi, \n\n";

if(isset($_SESSION['downloadDataUsername'])){
	$body .= "The unregistered user called '". $_SESSION['downloadDataUsername'] ."' from this ".$_SESSION['downloadDataUserobs']." Inst/Obs downloaded '".$dataType."' data for '".$data[1][0]."' volcano today.\n\n";

}else if(isset($_SESSION['login']['cr_uname'])){

	$body .= "The registered user called '". $_SESSION['login']['cr_uname'] ."' downloaded  '".$dataType."' data for '".$data[1][0]."' volcano today.\n\n";
}

$body .= "Thanks,\n". "The WOVOdat team";

// Send email
$mail->send($to, $headers, $body);			
		

?>