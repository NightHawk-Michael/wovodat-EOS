<?php
session_start();

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
//usleep(5000);

$imagelink=$_SESSION['imagelink'];
$code=$_SESSION['code'];

$targetDir ="../../../../../region".$imagelink."/";

$fileName = pathinfo($_FILES["file"]["name"]);  
$fileNameWithoutext=$fileName['filename'];
$fileExtension=$fileName['extension'];
$fileName = $fileNameWithoutext."_wovocode=".$code.".".$fileExtension;
$filePath = $targetDir . $fileName;



// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}


while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);



// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
	
/*********** Sending email to WOVOdat email ****************/
$to = "nangthinzarwin1@gmail.com";
$subject = "Submission of New Image";

$txt  = "Dear Admin,\r\n";
$txt .= "Our customer (cc_id is ".$_SESSION['login']['cc_id'].") has uploaded this image:\r\n";
$txt .= "Image Name:  ".$fileName."\r\n";
$txt .= "Image Path:  ".$targetDir."\r\n";

$headers = "From: nangthinzarwin2@gmail.com" . "\r\n" .
"CC: tzwnang@ntu.edu.sg";

mail($to,$subject,$txt,$headers);

}

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

