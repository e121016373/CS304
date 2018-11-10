<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<?php createRows(); ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div class = "container">
		<div class = "col-xs-6">
			<form action="login_create.php" method="post">
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