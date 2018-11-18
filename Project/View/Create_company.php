<?php
include "../Controller/Employers.php";
include "../Controller/DB.php"
?>
<?php
if(registerCompany()) {
	//header("Location: Register_employer.php");
}

?>
<link rel="stylesheet" type="text/css" href="template4.css"/>

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
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 35px;text-align: center"> Create Your Own Campany</h1>
	<form action = "Create_company.php" method = "post">
		<label for="companyName">CompanyName</label>
		<input id="companyName" type="text" name="companyName" required>

		<br>

		<label for="companySize">CompanySize</label>
		<input id="companySize" type="text" name="companySize">

		<br>

		<label for="company_info">Company Info</label>
		<input id="company_info" type="text" name="company_info">

		<br>
		<label for="field">Field</label>
		<input id="field" type="text" name="field">

		<br>
		<input type="submit" name="register_company" style="background-color:#4CAF50;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px">
	</form>
</body>
</html>