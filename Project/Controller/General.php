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

		$receiver = mysqli_real_escape_string($connection, $_POST['username']);

		$result = mysqli_query($connection, "SELECT Username FROM Person WHERE '$username' = Username");
		if (!$result) {
			die("User not found: " . mysqli_error($connection));
		} else {
			$sender = $_SESSION['username'];
			$_SESSION['sender'] = $sender;
			$sql = "INSERT INTO Request(Sender, Receiver) VALUES('$sender', '$receiver')";
			if (mysqli_query($connection, $sql)) {
				echo "Request sent.";
			}
		}
	}
}

/*
function acceptRequest() {
	if(isset($_POST["accept"])) {
		global $connection;
		$receiver = $_SESSION['username'];
		$senderQuery = "SELECT Sender FROM Request WHERE '$receiver' = Receiver";
		$senderList = mysqli_query($connection, $senderQuery);

		if(!$senderList) {
			die("Request not found: " . mysqli_error($connection));
		} else {
			while ($row = mysqli_fetch_assoc($senderList)) {

			}
		}

		$result = mysqli_query($connection, "SELECT Username FROM Person WHERE '$username' = Username");
		if (!$result) {
			die("User not found: " . mysqli_error($connection));
		} else {
			$sql = "INSERT INTO Connection(User_SIN, Connection_SIN) VALUES('$username')";
			mysqli_query($connection, $sql);
			echo "Request accepted.";
		}
	}
}
*/

?>