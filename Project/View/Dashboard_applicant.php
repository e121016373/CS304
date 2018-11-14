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
	<form action = "Dashboard_applicant.php">
		<button type = "submit" name = "view_job">View Job Postings</button>
		<button type = "submit" name = "view_my_reviews">View My Reviews</button>
	</form>
	<?php
	$query = "SELECT * FROM postedjob";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Query Failed" . mysqli_error($connection));
	}
	
	echo "<table>"; // start a table tag in the HTML
	while($row = mysqli_fetch_assoc($result)){   
	echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Requirements'] . "</td><td>" . $row['Description'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Salary'] . "</td></tr>"; 
	}
	echo "</table>"; //Close the table in HTML
	?>

</body>
</html>