<?php
if (!isset($_SESSION))
    session_start();  // Start session
	
include "commoneruption_ng.php";
include "model/common_model_eruption_ng.php";
require_once "php/include/get_root.php";


if(!isset($_SESSION['login'])){       // can't proceed without log in
	header('Location: '.$url_root.'login_required.php');
}

if(!isset($_FILES['fname'])) {  // can't proceed when html form can't post anything if exceed 2MB (OR) directly come 
	$fileerrors = "File submission fails. Please take note the maxmium file upload size is 2MB.<br/> Please try again!";		
 	include "showxmlresult_ng.php";
	exit();
}

if(isset($_POST['observ']))
	$observ=$_POST['observ'];

//Changed line 21-40 coz of vol list on 18-Mar-2013 
if(isset($_POST['conv']))
	$conv=$_POST['conv'];

	
if(isset($_POST['vol2'])){

	$volLength=sizeof($_POST['vol2']);
	$vol=$_POST['vol2'];
	
	if($conv == 'ed' || $conv == 'ed_phs' || $conv == 'ed_for' || $conv == 'ed_vid'){
		$volcode=getvolcode($vol);        // Get cavw from DB 
	}
}	
	

if(isset($_POST['edStime']))
	$edId=$_POST['edStime'];

	
if(isset($_POST['edPhsStime']))
	$edPhsId =$_POST['edPhsStime'];

$edCode=getEruptionCode($edId);  // Get network code from cn / sn table

$phaseCode=getEruptionPhaseCode($edPhsId);  // Get station code from DB


		
$filename=$_FILES['fname']['name'];
$filesize=$_FILES['fname']['size'];


//prepare the directory of output file
$infile="../../../../incoming/to_be_translated/".$filename;       //prepare the name of inputfile
$outputfilepath="../../../../incoming/translated/";              //prepare the directory of output file


$outputfilename=substr($filename,0,-4).".xml"; 
$outfile=$outputfilepath.$outputfilename;

$fileextension=substr($filename,-3);
		
if($_FILES['fname']['type'] == "" && $filesize == "0") {  
	$fileerrors = " File submission fails. The Maxmium file upload size is 2MB.<br/>File size you tried to upload is too  big/empty. Please try again!";
	include "showxmlresult_ng.php";
	exit();
}else if($fileextension != 'csv'){  //Check csv file
	$fileerrors = "File submission fails.<br/> The extension of file you tried to upload is not csv format. Please try again!";
	include "showxmlresult_ng.php";
	exit();
  
}else if($filesize == 0){
	$fileerrors = "File submission fails. <br/> File you tried to upload is empty. Please try again!";
	include "showxmlresult_ng.php";
	exit();
}else if($filesize<= 2000000){    //Move "temp" to inputfile name	
	if (!move_uploaded_file($_FILES['fname']['tmp_name'],$infile)){
		$fileerrors = "File submission fails.  Please try again!";
		include "showxmlresult_ng.php";
		exit();
	}    		  
} 


//$findtable = array("Eruption" => "ed", "Eruption Phase" => "ed_phs", "Eruption forecast" => "ed_for", "Eruption video" => "ed_vid");	

//$datatype = $findtable[$conv];
$datatype = $conv;
$monitorcode=$datatype."_code";          // Prepare to get like cn_code
$monitorpubdate=$datatype."_pubdate";    // Prepare to get like cn_pubdate


$handle=fopen($infile,"r");            // Read CSV Header
$csvheader=fgetcsv($handle);

$newfileheader=getxmlheader($datatype);     //Read xml header
$xmlheader=array_keys($newfileheader);


$xmlheadersize=sizeof($xmlheader);
$csvheadersize=sizeof($csvheader);


if($csvheadersize < $xmlheadersize){    // Double check csv file again. 
	$fileerrors = "CSV error. Please Check your CSV again!";
	include "showxmlresult_ng.php";
	exit();
}


for($i=0;$i<$xmlheadersize;$i++){         //Compare csv and xml Header
	$x=$xmlheader[$i];
	for($j=0;$j<$csvheadersize;$j++){
		if($x == $csvheader[$j]){
			break;
		}
	}
	$order[$i]=$j;
}



