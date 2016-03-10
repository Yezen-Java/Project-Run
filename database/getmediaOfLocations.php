<?php 

$getLocationId = $_POST['LocationId'];


$getLocationMeida = pg_query("SELECT * From location_res, media where locationid = $getLocationId");


$rowsNumber = pg_num_rows($getLocationMeida);


if ($getLocationMeida) {

	if($rowsNumber>0){

	    while ($rows = pg_fetch_array($getLocationMeida)) {
		       $meidaId = $rows['mediaid'];
               $meida_name = $rows['media_name'];

        echo "<li id='$meidaId'>$meida_name</li>";

	}
}else{
	echo "No Meida";
}


}




?>