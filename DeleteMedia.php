<?php

include 's3_config.php';
include 'database/Connect.php';
include

$mediaid = $_POST['checkboxmedia'];

$MediaManager = new MediaManager();

$GetDeletedNumber = $MediaManager->deleteMeida($mediaid); 

echo $GetDeletedNumber;


?>