<?php
if (!isset($_SESSION)) {
    session_start();
}

$upload_code = $_GET['upload_code'];
$upload_dir = $_GET['upload_dir'];

$data = array();
$uploaddir = "./".$upload_dir."/".$upload_code."/";

//mkdir($uploaddir);
mkdir( $uploaddir, 0777, true );

if(isset($_GET['files'])){  
    $error = false;
    $files = array();    
    foreach($_FILES as $file)    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
            $files[] = $uploaddir .$file['name'];
        }
        else{
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else{
    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
echo json_encode($data);
?>