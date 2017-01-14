<?php

function showCommonHeader (){

	include "php/include/header.php";
	
}
		
function showCssExternalJs(){
echo <<< HTMLBLOCK
	<script language="javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>	
	<script type="text/javascript" src="/js/jquery.defaultvalue.js"></script>	
	<script type="text/javascript" src="/js/insertFormValidation.js"></script>
	
	<style type="text/css">
		label.error { float: none; color: red; }
		input[type="text"]  { width:180px; }
		 select           { width:180px; }
		.bibliographic   {width:450px;}
		textarea { width:180px; }
		.formFont {font-size:12px;font-weight:bold;}
	</style>
HTMLBLOCK;

	include 'php/include/menu.php'; 
	
	echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > <a href='http://{$_SERVER['SERVER_NAME']}/populate/home.php'>Submit Data</a> > Online Form </div>";

	echo"</div>";
	
	echo"<div class='body'>";
		echo"<div class='widecontent'>";

}

function showCommonFooter(){
	
		echo"</div>";
	echo"</div>";

	echo"<div class='footer'>";
		include "php/include/footer.php";
	echo"</div>";
	
echo"</div>";
echo"</div>";  
echo"</body>";
echo"</html>";  
}



function showSuccessfulMessage(){
echo <<< HTMLBLOCK

		<!-- Content -->

		<div id="content">
		<!-- Page content -->
		
			<h2>Successfully Upload to the database</h2>
		
			<ul><br/>
				<li>If you want to upload more data, 
				you can click <a href="http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php"> here </a> to go back to online form page.</li><br/>
				<li>If you want to check out your data, you can click <a href="http://{$_SERVER['SERVER_NAME']}/phpmyadmin/" target="_blank"> here </a> to go to phpmyadmin. </li>
			</ul>
		</div>  <!-- end page content div -->
HTMLBLOCK;
}

function showUnsuccessfulMessage(){
echo <<< HTMLBLOCK

		<!-- Content -->

		<div id="content">
		<!-- Page content -->
		
			<h2>Error on Uploading form</h2>

			<p>
				Unexcepted error occured, 
				please try again by clicking <a href="http://{$_SERVER['SERVER_NAME']}/populate/home_populate.php"> here </a> to go back to online form page.
				<br/>
				If you contiuously encounter this problem, please click <a href="http://{$_SERVER['SERVER_NAME']}/populate/contact_us_form.php"> here </a> to send email to our wovodat team. 
			</p>
		</div>  <!-- end page content div -->
HTMLBLOCK;
}
?>