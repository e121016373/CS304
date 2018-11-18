<?php include "../Controller/DB.php";
// session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Job Action</title>
</head>
<body>
	<h1>
		<?php
		echo "You are going to take action to Job with JobID" . $_POST["job_action"];
		?>
	</h1>
	</form>
	<form action = "modify_job.php" method = "post">
		<?php
		echo "<button type = \"submit\" name = \"modify_job\" value = ". $_POST["job_action"] . ">Modify</button>";
		echo "<button type = \"submit\" name = \"delete_job\" value = ". $_POST["job_action"] . ">Delete</button>";
		?>
	</form>
	<p>All applicants which apply this job:</p>
	<form action = "set_up_interview.php" method = "post">
	<table>
		<tr>
			<td>Name</td>
			<td>SIN</td>
			<td>Cover Letter</td>
			<td>Resume</td>
		</tr>
		<?php
		$query = "SELECT * FROM application INNER JOIN person ON Applicant_SIN = SIN";
		$query .= " WHERE JobID = ". $_POST["job_action"];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['SIN'] . "</td><td>" . $row['CoverLetter'] . "</td><td>" . $row['Resume'] . "</td>";
			echo "<td><button type = \"submit\" name = \"set_up_interview\" value = ". $row['ApplicationID'] . ">Set Up Interview</button></tr>"; 
		} ?>
	</table>
</body>
</html>