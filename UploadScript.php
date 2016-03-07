<?php
include('image_check.php');
include 'Connect.php';
$msg='';

include('s3_config.php');
//Rename image name. 


// $query = "INSERT into media (media_name,link) values ('$1','$2')";
// $result = pg_prepare($dbconn,"query", $query);

$len = count($_FILES['file']['name']);

//echo "number "+$len;

for ($i = 0; $i < $len; $i++)
 {
$tmp = $_FILES['file']['tmp_name'][$i];
$name = $_FILES['file']['name'][$i];
$ext = getExtension($name);
//$actual_media_name = time().".".$ext;
if($s3->putObjectFile($tmp, $bucket,$name, S3::ACL_PUBLIC_READ) ){
$msg = "S3 Upload Successful.";	
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$name;
echo   "<div class='col-md-3 col-sm-4 col-xs-6'>
              <img src='$s3file' alt='Mountain View' style='width:100px;height:150px;'>
            </div>";

$result = pg_query("INSERT into media (media_name,link) values ('$name','$name')");

if(!$result){
	echo "fail";
}

}
else{
 $msg = "S3 Upload Fail.";

  }

}
// else{
// $msg = "Image size Max 1 MB";

// }
// else{
// $msg = "Invalid file, please upload image file.";

// }
// else{
// $msg = "Please select image file.";
// }

?>



