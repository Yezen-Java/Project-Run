<?php
include('image_check.php');
include('database/Connect.php');
include('s3_config.php');

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

                  echo "<div class='col-md-4 portfolio-item' id='temp'>
                    <img class='img-responsive' src='$nameLink' max-width='100%' height='auto'>
                    <h3>$nameData</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio</p>
                    <div id='displayCheckBoxSpan'>
                    <span class='input-group-addon' id='checkBoxDeleteSpan'>
                        <input type='checkbox' id='checkBoxesDelete' name='checkboxmedia[]'>
                      </span></div></div>";
                }else{
                  echo "Faild To access database";
                }
        }
  else{
    echo "S3 Upload Fail.";

  }

}else{

  echo $name +" Was not uploaded, File Too Large";
}

}else{

 echo $name +" invalid file type";

}

}else{
  echo "error, not valid file name";
}

 sleep(3);

}


// function getExtension($str) 
// {
//          $i = strrpos($str,".");
//          if (!$i) { return ""; } 

//          $l = strlen($str) - $i;
//          $ext = substr($str,$i+1,$l);
//          return $ext;
// }

// $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP","txt","mp4","mp3","m4v","DICOM");



?>



