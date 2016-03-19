<?php

include 'Connect.php';
include 'database/MediaManagerClass.php';


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
