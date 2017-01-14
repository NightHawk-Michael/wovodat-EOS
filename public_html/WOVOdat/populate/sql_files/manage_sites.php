<?php

$HOST = "127.0.0.1:3307";
$USER = "wovodat";
$PASS = "+62Nusantara";
$DBase = "wovodat";

session_start();
set_time_limit(0);

function distance($Lat1,$Lon1,$Lat2,$Lon2){
	$E=deg2rad($Lat1);
	$G=deg2rad($Lat2);
	$F=deg2rad($Lon1);
	$H=deg2rad($Lon2);
	return 6371*acos(sin($E)*sin($G)+cos($E)*cos($G)*cos($H-$F));
}

function read_to_array($File_name){
	$data=array();
	if(!file_exists($File_name)){
		$myfile = fopen($File_name, "w") or die("Unable to open file!");
		fclose($myfile);
	}
	$myfile = fopen($File_name, "r") or die("Unable to open file!");
	if ($myfile) {
		$i=0;
		while (!feof($myfile)) {
		   $buffer = fgets($myfile);
			$data[$i]=$buffer;
			$i++;
		}    
	}
	fclose($myfile);
	return $data;
}

function query_mysql($query){
	global $HOST, $USER, $PASS, $DBase;
	$My_rows=array();
	@mysql_connect($HOST , $USER, $PASS) or die("Could not connect to MySQL server!");
	@mysql_select_db($DBase) or die("Could not select database!");
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)):
		$My_rows[]=$row;	
	endwhile;
	mysql_close();
	return $My_rows;
}

$sites_info = read_to_array("sites_nevada.txt");
$len = sizeof($sites_info);

$data = array();
for($i=0;$i<$len;$i++){
	$data[] = explode("\t",$sites_info[$i]);
}

$vd_inf = query_mysql("SELECT DISTINCT vd_name, vd_inf_slat, vd_inf_slon FROM vd, vd_inf WHERE vd_inf.vd_id = vd.vd_id");


$myfile = fopen("data_distance_nevada.dat", "w") or die("Unable to open file!");
$echod = 0;
for($i=0;$i<sizeof($vd_inf);$i++){	
	for($j=0;$j<$len;$j++){		
		$dist = distance($vd_inf[$i][1],$vd_inf[$i][2],$data[$j][1],$data[$j][2]);
		if($dist<=100){
			if($echod==0){
				fwrite($myfile,$vd_inf[$i][0]."\t".$vd_inf[$i][1]."\t".$vd_inf[$i][2]."\n");
				$echod = 1;
			}
			fwrite($myfile,$data[$j][0]."\t".$data[$j][1]."\t".$data[$j][2]."\t".trim($data[$j][3])."\t".$dist."\n");
		}
	}
	$echod = 0;
}
fclose($myfile);



?>