<?php

function showNoMonitorData($noMonitorData){

    echo"<div style='font-size:12px;font-weight:bold;'>";
    echo "Data Search Results: ".sizeof($noMonitorData);
    echo"</div><br/>";
	
	$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start time','Eruption End time','VEI','Visualization');

		echo"<div>";
		echo"<table border='1'>";

		echo"<tr>";
			for($i=0;$i< sizeof($tableheader);$i++){

				echo"<td align=\"center\">{$tableheader[$i]}</td>";
				}	
				echo"</tr>";	

				for($i=0;$i<sizeof($noMonitorData); ){

					echo"<tr align=\"center\">";

					for($j=0;$j<sizeof($tableheader);$j++){
						echo"<td align=\"center\">";

						if($j == 6)
						echo"<a href='http://{$_SERVER{'SERVER_NAME'}}/eruption/index.php?{$noMonitorData[$i][$j]}'  target='_blank'>Link<a>";
						else
						echo $noMonitorData[$i][$j];
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

    echo"<div style='padding-top:50px;padding-left:270px;'>";
    echo $count;
    echo"</div>";

}
?>