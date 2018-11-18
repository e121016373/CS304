<?php
include "../Controller/Applicants.php";
	if(isset($_POST["submit"])) {
		if(createApplication()) header("Location:Dashboard_applicant.php");
	}
?>
<link rel="stylesheet" type="text/css" href="template4.css"/>
<!DOCTYPE html>
<html>
<head>
	<title >Apply Job</title>
</head>
<body style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 20px;text-align: center">
	<?php 
	echo "<h1 > You are going to apply Job with Job ID". $_POST["apply_job"] . "</h1>" ;
	?>
	<form action="apply_job.php" method="post">
		<label for="job_ID"><b>Job ID</b></label>
		<textarea id="job_ID" type="text" name="job_ID"></textarea>
		
		<br>
	
		<label for="cover_letter"><b>Cover Letter</b></label>
		<textarea id="cover_letter" type="text" name="cover_letter"></textarea>

		<br>

		<label for="resume"><b>Resume</b></label>
		<textarea id="resume" type="text" name="resume"></textarea>

		<br>

		<button type="submit" name="submit">Submit</button>
	</form>


</body>
</html>