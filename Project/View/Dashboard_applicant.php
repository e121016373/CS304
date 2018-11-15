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
		<button type = "submit" name = "view_my_application">View My Application</button>
		<button type = "submit" name = "view_my_schedule">View My Schedule</button>
		<button type = "submit" name = "view_my_connection">View My Connection</button>
		<button type = "submit" name = "view_my_reviews">View My Reviews</button>
	</form>

	<?php
	if(isset($_GET['view_job'])) {
		$query = "SELECT * FROM postedjob";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "<form action =\"apply_job.php\" mthod =\"post\">";
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . "JobID" . "</td><td>" . 'CompanyName' . "</td><td>" . 'Requirements' . "</td><td>" . 'Description' . "</td><td>" . 'Location' . "</td><td>" . 'Type' . "</td><td>" . 'Salary' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Requirements'] . "</td><td>" . $row['Description'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Salary'] . "</td>";
			echo "<td><button type = \"submit\" name = \"apply_job\" value = " . $row['JobID'] .">apply</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
	}
	if (isset($_GET["view_my_reviews"])) {
		$query = "SELECT * FROM postedjob";
		$result = mysqli_query($connection, $query);
	}

	?>

</body>
</html>