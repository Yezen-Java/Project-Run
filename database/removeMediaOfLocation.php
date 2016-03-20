<?php

 error_reporting(E_ALL & ~E_NOTICE);
 session_start();

include 'Connect.php';
include 'Classes/MediaManagerClass.php';


$locationId = $_POST['LocationId'];
$mediaid = $_POST['MediaId'];
$username = $_SESSION['username'];

$mediaManager = new MediaManager();

$checkMedia = $mediaManager->deleteMediaOfLocation($locationId,$mediaid,$dbconn,$username);

if ($checkMedia) {
	
	echo $checkMedia;
}else{
	echo false;
}



?>
