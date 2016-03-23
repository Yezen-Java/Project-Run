<?php

include 'Classes/NoteClass.php';
include 'Connect.php';
include 'LoadDataOnstart.php';

session_start();

$description = $_POST['Note'];
$userid = $_SESSION['id'];

$notesCLass = new NotesCLass();
$result = $notesCLass->addNotes($description,$userid,$dbconn);

if($result){
	$LoadDataOnstart = new LoadOnStart();

	$htmlTag = $LoadDataOnstart->getNotesOfuser();

	echo $htmlTag;
}else{

	echo $result;
}
?>