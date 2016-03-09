<?php

include 's3_config.php';
include 'Connect.php';

$getArrayMedia = $_POST['ArrayMedia'];
$i = count($getArrayMedia);

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);

for ($i=0; $i < $i; $i++) { 

if ($s3->deleteObject($bucket,$getArrayMedia[$i])) {
$result = pg_execute($dbconn,"query1",  array($getArrayMedia[$i]));

        echo 'deleted';

}

sleep(2);
}

?>