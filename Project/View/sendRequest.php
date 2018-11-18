<?php
include "../Controller/General.php";
if(isset($_POST['send'])){
	if(sendRequest()) header("Location:Dashboard_applicant.php?view_my_connection=.php");
}

?>
<link rel="stylesheet" type="text/css" href="template5.css"/>
<!DOCTYPE html>


<html>
<head>
	<title>Send Request</title>
</head>
<body>
	<h1  style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:8%;margin-bottom:0%; border-radius: 12px; color: black; font-size: 40px;text-align: center">Please input the username of your friend</h1>
	<form action="sendRequest.php" method = "post">
		<label for="username" style="color:#1E90FF;"><b>Username</b></label>
		<input id="username" type="text" name="username" required>

		<button type="submit" name="send" style="size:15;">Send</button>

</body>
</html>