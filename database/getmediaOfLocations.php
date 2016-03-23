<?php 

/**
 * function call 'getMeidaofLocations'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

 error_reporting(E_ALL & ~E_NOTICE);
 session_start();
include 'Connect.php';
include 'Classes/MediaManagerClass.php';
$getLocationId = $_POST['LocationId'];
$username = $_SESSION['username'];
$getMediaLocation = new MediaManager();
$getresults = $getMediaLocation->getMediaOfLocation($getLocationId,$username);
echo $getresults;

?>