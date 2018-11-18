<?php include "../Controller/DB.php";
session_start();
?>
<link rel="stylesheet" type="text/css" href="template3.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Employer</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 55px;text-align: center">
		<?php
		echo "Welcome!" . $_SESSION['name'];
		?>
		
	</h1>
	<form action = "Dashboard_employer.php">
		<button type = "submit" name = "view_my_job_postings">View My Job Postings</button>
		<button type = "submit" name = "view_my_schedule">View My Schedule</button>
		<button type = "submit" name = "view_my_connection">View My Connection</button>
		<button type = "submit" name = "view_my_reviews">View My Reviews</button>
	</form>

	<?php
	if(isset($_GET['view_my_job_postings'])) {
		$query = "SELECT * FROM postedjob ";
		$query .= "WHERE Employer_SIN = ".$_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "<form action =\"modify_job.php\" method =\"post\">";
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML
		echo "<tr><td>" . "JobID" . "</td><td>" . 'CompanyName' . "</td><td>" . 'Requirements' . "</td><td>" . 'Description' . "</td><td>" . 'Location' . "</td><td>" . 'Type' . "</td><td>" . 'Salary' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Requirements'] . "</td><td>" . $row['Description'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Salary'] . "</td>";
			echo "<td><button type = \"submit\" name = \"modify_job\" value = ". $row['JobID'] . ">Modify</button></td></td>"; 
			echo "<td><button type = \"submit\" name = \"modify_job\" value = ". $row['JobID'] . ">Delete</button></td></tr>"; 
		}
		echo "</table >"; //Close the table in HTML 
		echo "</form>";
		echo "<form action =\"post_job.php\" method =\"post\">";
		echo "<button type = \"submit\" name = \"post_new_job\" value = ". $row['JobID'] . ">Post a New Job</button>";
		echo "</form>";
	}
	if (isset($_GET["view_my_schedule"])) {
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML
		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Applicant' . "</td><td>" . 'Date' . "</td><td>" . 'Time' . "</td><td>" . 'Length' . "</td><td>" . 'Type' . "</td><td>". 'Form' . "</td></tr>";
		$query = "SELECT * FROM evaluation NATURAL JOIN phoneinterview NATURAL JOIN application INNER JOIN applicant ON applicant.SIN = application.Applicant_SIN NATURAL JOIN person";
		$query .= " WHERE evaluation.Employer_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . "Phone Interview" . "</td><td>" . $row['PhoneNumber'] . "</td></tr>";
		}

		$query = "SELECT * FROM evaluation NATURAL JOIN examinterview NATURAL JOIN application INNER JOIN applicant ON applicant.SIN = application.Applicant_SIN NATURAL JOIN person";
		$query .= " WHERE evaluation.Employer_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . "Exam Interview" . "</td><td>" . $row['Location'] . "</td></tr>";
		}

		$query = "SELECT * FROM evaluation NATURAL JOIN onsiteinterview NATURAL JOIN application INNER JOIN applicant ON applicant.SIN = application.Applicant_SIN NATURAL JOIN person";
		$query .= " WHERE evaluation.Employer_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . "Onsite Interview" . "</td><td>" . $row['Location'] . "</td></tr>";
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
	}

	?>


</body>
</html>