<?php
include "../Controller/Applicants.php";

	if(isset($_POST["submit"])) {
		if(createrApplication()) header("Location:Dashboard_applicant.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Apply Job</title>
</head>
<body>
	<?php 
	echo "<h1> You are going to apply Job with Job ID". $_POST["apply_job"] . "</h1>" ;
	?>
	<form action="Dashboard_applicant.php" method="post">
		<label for="cover_letter">Cover Letter</label>
		<textarea id="cover_letter" type="text" name="cover_letter"></textarea>

		<br>

		<label for="resume">Resume</label>
		<textarea id="resume" type="text" name="resume"></textarea>

		<br>

		<button type="submit" name="submit">Submit</button>
	</form>


</body>
</html>