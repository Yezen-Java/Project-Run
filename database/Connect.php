<?php 

/**
 * Database Connection.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

$host = getenv('host');
$databaseName = getenv('database');
$user = getenv('user');
$password = getenv('password');





$dbconn = pg_connect("host= $host dbname=$databaseName user=$user
 password=$password")
or die('Could not connect: ' . pg_last_error());

?>