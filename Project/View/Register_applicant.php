<!-- Username, Password, SIN, Contact info, Name, Physiological info, Work Experience, Education, industry. -->


<?php
include "../Controller/Applicants.php";
include "../userInfo.php";
?>

<?php
if(createApplicant()) header("Location:Dashboard_applicant.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Register Applicant</title>
</head>
<body>
	<h1>Register</h1>
	<form action="Register_applicant.php" method = post id=registration_form>

		<label for="username">Username</label>
		<input id="username" type="text" name="username" required>

		<br>

		<label for="possword">Password</label>
		<input id="password" type="Password" name="Password" required>

		<br>

		<label for="sin">SIN</label>
		<input id="sin" type="number" name="sin" size="8" required>

		<br>

		<label for="name">Name</label>
		<input id="name" type="text" name="name" required>

		<br>

		<label for="contact_info">Contact Information</label>
		<input id="contact_info" type="text" name="contact_info"required>

		<br>

		<label for="physiological_info">Physiological Info</label>
		<textarea id="physiological_info" type="text" name="physiological_info"></textarea>

		<br>

		<label for="work_experience">Work Experience</label>
		<textarea id="work_experience" type="text" name="work_experience"></textarea>

		<br>

		<label for="education">Education</label>
		<textarea id="education" type="text" name="education"></textarea>

		<br>
		
		<br>

		<label for="industry">Industry</label>
		<textarea id="industry" type="text" name="industry"></textarea>

		<br>
		
		<input type="submit" name="register">

	</form>

</body>
</html>