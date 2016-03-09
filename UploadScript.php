<?php
include('image_check.php');
include('s3_config.php');
include('database/Connect.php');


$msg='';
//Rename image name. 


// $query = "INSERT into media (media_name,link) values ($1,$2)";
// $result = pg_prepare($dbconn,"query", $query);
// $result = pg_execute($dbconn,"query",  array($nameData,$nameLink));


$len = count($_FILES['file']['name']);

//echo "number "+$len;

for ($i = 0; $i < $len; $i++){
$tmp = $_FILES['file']['tmp_name'][$i];
$name = $_FILES['file']['name'][$i];
$ext = getExtension($name);
$actual_media_name = time().".".$ext;
if($s3->putObjectFile($tmp, $bucket,$actual_media_name, S3::ACL_PUBLIC_READ) ){
$msg = "S3 Upload Successful.";	
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_media_name;
$result = pg_query("INSERT into media (media_name,link) values ('$name','$s3file')");
$nameData = $name;
$nameLink = $s3file;

if($result){

  echo "<div class='col-md-4 portfolio-item' id='temp'>
    <img class='img-responsive' src='$nameLink'>
    <h3>$nameData</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio</p></div>";
}
}
else{
 $msg = "S3 Upload Fail.";

  }

  sleep(3);

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



