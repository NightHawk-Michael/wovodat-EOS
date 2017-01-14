<?php
if(!isset($_SESSION))
	session_start();

if (!isset($_POST['message'])) {
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php');
	exit();
}
else{
	// Get posted fields
	$subject=trim($_POST['subject']);
	$message=trim($_POST['message']);
	$name=trim($_POST['name']);
	$email=trim($_POST['email']);

	// Store fields
	$_SESSION['contact']['subject']=$_POST['subject'];
	$_SESSION['contact']['message']=$_POST['message'];
	$_SESSION['contact']['name']=$_POST['name'];
	$_SESSION['contact']['email']=$_POST['email'];
}

include 'php/include/header.php'; 
include 'php/include/menu.php'; 

require_once "Mail-1.2.0/Mail.php";
$mail=Mail::factory("mail");

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Contact</div>";
?>
</div>  <!-- header-menu -->

<div class="body">
	<div class="widecontent">
					
			<?php
				
				$to ="wovodat@wovodat.org";
				$headers=array("From"=>$name." <".$email.">", "Subject"=>$subject);
	
				echo "To: WOVOdat Team<br />";
				echo "From: ".htmlentities($name)." &lt;".htmlentities($email)."&gt;<br />";
				echo "Subject: ".htmlentities($subject)."<br />";
				echo "Message: ".htmlentities($message)."<br /><br /><br />";

				$mail->send($to, $headers, $message);
				
				if(!$mail){ 
					echo "<h2>Dear $name,</h2>";
					echo "We received your inquiry and we will respond to you very shortly."; 
					echo "<br/><br/>Best Regards,";
					echo "<br/>WOVOdat Team";
					
					unset($_SESSION['contact']);
				}else {
					echo "<b>ERROR</b> -- Your message was not sent. Please try again later.";
				}
			?>

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   
</div>   
</body>  
</html>  	