<?php
set_time_limit(0);
error_reporting ( 0 );

$File_dir_to_clean = $_POST['File_dir_to_clean'];

function delete_unnecessary_files($dir_to_delete){
	$dir_to_delete = $dir_to_delete."/*";
	$files = glob($dir_to_delete); 
	foreach($files as $file){ 
		if(is_file($file)){
			unlink($file); 
			//echo $file."\n";
		}
	}	
}
delete_unnecessary_files($File_dir_to_clean);
?>