<?php

if(isset($_POST["register_company"])) {
	header("Location: Register_employer.php");
}

?>

<!-- CompanyName
CompanySize
Contact_Info
Field -->
<!DOCTYPE html>
<html>
<head>
	<title>Create Company</title>
</head>
<body>
	<h1> Create Your Own Campany</h1>
	<form action = "Register_employer.php" method = "post">
		<label for="companyName">CompanyName</label>
		<input id="companyName" type="text" name="companyName" required>

		<br>

		<label for="companySize">CompanySize</label>
		<input id="companySize" type="text" name="companySize">

		<br>

		<label for="company_info">Contact Info</label>
		<input id="company_info" type="text" name="Contact Info">

		<br>
		<label for="field">Field</label>
		<input id="field" type="text" name="field">

		<br>
		<input type="submit" name="register_company">
	</form>
</body>
</html>