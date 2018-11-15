<?php


$connection = mysqli_connect('localhost', 'root', 'root', 'projectDB');

if(!$connection) {
	die("Database connection fails");
}



/*
$user = 'root';
$password = 'root';
$db = 'projectdb';
$host = 'localhost';
$port = 3308;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);

if(!$success) {
	die("Database connection fails");
}
*/

?>