<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<?php
	updateTable();
?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="login_update.php" method="post">
		<div class = "form-group">
			<label for="username">Username</label>
			<input type="text" name="username" class = "form-control">
		</div>

		<div class = "form-group">
			<label for="password">Password</label>
			<input type="password" name = "password" class = "form-control">
		</div>

		<div class="form-group">
			<select name="id" id="">

				<?php

				showAllData();

				?>
			</select>

		</div>


		<input type="submit" name="submit" value="UPDATE">


	</form>
</body>
</html>