<?php 
include "../Controller/DB.php";
include "../Controller/Applicants.php";
//session_start();

deleteApplication();

?>
<link rel="stylesheet" type="text/css" href="template3.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard_applicant</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 55px;text-align: center">
		<?php
		echo "Welcome! " . $_SESSION['name'];
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
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML
		echo "<tr ><td><size='3pt'>" . "JobID" . "</td><td>" . 'CompanyName' . "</td><td>" . 'Requirements' . "</td><td>" . 'Description' . "</td><td>" . 'Location' . "</td><td>" . 'Type' . "</td><td>" . 'Salary' . "</td></tr>"; 
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
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML

		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Company Name' . "</td><td>" . 'Employer Cantact_info' . "</td><td>" . 'Status' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . "Null" . "</td>";
			echo "<td><button type = \"submit\" name = \"cancel_job\" value = ". $row['ApplicationID'] . ">Cancel</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
		
	}
	if (isset($_GET["view_my_schedule"])) {

		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML
		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Company Name' . "</td><td>" . 'Interviewer' . "</td><td>" . 'Date' . "</td><td>" . 'Time' . "</td><td>" . 'Length' . "</td><td>" . 'Type' . "</td><td>". 'Form' . "</td></tr>";
		$query = "SELECT * FROM evaluation INNER JOIN employer ON employer.SIN = evaluation.Employer_SIN NATURAL JOIN person NATURAL JOIN phoneinterview NATURAL JOIN application";
		$query .= " WHERE Applicant_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . "Phone Interview" . "</td><td>" . $row['PhoneNumber'] . "</td></tr>";
		}

		$query = "SELECT * FROM evaluation INNER JOIN employer ON employer.SIN = evaluation.Employer_SIN NATURAL JOIN person NATURAL JOIN examinterview NATURAL JOIN application";

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
	if (isset($_GET["view_my_connection"])) {
		?>
		<p>My Connections</p>
		<form action = "sendRequest.php" method = "post">
			<table>
				<tr>
					<td>Username</td>
					<td>Name</td>
					<td>Contact Info</td>
					<td>Physiologocal Info</td>
					<td>Work Experience</td>
					<td>Education</td>
				</tr>
				<?php
				$query = "(SELECT * FROM connection INNER JOIN person ON connection.User_Username = person.Username";
				$query .= " WHERE connection.Connection_Username = \"" . $_SESSION['username'] . "\")";
				$query .= " UNION";
				$query .= "(SELECT * FROM connection INNER JOIN person ON connection.Connection_Username = person.Username";
				$query .= " WHERE connection.User_Username = \"" . $_SESSION['username'] . "\")";
				$result = mysqli_query($connection, $query);
				if (!$result) {
					die("Query Failed" . mysqli_error($connection));
				}
				while($row = mysqli_fetch_assoc($result)){   
					echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . $row['Physiological_Info'] . "</td><td>" . $row['Work_Experience'] . "</td><td>" . $row['Education'] . "</td></tr>";
				}
				?>
			</table>
			<button type = "submit" name = "sendRequest">Send Request</button>
		</form>

		<p>Connection Request</p>
		<form action = "Dashboard_applicant.php" method = "post">
		<table>
			<tr>
				<td>Username</td>
				<td>Name</td>
			</tr>
			<?php
			$query = "SELECT * FROM request INNER JOIN person ON Sender_Username = Username";
			$query .= " WHERE Receiver_Username = \"" . $_SESSION['username'] . "\"";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			while($row = mysqli_fetch_assoc($result)){   
				echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['Name'] . "</td>";
				?>
				<td><button type = "submit" name = "accept">Accept</button></td>
				<td><button type = "submit" name = "reject">Reject</button></td></tr>
			<?php }?>
		</table>
	</form>
	<?php } ?>

</body>
</html>