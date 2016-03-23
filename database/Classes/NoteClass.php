<?php


/**
 * LocationClass.php
 * Location managent
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

class NotesCLass
{
	/*
	add notes inserted by the user, add notes id to username.
	*/
	public function addNotes($description,$userid,$dbconn){

		$query = "INSERT into notes (description,userid) values ($1,$2);";

		$results = pg_prepare($dbconn, "query", $query);
		$results = pg_execute($dbconn, "query",array($description,$userid));

		if(pg_affected_rows($results)>0){
			return true;
		}
		return false;
	}

    
    /*
    detele notes from specific user account.
    */
	public function deleteNotes($noteId,$userid,$dbconn){

	$query = "DELETE from notes where notesid = $1 and userid = $2";

		$results = pg_prepare($dbconn, "query", $query);
		$results = pg_execute($dbconn, "query",array($noteId,$userid));

		if(pg_affected_rows($results)>0){

			return true;

		}

		return false;


	}

}





?>