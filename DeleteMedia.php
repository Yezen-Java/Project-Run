<?php

include 's3_config.php';
include 'database/Connect.php';
include 'Classes/MediaManagerCLass.php';

$mediaid = $_POST['checkboxmedia'];

$mediaManager = new MediaManager();

$GetDeletedNumber = $mediaManager->deleteMeida($mediaid); 

echo $GetDeletedNumber;


?>