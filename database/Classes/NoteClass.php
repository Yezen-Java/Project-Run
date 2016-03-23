<?php


/**
* 
*/
class NotesCLass
{
	
	public function addNotes($description,$userid,$dbconn){

		$query = "INSERT into notes (description,userid) values ($1,$2);";

		$results = pg_prepare($dbconn, "query", $query);
		$results = pg_execute($dbconn, "query",array($description,$userid));

		if(pg_affected_rows($results)>0){
			return true;
		}
		return false;
	}


	public function deleteNotes(){

	}

}





?>