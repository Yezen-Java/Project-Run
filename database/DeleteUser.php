<?php

include 'Connect.php';
include 'Classes/NoteClass.php';

$userId = $_POST['userId'];

$userClass = new UserClass();

$results = $userClass->deleteUsers($userId,$dbconn);

if ($results) {

	echo true;
}else{

	echo false;
}


?>