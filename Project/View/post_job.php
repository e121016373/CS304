<?php 
include "../Controller/Employers.php";
include "../Controller/DB.php"
?>
<?php 
if(isset($_POST['post_job'])) {
	createJobs();
	header("Location:Dashboard_employer.php");
	exit();
}
?>
<link rel="stylesheet" type="text/css" href="template4.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Post a New Job</title>
</head>

<body >
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 40px;text-align: center">Post a New Job</h1>
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
		<button type="submit" name="post_job">Submit</button>


</body>
</html>