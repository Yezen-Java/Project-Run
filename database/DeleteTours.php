<?php

include 'Connect.php';
include 'Classes/TourClass.php';


$GetTourID = $_POST['TourID'];


$tourClass = new TourCLass();

$message = $tourClass->deleteTour($GetTourID);

if($message){

	echo "deleted";
}else{
	echo "faild";
}



?>