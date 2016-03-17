<?php

require 'Connect.php';
include 'Classes/TourClass.php';
include 'LoadDataOnstart.php';

$TourId = $_POST['TourID'];
$NewTourName = $_POST['newName'];

$tourClass = new TourCLass();
$tourData = new LoadOnStart();

$CheckModifyTour = $tourClass->EditTourName($TourId,$NewTourName,$dbconn);
$htmlTage = $tourData->getTourList();


if ($CheckModifyTour) {
	echo $htmlTage;
}else{
	echo $CheckModifyTour;
}


?>