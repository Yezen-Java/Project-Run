<?php

include 'Connect.php';
include 'Classes/MediaManagerClass.php';


$locationId = $_POST['LocationId'];
$mediaid = $_POST['MediaId'];


$mediaManager = new MediaManager();

$checkMedia = $mediaManager->deleteMediaOfLocation($locationId,$mediaid,$dbconn);

if ($checkMedia) {
	
	echo $checkMedia;
}else{
	echo false;
}



?>
