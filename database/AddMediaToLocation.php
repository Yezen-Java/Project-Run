<?php

include 'Connect.php';
include 'Classes/MediaManagerClass.php';


$location = $_POST['locationNo'];
$lis = $_POST['items'];
$liarray = explode("::", $lis);
$le = count($liarray);

$Addmedia = new MediaManager();
$getResults = $Addmedia-> addMeidaToLocation($le,$liarray,$location,$dbconn);

echo $getResults;




?>