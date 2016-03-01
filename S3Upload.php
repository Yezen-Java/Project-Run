<?php 

use Aws\S3\Exception\S3Exception;
include('image_check.php');
require 'start.php';
$msg='';


if (isset($_FILES['file'])) {

	$file = $_FILES['file'];

    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $tmp = $_FILES['file']['tmp_name'];
    $ext = getExtension($name);
    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$ext}";
    $tmp_file_path = "media/{$tmp_file_name}";

    include('s3_config.php');

    //move_uploaded_file($tmp, $tmp_file_path);

    try {
    	$actual_image_name = time().".".$ext;
            if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
            {
                $msg = "S3 Upload Successful."; 
                $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
                echo "<img src='$s3file' style='max-width:400px'/><br/>";
                echo '<b>S3 File URL:</b>'.$s3file;
            }
    	unlink($tmp_file_path);
    } catch (S3Exception $e) {
    	die("Error, could not upload file");
    	
    }

}
?>