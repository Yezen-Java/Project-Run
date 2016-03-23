<?php
/**
 * function call add Media To Location.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */
 error_reporting(E_ALL & ~E_NOTICE);
 session_start();

include 'Connect.php';
include 'Classes/MediaManagerClass.php';

$location = $_POST['locationNo'];
$username = $_SESSION['username'];
$lis = $_POST['items'];
$liarray = explode("::", $lis);
$le = count($liarray);

$Addmedia = new MediaManager();
$getResults = $Addmedia-> addMeidaToLocation($le,$liarray,$location,$dbconn,$username);

echo $getResults;


?>