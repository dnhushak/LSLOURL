<?php
//This is a template file. Fill in the appropriate values for your database, 
//and then rename this file to "connect2db.php"

$database="dbase";
$username="user";
$password="pass";
$hostname="host url or ip";
$db = new mysqli($hostname, $username, $password, $database);
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>