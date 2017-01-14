<?php
if(!isset($_SESSION))
	session_start();

if(isset($_SESSION['downloadDataUsername'])){	
header('Location:booleanDownloadData.php?i='.$_GET['i'].'&data='.$_GET['data']);
}

include 'php/include/header.php';
?>

<script src="/js/jquery-1.4.2.min.js"></script>                               
<script type="text/javascript" src="/js/jquery.validate.js"></script>    
<script type="text/javascript" src="/js/formValidation.js"></script>        

<style type="text/css">
	label.error {font-size:12px; display:block; float: none; color: red;}
</style>

<?php

include 'php/include/menu.php';

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Contact</div>";

?>


</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">

		<div class="form">
		
			<table>
				<tr>
					<td colspan="4"><h3>Please provide information before starting data download.</h3></td>
				</tr>
				
				<tr>
					<td>(All fields * are required)</td> <td></td>
				</tr>	
				
				<tr>
					<td>   
						<form name="downloadDataForm" id="downloadDataForm" method="get" action="booleanDownloadData.php">
							<table>
								<tr>
									<td class="label">*Name: </td>
									<td><input type="text" id="downloadDataUsername" name="downloadDataUsername" class="required"/></td>
								</tr>
								
								<tr>
									<td class="label">*Email:</td>
									<td><input id="downloadDataUseremail" name="downloadDataUseremail" class="required" /></td>
								</tr>
						
								<tr>
									<td class="label">*Institution/Observatory:</td>
									<td><input id="downloadDataUserobs" name="downloadDataUserobs" class="required" /></td>
								</tr>
								
								<tr>
									<td align="right"><input type="checkbox" name="agree" value="T&C" id="agree"></td>
									<td align="left"><a href="/populate/dataPolicy.php" target="_blank"> I agree to WOVOdat Data Policy</a></td>
								</tr>
								
													
								<?php

									echo "<input type='hidden' name='i' value='{$_GET['i']}'>";
									echo "<input type='hidden' name='data' value='{$_GET['data']}'>";
								?>	  
								<tr colspan="5">
									<td>&nbsp;</td>
									<td>
										<input type="submit" name="Submit" value="Submit" id="submit" />
									</td>
								</tr>
							</form>
						</table>
					</td>
				</tr>
			</table>
	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->
