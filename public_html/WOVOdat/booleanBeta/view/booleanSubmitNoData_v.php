<?php

function showNoMonitorData($noMonitorData){

    echo"<div><br/>";
    echo "<h2 class = 'container'>Data Search Results: ".sizeof($noMonitorData) . "</h2>";
    echo"</div><br/>";
	
	$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start time','Eruption End time','VEI','Visualization');

		echo"<div class='container'>";
		echo"<table class = 'centered highlight bordered' >";

		echo"<tr>";
		for($i=0;$i< sizeof($tableheader);$i++){

			echo"<th>{$tableheader[$i]}</th>";
		}
		echo"</tr>";
		echo"<tbody>";
		for($i=0;$i<sizeof($noMonitorData); ){

			echo"<tr>";

			for($j=0;$j<sizeof($tableheader);$j++){
				echo"<td >";

				if($j == 6)
				echo"<a href='/eruption/index.php?{$noMonitorData[$i][$j]}' 'target='_blank'>Link<a>";
				else
				echo $noMonitorData[$i][$j];
				echo"</td>";
			}
			$i++;
			echo"</tr>";
		}
		echo"<tbody>";
		echo"	</table> ";
		echo"	</div>";
		echo"	</div>";	

}

function showNoResult(){
	echo"<div><br/>";
	echo "<h2 class = 'container'>Data Search Results: 0 </h2>";
	echo"</div><br/>";
}

function showcount($count){

    echo"<div class ='container'>";
	echo"<div class ='row'></div>";
	echo"<div class ='row'></div>";
	echo"<div class ='row'></div>";
    echo $count;
    echo"</div>";

}
?>