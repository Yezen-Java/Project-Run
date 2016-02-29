<?php 

use Aws\S3\Exception\S3Exception;
require 'start.php';


if (isset($_FILES['file'])) {

	$file = $_FILES['file'];

	$name = $file['name'];
	$tmp_name = $file['tmp_name'];

    $extension = explode('.', $name);
    $extension = strtolower(end($extension));


    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "media/{$tmp_file_name}";


    move_uploaded_file($tmp_name, $tmp_file_path);

    try {
    	$s3 ->putObject([
    		'Bucket' => $config['s3']['bucket'],
    		'Key' => "uploads/{$name}",
    		'Body'=> fopen($tmp_file_path, 'rb'),
    		'ACL' => 'public-read'

    	]);

    	unlink($tmp_file_path);
    	
    } catch (S3Exception $e) {
    	die("Error, could not upload file");
    	
    }

}
?>