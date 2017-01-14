<?php
if(!isset($_SESSION))
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

include 'php/include/header.php'; 
?>

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
	

<?php
include 'php/include/menu.php';  

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/doc/index.php'>Documentation </a> > WOVODat Standalone Package </div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="twocolcontent">
			
		<div class="leftcolumn">
		
			<h2 class="pagetitle">Installing WOVOdat Structure on own system</h2>
			<p>
				WOVOdat scripts are also available for countries those willing to start developing their own database for managing volcano monitoring data. This also to familiarize users/observatories with the WOVOdat data formats.
			</p>
			<p>
				We provide a ready installable MySQL database template (WOVOdat database), which follow schematic structure and format of WOVOdat, designated for each individual volcano observatory.	
			</p>	
			
			<p>
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
			<p>
				Detail information about installation is explained in the <a href="readme.pdf" target="_blank">README</a> file. 
			</p>					
		</div>
				
		<!-- Right content -->
		<div class="rightcolumn">
			
			<div style="padding-top:60px;">
			
				<h4 style='text-align:center;font-weight:bold;'>Download WOVODat Standalone Package</h4>
				
				<p style="padding:0px 35px 0px 45px;">Please select observatory before downloading the database.</p>
				
				<form name="downloadtool" id="downloadtool" method="post" action="download_db.php" >
				
				<table>
					<tr>
						<td style="padding:0px 35px 0px 45px;">
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
					</tr>
				
					<tr height="20">
					<tr>
						<td style="padding:0px 35px 0px 45px;">
							<a href="#" class="check">Download WOVODAT Database package</a> 
						</td>
					</tr>
					
					<tr height="20">
					<tr>
						<td style="padding:0px 35px 0px 45px;">
						
						<?php
							if ($observname == ""){
								echo"<a href='wovodat_Tool.tar'>Download WOVOdat UI Tool</a>.";
							}else{
								echo"<a href='/installing/$observname/wovodat_Tool.tar'>Download WOVOdat UI Tool:</a>.";
							}
						?> 	
						</td>						
					</tr>
					
				</table>
				</form>	
			</div>
		</div> <!-- Right content -->
		
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->