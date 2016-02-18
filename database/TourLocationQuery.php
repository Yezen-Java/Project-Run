<?php 

$tourCode = pg_escape_string($_POST['TourCode']);
$result = pg_query( "SELECT * from tour r, tour_res tr, location l where r.tourgode = '$tourCode' and tr.tourid = r.tourid and tr.locationid = l.locationid;");
echo $result;

?>