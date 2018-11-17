<?php 
include "../Controller/Employers.php";
include "../Controller/DB.php"
?>
<?php 
createJobs();
?>
<?php 
if(isset($_POST['post_job'])) {
	header("Location:Dashboard_employer.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Post a New Job</title>
</head>
<body>
	<h1>Post a New Job</h1>
	<form action="post_job.php" method = "post">

		<label for="JobID">JobID</label>
		<input id="JobID" type="text" name="jobid" required>

		<br>

		<label for="companyName">Company Name</label>
		<input id="companyName" type="text" name="companyName" required>

		<br>

		<label for="requirements">Requirements</label>
		<textarea id="requirements" type="text" name="requirements"></textarea>

		<br>

		<label for="description">Description</label>
		<textarea id="description" type="text" name="description"></textarea>

		<br>
		<label for="location">Location</label>
		<input id="location" type="text" name="location">

		<br>
		<label for="type">Job Type</label>
		<input id="type" type="text" name="type">

		<br>
		<label for="salary">Salary</label>
		<input id="salary" type="text" name="salary">

		<br>
		<input type="submit" name="post_job">


</body>
</html>