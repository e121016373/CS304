<?php


/* $connection = mysqli_connect('localhost', 'root', '', 'projectDB');

if(!$connection) {
	die("Database connection fails");
}
 */



$user = 'root';
$password = '';
$db = 'projectdb';
$host = 'localhost';
$port = 3306;

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


?>