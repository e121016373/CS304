<?php

if(isset($_POST["submit"])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$connection = mysqli_connect('localhost', 'root', '', 'loginapp');

	if($connection) {
		echo "We are connected";
	} else {
		die("Datablase connection fails");
	}

	// if($username && $password) {
	// 	echo $username;
	// 	echo $password;
	// } else {
	// 	echo "This field cannot be blank";
	// }
}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div class = "container">
		
		<div class = "col-xs-6">
			<form action="login.php" method="post">
				<div class = "form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class = "form-control">
				</div>

				<div>
					<label for="password">Password</label>
					<input type="password" name = "password" class = "form-control">
				</div>

				<input type="submit" name="submit" value="Submit">


			</form>
	</div>
</body>
</html>