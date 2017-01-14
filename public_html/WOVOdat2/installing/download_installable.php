<?php
session_start();
include "download_db.php"; 

if(!isset($_SESSION['login'])){
	header('Location:index.php?nopost=1');
}

$cc_id=$_SESSION['login']['cc_id'];
        
$observlist = obslist();            // For observatory drop down list added on 10oct2012
$observname = obsname($cc_id);     // Added to distingish wovodat_Tool.tar using obs_code on 10oct2012

//Add more arrays here if there are more new obs 
$observatorylist= array("Philippine Institute of Volcanology and Seismology" => "phivolcs", "PHIVOLCS" => "phivolcs");    

if(isset($observatorylist[$observname])){
	$observname = $observatorylist[$observname];
}else{
	$observname = "";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>
	
		$(document).ready(function(){

			$("#downloadtool").validate();
		
			$("a.check").click(function() {
			
				$("#downloadtool").submit(); 
			});
			
		});

	</script>


<style type="text/css">
label.error {font-size:12px; display:block; float: none; color: red;}
</style>	
	
</head>
<body>
	<div id="wrapborder">
		<div id="wrap">	
			<?php include 'php/include/header_beta.php'; ?>
			<!-- Content -->
			<div id="content">	
				
				<!-- Left content -->
				<div id="contentl"><br>
					<p style="padding:0px 0px 0px 35px;font-size:14px;font-weight:bold;">Installing WOVOdat Structure on own system</p>
				
					<p style="padding:10px 50px 0px 2px;font-size:13px;text-align:justify;">
						WOVOdat scripts are also available for countries those willing to start developing their own database for managing volcano monitoring data. This also to familiarize users/observatories with the WOVOdat data formats.
					</p>
					<p style="padding:5px 50px 0px 2px; font-size:13px;text-align:justify;">
						We provide a ready installable MySQL database template (WOVOdat database), which follow schematic structure and format of WOVOdat, designated for each individual volcano observatory.	
					</p>	
					<p style="padding:5px 50px 0px 2px; font-size:13px;text-align:justify;">
						An interactive tool for user to submit data is also provided
						<?php
						if ($observname == ""){
							echo"(<a href='wovodat_Tool.tar'>WOVOdat tool</a>).";
						}else{
							echo"(<a href='/installing/$observname/wovodat_Tool.tar'>WOVOdat tool</a>).";
						}
						?> 
						The data will be converted from common WOVOdat CSV format into WOVOdat XML common formats (WOVOml), uploaded and store in the database system.	
					</p>					
					<p style="padding:5px 50px 0px 2px; font-size:13px;text-align:justify;">
						Detail information about installation is explained in the <a href="readme.pdf" target="_blank">README</a> file. 
					</p>					
				</div>
				
				<!-- Right content -->
				<div id="contentr">
					<div id="top" style="padding:10px;">
					</div>	
					<div style="background:#ddffdd;"><br>
						<h2 style="padding:10px 0px 0px 30px;text-align:center;"><a href=""> Downloadable Packages</a></h2>
					
						<div class="home1" style="font-size:11px;">
						
						<h4><ul><li>WOVOdat database template:</ul></li></h4>
							<p style="padding:0px 35px 0px 45px;font-weight:bold;">Please select observatory before downloading the database.</p>
							<form name="downloadtool" id="downloadtool" method="post" action="download_db.php" >
							
							<table>
								<tr>
								<th colspan='6' style="padding:0px 35px 0px 45px;">Select Observatory:</th>
								<td>
									<select id='observ' name='observ' class="required">  
										<option value="">Select Observatory</option>
										<?php
											for($i=0; $i < sizeof($observlist); $i++){
												if(!is_numeric($observlist[$i][0])){
													$titles=htmlentities($observlist[$i][2], ENT_COMPAT, "cp1252");
													if($observlist[$i][1]==""){
														echo "<option value=\"{$observlist[$i][0]}\" title=\"$titles\">".$observlist[$i][0]."</option>";
													}
													else{
														echo "<option value=\"{$observlist[$i][0]}\" title=\"$titles\">".$observlist[$i][1].",".$observlist[$i][0]."</option>";
													} 
												}
											}
										?>	
										</select>
								</td>
								<td></td>
								</tr>
							
								<tr height="50">
								<th colspan='6' style="padding:0px 0px 0px 45px;">Download WOVOdat Database: </th>
								<td><a href="#" class="check">WOVODAT Database package</a> </td>
								
								</tr>
								
								<tr>
								<th colspan='6'><ul><li>Download WOVOdat UI Tool: </ul></li></th>
								<td> 
								<?php
									if ($observname == ""){
										echo"<a href='wovodat_Tool.tar'>WOVOdat tool</a>.";
									}else{
										echo"<a href='/installing/$observname/wovodat_Tool.tar'>WOVOdat tool</a>.";
									}
								?> 								
								
								</tr>
								
							</table>
							</form>
							<br/><br/>	
						</div>	
					</div>
				</div> <!-- contentr -->
			</div> <!-- content -->
			<!-- Footer -->
			<div>
				<?php include 'php/include/footer_main_beta.php'; ?>
			</div>
		</div> <!--end of wrap-->
	</div> <!--end of wrapborder-->
</body>
</html>
