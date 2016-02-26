<?php 

include 'Connect.php';
$TouridCode = $_POST['value'];

//$query = pg_query("SELECT * from tour_res tr, location l where tourid ='$TouridCode' and tr.locationid = l.locationid;");
$query = pg_query("SELECT * from tour_res;");

//if(pg_num_rows($query)==0){
//	echo "No locations found for this tour";
//}else{
if (pg_num_rows($query )==0) {
	echo "No location returned";
}else{

	echo "<lu>";

while($row = mysql_fetch_array($query)) {
	//$locationname = $row['lname'];
	$locationId = $row['locationid'];

echo "<a href ='#' id ='$locationId'>'$locationname</a>";
}

echo "</lu>";
//}
}

?>