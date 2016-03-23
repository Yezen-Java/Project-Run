<?php

/**
 * function call add media description.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

require 'Connect.php';
include 'Classes/MediaManagerClass.php';

$mediaid = $_POST['Mediaid'];
$description = $_POST['Description'];

$mediaCalss = new MediaManager();
$CheckMeidaDpAdded = $mediaCalss->meidaDescription($mediaid,$description,$dbconn);

echo $CheckMeidaDpAdded;

?>