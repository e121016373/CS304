<?php 
include "../Controller/Employers.php";
include "../Controller/DB.php"
?>

<?php
if(createEmployer()) header("Location:Dashboard_employer.php");
?>
<?php
if(isset($_POST['createCompany'])) {
	header("Location:Create_company.php");
}
?>
<link rel="stylesheet" type="text/css" href="template.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Register Employer</title>
</head>
<body>
	<h1>Register</h1>
	<form action="Register_employer.php" method = post id=registration_form>

		<label for="username">Username</label>
		<input id="username" type="text" name="username" required>

		<br>

		<label for="possword">Password</label>
		<input id="password" type="Password" name="Password" required>

		<br>

		<label for="sin">SIN</label>
		<input id="sin" type="number" name="sin" size="8" maxlength="8" required>

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
		<label for="company">Company</label>
		<select id="company" name="company">
			<?php
			$query = "SELECT * FROM Company";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['CompanyName'];
				echo "<option value='$id'>$id</option>";
			}

			?>
		</select>


		<input type="submit" name="register" style="background-color:tomato;font-size: 15px;border-radius: 12px;margin-top: 1%">

	</form>
	<p style="font-size: 20px;margin-top: 2%;color:orange"> <b>Didn't find your company? Create your own</b></p>
	<form action="Register_employer.php" method = post id=registration_form>
		<input type="submit" name="createCompany" value="Create Company" style="background-color:#4CAF50;font-size:20px;border-radius: 12px">
	</form>

</body>
</html>