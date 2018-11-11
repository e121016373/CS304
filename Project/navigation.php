<?php
	
	if(isset($_POST["employer"])) {
		header("Location:login_employer.php");
		exit;
	}
	if(isset($_POST["applicant"])) {
		header("Location:login_applicant.php");
		exit;
	}

	?>

<!DOCTYPE html>
<html>
<head>
	<title>navigation</title>
</head>
<body>
	<form action = "navigation.php" method = "post">
		<input type="submit" name = "applicant" value = "applicant">
		</input>
		<input type="submit" name = "employer" value = "employer"></input>
	</form>

</body>
</html>