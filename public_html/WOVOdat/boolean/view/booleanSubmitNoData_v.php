<?php

function showNoMonitorData($noMonitorData){

	echo"<h3>";
    echo "Data Search Results: ".sizeof($noMonitorData);
    echo"</h3><br/>";
	
	$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start time','Eruption End time','VEI','Visualization');

		echo"<div>";
		echo"<table border='1'>";

		echo"<tr align='center'>";
			for($i=0;$i< sizeof($tableheader);$i++){

				echo"<td>{$tableheader[$i]}</td>";
				}	
				echo"</tr>";	

				for($i=0;$i<sizeof($noMonitorData); ){

					echo"<tr align='center'>";

					for($j=0;$j<sizeof($tableheader);$j++){
						echo"<td>";

						if($j == 6)
						echo"<a href='http://{$_SERVER{'SERVER_NAME'}}/eruption/index.php?{$noMonitorData[$i][$j]}' 'target='_blank'>Link</a>";
						else
							echo $noMonitorData[$i][$j];
						echo"</td>";
					}
					$i++;
					echo"</tr>";
				}				
		echo"	</table> ";
		echo"	</div>";
		//echo"	</div>";	

}

function showNoResult(){
    echo"<div align='center'>";
    echo "Search Result: 0";
    echo"</div>";
}

function showcount($count){

    echo"<div id='pager'>";
    echo $count;
    echo"</div>";

}
?>