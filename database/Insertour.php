<?php 

error_reporting(E_ALL & ~E_NOTICE);
session_start();
require 'Connect.php';
include 'Classes/TourClass.php';

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];
$username= $_SESSION['username'];

$escapeTourid = pg_escape_string($tourID);
$escapeTName = pg_escape_string($tourName);
$escapeTD = pg_escape_string($tourDate);
$escapeUser = pg_escape_string($username);




$tourClass = new TourCLass();

$message = $tourClass->insertTour($escapeTourid,$escapeTName,$escapeTD,$escapeUser);

echo $message;

?>