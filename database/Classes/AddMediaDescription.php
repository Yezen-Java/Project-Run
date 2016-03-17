<?php

require 'Connect.php';
include 'Classes/MediaManagerClass.php';

$mediaid = $_POST['Mediaid'];
$description = $_POST['Description'];

$mediaCalss = new MediaManager();
$CheckMeidaDpAdded = $mediaCalss->meidaDescription($mediaid,$description,$dbconn);

echo $CheckMeidaDpAdded;

?>