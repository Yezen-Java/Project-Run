<?php

/**
 * function call 'deleteNotes'
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

include 'Connect.php';
include 'Classes/NoteClass.php';

session_start();

$noteId = $_POST['NoteId'];

$userid =  $_SESSION['id'];

$notesCLass = new NotesCLass();
$result = $notesCLass->deleteNotes($noteId,$userid,$dbconn);

if($result){

	echo $result;
}else{

	echo $result;
}

?>