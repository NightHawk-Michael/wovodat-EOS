<?php

function showMonitorData($data){

$_SESSION['bolParameter'] = $data;


$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start
time','Eruption End time','VEI','Monitoring Data Type','Monitoring Start Time','Monitoring End
Time','Visualization','Preview/Download');

	echo"<div style='padding-top:30px;'>"; 

		echo"<div>"; 
			
			echo"<table class='table-style-two'>";

				echo"<tr>";
					echo"<td colspan=17 align='center'>";
						echo "Data Search Results: ". sizeof($data); 
					echo"</td>";
				echo"<tr/>";


				echo"<tr align='center'>"; 
					for($i=0;$i< sizeof($tableheader);$i++){ 
						echo"<th align=\"center\">{$tableheader[$i]}</th>";
					}
				echo"</tr>";

				for($i=0;$i<sizeof($data); ){

					echo"<tr align=\"center\">";

						for($j=0;$j<sizeof($tableheader);$j++){ 

							echo"<td>";

								if($j == 9) 
								
									echo"<a href='http://{$_SERVER['SERVER_NAME']}/eruption/index.php#{$data[$i][$j]}' target='_blank'>Visualization (In development)<a>"; 
								
								else if($j == 10){
								
									if(isset($_SESSION['login']) || isset($_SESSION['downloadDataUsername'])){	

									echo"<a href='http://{$_SERVER['SERVER_NAME']}/boolean/booleanDownloadData.php?i=$i&data={$data[$i][11]}'>Preview/Download<a>"; 
								}
								else{									
									/*  Index.php will redirect again */
									echo"<a href='http://{$_SERVER['SERVER_NAME']}/boolean/downloadDataUserInfo.php?i=$i&data={$data[$i][11]}'>Preview/Download <a>";
								}	
								}else {
									echo $data[$i][$j];
								}	
							echo"</td>";
						} 
						$i++; 
					echo"</tr>";
				}
				echo"</table> "; 
			echo"</div>"; 
		echo"</div>";
}

function showNoResult(){ 
echo"<div align='center'>"; echo "Search Result: 0"; echo"</div>";
}

function showcount($count){

echo"<div align='center'>"; 
	echo $count; 
echo"</div>";

}
?>
