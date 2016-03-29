
<?php

/**
 * LocationClass.php
 * Location managent
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

class MediaManager 
{
	//this adds media to a location.
public function addMeidaToLocation($le,$liarray,$location,$dbconn,$username){
	//remove all spaced form the sting or unwated expressions. 
	$escapeIDLocation = pg_escape_string($location);
	//delete exsiting media from location that belongs to a user.
	$deleteQuery = pg_query("DELETE FROM location_res where locationid = '{$escapeIDLocation}' and username ='{$username}' ");
	       //query for adding media to a location that belongs to a user 
	    $query = "INSERT into location_res(locationid,mediaid,username) values ($1,$2,$3);";
	    //perpare the query to be executed more than once.;
		$result = pg_prepare($dbconn,"query", $query);
		    for ($i=0; $i < $le;$i++) { 
				//execute the query.
				$result = pg_execute($dbconn,"query",  array($location,$liarray[$i],$username));
			}
			    //check whether the query took effect.
				$cmdtuples = pg_affected_rows($result);
				if ($cmdtuples > 0) {
					 return true;
				}else{

				return false;
			}
	    
    
return false;
}

/*
get Media of location that belongs to specific user tour,
it gets all the existing locations.
*/
public function getMediaOfLocation($getLocationId,$username){

$getContent ='';
$escapeGetLocationId = pg_escape_string($getLocationId);
$getLocationMedia = pg_query("SELECT * From location_res, media where location_res.locationid = '{$escapeGetLocationId}' and location_res.username = '{$username}' and location_res.mediaid = media.mediaid;");
	if($getLocationMedia){

	    while ($rows = pg_fetch_array($getLocationMedia)) {
		       $mediaId = $rows['mediaid'];
               $media_name = $rows['media_name'];


        $getContent = $getContent."<li class ='tourLoactions'>
        <button class='trashBoxMedia glyphicon glyphicon-trash' value ='$mediaId' onclick='deleteMediaLi(this.value);'></button><a>$media_name</a><div class ='$mediaId' value='$mediaId'></div>  </li>";
	}
}else{
	return $getContent;
}

return $getContent;

}


/*
insert description for each media.
*/
public function meidaDescription($mediaid,$description,$dbconn){
	$query = "UPDATE media SET description = $1 WHERE mediaid = $2";
	$updateQuery = pg_prepare($dbconn,"updateQuery",$query);
	$updateQuery = pg_execute($dbconn,"updateQuery", array($description,$mediaid));

	if (pg_affected_rows($updateQuery)>0){
		return true;
	}

	return false;

}

    /*
    Delete media from locations.
    */
	public function deleteMediaOfLocation($locationId,$mediaid,$dbconn,$username){

		$query = "DELETE FROM location_res where locationid = $1 and mediaid = $2 and username = $3";
	    $result = pg_prepare($dbconn, "query",$query);
	    $result = pg_execute($dbconn,"query", array($locationId,$mediaid,$username));

	    if (pg_affected_rows($result)>0) {
	    	
	    	return true;
	    }

	    return false;


	}


}

?>