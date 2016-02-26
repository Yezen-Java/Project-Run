<?php 

include 'Connect.php';
$TouridCode = $_POST['value'];

$query = pg_query("SELECT * from tour_res, location"."where tourid ='$TouridCode' and tour_res.locationid = location.locationid");
//$query = pg_query("SELECT * from location;");

//if(pg_num_rows($query)==0){
//	echo "No locations found for this tour";
//}else{
if (pg_num_rows($query ) == 0) {
	echo "No location returned";
}else{

	echo "<lu>";
while($row = pg_fetch_array($query)) {
	$locationname = $row['lname'];
	$locationId = $row['locationid'];

echo "<a href ='#' id ='$locationId'>$locationname</a>";
}

echo "</lu>";
//}
}

?>