<?php 

error_reporting(E_ALL & ~E_NOTICE);
session_start();
include "Connect.php";

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];
$username= $_SESSION['username'];


$TourIDCheck = pg_query("SELECT * from tour where tourid = '$tourID'");

$TourNumberIDs = pg_num_rows($TourIDCheck);

if ( $TourNumberIDs == 0) {

	$tourQuery = pg_query("INSERT INTO tour Values('$tourID', '$tourName','$tourDate')");

    $result = pg_query("INSERT INTO usertour Values('$username','$tourID')");



if ($tourQuery && $result) {
	echo "TourCreated";


	}else{
		echo $username;
	}
	
}else{

	echo "Tour ID already exsits";
}






?>