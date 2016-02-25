<?php 

include 'Connect.php';
$TouridCode = $_POST['TourID'];
$query = pg_query("SELECT * from tour_res tr, location l where tourid ='$TouridCode' and tr.locationid = l.locationid;");
while($row = mysql_fetch_array($query)) {
	$locationname = $row['lname'];

echo "<a>$locationname</a>";
}

?>