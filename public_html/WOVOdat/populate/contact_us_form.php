<?php
if(!isset($_SESSION))
	session_start();

if (!isset($_SESSION['contact'])) {     // If 1st time access
	// Blank fields
	$subject="";
	$message="";
	$name="";
	$email="";
}else {                                // 2nd time access
	// Get fields
	$subject=$_SESSION['contact']['subject'];
	$message=$_SESSION['contact']['message'];
	$name=$_SESSION['contact']['name'];
	$email=$_SESSION['contact']['email'];
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
					<td><h2>Contact Form </h2></td>
				</tr>

				<tr>
					<td>(All fields * are required)</td> <td></td>
				</tr>	
						
				<tr>
					<td>   
						<form id="contactUsform" name="contactUsform" method="post" action="/populate/contact_us.php">
							<table>
								<tr>
									<td class="label">*Subject: </td>
									<td><input id="subject" name="subject" type="text" id="subject" size="50" maxlength="255" value="<?php echo $subject; ?>" /></td>
								</tr>
								
								<tr>
									<td class="label">*Message:</td>
									<td><textarea id="message" name="message" cols="50" rows="6" id="message"></textarea></td>
								</tr>
								<tr>
									<td class="label">*Name: </td>
									<td><input id="name" name="name" type="text" id="name" size="50" maxlength="255" value="" /></td>
								</tr>
								
								<tr>
									<td class="label">*Email:</td>
									<td><input id="email" name="email" type="text" id="email" size="50" maxlength="255" value="" /></td>
								</tr>

								<tr>
								<td></td>
									<td><img id="siimage" src="../securecheck/securimage_show.php" alt="CAPTCHA Image" />
									<img id="refreshbutton" src="../securecheck/images/refresh.gif" alt="Reload Image" onclick="secureimage();" title="Reload Image">
									</td>
								</tr>
								
								<tr>
									<td class="label">*Type the above security code:</td>
									<td><input type="text" id="code" name="code" /></td>
								</tr>
								
								<tr>
									<td>andnbsp;</td>
									<td>
										<input type="submit" name="Submit" value="Submit" id="submit" />
										<input type="reset" name="Submit2" value="Reset" id="reset" />
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