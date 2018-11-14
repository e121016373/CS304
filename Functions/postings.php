<?php

//View job postings
function viewPostings() {
	$connection = mysqli_connect('localhost', 'root', '', 'postings');

	if(!$connection) {
		die("Database connection fails");
		}
	
	if(isset($_POST["view"])) {

		$query = 'SELECT * FROM postings';

		mysqli_query($connection, $query);
	}
}
	
function searchJobs() {
	$connection = mysqli_connect('localhost', 'roor', '', 'postings');
	
	if(!$connection) {
		die("Database connection fails");
	}
	
	if(isset($_POST["search"])) {
		$
		
	}
}
	

?>