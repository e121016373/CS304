<?php

$connection = mysqli_connect('localhost', 'root', '', 'projectDB');

if(!$connection) {
	die("Database connection fails");
}

?>