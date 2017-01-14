<?php

function showMonitorData($data){

    echo"<div style='font-size:12px;font-weight:bold;'>";
    echo "Data Search Results: ".sizeof($data);
    echo"</div><br/>";
	
	$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start time','Eruption End time','VEI','Monitoring Data Type','Monitoring Start Time','Monitoring End Time','Visualization');		

	echo"<div>";
	echo"<table border='1'>";

	echo"<tr>";
	for($i=0;$i< sizeof($tableheader);$i++){
		echo"<td align=\"center\">{$tableheader[$i]}</td>";
	}	
	echo"</tr>";	
	
	for($i=0;$i<sizeof($data); ){

		echo"<tr align=\"center\">";
				
		for($j=0;$j<sizeof($tableheader);$j++){
			echo"<td align=\"center\">";

			if($j == 9)
				echo"<a href='http://www.wovodat.org/eruption/index.php?{$data[$i][$j]}' target='_blank'>Link<a>";
				
				//echo"<a href='http://wovodat.org/eruption/eruption.php?{$data[$i][$j]}'>Link<a>";
				//echo"<a href='http://localhost/eruption/eruption.php?{$data[$i][$j]}'>Link<a>";
			else
				echo $data[$i][$j];
			
			echo"</td>";
		} 
		$i++;
		echo"</tr>";
	}				
	echo"	</table> ";
	echo"	</div>";
	echo"	</div>";	   		


}


function showNoResult(){
    echo"<div align='center'>";
    echo "Search Result: 0";
    echo"</div>";
}

function showcount($count){

    echo"<div align='center'>";
    echo $count;
    echo"</div>";

}
?>