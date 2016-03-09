<?php

include 's3_config.php';
include 'database/Connect.php';

$stringBuilder = $_GET['checkBoxesDelete']; 


echo $stringBuilder;

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);

$e = count($stringBuilder);
for ($i=0; $i < $e; $i++) { 
	# code...
$id = $stringBuilder[$i];
$mediaObject = pg_query("SELECT * From media where mediaid = $id");

if ($mediaObject) {
	
$rows = pg_fetch_array($mediaObject);

echo $rows['ext_name'];

if ($s3->deleteObject($bucket,$rows['ext_name'])) {
$result = pg_execute($dbconn,"query1",  array($stringBuilder[$i]));

        echo 'Deleted';

}else{
	echo "error";
}
//}

sleep(2);
}
}


?>