<?php 

require 'start.php';

if(isset($_FILES['uploadFile'])){

	$file = $_FILES['uploadFile'];

	$name = $file['name'];
	$tmp_name = $file['tmp_name'];

    $extension = explode('.', $name);
    $extension = strtolower(end($extension));


    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "media/{ $tmp_file_name}";


    move_uploaded_file($tmp_name, $tmp_file_path);

    try {
    	$s3 ->putObject([
    		'Bucket' => $config['s3']['bucket'],
    		'Key' => "uploads/{$name}",
    		'Body'=> fopen($tmp_file_path, 'rb'),
    		'ACL' => 'public-read'

    	]);
    	
    } catch (Exception $e) {
    	die("Error, could not upload file");
    	
    }


}





 ?>