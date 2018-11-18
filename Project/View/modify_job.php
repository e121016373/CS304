<?php include "../Controller/DB.php";
include "../Controller/Employers.php";
?>
<?php 
	if(isset($_POST['update_job'])) {
		$jobid = $_POST['update_job'];
		$companyName = $_POST['companyName'];
		$requirement = $_POST['requirement'];
		$description = $_POST['description'];			
		$location = $_POST['location'];
		$type = $_POST['type'];
		$salary = $_POST['salary'];
		updateJobs($jobid, $companyName, $requirement, $description, $location, $type, $salary);
		// header("Location:Dashboard_employer.php");
	}
?>
<?php 
if(deleteJob()) {
	header("Location:Dashboard_employer.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modify your Job</title>
</head>
<body>
	<h1>
		<?php
		echo "You are going to modify your job with job ID" . $_POST["modify_job"];
		?>
	</h1>

	<form action = "modify_job.php" method = "post">
		<?php
		$query = "SELECT * FROM postedjob ";
		$query .= "WHERE JobID = " . $_POST["modify_job"];
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		$row = mysqli_fetch_assoc($result);
		?>

		<label for="companyName">CompanyName</label>
		<input id="companyName" type="text" name="companyName" value = <?php echo $row['CompanyName']; ?> required>

		<br>

		<label for="requirement">Requirment</label>
		<textarea id="requirement" type="text" name="requirement"><?php echo $row['Requirements']; ?></textarea>

		<br>

		<label for="description">Description</label>
		<textarea id="description" type="text" name="description"><?php echo $row['Description']; ?></textarea>

		<br>
		<label for="location">Location</label>
		<input id="location" type="text" name="location" value = <?php echo $row['Location']; ?>>

		<br>
		<label for="type">Type</label>
		<input id="type" type="text" name="type" value = <?php echo $row['Type']; ?>>

		<br>
		<label for="salary">Salary</label>
		<input id="location" type="text" name="salary" value = <?php echo $row['Salary']; ?>>

		<br>
		<input type="submit" name="update_job">

	</form>



</body>
</html>