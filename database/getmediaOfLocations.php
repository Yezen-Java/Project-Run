<?php 

include 'Connect.php';

$getLocationId = $_POST['LocationId'];

echo $getLocationId ;

$getLocationMedia = pg_query("SELECT * From location_res, media where location_res.locationid = $getLocationId and location_res.mediaid = media.mediaid;");


$rowsNumber = pg_num_rows($getLocationMedia);



	if($rowsNumber>0){

	    while ($rows = pg_fetch_array($getLocationMeida)) {
		       //$mediaId = $rows['mediaid'];
               $media_name = $rows['media_name'];

        echo "<li id='$mediaId'>$media_name</li>";


	}
}else{
	echo "No Media";
}





?>