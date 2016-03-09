<?php

include 's3_config.php';
include 'Connect.php';

$stringBuilder = $_POST['Array']; 
$stringBuilder = 45;

echo $stringBuilder;

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);

//$e = count($stringBuilder);

//for ($i=0; $i < 1; $i++) { 


$mediaObject = pg_query("SELECT * From media where mediaid = $stringBuilder");

if ($mediaObject) {
	
$rows = pg_fetch_array($mediaObject);

echo $rows['media_name'];

if ($s3->deleteObject($bucket,$rows['media_name'])) {
$result = pg_execute($dbconn,"query1",  array($stringBuilder[$i]));

        echo 'Deleted';

}else{
	echo "error";
}
//}

sleep(2);
}



?>