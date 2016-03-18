
<?php


class MediaManager 
{

public function addMeidaToLocation($le,$liarray,$location,$dbconn){
	$escapeIDLocation = pg_escape_string($location);
	$deleteQuery = pg_query("DELETE FROM location_res where locationid = '{$escapeIDLocation}'");

	if($deleteQuery){
	    $query = "INSERT into location_res(locationid,mediaid) values ($1,$2);";
		$result = pg_prepare($dbconn,"query", $query);
		    for ($i=0; $i < $le;$i++) { 
				# code...
				$result = pg_execute($dbconn,"query",  array($location,$liarray[$i]));
			}
				$cmdtuples = pg_affected_rows($result);
				if ($cmdtuples > 0) {
					 return true;
				}else{

				return false;
			}
	    
    }
return false;
}



public function getMediaOfLocation($getLocationId){

$getContent ='';
$escapeGetLocationId = pg_escape_string($getLocationId);
$getLocationMedia = pg_query("SELECT * From location_res, media where location_res.locationid = '{$escapeGetLocationId}' and location_res.mediaid = media.mediaid;");

	if($getLocationMedia){

	    while ($rows = pg_fetch_array($getLocationMedia)) {
		       $mediaId = $rows['mediaid'];
               $media_name = $rows['media_name'];


        $getContent = $getContent."<li value ='$mediaId'><button class='glyphicon glyphicon-trash' id='trashBoxMedia'></button> <a>$media_name</a> </li>";
	}
}else{
	return $getContent;
}

return $getContent;

}



public function meidaDescription($mediaid,$description,$dbconn){
	$query = "UPDATE media SET description = $1 WHERE mediaid = $2";
	$updateQuery = pg_prepare($dbconn,"updateQuery",$query);
	$updateQuery = pg_execute($dbconn,"updateQuery", array($description,$mediaid));

	if (pg_affected_rows($updateQuery)>0){
		return true;
	}

	return false;

}


public function mediaUpload($_files, $dbconn){

include('s3/image_check.php');
include('s3/s3_config.php');

$len = count($_files);
$msg='';
$query = "INSERT into media (media_name,link,ext_name,media_type) values ($1,$2,$3,$4)";
$result = pg_prepare($dbconn,"query", $query);
$sizeLimit = 2097152;

for ($i = 0; $i < $len; $i++){

  $tmp = $_files['tmp_name'][$i];
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

                if(pg_execute($dbconn,"query", array($name,$s3file,$actual_media_name,$MediaType))){

                }else{
                  echo flase;
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

 sleep(2);

}

return true;


}



}

?>