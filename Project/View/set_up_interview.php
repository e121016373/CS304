<?php include "../Controller/DB.php";
include "../Controller/Employers.php";
// session_start();
?>
<link rel="stylesheet" type="text/css" href="template4.css"/>
<?php 
if(isset($_POST['setup_Interview'])) {
		$applicationID = mysqli_real_escape_string($connection, $_POST['setup_Interview']);
		setupInterview($applicationID);
		header("Location:Dashboard_employer.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Set up an interview</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 40px;text-align: center">Set up an interview</h1>
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
		<!-- <input type="submit" name="submit" style="background-color:tomato;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px"> -->
		<button type="submit" name="setup_Interview" style="background-color:tomato;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px" value= <?php echo $_POST['set_up_interview']; ?>> Submit</button>
	</form>

</body>
</html>