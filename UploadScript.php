<?php
//include('image_check.php');
$msg='';


include('s3_config.php');
//Rename image name. 


$len = count($_FILES['file']['name']);

//echo "number "+$len;

for ($i = 0; $i < $len; $i++)
 {
$tmp = $_FILES['file']['tmp_name'][$i];
$name = $_FILES['file']['name'][$i];
$ext = getExtension($name);
$actual_image_name = time().".".$ext;
if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) ){
$msg = "S3 Upload Successful.";	
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
//echo '<b>S3 File URL:</b>'.$s3file;
$msg = $msg + "<img src='$s3file' style='width:100px;height:150px;'>";
}

else{
 $msg = "S3 Upload Fail.";

  }

  echo $msg;


}


?>



