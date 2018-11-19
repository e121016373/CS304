<?php 
include "DB.php";

function showJobPostings($sin) {
	global $connection;
	$query = "SELECT * FROM postedjob";
	$query .= " WHERE JobID NOT IN ";
	$query .= "(SELECT JobID FROM application";
	$query .= " WHERE Applicant_SIN = $sin)";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Query Failed" . mysqli_error($connection));
	}
	while($row = mysqli_fetch_assoc($result)){   
		echo "<tr>
			<td>" . $row['JobID'] . "</td>
			<td>" . $row['CompanyName'] . "</td>
			<td>" . $row['Requirements'] . "</td>
			<td>" . $row['Description'] . "</td>
			<td>" . $row['Location'] . "</td>
			<td>" . $row['Type'] . "</td>
			<td>" . $row['Salary'] . "</td>";
		echo 
			"<td><button type = \"submit\" name = \"job_action\" value = ". $row['JobID'] . ">Action</button></td>
			</tr>"; 
	}
}

function viewMyApplication($sin) {
	global $connection;
	$query = "SELECT * FROM application NATURAL JOIN postedjob INNER JOIN employer ON employer.SIN = postedjob.Employer_SIN NATURAL JOIN person ";
		$query .= " WHERE Applicant_SIN = $sin";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}

		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . "Null" . "</td>";
			echo "<td><button type = \"submit\" name = \"cancel_job\" value = ". $row['ApplicationID'] . ">Cancel</button></td></tr>"; 
		}
}

function viewMySchedule($sin) {
	global $connection;
	$query = "SELECT * FROM interview INNER JOIN employer ON employer.SIN = interview.Employer_SIN NATURAL JOIN person NATURAL JOIN application";
		$query .= " WHERE Applicant_SIN = $sin";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Length'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Form'] . "</td>";
			echo "<td><button type = \"submit\" name = \"review\" value = ". $row['CompanyName'] . ">Write Reviews</button></td></tr>"; 
		}
}

