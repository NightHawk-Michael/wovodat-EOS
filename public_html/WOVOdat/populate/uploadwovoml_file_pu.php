<?php

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Get information stored
$cp_access=$_SESSION['permissions']['access'];
$user_upload=$_SESSION['permissions']['user_upload'];
$l_user_upload=$_SESSION['permissions']['l_user_upload'];

?>

<html>
	<br><br>
	<div>
		<ul>
<?php

		// Original file
		// If user has no upload permission for other users
		if ($l_user_upload==0) {
print <<<STRING
			<p><a href="upload_file.php?type=wovoml">Upload an original file</a></p>
STRING;
		}else {
print <<<STRING
			<form action="upload_file.php?type=wovoml" enctype="multipart/form-data" method="post">
				<p>Convert an original file from:
					<select name="select_user_upload_csv">
						<option value="$cc_id"> Myself ($user_name) </option>\n
STRING;
						for ($i=0; $i<$l_user_upload; $i++) {
							$user_id=$user_upload['id'][$i];
							$username=$user_upload['name'][$i];
							if(strlen($username)>45){$username=substr($username,0,45);}
print <<<STRING
							<option value="$user_id"> $username </option>\n
STRING;
						}
print <<<STRING
					</select>
				</p>
				<p><input type="submit" name="upload_file_csv_ok" value="OK" /></p>
			</form>
STRING;
		}
?>

<!--  Nang commented out on 27-Feb-2013 
<?php

// If user is Alex, allow them to see link to more upload options (can be changed later, it's just to avoid making other developers confused)
if ($_SESSION['login']['cc_id']==3) {
	print <<<STRING
				<li>
					<p><a href="upload_file.php?type=wovoml_no_ul">Upload a WOVOML file <b>[No upload to DB]</b></a></p>
				</li>
				<li>
					<p><a href="upload_file.php?type=wovoml_no_pub">Upload a WOVOML file <b>[No checking of publish dates]</b></a></p>
				</li>
STRING;
}
?>
-->
		</ul>
	</div>
</html>