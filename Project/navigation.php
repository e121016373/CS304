<?php
	
	if(isset($_GET["employer"])) {
		header("Location:View/Login_employer.php");
		exit;
	}
	if(isset($_GET["applicant"])) {
		header("Location:View/Login_applicant.php");
		exit;
	}

	?>

<!DOCTYPE html>
<html>
<head>
	<title>navigation</title>
</head>
<body>
	<form action = "navigation.php">
		<input type="submit" name = "applicant" value = "applicant">
		</input>
		<input type="submit" name = "employer" value = "employer"></input>
	</form>

</body>
</html>