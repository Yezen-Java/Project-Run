<?php

include 'Classes/NoteClass.php';
include 'Connect.php';

$description = $_POST['Note'];
$notesCLass = new NotesCLass();
$userid = $_SESSION['id'];

$result = $notesCLass->addNotes($description,$userid);

if($result){

	echo $result;
}else{

	echo $result;
}

?>