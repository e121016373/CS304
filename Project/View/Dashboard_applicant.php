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
		<button type = "submit" name = "view_reviews">View Reviews</button>
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
		echo "<tr ><td><b>" . "JobID" . "</td></b><td><b>" . 'CompanyName' . "</td><td><b>" . 'Requirements' . "</td><td><b>" . 'Description' . "</td><td><b>" . 'Location' . "</td><td><b>" . 'Type' . "</td><td><b>" . 'Salary' . "</td><td><b>" . 'Next Step' . "</td></tr>"; 
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

		echo "<form action =\"Dashboard_applicant.php\" method =\"post\">";
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML

		echo "<tr><td><b>" . 'Job ID' . "</td><td><b>" . 'Company Name' . "</td><td><b>" . 'Employer Cantact_info' . "</td><td><b>" . 'Status' . "</td><td><b>" . 'Next Step' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . "Null" . "</td>";
			echo "<td><button type = \"submit\" name = \"cancel_job\" value = ". $row['ApplicationID'] . ">Cancel</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
		
	}
	if (isset($_GET["view_my_schedule"])) {
		echo "<form action = \"write_review.php\" method = \"post\">";
		echo "<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>"; // start a table tag in the HTML

		echo "<tr><td><b>" . 'Job ID' . "</td><td><b>" . 'Company Name' . "</td><td><b>" . 'Interviewer' . "</td><td><b>" . 'Date' . "</td><td><b>" . 'Time' . "</td><td><b>" . 'Length' . "</td><td><b>" . 'Type' . "</td><td><b>". 'Form' . "</td><td><b>". 'Next Step' . "</td></tr>";
		$query = "SELECT * FROM interview INNER JOIN employer ON employer.SIN = interview.Employer_SIN NATURAL JOIN person NATURAL JOIN application";
		$query .= " WHERE Applicant_SIN = " . $_SESSION['sin'];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Form'] . "</td>";
			echo "<td><button type = \"submit\" name = \"review\" value = ". $row['CompanyName'] . ">Write Reviews</button></td></tr>"; 
		}
		echo "</table>";
	}
	if (isset($_GET["view_my_connection"])) {
		?>
		<p style= "font-size: 15px;"><b>My Connections</b></p>
		<form action = "sendRequest.php" method = "post">
			<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
				<tr>
					<td><b>Username</b></td>
					<td><b>Name</b></td>
					<td><b>Contact Info</b></td>
					<td><b>Physiologocal Info</b></td>
					<td><b>Work Experience</b></td>
					<td><b>Education</b></td>
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

		<p style= "font-size: 15px;"><b>Connection Request</b></p>
		<form action = "Dashboard_applicant.php" method = "post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center >
			<tr>
				<td><b>Username</b></td>
				<td><b>Name</b></td>

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
				<td><button type = "submit" name = "accept" style = " background-color:transparent;color:#FF8C00;font-size: 20"><b>Accept?</b></button></td>
				<td><button type = "submit" name = "reject" style = " background-color:transparent;color:tomato;font-size: 20"><b>Reject X</b></button></td></tr>
			<?php }?>
		</table>
	</form>
	<?php 
	} 
	if (isset($_GET["view_reviews"])) {
		?>
		<form action="Dashboard_applicant.php">
			<p>Which company do you like to look their reviews?</p>
			<label for="company">Company</label>
			<select id="company" name="company">
			<?php
			$query = "SELECT * FROM Company";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['CompanyName'];
				echo "<option value='$id'>$id</option>";
			}

			?>
		</select>
		<button type="submit" name="search_review">Search</button>
		</form>
	<?php
	}
	if (isset($_GET["search_review"])) { ?>
		<form action="Dashboard_applicant.php">
			<p>Which company do you like to look their reviews?</p>
			<label for="company">Company</label>
			<select id="company" name="company">
			<?php
			$query = "SELECT * FROM Company";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			echo "<option value=\"" .$_GET['company'] . "\" selected>" .$_GET['company'] . "</option>";
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['CompanyName'];
				echo "<option value='$id'>$id</option>";
			}

			?>
		</select>
		<button type="submit" name="search_review">Search</button>
		</form>
		<?php
		$query = "SELECT * FROM review NATURAL JOIN person";
		$query .= " WHERE CompanyName = \"" . $_GET['company'] . "\"";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo $row['Username'] . " reviewed: "; 
			echo "Rate: " . $row['Rating'];
			echo "<br>";
			echo "Comment: " . $row['Comment'];
			echo "<br><br>";
		}
		} ?>




</body>
</html>