<?php
include "../Controller/General.php";
if(isset($_POST['send'])){
	if(sendRequest()) header("Location:Dashboard_applicant.php?view_my_connection=.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Send Request</title>
</head>
<body>
	<h1>Please input the username of your friend</h1>
	<form action="sendRequest.php" method = "post">
		<label for="username">Username</label>
		<input id="username" type="text" name="username" required>
		<button type="submit" name="send">Send</button>

</body>
</html>