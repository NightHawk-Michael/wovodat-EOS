<?php
if (!isset($_SESSION))      
    session_start();
	
require_once "php/include/get_root.php";

if(!isset($_SESSION['login'])) {  // can't proceed without log in
	header('Location: '.$url_root.'login_required.php');
}


if(!isset($filename)){
	header('Location: '.$url_root.'home_populate.php');
}

include 'php/include/header.php'; 
 

	echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > 
	<a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'>Submit Data</a> > Converting Data
	</div>";

?>

</div>  <!-- header-menu -->

	<style type="text/css">
		label.error {font-size:12px; display:block; float: none; color: red;}
	</style>
	
	<script src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>

	
<div class="body">
	<div class="widecontent">
			<!-- Page content -->
			
			<div>
			
				<?php

					if(isset($imagelink) && ($imageName != "")){  // Added on 28-feb-2012
						
						if(isset($option) == 'a/b'){
						
							$_SESSION['imageName']=$imageName;
							$_SESSION['imagelink']=$imagelink;
							$_SESSION['code']=$code; 
							
							include "../../plupload-2.0.0/plupload-2.0.0/scripts/custom.php"; 
							
							echo "<div id='downloadXml' style='display:none;'>";	 
						}
					}  
					else{
						echo "<div id='downloadXml' style='display:block;'>";	 
					}
					echo"<h1>Converting Data ...</h1><br/>";
					
					$time = date("Y-m-d H:i:s");
				
					echo "Time: $time<br/>";
					
					if(isset($observ))
						echo "Observatory Name:  $observ <br/>";

					//Changed line 98-122 bcoz of vol list  on 18-Mar-2013  		 		
					if(isset($conv))
						echo "Conversion data type: $conv <br/>";
				
				
					if(isset($vol)){  
						if($conv == 'SeismicNetwork' || $conv == 'DeformationNetwork' || $conv == 'GasNetwork' || $conv == 'HydrologicNetwork' || $conv == 'ThermalNetwork' || $conv == 'FieldsNetwork' || $conv == 'MeteorologicalNetwork' ){
							echo "Volcano Name: ";	
						
							if ($volLength > 1){     // if more than vol list  
								if($volLength > 4)   // flag to put "etc..." to eliminate showing plenty of vols list 
									$volLength = 4;
									
									for($i=0; $i < $volLength ; $i++){
										echo $vol[$i] .", ";
									}
									echo "etc...<br/>";							
							}else{ 
								echo $vol[0] ."<br/>";
							}	
						}else{     // For other types of data except Networks can have multiple volcanoes 
							echo "Volcano Name:  $vol <br/>";
						}			
					}

					//Changed line 98-122 coz of vol list on 18-Mar-2013  		
					if(isset($_POST['network']))
						echo "Network Name: {$_POST['network']} <br/>";        //Changed it on 21-Mar-2013
					
					if(isset($_POST['station']) || isset($_POST['stat'])){     //Changed it on 21-Mar-2013
						if(isset($_POST['station']))       //Coming from Monitoring System/Specific
							echo "Station Name: {$_POST['station']} <br/>";
						elseif(isset($_POST['stat']))	   //Coming from Monitoring Data
							echo "Station Name: {$_POST['stat']} <br/>"; 
					}
					
					if(isset($_POST['instrument']))
						echo "Instrument Name: {$_POST['instrument']} <br/>";
					
					if(!isset($fileerrors)){
							if(isset($filename2)){
								$f_csvrows_withoutheader = $count;
								
								$s_csvrows_withoutheader = $count2;
								
								echo "<br/><b>First CSV File Info:</b>";
								echo "<br/>Input File Name:  $filename <br/>";
								echo "Uploaded Total CSV rows: $f_csvrows_withoutheader rows <br/>";
								echo "Input File Size:$filesize bytes<br/>";

							echo "<br/><b>Second CSV File Info:</b>";				
							echo "<br/>Input File Name:  $filename2 <br/>";
							echo "Uploaded Total CSV rows: $s_csvrows_withoutheader rows <br/>";
							echo "Input File Size:$filesize2 bytes<br/>";		
						}else{
							$csvrows_withoutheader=$count;
							echo "<br/>Input File Name:  $filename <br/>";
							echo "Uploaded Total CSV rows: $csvrows_withoutheader rows <br/>";
							echo "Input File Size:$filesize bytes<br/>";
						}
						
						if(isset($outputfilename))
							echo "<br/>Convert File Name:  $outputfilename <br/>";
					
					
						if(isset($filename2)){
							echo "<br/><b>Successfully converted from $filename file and $filename2 file to $outputfilename file...</b>";
						}else{
							echo "<br/><b>Successfully converted from $filename file to $outputfilename file...</b>";
						}
							
						echo"<br/><br/><b>If you would like to see the result of $outputfilename, please click here to download it:</b><br/><br/>";
					
						echo"<div style='padding-left:13px;'>";

						//To distinguish whether a,b,c come from showxmlresult_ng.php coz added additional folder for option 'c'
						
						if(isset($option) == 'a/b'){
					
							echo"<form name='done' action='downloadxmlfile_ng.php' method='post' enctype='multipart/form-data'>";
						
						}else{
							echo"<form name='done' action='../downloadxmlfile_ng.php' method='post' enctype='multipart/form-data'>";
						}
						
						echo"<input name='fname' type='hidden' value='$outfile' />";
						echo"<input type='submit' value='Download XML file' />";
						echo"</form>";
						echo"</div>";
					 
					} 
					else{
						echo "<br/><b style='color:red;'>$fileerrors</b>";
					}	
				?>
				
			
			</div>
			
	</div>
</div>

		<div class="footer">
			<?php include 'php/include/footer.php'; ?>
		</div>
	
</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->