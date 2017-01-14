<?php
echo <<<HTMLBLOCK

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="../../plupload-2.0.0/plupload-2.0.0/js/jquery.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../plupload-2.0.0/plupload-2.0.0/js/plupload.full.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../plupload-2.0.0/plupload-2.0.0/js/jquery.plupload.queue.min.js" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="../../plupload-2.0.0/plupload-2.0.0/js/jquery.plupload.queue/css/jquery.plupload.queue.css" media="screen" />
</head>
<body>


<form method="post" action="#">
	
	<h1> Upload Image section: </h1><br/>
	
	<p>Please upload only one image file (Max file size is 2MB) for one time:</p>

	<div id="html5_uploader" style="margin-left:17px;">Your browser doesn't support HTML5 upload. Please try to convert from CSV to XML and upload an image again using other browsers like Firefox or hrome.</div>

	<br style="clear: both" />

</form>

<script type="text/javascript">
$(function() {


	// Setup html5 version
	$("#html5_uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : "../../plupload-2.0.0/plupload-2.0.0/scripts/upload.php",
		chunk_size : '2mb',
		unique_names : true,
	
		filters : {
			max_file_size : '2mb',
		}, 

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90}
	});
	
});
</script>

</body>
</html>

HTMLBLOCK;
?>