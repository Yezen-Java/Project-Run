<?php

include 'Connect.php';
include 'database/Classes/MediaManagerClass.php';

$mediaid = $_POST['checkboxmedia'];

$mediaManager = new MediaManager();

$GetDeletedNumber = $mediaManager->deleteMeida($mediaid); 

echo $GetDeletedNumber;


?>