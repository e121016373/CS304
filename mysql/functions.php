<?php include "db.php"; ?>
<?php

function createRows() {
	if(isset($_POST["submit"])) {
		global $connection;
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);


		$query = 'INSERT INTO users(username, password)';
		$query .= "VALUES ('$username', '$password')";


		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		} else {
			echo "Record Created";
		}
	}
}

function showAllData() {
	global $connection;
	$query = "SELECT * FROM users";
	echo $query;
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Query Failed" . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_assoc($result)) {
		$id = $row['id'];

		echo "<option value='$id'>$id</option>";
	}
}

function updateTable() {
	global $connection;
	if(isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$id = $_POST['id'];

		$query = "UPDATE users SET ";
		$query .= "username = '$username', ";
		$query .= "password = '$password' ";
		$query .= "WHERE id = $id";

		$result = mysqli_query($connection, $query);
		if(!$result) {
			die("Query FAILED" . mysqli_error($connection));
		} else {
			echo "Record Updated";
		}
	}
}

function deleteRows() {
	global $connection;
	if(isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$id = $_POST['id'];

		$query = "DELETE FROM users ";
		$query .= "WHERE id = $id";

		$result = mysqli_query($connection, $query);
		if(!$result) {
			die("Query FAILED" . mysqli_error($connection));
		} else {
			echo "Record Deleted";
		}
	}
}

?>