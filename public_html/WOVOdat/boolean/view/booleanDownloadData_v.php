<?php
function showMonitorDetailData($data,$trackPoint,$length,$dataType ){

echo <<<HTMLBLOCK

	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>

		$(document).ready(function(){
		
			$("a#downloadData").click(function() {
				
				$("#downloadDataTool").submit(); 
			});
			
		});

	</script>
HTMLBLOCK;
	
	$dataArray=serialize($data);   // pass huge data set as hidden post value 
	
	if(sizeof($data) < 5000){
		$limit = sizeof($data);
	}else{
		$limit = 5000;
	}				

	echo"<div style='padding-top:30px;'>"; 
	
		echo"<div>";  
		
		echo'<form name="downloadDataTool" id="downloadDataTool" method="post" action="booleanCsvAndSendMail.php" >';
		
			echo"<table class='table-style-two'>";
				echo"<tr>";
					echo"<td colspan=$length align='center'>";
						echo "Search Results: ".$limit." of ".sizeof($data); 
					echo"</td>";
				echo"<tr/>";

				
				echo"<tr>";	
					echo"<td colspan=$length align='right'>";

						echo"<a href='#' id='downloadData' style='padding:3px;border:1px dotted #A52A2A;color:#A52A2A;'> 
						
						Download ". sizeof($data) ." results to CSV </a>";
					echo"</td>";
					
				echo"<tr/>";
			

			for($i=0;$i<$limit; ){     // only Display Limit to 5000. But retrive all from db and can download all in csv.

				echo"<tr align=\"center\">";
					
					for($j=0;$j<$length;$j++){	
						if($i == 0 ){   //Add color for table header
							echo"<th>";							
								echo $data[$i][$j];
							echo"</th>";
						}else{
							echo"<td>";							
								echo $data[$i][$j];
							echo"</td>";
						}	
					}	
			 
				$i++; 
				echo"</tr>";
			}
			echo"	</table> "; 
			
			echo "<input type='hidden' name='i' value='$length'>";
			echo "<input type='hidden' name='dataType' value='$dataType'>";
			echo "<input type='hidden' name='dataArray' value='$dataArray'>";		

			echo"</form>";
			
		echo"	</div>"; 
	echo"	</div>"; 
}

?>
