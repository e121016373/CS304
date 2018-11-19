<?php 
include "DB.php";

function showJobPostings($sin) {
	global $connection;
	$query = "SELECT * FROM postedjob ";
	$query .= "WHERE Employer_SIN = ".$_SESSION['sin'];
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