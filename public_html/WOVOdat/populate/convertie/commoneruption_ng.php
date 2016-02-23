<?php

$servpath="C:/xampp/htdocs/home/wovodat/public_html/WOVOdat";

require_once($servpath."/populate/convertie/f2genfunc/func_xmlparse.php"); 	// class xml parser 
require_once($servpath."/populate/convertie/f2genfunc/funcgen_printarray.php"); 



function getxmlheader($datatype){	

	$filetag="wovodat2wovoml11.xml";
	$datafile=file_get_contents($filetag);
	$params=xml2ary_1($datafile); 
	$tag=$params;

	$table_ini=$datatype;

	$newfileheader=array();

	foreach($tag as $k => $v){
		if(is_array($v)){
			foreach($v as $k1 => $v1){
				if(is_array($v1)){
					if($k1==$table_ini){
						foreach($v1 as $k2 => $v2){
							$newfileheader[$k2]=$v2;
						}	
					}	
				}	
			}	
		}	
	}

return $newfileheader;
}


function getxml_head_foot($conv,&$header,&$footer){

if($conv == 'ed' || $conv == 'ed_phs' || $conv == 'ed_for' || $conv == 'ed_vid'){

$header = <<<HTMLBLOCK
<?xml version="1.0" encoding="UTF-8" ?> 
<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">
<Eruptions>
HTMLBLOCK;

$footer ="\n</Eruptions>";
$footer .="\n</wovoml>";
}

}


function convert_xml($r,$newfileheader,$sortedline,$xmlheader){
	for ($i = 0; $i < sizeof($newfileheader); $i++){ 
		if($sortedline[$i] != '' && $sortedline[$i] != 'NULL'){
			$r .= "\t\t<{$newfileheader[$xmlheader[$i]]}>";
			$r .= $sortedline[$i];
			$r .= "</{$newfileheader[$xmlheader[$i]]}>\n";
		}
	}
	return $r;	
}
?>