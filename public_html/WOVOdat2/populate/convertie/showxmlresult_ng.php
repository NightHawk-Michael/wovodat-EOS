<?php
if (!isset($_SESSION))      // Nang added 21-Mar-2013
    session_start();
	
require_once "php/include/get_root.php";

if(!isset($_SESSION['login'])) {  // can't proceed without log in
	header('Location: '.$url_root.'login_required.php');
}


if(!isset($filename)){
	header('Location: '.$url_root.'home_populate.php');
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	
	<style type="text/css">
	label.error {font-size:12px; display:block; float: none; color: red;}
	</style>
	
	<script src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	

<!--<script language='javascript' type='text/javascript'>
	
jQuery(document).ready(function () {
    jQuery("#uploadimage").validate({
        rules: {
            imagefile: {
                required: true              
            }
        },
        messages: {
            imagefile: {
                required: "This field is required."
                
            }
        }
    });

    jQuery("input[type=file]").each(function() {
        jQuery(this).rules("add", {
            accept: "gif|png|jpe?g",
            messages: {
                accept: "Only gif,jpeg, jpg or png images"
            }
        });
    });
	
});

</script> 
-->

</head>

<body>

<div id="wrapborder">
	<div id="wrap">

		<?php include 'php/include/header_beta.php'; ?>

		<div id="content">	
			
				<div>
					<div id="contentlhead"></div>
					<div id="contentlform"> <br/>
						<p class="home3">
					
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
						
						</p>  <!-- end of home3-->
					</div>  <!-- end of contentlform-->
				</div>
		</div> <!-- end of content-->
	</div>  <!-- end of wrap-->
		
</div>  <!-- end of wrapborder-->

		<div style="height: 70px"></div>
		<div class="reservedSpace"></div>
		
        <div class="wrapborder_x">
            <?php include 'php/include/footer_main_beta.php'; ?>
        </div>
    </body>
</html>