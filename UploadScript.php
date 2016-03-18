<?php


// include'database/Classes/MediaManagerClass.php';
// include'database/Connect.php';
// include'database/LoadDataOnstart.php';
// include'database/Classes/s3/image_check.php';
// include'database/Classes/s3/s3_config.php';



// $uploadmedia = new MediaManager();
// $checkUpload = $uploadmedia->mediaUpload($_FILES['file'],$dbconn,$s3);
// $loadDataUploaded = new LoadOnStart();
// $htmlTageOuput = $loadDataUploaded->admediaResultsFucntion();

// if($checkUpload){

//   echo $htmlTageOuput;

// }else{

//   echo $checkUpload;
// }



include('image_check.php');
include('database/Connect.php');
include('s3_config.php');
include'database/LoadDataOnstart.php';

$_files = $_FILES['file'];

$checkUpload = uploadMedia();


if($checkUpload){

$loadDataUploaded = new LoadOnStart();
$htmlTageOuput = $loadDataUploaded->admediaResultsFucntion();
echo $htmlTageOuput;
}else{
  echo false;
}



function uploadMedia(){

global $dbconn;
global $s3;
global $_files;

$len = count($_files['file']['name']);
$msg='';
$query = "INSERT into media (media_name,link,ext_name,media_type) values ($1,$2,$3,$4)";
$result = pg_prepare($dbconn,"query", $query);
$sizeLimit = 2097152;

for ($i = 0; $i < $len; $i++){

  $tmp = $_files['file']['tmp_name'][$i];
  $name = $_files['file']['name'][$i];
  $size = $_files['file']['size'][$i];
  $ext = getExtension($name);
  $actual_media_name = time().".".$ext;
  $MediaType = '';

  if(strlen($name) > 0){

    if(in_array($ext, $valid_formats)){

      if(in_array($ext, $imageFormates)){
        $MediaType ="image";
      }else{
          $MediaType ="video";
      }
        if($size<=$sizeLimit){

            if($s3->putObjectFile($tmp, $bucket,$actual_media_name, S3::ACL_PUBLIC_READ) ){
              $msg = "S3 Upload Successful."; 
              $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_media_name;
              $nameData = $name;
              $nameLink = $s3file;
                pg_execute($dbconn,"query", array($name,$s3file,$actual_media_name,$MediaType));

        }
  else{

    return false;

  }

}else{


    return false;
}

}else{


    return false;

}

}else{

    return false;
}

 sleep(2);

}


return true;

}


?>



