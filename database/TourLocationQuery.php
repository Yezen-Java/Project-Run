<?php 

$tourCode = pg_escape_string($_POST['TourCode']);
$result = pg_query( "SELECT lname, latitude, logitude from tour_res tr, location l where tr.tourid = '1' and tr.locationid = l.locationid");
echo $result;

?>