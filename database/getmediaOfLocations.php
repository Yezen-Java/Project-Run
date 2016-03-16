<?php 

include 'Connect.php';
include 'Classes/MediaManagerClass.php';
$getLocationId = $_POST['LocationId'];


$getMediaLocation = new MediaManager();

$getresults = $getMediaLocation->getMediaOfLocation($getLocationId);

echo $getresults;



?>