<?php
include "DB.php";

if(!isset($_SESSION)) session_start();

function login() {
	if(isset($_POST["submit"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}
		
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		
		$result = mysqli_query($connection, "SELECT * FROM person WHERE '$username' = Username");
		if (!$result) {
			die("Login Fails " . mysqli_error($connection));
		} else if (mysqli_num_rows($result) <= 0) {
			return 'notFound';
		} else {
			$result2 = mysqli_query($connection, "SELECT * from person WHERE '$username'=Username and '$password'=Password");

			if (!$result2 || mysqli_num_rows($result2) <= 0) {
				return 'wrongPassword';
			}

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
		$sender = $_SESSION['username'];
		
		$result = mysqli_query($connection, "SELECT * FROM person WHERE Username='$receiver'");
		
		$query = "(SELECT * FROM connection WHERE User_Username='$sender' AND Connection_Username='$receiver')";
		$query .= "UNION";
		$query .= "(SELECT * FROM connection WHERE User_Username='$receiver' AND Connection_Username='$sender')";
		$friends = mysqli_query($connection, $query);

		
		if (!$result) {
			die("Something went wrong. " . mysqli_error($connection));
		} else {
			if ($friends->num_rows !== 0){
				echo "Already friends.";
			} else {
			if($result->num_rows ===0){
				echo "User not found.";
			} else {
				
				$sql = "INSERT INTO request(Sender_Username, Receiver_Username) VALUES('$sender', '$receiver')";
				$result = mysqli_query($connection, $sql);
				
				if(!$result) {
					echo "Something went wrong" . mysqli_error($connection);
				} else {
					echo "Request sent.";
					return true;
				}
			}
			}
		}
	}
}


function acceptRequest() {
	if(isset($_POST["accept"])) {
		global $connection;

/* 		$senderQuery = "SELECT Sender FROM Request WHERE '$receiver' = Receiver";
		$senderList = mysqli_query($connection, $senderQuery);

		if(!$senderList) {
			die("Request not found: " . mysqli_error($connection));
		} else {
			while ($row = mysqli_fetch_assoc($senderList)) {

			}
		} */
		$receiver = $_SESSION['username'];
		$sender = $_POST['accept'];
				
		$dropRequest = mysqli_query($connection, "DELETE FROM request where Sender_Username='$sender' AND Receiver_Username='$receiver'");
		$addConnection = mysqli_query($connection, "INSERT INTO connection VALUES('$sender', '$receiver')");
		//$addConnection1 = mysqli_query($connection, "INSERT INTO connection VALUES('$reciver', '$sender')");

		if (!$dropRequest or !$addConnection /* or !$addConnection1*/) {
			die("Accept fails. " . mysqli_error($connection));
			return true;
		} else {
			echo "Request accepted.";
			return true;
		}
	}
}

function rejectRequest(){
	if(isset($_POST['reject'])){
		global $connection;
		
		$receiver = $_SESSION['username'];
		$sender = $_POST['reject'];

		$dropRequest = mysqli_query($connection, "DELETE FROM request where Sender_Username='$sender' AND Receiver_Username='$receiver'");
		
		if(!$dropRequest){
			die("Reject fails. " . mysqli_error($connection));
			return true;
		} else {
			echo "Reject accepted.";
			return true;
		}
		
	}
}
?>