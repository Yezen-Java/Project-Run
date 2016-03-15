<?php 

error_reporting(E_ALL & ~E_NOTICE);
session_start();
require 'Connect.php';
include 'TourClass.php';

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];
$username= $_SESSION['username'];

$escapeTourid = pg_escape_string($tourID);
$escapeTName = pg_escape_string($tourName);
$escapeTD = pg_escape_string($tourDate);
$escapeUser = pg_escape_string($username);



global $tourClass;

$tourClass = new TourCLass();


$message = $tourClas::insertTour($escapeTourid,$escapeTName,$escapeTD,$escapeUser);

echo $message;


// $TourIDCheck = pg_query("SELECT * from tour where tourid = '$escapeTourid'");

// $TourNumberIDs = pg_num_rows($TourIDCheck);

// if ( $TourNumberIDs == 0) {
// 	$tourQuery = pg_query("INSERT INTO tour Values('$escapeTourid', '$escapeTName','$escapeTD')");
//     $result = pg_query("INSERT INTO usertour Values('$escapeUser','$escapeTourid')");

// if ($tourQuery && $result) {
// 	echo "TourCreated";


// 	}else{
// 		echo $username;
// 	}
	
// }else{

// 	echo "Tour ID already exsits";
// }






?>