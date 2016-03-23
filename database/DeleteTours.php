<?php

/**
 * function Call 'deleteTour'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

include 'Connect.php';
include 'Classes/TourClass.php';


$GetTourID = $_POST['TourID'];


$tourClass = new TourCLass();

$message = $tourClass->deleteTour($GetTourID);

echo $message;



?>