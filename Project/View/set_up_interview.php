<?php include "../Controller/DB.php";
// session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Set up an interview</title>
</head>
<body>
	<h1>Set up an interview</h1>
	<form actiinput type= on="set_up_interview.php" method="post">
		<label for="type">Type</label>
		<select id = "type" name="type" required>
				<option value='Onsite Interview'>Onsite Interview</option>
				<option value='Phone Interview'>Phone Interview</option>
				<option value='Exam Interview'>Exam Interview</option>
		</select>

		<br>
		<label for="date">Date</label>
		<input id="date" type="date" name="date" required>

		<br>
		<label for="time">Time</label>
		<input id="time" type="time" name="time" required>

		<br>
		<label for="length">Length</label>
		<input id="length" type=number name="length" required>hour(s)

		<br>
		<label for="form">Location Or Phone Number</label>
		<input id="form" type="text" name="form" required>

		<br>
		<input type="submit" name="submit">
	</form>

</body>
</html>