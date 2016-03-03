<?php 

include "Connect.php";

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];



$TourIDCheck = pg_query("SELECT * from tour where tourid = '$tourID'");

$TourNumberIDs = pg_num_rows($TourIDCheck);

if ( $TourNumberIDs == 0) {

	$stmt = $dbh->prepare("INSERT INTO tour Values(?,?,?)");
	$stmt->bindParam(1, $tourID);
    $stmt->bindParam(2, $tourName);
    $stmt->bindParam(3, $tourDate);
    $stmt->execute();


    $stmt = $dbh->prepare("INSERT INTO usertour Values(?,?)");
	$stmt->bindParam(1, $username);
    $stmt->bindParam(2, $tourid);
    $stmt->execute();

if ($tourQuery) {
	echo "TourCreated";
	}else{
		echo "Tour Creation Failed, Try again";
	}
	
}else{

	echo "Tour ID already exsits";
}


?>