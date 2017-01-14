<?php  
include ("file_manipulation.php");

$delimeter = $_POST['delimiter'];
$dir = $_POST['directory'];

$files = list_files_in_directory($dir);
$num_files = sizeof($files);
for ($j=0;$j<$num_files;$j++){
	$File_name = $dir.$files[$j];
	$data = read_to_array($File_name);
	$data_len = sizeof($data);
	echo "<tr><th colspan='8' style='text-align:center'>$files[$j]</th><tr/>";
	for ($i=0;$i<5;$i++){
		echo str_replace($delimeter,"</td><td>","<tr><td>".$data[$i]."</td></tr>");
	}	
}
?>