<?php
	
	if(isset($_POST["register"])) {
		header("Location: Register_employer.php");
		exit;
	}
	include "../Controller/General.php";

	if(isset($_POST["submit"])) {
		if(login() == 'employer') {
			header("Location:Dashboard_employer.php");
			exit();
		} else {
			echo "Wrong password/user";
		}
	}


?>
<link rel="stylesheet" type="text/css" href="template2.css"/>



<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
    <h1 style="background-color: transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 30px;text-align: center">Be great at what you do!</h1>
	<form action="Login_employer.php" method="post">
		<div class = "form-group">
			<label for="username">Username</label>
			<input type="text" name="username" class = "form-control">
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name = "Password" class = "form-control">
		</div>

		<input type="submit" name="register" value = "register" style="background-color: tomato;margin-top: 2%;"></input> 
		<input type="submit" name="submit" value="submit" style="background-color: tomato;margin-top: 2%;"></input>


	</form>
</body>
</html>