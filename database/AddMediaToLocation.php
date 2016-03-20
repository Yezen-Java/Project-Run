<?php


error_reporting(E_ALL & ~E_NOTICE);
session_start();

include 'Connect.php';
include 'Classes/MediaManagerClass.php';

$username = $_SESSION['username'];

$location = $_POST['locationNo'];
$lis = $_POST['items'];
$liarray = explode("::", $lis);
$le = count($liarray);

$Addmedia = new MediaManager();
$getResults = $Addmedia-> addMeidaToLocation($le,$liarray,$location,$dbconn,$username);

echo $getResults;




?>