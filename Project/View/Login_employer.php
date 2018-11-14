<?php
	
	if(isset($_POST["register"])) {
		header("Location: Register_employer.php");
		exit;
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form action="Login_employer.php" method="post">
		<div class = "form-group">
			<label for="username">Username</label>
			<input type="text" name="username" class = "form-control">
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name = "password" class = "form-control">
		</div>

		<input type="submit" name="register" value = "register"></input> 
		<input type="submit" name="submit" value="submit"></input>


	</form>
</body>
</html>