// Try to get index
$codeindex = array_search($monitorcode,$csvheader);		  
$pubindex = array_search($monitorpubdate,$csvheader);
$owner2index = array_search('cc_id2',$csvheader);
$owner3index = array_search('cc_id3',$csvheader);
$cscodeindex = array_search('cs_id',$csvheader);


$xmlbody = "";
$count=0;

$ordersize=sizeof($order);

while(!feof($handle)){
	$orgline=fgetcsv($handle);
	
	if($orgline == ""){     // Try to remove empty last row from csv file if file has empty row at EOF
		break;
	}	
	
	$count++;             // Get total csv rows without csv header and minus empty last row if it is.
	
	for($i=0;$i<$ordersize;$i++){      // Get same order as xml 
		$sortedline[$i] =  $orgline[$order[$i]];
	}
	
	// get a code
	$code = $orgline[$codeindex];
	
	//Get Pubdate  
	if($pubindex){
		$pubdate = $orgline[$pubindex];	
		
		if($pubdate != '' && $pubdate != 'NULL'){
			$pubdate =" pubDate=\"$pubdate\"";			
		}else{
			$pubdate ="";
		}
	}else{
		$pubdate ="";
	}
	
	//Get owner2
	if($owner2index){
		$owner2 = $orgline[$owner2index];	
		
		if($owner2 != '' && $owner2 != 'NULL'){
			$owner2=" owner2=\"$owner2\"";
		}else{
			$owner2="";
		}
	}else{
		$owner2="";
	}	
	
	//Get owner3
	if($owner3index){
		$owner3 = $orgline[$owner3index];	
		
		if($owner3 != '' && $owner3 != 'NULL'){
			$owner3=" owner3=\"$owner3\"";
		}else{
			$owner3="";
		}
	}else{
		$owner3="";
	}	

	
	getxml_head_foot($conv,$outputxmlhead,$outputxmlfooter);


	if($conv == 'ed'){
		
		$r	= "\n\t<Eruption code=\"$code\" volcano=\"$volcode\" owner1=\"$observ\"$owner2$owner3$pubdate>\n";	
		
		$r	= convert_xml($r,$newfileheader,$sortedline,$xmlheader);  // convert to xml

		$r .= "\t</Eruption>";
	}
	else if($conv == 'ed_phs'){
		
		$r	= "\n\t<Phase code=\"$code\" eruption=\"$edCode\" owner1=\"$observ\"$owner2$owner3$pubdate>\n";	
		
		$r	=convert_xml($r,$newfileheader,$sortedline,$xmlheader);  // convert to xml

		$r .= "\t</Phase>";
				
		
	}else if($conv == 'ed_for'){

		$r	= "\n\t<Forecast code=\"$code\" volcano=\"$volcode\" phase=\"$phaseCode\"owner1=\"$observ\"$owner2$owner3$pubdate>\n";
	
		$r	= convert_xml($r,$newfileheader,$sortedline,$xmlheader);  // convert to xml
	
		$r .= "\t</Forecast>";

	}else if($conv == 'ed_vid'){

		$r	= "\n\t<Video code=\"$code\" volcano=\"$volcode\" eruption=\"$edCode\" phase=\"$phaseCode\"owner1=\"$observ\"$owner2$owner3$pubdate>\n";
	
		$r	= convert_xml($r,$newfileheader,$sortedline,$xmlheader);  // convert to xml
	
		$r .= "\t</Video>";

	}
	
	
	$xmlbody .=$r;	
		
}	
	fclose($handle);
	
	$fullxml=$outputxmlhead.$xmlbody.$outputxmlfooter;
	
	// Write XML to file
	$outhandle = fopen($outfile, 'w');
	fwrite($outhandle, $fullxml);
	fclose($outhandle);
	
	//To distinguish whether a,b,c on line '143' & '168' in showxmlresult_ng.php  coz added additional folder for option 'c'
	$option="a/b";                        
	
	include "showxmlresult_ng.php";      //Show every results here...        

?>