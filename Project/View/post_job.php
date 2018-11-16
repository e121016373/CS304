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
		<input type="submit" name="post_job">


</body>
</html>