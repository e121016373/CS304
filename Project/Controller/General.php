<?php
include "DB.php";
session_start();

function login() {
	if(isset($_POST["submit"])) {
		global $connection;
		
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		
		$result = mysqli_query($connection, "SELECT * from person WHERE '$username'=Username and '$password'=Password");
		
		
		if (!$result){
			die("Login Fails " . mysqli_error($connection));
		} else {
			
			$_SESSION['username'] = $username;
			$row = mysqli_fetch_assoc($result);
			$_SESSION['name'] = $row['Name'];
			$_SESSION['sin'] = $row['SIN'];
			
			$role = 'employer'; 
			$sin = $row['SIN'];
			if (mysqli_num_rows(mysqli_query($connection, "SELECT * from applicant WHERE SIN='$sin'")) != 0){
					$role = 'applicant';
			}
			return $role;
			
		}
	
	}
}

function sendRequest() {
	if(isset($_POST["send"])) {
		global $connection;

		$username = mysqli_real_escape_string($connection, $_POST['username']);

		$result = mysqli_query($connection, "SELECT Username FROM Person WHERE '$username' = Username");
		if (!$result) {
			die("User not found: " . mysqli_error($connection));
		} else {
			$_SESSION['username'] = $username;
			$sql = "INSERT INTO Request(Username) VALUES('$username')";
			mysqli_query($connection, $sql);
			echo "Request sent.";
		}
	}
}

?>