<?php include "users.php"; ?>
<?php

//Creat new normal user
function createNormal() {
	if(isset($_POST["submit"])) {
		global $connection;
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$sin = mysqli_real_escape_string($connection, $_POST['sin']);
		$contactinfo = mysqli_real_escape_string($connection, $_POST['contact_info']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$pysiologicalinfo = mysqli_real_escape_string($connection, $_POST['physiological_info']);
		$workexperience = mysqli_real_escape_string($connection, $_POST['work_experience']);
		$education = mysqli_real_escape_string($connection, $_POST['education']);
		$industry = mysqli_real_escape_string($connection, $_POST['industry']);


		$query = 'INSERT INTO users(username, password)';
		$query .= "VALUES ('$username', '$password', '$sin','$contactinfo','$name','$pysiologicalinfo','$workexperience','$education', '$industry')";


		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		} else {
			echo "Record Created";
		}
	}
}