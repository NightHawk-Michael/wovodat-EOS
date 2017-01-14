<?php
if(!isset($_SESSION))
	session_start();
	
require_once "php/include/get_root.php";

$uname="";
$ccd="";

if(isset($_SESSION['login'])) {
	$uname=$_SESSION['login']['cr_uname'];
	$ccd=$_SESSION['login']['cc_id'];
}
else{       // can't proceed without log in
	header('Location: '.$url_root.'login_required.php');
}

if(!isset($intensity_time)){
	header('Location:commonconvertdata_ng.php');
}

include "php/include/header.php";  

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>Submit Data</a> > Converting Intensity Data </div>";

?>

</div>  <!-- header-menu -->
	
	<script src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>
	
		$(document).ready(function(){

			$("#intensityform").validate({
			
				errorPlacement: function(error, element) { 
					error.appendTo(element.parent().parent().prev().children());
				}				
						
			});	
	
		});

	</script>

	<style type="text/css">
		label.error {font-size:10px; display:block; color: red;}
	</style>
	
<div class="body">
	<div class="widecontent">


		<?php 
			
			echo '<form id="intensityform" name="intensityform" method="post" action="intensity_csvxml_ng.php" >';		

						
			echo '<table border="2" width="100%">';
	
			echo "<tr>";
			echo"<td colspan='4' align='center'>Possible Intensity Events</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo"<td align=\"center\"></td>";
			echo"<td align=\"center\">Magnitude</td>";
			echo"<td align=\"center\">DateTime</td>";
			echo"<td align=\"center\">Select Events</td>";	
			echo "</tr>";			
			
			$intenstiysize = sizeof($intensity_time);   // Total array rows 
			
			for($i=0;$i<$intenstiysize;$i++){
			
				$rows=sizeof($intensity_time[$i])+1;    // To use in rowspan 
						
				$csvline=$i+1;                         

			
				if(empty($intensity_time[$i])){
					$flag="true";
					echo"<tr><td rowspan=\"$rows\" align='center'>CSV Line $csvline</td>";
					echo "<td colspan=\"3\" align=\"center\">No Record for this interval time!</td></tr>";
				}else{
				 
					echo"<tr><td rowspan=\"$rows\" align='center'>CSV Line $csvline</td>";
					
				
					for($j=0;$j<sizeof($intensity_time[$i]);$j++){
					
						echo"<tr>";
						echo"<td align=\"center\">{$intensity_time[$i][$j]['mag']}</td>";
						echo"<td align=\"center\">{$intensity_time[$i][$j]['time']}</td>";
						echo"<td align=\"center\">";
						echo"<input type=\"radio\" id=\"evn_code\" name=\"evn_code$i\" value=\"{$intensity_time[$i][$j]['code']}_type{$intensity_time[$i][$j]['type']}\" class=\"required\"/>";
						echo"</td>";	
						echo "</tr>";
					}
					echo "</tr>";
				}
			}
			echo"<input type=\"hidden\" name=\"filename\" value=\"$filename\">";
			echo"<input type=\"hidden\" name=\"observ\" value=\"$observ\">";
			echo"<input type=\"hidden\" name=\"vol\" value=\"$vol\">";
			echo"<input type=\"hidden\" name=\"filesize\" value=\"$filesize\">";
			echo"<input type=\"hidden\" name=\"intenstiysize\" value=\"$intenstiysize\">";
					
		
			if(isset($flag)){  // if there is no record, then need to submit the CSV form again
			
				echo "<tr><td colspan='4' align='center'>
				There is no possible event for the interval Time.<br/>
				<input type='button' value='Please Check & Submit CSV Again' onClick=\"window.location.href='http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php'\"></td></tr>";
			}
			else{
				echo "<tr><td  colspan='4' align='center'><input type=\"submit\" name=\"Submit\" value=\"Submit\"/></td></tr>";
			}  
			
			echo"</table>";
			echo "</form>";
			
		?>
			
	</div>
</div>

		<div class="footer">
			<?php include 'php/include/footer.php'; ?>
		</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->