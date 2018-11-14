<!-- Username, Password, SIN, Contact info, Name, Physiological info, Work Experience, Education, industry. -->


<?php
include "../Controller/Applicants.php";?>
<?php
createApplicant();
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
		<input id="sin" type="number" name="sin" min= "8" max ="8"required>

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
		<textarea id="work_experience" type="text" name="contact_info"></textarea>

		<br>

		<label for="education">Education</label>
		<textarea id="education" type="text" name="education"></textarea>

		<br>
		<input type="submit" name="register">

	</form>

</body>
</html>