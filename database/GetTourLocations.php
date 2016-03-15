<?php 

include 'Connect.php';
include 'Classes/LocationClass.php';
$TouridCode = $_POST['value'];


$locationClass = new LocationClass();

$geetLocations = $locationClass->getLocation();

echo $geetLocations;










// $queryString = "SELECT * from tour_res, location where tourid ='$TouridCode' and tour_res.locationid = location.locationid";

// $query = pg_query($queryString);

// if (pg_num_rows($query ) == 0) {
// 	echo "No location returned";
// }else{

// 	echo "<lu id='roomlist'>";
// while($row = pg_fetch_array($query)) {
// 	$locationname = $row['lname'];
// 	$locationId = $row['locationid'];

// 	//this generates a list based on the number of the locations.

// echo "<a href ='#'id ='pointer1' value ='$locationId' onclick='addLocationRes($locationId)'>$locationname</a>
// <button type='button' value ='$locationId' class='btn btn-default btn-sm'>
//           <span class='glyphicon glyphicon-trash'></span> Trash 
//         </button>";
// }

// echo "</lu>";
// }

?>