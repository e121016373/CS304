<?php

$connection = mysqli_connect('localhost', 'root', '', 'loginapp');
$user_sin = 100000000;

if(!$connection) {
	die("Database connection fails");
}

?>