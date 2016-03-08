<?php 


include 'Connect.php';

$tourIDL = $_POST['TourID'];
$locationId = $_POST['LocationId'];


 $query = "INSERT into tour_res values($1,$2);";


 
 $result = pg_prepare($dbconn,"query", $query);



 $result = pg_execute($dbconn,"query",  array($tourIDL,$locationId));


 if ($result) {

 	echo "<lu>$locationId</lu>";

 }


 ?>