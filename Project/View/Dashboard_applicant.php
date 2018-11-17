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
		echo "Welcome " . $_SESSION['name'];
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
		echo "<form action =\"apply_job.php\" method =\"post\">";
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . "JobID" . "</td><td>" . 'CompanyName' . "</td><td>" . 'Requirements' . "</td><td>" . 'Description' . "</td><td>" . 'Location' . "</td><td>" . 'Type' . "</td><td>" . 'Salary' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Requirements'] . "</td><td>" . $row['Description'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Salary'] . "</td>";
			echo "<td><button type = \"submit\" name = \"apply_job\" value = ". $row['JobID'] . ">apply</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
	}
	if (isset($_GET["view_my_application"])) {
		$query = "SELECT * FROM application NATURAL JOIN postedjob INNER JOIN employer ON employer.SIN = postedjob.Employer_SIN NATURAL JOIN person ";
		$query .= " WHERE Applicant_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "<form action =\"cancel_application.php\" method =\"post\">";
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Company Name' . "</td><td>" . 'Employer Cantact_info' . "</td><td>" . 'Status' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . "Null" . "</td>";
			echo "<td><button type = \"submit\" name = \"cancel_job\" value = ". $row['ApplicationID'] . ">Cancel</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
	}
	if (isset($_GET["view_my_schedule"])) {
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Company' . "</td><td>" . 'Interviewer' . "</td><td>" . 'Date' . "</td><td>" . 'Time' . "</td><td>" . 'Length' . "</td><td>" . 'Type' . "</td><td>". 'Form' . "</td></tr>";
		$query = "SELECT * FROM interview INNER JOIN employer ON employer.SIN = interview.Employer_SIN NATURAL JOIN person NATURAL JOIN application";
		$query .= " WHERE Applicant_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Form'] . "</td></tr>";
		}
		echo "</table>";
	}

	?>

</body>
</html>