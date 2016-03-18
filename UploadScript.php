<?php

include'database/LoadDataOnstart.php';
include('s3/image_check.php');
include('database/Connect.php');
include('s3/s3_config.php');


$loadData = new LoadOnStart();


$len = count($_FILES['file']['name']);
$msg='';
$query = "INSERT into media (media_name,link,ext_name,media_type) values ($1,$2,$3,$4)";
$result = pg_prepare($dbconn,"query", $query);
$sizeLimit = 2097152;

for ($i = 0; $i < $len; $i++){

  $tmp = $_FILES['file']['tmp_name'][$i];
  $name = $_FILES['file']['name'][$i];
  $size = $_FILES['file']['size'][$i];
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
              //$result = pg_query("INSERT into media (media_name,link,ext_name) values ('$name','$s3file','$actual_media_name')");
              // pg_execute($dbconn,"query", array($name,$s3file,$actual_media_name));
              $nameData = $name;
              $nameLink = $s3file;

                if(pg_execute($dbconn,"query", array($name,$s3file,$actual_media_name,$MediaType))){

                  echo $loadData->mediaResultsFucntion();;
                }else{
                  echo "Faild To access database";
                }
        }
  else{
    echo false;

    return;

  }

}else{

   echo false;

    return;
}

}else{

  echo false;

    return;

}

}else{
   echo false;

    return;
}

 sleep(3);

}



?>



