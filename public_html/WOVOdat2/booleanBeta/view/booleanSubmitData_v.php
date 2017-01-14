					<?php


					function showMonitorData($data){

					
						$_SESSION['bolParameter'] = $data;
						
					
				
						echo"<div style='padding-top:30px;'>"; 

						$tableheader=array('Volcano Name','Vol Feature','Vol Rock Types','Eruption Start
						time','Eruption End time','VEI','Monitoring Data Type','Monitoring Start Time','Monitoring End
						Time','Visualization','Preview/Download');

						echo"<div>"; 
						
						echo"<table class='table-style-two'>";

						echo"<tr>";
							echo"<td colspan=11 align='center'>";
								echo "Data Search Results: ". sizeof($data); 
							echo"</td>";
						echo"<tr/>";
						
						
						echo"<tr>"; 
							for($i=0;$i< sizeof($tableheader);$i++){ 
								echo"<th align=\"center\">{$tableheader[$i]}</th>";
							}
						echo"</tr>";

						for($i=0;$i<sizeof($data); ){

							echo"<tr align=\"center\">";

							for($j=0;$j<sizeof($tableheader);$j++){ 
							
								echo"<td align=\"center\">";
//index.php?vnum=273083
									if($j == 9) 


echo"<a target='_blank' href='http://{$_SERVER['SERVER_NAME']}/eruption/index.php#{$data[$i][9]}&dataType={$data[$i][6]}&dataMinTime={$data[$i][7]}&dataMaxTime={$data[$i][8]}&ed_stime={$data[$i][3]}&ed_etime={$data[$i][4]}&vei={$data[$i][5]}'>Visualization<a>";   
						
									else if($j == 10){
									
if(isset($_SESSION['login']) || isset($_SESSION['downloadDataUsername'])){	

echo"<a href='http://{$_SERVER['SERVER_NAME']}/boolean/booleanDownloadData.php?i=$i&data={$data[$i][11]}'
>Preview/Download<a>"; 
	
}
else{									
/*  Index.php will redirect again */
echo"<a href='http://{$_SERVER['SERVER_NAME']}/boolean/downloadDataUserInfo.php?i=$i&data={$data[$i][11]}'>Preview/Download <a>";
	
}	
	
									}						
									else {
																				
										echo $data[$i][$j];
										
										
									}	
								echo"</td>";

							} 
						    $i++; 
						    echo"</tr>";
						}
						echo"	</table> "; echo"	</div>"; echo"	</div>";


}

					function showNoResult(){ 
						echo"<div align='center'>"; echo "Search Result: 0"; echo"</div>";
					}

					function showcount($count){

					    echo $count;

					}
					?>
