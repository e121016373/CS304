<?php


	$connection = mysqli_connect('localhost', 'root', '', 'loginapp');

	

	if($connection) {
		echo 'We are connected';
	} else {
		die("Database connection fails");
	}

	$query = "SELECT * FROM users";

	echo $query;

	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Query Failed" . mysqli_error($connection));
	}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php

	while($row = mysqli_fetch_assoc($result)) {

		?>

		<pre>
			<?php
			print_r($row);
			?>
		</pre>

		<?php


	}

	?>
</body>
</html>