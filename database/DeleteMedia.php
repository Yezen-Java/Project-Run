<?php

include 's3_config.php';
include 'Connect.php';

$getMedia = $_POST['ArrayMedia']; 
//$getArrayMedia = json_decode(str_replace('\\', '', $_POST['ArrayMedia']));
//explode(",", $_POST['data']);

echo $getMedia;

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);


$mediaObject = pg_query("SELECT * From media where mediaid = $getMedia");

if ($mediaObject) {
	
$rows = pg_fetch_array($mediaObject);

echo $rows['media_name'];

if ($s3->deleteObject($bucket,$rows['media_name'])) {
$result = pg_execute($dbconn,"query1",  array($getMedia));

        echo 'deleted';

}

sleep(2);
}



?>