<?php 

$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("SystemManagement", $connection); 
if ($db) {
  echo "Connected to database";
}else {
	
echo "Couldn't Connect To Database";

}

?>