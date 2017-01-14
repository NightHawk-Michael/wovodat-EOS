<?php
if (!isset($_SESSION))    
	session_start();  
	
if(!isset($_SESSION['login'])){ 	
header('Location:dataPolicyAgreementRequest.php');	
}else{
	$cc_id=$_SESSION['login']['cc_id'];
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/styles_beta.css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapborder_x">
            <!-- Header -->
            <div id="wrap_x">
				<?php
					include 'php/include/header_beta.php'; 
					include 'php/include/db_connect.php';
					
					$datetime = date('Y-m-d H:i:s');
					
					if($_POST['agree']){
						
						echo "Thank you for your agreement";
						
							global $link;

							$data=array();
								
							$sql="insert into cpa (cc_id,cpa_opt,cpa_date) values ('$cc_id','{$_POST['option']}','$datetime')"; 

							$result = mysql_query($sql, $link);
	
				
					}
				
				?>               
						

            </div>  <!-- end wrap_x -->
			
        </div>   <!-- end wrapborder_x -->
		
        <div class="wrapborder_x">
            <?php include 'php/include/footer_main_beta.php'; ?>
        </div>
    </body>
</html>
