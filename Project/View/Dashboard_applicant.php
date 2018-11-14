<?php include "../Controller/DB.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard_applicant</title>
</head>
<body>
	<h1>
		<?php

		echo "Welcome ". $_SESSION['name'];

		?>
	</h1>

</body>
</html>