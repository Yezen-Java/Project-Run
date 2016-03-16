
<?php


class MediaManager 
{

public function addMeidaToLocation($le,$liarray,$location,$dbconn){
	$escapeIDLocation = pg_escape_string($location);
	$deleteQuery = pg_query("DELETE FROM location_res where locationid = '{$escapeIDLocation}'");

	if($deleteQuery){
	    $query = "INSERT into location_res(locationid,mediaid) values ($1,$2);";
		$result = pg_prepare($dbconn,"query", $query);
		    for ($i=0; $i < $le;$i++) { 
				# code...
				$result = pg_execute($dbconn,"query",  array($location,$liarray[$i]));
			}
				$cmdtuples = pg_affected_rows($result);
				if ($cmdtuples > 0) {
					 return true;
				}else{

				return false;
			}
	    
    }
return false;
}



public function getMediaOfLocation($getLocationId){

$getContent ='';
$escapeGetLocationId = pg_escape_string($getLocationId);
$getLocationMedia = pg_query("SELECT * From location_res, media where location_res.locationid = '{$escapeGetLocationId}' and location_res.mediaid = media.mediaid;");

	if($getLocationMedia){

	    while ($rows = pg_fetch_array($getLocationMedia)) {
		       $mediaId = $rows['mediaid'];
               $media_name = $rows['media_name'];


        $getContent = $getContent."<li value ='$mediaId'><button class='glyphicon glyphicon-trash' id='trashBoxMedia'></button> <a>$media_name</a> </li>";
	}
}else{
	return $getContent;
}

return $getContent;

}



// public function deleteMeida($arrayMedia){

// 	global $dbconn;
// 	$checkDelete = 0;

// $query = "DELETE From media where mediaid = $1";
// $query2 = "SELECT * From media where mediaid = $1";

// $result = pg_prepare($dbconn,"query", $query);
// $amazonQuery = pg_prepare($dbconn,"query2", $query2);


// foreach ($arrayMedia as $number) {

// 	$amazonQuery = pg_execute($dbconn,"query2", array($number));
// 	$rows = pg_fetch_array($amazonQuery);
// 	$mediaExt = $rows['ext_name'];
	
// 	if ($s3->deleteObject($bucket,$mediaExt)) {
// 	 $result = pg_execute($dbconn,"query",  array($number));

// 	 $checkDelete++;

// 	}else{

// 		$checkDelete--;
// }


// sleep(1);

// }

// return $checkDelete;

// }

}

?>