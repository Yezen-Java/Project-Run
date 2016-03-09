<?php

include 's3_config.php';
include 'Connect.php';

$getArrayMedia = $_POST['ArrayMedia'];
$i = count($getArrayMedia);

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);

for ($i=0; $i < $i; $i++) { 

$mediaObject = pg_query("SELECT * From media where mediaid = $getArrayMedia[$i]");

if ($mediaObject) {
	
$rows = pg_fetch_array($mediaObject);

if ($s3->deleteObject($bucket,$rows['media_name'])) {
$result = pg_execute($dbconn,"query1",  array($getArrayMedia[$i]));

        echo 'deleted';

}

sleep(2);
}

}


?>