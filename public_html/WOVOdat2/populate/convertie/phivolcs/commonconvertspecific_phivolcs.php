<?php
session_start();
include "../model/common_model_specific_ng.php";
require_once "php/include/get_root.php";


if(!isset($_SESSION['login'])){       // can't proceed without log in
	header('Location: '.$url_root.'login_required.php');
}


if(!isset($_FILES['fname'])) {  // can't proceed when html form can't post anything if exceed 2MB (OR) directly come 
	$fileerrors = "File submission fails. Please take note the maxmium file upload size is 2MB.<br/> Please try again!";		
	include "/../showxmlresult_ng.php";
	exit();
}

if(isset($_POST['observ']))
	$observ=$_POST['observ'];

if(isset($_POST['owner2']) && ($_POST['owner2'] != "")){
	$owner2= " owner2=\"{$_POST['owner2']}\"";	
}else{
	$owner2= "";
}

if(isset($_POST['owner3']) && ($_POST['owner3'] != "")){
	$owner3= " owner3=\"{$_POST['owner3']}\"";	
}else{
	$owner3= "";
}


if(isset($_POST['vol2']))
	$volcode=getvolcode($_POST['vol2']);        // Get cavw from DB 

if(isset($_POST['conv']))
	$conv=$_POST['conv'];

if(isset($_POST['network']))
	$network =$_POST['network'];

	
if(isset($_POST['station'])){

//Use so many funs here because try to synchronize with SA scripts.

	$pos=strpos($_POST['station'], "_sflag_");  				 //Find the position
	$station=substr($_POST['station'],$pos+7);  				 //Get station name
	$stationcode=substr($_POST['station'],0,$pos);		         // Get station code 
	$stationid=getstationid($_POST['station'],$conv);     	     // Get station id from DB
}


if(isset($_POST['instrument']))
	$instrument = $_POST['instrument'];
	
if(isset($_POST['dd_tlt_processtype']))
	$dd_tlt_processtype = $_POST['dd_tlt_processtype'];	
		
		
		
$filename=$_FILES['fname']['name'];
$filesize=$_FILES['fname']['size'];

$infile="C:/xampp/htdocs/home/wovodat/incoming/to_be_translated/".$filename;//prepare the name of inputfile

$outputfilepath="C:/xampp/htdocs/home/wovodat/incoming/translated/";     //prepare the directory of output file
$outputfilename=substr($filename,0,-4).".xml"; 
$outfile=$outputfilepath.$outputfilename;

$fileextension=substr($filename,-3);
		
if($_FILES['fname']['type'] == "" && $filesize == "0") {  
	$fileerrors = " File submission fails. The Maxmium file upload size is 2MB.<br/>File size you tried to upload is too  big/empty. Please try again!";
	include "/../showxmlresult_ng.php";
	exit();
}else if($fileextension != 'csv'){  //Check csv file
	$fileerrors = "File submission fails.<br/> The extension of file you tried to upload is not csv format. Please try again!";
	include "/../showxmlresult_ng.php";
	exit();
  
}else if($filesize == 0){
	$fileerrors = "File submission fails. <br/> File you tried to upload is empty. Please try again!";
	include "/../showxmlresult_ng.php";
	exit();
}else if($filesize<= 2000000){    //Move "temp" to inputfile name	
	if (!move_uploaded_file($_FILES['fname']['tmp_name'],$infile)){
		$fileerrors = "File submission fails.  Please try again!";
		include "/../showxmlresult_ng.php";
		exit();
	}    		  
}


 $seismic_interval = array( 
 array("TQ", 2 , 3),
 array("HFVQ(LT)", 4 , 5),
 array("HFVQ(S)", 6 , 7),
 array("LFVQ(SX)", 8 ,9),
 array("LFVQ(X)", 10 ,11),
 array("SDH(HF)",12 , 13),
 array("SDH(LF)", 14 , 15),
 array("H", 16 , 17),
 array("E", 18, 19),
 array("tele", 20, 21));




$handle=fopen($infile,"r");            // Read CSV Header
$csvheader=fgetcsv($handle);

$csvheadersize=sizeof($csvheader);

$xmlbody = "";
$count=0;

