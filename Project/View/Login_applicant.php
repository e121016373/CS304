<?php
	
	if(isset($_POST["register"])) {
		header("Location:Register_applicant.php");
		exit;
	}
	
include "../Controller/General.php";

	if(isset($_POST["submit"])) {
		if(login() == 'applicant') header("Location:Dashboard_applicant.php");
	}

	
?>




<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form action="Login_applicant.php" method="post">
		<div class = "form-group">
			<label for="username">Username</label>
			<input type="text" name="username" class = "form-control">
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name = "Password" class = "form-control">
		</div>

		<input type="submit" name="register" value = "register"></input> 
		<input type="submit" name="submit" value="submit"></input>


	</form>
</body>
</html>