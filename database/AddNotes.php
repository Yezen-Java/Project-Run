<?php

include 'Classes/NoteClass.php';
include 'Connect.php';

$description = $_POST['Note'];
$userid = $_SESSION['id'];

$notesCLass = new NotesCLass();
$result = $notesCLass->addNotes($description,$userid,$dbconn);

if($result){

	echo $result;
}else{

	echo $result;
}

?>