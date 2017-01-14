<?php  
include ("file_manipulation.php");

$delimeter = $_POST['delimiter'];

$dir = "./Data_to_upload/RSAM/";
$files = list_files_in_directory($dir);
$num_files = sizeof($files);
for ($j=0;$j<$num_files;$j++){
	echo "<tr>".
			"<td>".$files[$j]."</td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input type='text'/></td>".
			"<td><input value='D' type='checkbox'/>D<input value='O' type='checkbox'/>O</td>".
	    "</tr>";
}
?>