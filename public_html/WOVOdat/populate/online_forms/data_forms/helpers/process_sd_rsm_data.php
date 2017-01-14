<?php
ini_set("memory_limit", "-1");
set_time_limit(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

date_default_timezone_set('UTC');
if (!isset($_SESSION)) {
    session_start();
}

include ("file_manipulation.php");
require_once('special_db_connect.php');

function print_to_file($File,$data){
	$myfile = fopen($File, "a") or die("Unable to open file!");
	fwrite($myfile,$data."\n");
	fclose($myfile);
}

function not_null_fields($fields){
$not_null = array();
for($i =0;$i<sizeof($fields);$i++){
    if(preg_match('/[0-9]/', $fields[$i]) OR preg_match('/[a-zA-Z]/', $fields[$i])){
        $not_null[]=$i;
    }
}
return $not_null;
}

function array_to_delimeted_string($data,$delimeter){
$length = sizeof($data);
$hh = "";
	for ($i = 0;$i<$length-1;$i++) {	
    $hh = $hh.trim($data[$i]).$delimeter;
    } 
$hh = $hh.trim($data[$i]);	
return $hh;
}

function get_your_obs_cc_id($cc_id){
	$sql = "SELECT u1.cc_id, u1.cc_code, u1.cc_obs
			FROM cc u1, cc u2
			WHERE u1.cc_obs = u2.cc_obs
			AND u2.cc_id = ".$cc_id."
			AND u1.cc_code REGEXP '[a-zA-Z]'";
	$result = mysql_query($sql);       
	if ($result){
		$My_row = array();
		while ($row = mysql_fetch_array($result)):
			$My_row[]=$row;	
		endwhile;
		return $My_row[0][0];
	}
	else {return NULL;}
}

function Insert($TABLE,$field,$code,$Col,$Val){
	$Column="";
	$Values="";	
	$Verify = $field." ='".$code."'";	
	$rs = mysql_query("SELECT $field FROM $TABLE WHERE $Verify");       
	if (mysql_num_rows($rs)>0) {
		 echo "Data where $field = $code is already in the database"."\n";
	}
	else {

		$not_null = not_null_fields($Val);
		$length=sizeof($not_null);
		for ($l=0;$l<$length-1;$l++){
			$Column=$Column.$Col[$not_null[$l]].",";
			$Values =$Values."'".$Val[$not_null[$l]]."'".",";
		}
		$Column=$Column.$Col[$not_null[$length-1]];
		$Values =$Values."'".$Val[$not_null[$length-1]]."'";
		
		$sql = "INSERT INTO ".$TABLE." (".$Column.") "."VALUES (".$Values.")";
		$query = mysql_query($sql);     
		if ($query){
			//echo "Data where $field = $code inserted to table"."\n";
		}	
		else {
			echo "Problem encountered: Data where $field = $code saved to $field.txt"."\n";
			print_to_file($field.".txt",$Values);
		}		

	}
	
}

function process_sd_sam_data($new_data,$Origi){
	
	$col_names = explode("\t",$new_data[0]);
	$data_size = sizeof($new_data);
	$len_col = sizeof($col_names);

	$first_row = explode("\t",$new_data[1]);
	$second_row = explode("\t",$new_data[2]);
	$last_row = array();
	$ir = 1;
	$last = "";
	while (trim($last)==""){
		$last_row = explode("\t",$new_data[$data_size-$ir]);
		$last = $last_row[0];
		$ir++;
	}
	for ($iq=0;$iq<$len_col;$iq++){	
		if(trim($col_names[$iq])=="sd_rsm_stime"){
			$sd_sam_stime = $first_row[$iq];
			$sd_sam_etime = $last_row[$iq];
			$sd_sam_int = strtotime($second_row[$iq]) - strtotime($sd_sam_stime);
		}	
	}
	
	$sd_sam_data  = array(
		$sd_sam_code = substr($_POST['vd_num'],0,6)."_".
					   substr($_POST['ss_code'],0,6)."_".
					   substr(str_replace("-","",$sd_sam_stime),0,8).
					   substr(str_replace("-","",$sd_sam_etime),0,8),
		$ss_id = $_POST['ss_id'],
		$sd_sam_stime,
		$sd_sam_etime,
		$sd_sam_int,
		$sd_sam_ori = $Origi,	
		$sd_sam_com = $_POST['sd_sam_com'],
		$cc_id = get_your_obs_cc_id($_SESSION['login']['cc_id']),
		$cc_id2 = $_POST['cc_id2'],
		$cc_id3 = $_POST['cc_id3'],
		$sd_sam_loaddate = date("Y-m-d H:i:s",time()),
		$sd_sam_pubdate = $_POST['sd_sam_pubdate'],
		$cc_id_load = $_SESSION['login']['cc_id'],
		$cb_ids = $_POST['cb_ids']
	);
			
	$_POST['sd_sam_code'] = $sd_sam_code;
			
	$Val = $sd_sam_data ;
	$Col = array(   
		"sd_sam_code", 
		"ss_id", 
		"sd_sam_stime",
		"sd_sam_etime",
		"sd_sam_int", 
		"sd_sam_ori", 
		"sd_sam_com", 
		"cc_id", 
		"cc_id2",
		"cc_id3",
		"sd_sam_loaddate",
		"sd_sam_pubdate",
		"cc_id_load",
		"cb_ids"
	);
	//print_r($Col);
	//print_r($sd_sam_data);

    Insert("sd_sam","sd_sam_code",$sd_sam_code,$Col,$Val);
	
}

function query_mysql($query){
$My_rows=array();
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
while ($row = mysql_fetch_array($result)):
	$My_rows[]=$row;	
endwhile;
return $My_rows;
}

//function process_sd_rsm_data($new_data){
function process_sd_rsm_data($new_data,$ofile){
	
	$col_names = explode("\t",$new_data[0]);
	$data_size = sizeof($new_data);
	$len_col = sizeof($col_names);

	$rows = query_mysql("SELECT sd_sam_id FROM sd_sam WHERE sd_sam_code = '".$_POST['sd_sam_code']."'");
	
	$col_index = Array();
	for($ik=0;$ik<$len_col;$ik++){
	$column = $col_names[$ik];
		switch ($column) {
			case "sd_rsm_stime":
				$col_index["sd_rsm_stime"] = $ik;
				break;
			case "sd_rsm_count":
				$col_index["sd_rsm_count"] = $ik;
				break;
			case "sd_rsm_calib":
				$col_index["sd_rsm_calib"] = $ik;
				break;
			default:
				break;
		}	
	}
	$Filea = './Data_to_upload/for_import/'.$ofile.'.txt';
	$myfilea = fopen($Filea, "w") or die("Unable to open file!");
	for($ij=1;$ij<$data_size;$ij++){
		
		$current_row = explode("\t",$new_data[$ij]);
		
		$sd_rsm_stime = "0001-01-01 00:00:01";
		$sd_rsm_count = "";
		$sd_rsm_calib = "";	
		
		$sd_rsm_stime = $current_row[$col_index["sd_rsm_stime"]]; 
		$sd_rsm_count = $current_row[$col_index["sd_rsm_count"]]; 
		$sd_rsm_calib = $current_row[$col_index["sd_rsm_calib"]]; 
		
		$Val = array(
		    $sd_sam_id = $rows[0][0], 
			$sd_rsm_stime, 
			$sd_rsm_count,
			$sd_rsm_calib,
			$sd_rsm_com  = $_POST['sd_sam_com'],
			$sd_rsm_loaddate = date("Y-m-d H:i:s",time()),
			$cc_id_load = $_SESSION['login']['cc_id']
		);
		$Col = array(   
			"sd_sam_id", 
			"sd_rsm_stime", 
			"sd_rsm_count",
			"sd_rsm_calib",
			"sd_rsm_com", 
			"sd_rsm_loaddate",
			"cc_id_load"
		);
		
		//Insert("sd_rsm","sd_rsm_id","sd_sam_id",$Col,$Val);
		$dataa = array_to_delimeted_string($Val,"\t");
		fwrite($myfilea,$dataa."\n");		
	}		
	fclose($myfilea);
	$sql = "LOAD DATA LOCAL INFILE '".$Filea."'
		    INTO TABLE sd_rsm
            FIELDS TERMINATED BY '\t'
            LINES TERMINATED BY '\n'
           ( sd_sam_id, sd_rsm_stime, sd_rsm_count, sd_rsm_calib, sd_rsm_com, sd_rsm_loaddate, cc_id_load)";
	$rs = mysql_query($sql);
	if (!$rs) {
		echo "Failed to load $ofile rsam data into database :". mysql_error();
	}
	else {
		echo "$ofile rsam data imported to sd_rsam\n";
	}
}

$Files = $_POST['Files'];
$len_files = sizeof($Files);
$Origi = $_POST['sd_sam_ori'];

for ($ih=0;$ih<$len_files;$ih++){
$new_data = read_to_array('./Data_to_upload/RSAM_synchronize/'.$Files[$ih]);	
echo "Processing $Files[$ih]\n";
process_sd_sam_data($new_data,$Origi[$ih]);
echo "sd_sam metadata created\n";
echo "Processing sd_rsm data\n";
process_sd_rsm_data($new_data,$Files[$ih]);
//process_sd_rsm_data($new_data);
echo "\n";

}

?>