while(!feof($handle)){
	$orgline=fgetcsv($handle);
	
	if($orgline == ""){     // Try to remove empty last row from csv file if file has empty row at EOF
		break;
	}	
	
	$count++;             // Get total csv rows without csv header and minus empty last row if it is.
	

	if($conv == "IntervalSwarmData"){	

		for($i=0;$i<sizeof($seismic_interval);$i++){
			
			
			$orgdate=substr($orgline[0],0,10);   //YYYY-MM-DD
			
			$year=substr($orgdate,0,4); 
			$month=substr($orgdate,5,2); 
			$date=substr($orgdate,8,2);
			$nodash_date=$year.$month.$date;   //YYYYMMDD
			
			$starttime=$orgdate." 00:00:01";
			$endtime=$orgdate." 23:59:59";
			
			$code = $volcode."-".$stationid['sid']."-".$seismic_interval[$i][0]."-".$nodash_date;
		
			$numbOfRecEq=$seismic_interval[$i][1];
		
		//	if(($orgline[$numbOfRecEq] != 0) && ($orgline[$numbOfRecEq] != " ")){
			if($orgline[$numbOfRecEq] != ""){		
				$r = "\n\t<Interval code=\"$code\" station=\"$stationcode\" owner1=\"$observ\"$owner2$owner3>";
				
				
				$earthquakeType=$seismic_interval[$i][0];
				$r.="\n\t\t<earthquakeType>$earthquakeType</earthquakeType>";
				
				
				$r.="\n\t\t<numbOfRecEq>$orgline[$numbOfRecEq]</numbOfRecEq>";
				
				
				if($seismic_interval[$i][2] != "NULL" ){     // check my array room
					$amplitude=$seismic_interval[$i][2];
					
					if($orgline[$amplitude] != "NULL" && $orgline[$amplitude] != "")  // check amplitude from csv file
						$r.="\n\t\t<amplitude>$orgline[$amplitude]</amplitude>";
						
				}
				
				$r.="\n\t\t<startTime>$starttime</startTime>";
				$r.="\n\t\t<endTime>$endtime</endTime>";
				
				if($orgline[22] != "")
					$r.="\n\t\t<comments>$orgline[22]</comments>";
				
				
				$r .="\n\t</Interval>";
				$xmlbody.= $r;
			}	
		}
	}
	else if($conv == "ElectronicTiltData"){
	
		$orgdate=$orgline[0];   //YYYY-MM-DD HH:MM:SS     
		
		$year=substr($orgdate,0,4); 
		$month=substr($orgdate,5,2); 
		$date=substr($orgdate,8,2);
		$hour=substr($orgdate,11,2);
		$min=substr($orgdate,14,2);
		$sec=substr($orgdate,17,2);
		$nodash_date=$year.$month.$date.$hour.$min.$sec;   //YYYYMMDDHHMMSS	
	
		$code = $volcode."-".$stationid['sid']."-".$nodash_date."-".$dd_tlt_processtype;
	
		$r = "\n\t<ElectronicTilt code=\"$code\" station=\"$stationcode\" instrument=\"$instrument\" owner1=\"$observ\"$owner2$owner3>";
		
		if(($orgline[0] != "NULL") && ($orgline[0] != ""))
			$r.="\n\t\t<measTime>$orgline[0]</measTime>";
			
		if(($orgline[1] != "NULL") && ($orgline[1] != ""))
			$r .="\n\t\t<tilt1>$orgline[1]</tilt1>";
			
		if(($orgline[2] != "NULL") && ($orgline[2] != ""))
			$r .="\n\t\t<tilt2>$orgline[2]</tilt2>";
		
		$r .="\n\t\t<processed>$dd_tlt_processtype</processed>";  // get it from web page drop down		
		
		if(($orgline[3] != "NULL") && ($orgline[3] != ""))
			$r .="\n\t\t<temperature>$orgline[3]</temperature>";
		
		if(($orgline[4] != "NULL") && ($orgline[4] != ""))
			$r .="\n\t\t<battery>$orgline[4]</battery>";
			
		$r .="\n\t</ElectronicTilt>";
		$xmlbody.= $r;
	
	}
		
}	
	fclose($handle);
	
	
	$outputxmlhead = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>"; 
	$outputxmlhead .= "\n<wovoml xmlns=\"http://www.wovodat.org\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" version=\"1.1.0\" xsi:schemaLocation=\"http://www.wovodat.org/WOVOdatV1.xsd\">";
	$outputxmlhead .= "\n<Data>";	
	
	if($conv == "IntervalSwarmData"){		

		$outputxmlhead .= "\n<Seismic>";
		$outputxmlhead .= "\n<IntervalDataset>";

		$outputxmlfooter ="\n</IntervalDataset>";
		$outputxmlfooter .="\n</Seismic>";
		
	}
	else if($conv == "ElectronicTiltData"){

		$outputxmlhead .= "\n<Deformation>";
		$outputxmlhead .= "\n<ElectronicTiltDataset>";

		$outputxmlfooter ="\n</ElectronicTiltDataset>";
		$outputxmlfooter .="\n</Deformation>";
		
	}

	$outputxmlfooter .="\n</Data>";
	$outputxmlfooter .="\n</wovoml>";
	
	
	
	$fullxml=$outputxmlhead.$xmlbody.$outputxmlfooter;
	
	// Write XML to file
	$outhandle = fopen($outfile, 'w');
	fwrite($outhandle, $fullxml);
	fclose($outhandle);

	include "/../showxmlresult_ng.php";      //Show every results here...        

?>