<?php  

include ("file_manipulation.php");

function date_time($date_now){
if(strlen(trim($date_now))>0){
$date = new DateTime($date_now);
return $date->format('Y-m-d H:i:s');	
} else {
return "";
}
}

$file    = $_POST['File'];
$columns = $_POST['columns'];
$fields  = $_POST['fields'];
$delimeter = $_POST['delimeter'];

$dir1 = "./Data_to_upload/RSAM/";
$dir2 = "./Data_to_upload/RSAM_synchronize/";
mkdir($dir2);

$File_name1 = $dir1.$file;
$File_name2 = $dir2.$file;
$data = read_to_array($File_name1);

$File_to_write = $File_name2;
if(!file_exists($File_to_write)){
	$myfile = fopen($File_to_write, "w") or die("Unable to open file!");
	$fields_now = explode(",",$fields);
	$field_header = "";
	for($i=0;$i<sizeof($fields_now);$i++){
		$field_header = $field_header.$fields_now[$i]."\t";
	}
	fwrite($myfile,$field_header."\n");
	fclose($myfile);
}

$myfile = fopen($File_to_write, "a") or die("Unable to open file: Needs privileged to write files!");
$data_len = sizeof($data);
for ($i=0;$i<$data_len;$i++){
	$data_cols =  explode($delimeter,$data[$i]);
	$fields_now = explode(",",$fields);
	$cols = explode(",",$columns);
	$len_cols = sizeof($cols);
	$data_to_write = "";
	for($j=0;$j<$len_cols-1;$j++){
		$str = trim($fields_now[$j]);
		switch ($str) {
			case "sd_rsm_stime":
				try {
					$data_to_write = $data_to_write.date_time(str_ireplace("DES","DEC",$data_cols[$cols[$j]]))."\t";
				} catch(Exception $e){$j++;}
				break;
			case "sd_rsm_loaddate":
				try {
					$data_to_write = $data_to_write.date_time(str_ireplace("DES","DEC",$data_cols[$cols[$j]]))."\t";
				} catch(Exception $e){$j++;}
				break;
			default:
				$data_to_write = $data_to_write.$data_cols[$cols[$j]]."\t";
	   }		
	}
	$data_to_write = trim($data_to_write);
	if(strlen($data_to_write)>0){
		fwrite($myfile,$data_to_write."\n");
	}
}
fclose($myfile);

?>