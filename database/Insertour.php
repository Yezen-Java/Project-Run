<?php 

include "Connect.php";

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];



$TourIDCheck = pg_query("SELECT * from tour where tourid = '$tourID'");

$TourNumberIDs = pg_num_rows($TourIDCheck);

if ( $TourNumberIDs == 0) {

	$stmt = $dbconn->prepare("INSERT INTO tour Values(?,?,?)");
	$stmt->bindParam(1, $tourID);
    $stmt->bindParam(2, $tourName);
    $stmt->bindParam(3, $tourDate);
    $stmt->execute();

    if ($stmt->execute()) {
    	echo "Tour created";
    }else{
    	echo "tour faild";
    }


    $stmtuser = $dbconn->prepare("INSERT INTO usertour Values(?,?)");
	$stmtuser->bindParam(1, $username);
    $stmtuser->bindParam(2, $tourid);
    
    if($stmtuser->execute()){

	echo "TourCreated";
	}else{
		echo "Tour Was not added to the user";
	}
	
}else{

	echo "Tour ID already exsits";
}


?>