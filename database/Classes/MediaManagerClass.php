
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


        $getContent = $getContent."<li class ='$mediaId' value='$mediaId'><button class='glyphicon glyphicon-trash' id='trashBoxMedia' value ='$mediaId' onclick='deleteMediaLi(this.value);'></button> <a>$media_name</a> </li>";
	}
}else{
	return $getContent;
}

return $getContent;

}



public function meidaDescription($mediaid,$description,$dbconn){
	$query = "UPDATE media SET description = $1 WHERE mediaid = $2";
	$updateQuery = pg_prepare($dbconn,"updateQuery",$query);
	$updateQuery = pg_execute($dbconn,"updateQuery", array($description,$mediaid));

	if (pg_affected_rows($updateQuery)>0){
		return true;
	}

	return false;

}



	public function deleteMediaOfLocation($locationId,$mediaid,$dbconn){

		$query = "DELETE FROM location_res where locationid = $1 and mediaid = $2";
	    $result = pg_prepare($dbconn, "query",$query);
	    $result = pg_execute($dbconn,"query", array($locationId,$mediaid));

	    if (pg_affected_rows($result)>0) {
	    	
	    	return true;
	    }

	    return false;


	}


}

?>