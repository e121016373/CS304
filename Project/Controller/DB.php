<?php

// $connection = mysqli_connect('localhost', 'root', 'root', 'projectDB');

$user = 'root';
$password = 'root';
$db = 'projectDB';
$host = 'localhost';
$port = 3307;

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