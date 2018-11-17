<?php
	
	if(isset($_POST["register"])) {
		header("Location:Register_applicant.php");
		exit;
	}
	
include "../Controller/General.php";

	if(isset($_POST["submit"])) {
		if(login() == 'applicant') {
			header("Location:Dashboard_applicant.php");
			exit();
		} else {
			echo "Wrong password/username";
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
    <h1 style="background-color: transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 30px;text-align: center">Quick login to find suitable jobs!</h1>
	<form action="Login_applicant.php" method="post">
		<div class = "form-group">
			<label for="username">Username</label>
			<input type="text" name="username" class = "form-control">
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name = "Password" class = "form-control">
		</div>

		<input type="submit" name="register" value = "register" style="background-color: tomato;margin-top: 2%;"></input> 
		<input type="submit" name="submit" value="submit" style="background-color:tomato;margin-top: 2%;"></input>


	</form>
</body>
</html>