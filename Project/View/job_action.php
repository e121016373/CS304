<?php include "../Controller/DB.php";
// session_start();
?>
<link rel="stylesheet" type="text/css" href="template3.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Job Action</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 40px;text-align: center">
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
	<p style ="color:tomato;font-size: 18px;"><b>All applicants which apply this job:</b></p>
	<form action = "set_up_interview.php" method = "post">
	<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
		<tr>
			<td><b>Name</b></td>
			<td><b>SIN</b></td>
			<td><b>Cover Letter</b></td>
			<td><b>Resume</b></td>
			<td><b>Next Step</b></td>
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
			echo "<td><button type = \"submit\" name = \"set_up_interview\" value = ". $row['Username'] . ">Set Up Interview</button></tr>"; 
		} ?>
	</table>
</body>
</html>