<?php 
include "../Controller/DB.php";
include "../Controller/Employers_ReadData.php";
include "../Controller/General_ReadData.php";
include "../Controller/Employers.php";
include "../Controller/General.php";
// session_start();

if (acceptRequest()) header("Location:Dashboard_employer.php?view_my_connection=");
if (rejectRequest()) header("Location:Dashboard_employer.php?view_my_connection=");
?>

<link rel="stylesheet" type="text/css" href="template3.css"/>


<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Employer</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 55px;text-align: center">
		<?php
		echo "Welcome! " . $_SESSION['name'];
		?>
		
	</h1>
	<form action = "Dashboard_employer.php">
		<button type = "submit" name = "view_my_job_postings">View My Job Postings</button>
		<button type = "submit" name = "view_my_schedule">View My Schedule</button>
		<button type = "submit" name = "view_my_connection">View My Connection</button>
		<button type = "submit" name = "view_reviews">View Reviews</button>
	</form>

	<?php
	if(isset($_GET['view_my_job_postings'])) { ?>

		<form action ="job_action.php" method ="post">;
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>

		<tr>
			<td><b>JobID</td>
			<td><b>CompanyName</td>
			<td><b>Requirements</td>
			<td><b>Description</td>
			<td><b>Location</td>
			<td><b>Type</td>
			<td><b>Salary</td>
			<td><b>Next Step</td>
		</tr>
		<?php showJobPostings($_SESSION['sin']); ?>
	
		</table>
		</form>
		<form action ="post_job.php" method ="post">
		<button type = "submit" name = "post_new_job">Post a New Job</button>
		</form>
		<?php 
	}
	if (isset($_GET["view_my_schedule"])) { ?>
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
			<tr>
				<td><b>Job ID</td>
				<td><b>Applicant</td>
				<td><b>Date</td>
				<td><b>Time</td>
				<td><b>Length</td>
				<td><b>Type</td>
				<td><b>Form</td>
			</tr>

			<?php viewMySchedule($_SESSION['sin']); ?>
		
		</table>
		<?php
	}

	if (isset($_GET["view_my_connection"])) { ?>
		<p style="margin-top: 2%; font-size: 16px;"><b>My Connections</b></p>
		<form action = "sendRequest.php" method = "post">
			<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
				<tr>
					<td><b>Username</b></td>
					<td><b>Name</b></td>
					<td><b>Contact Info</b></td>
					<td><b>Physiologocal Info</b></td>
					<td><b>Work Experience</b></td>
					<td><b>Education</b></td>
				</tr>
				<?php
				viewMyConnection($_SESSION['username']);
				?>
			</table>
			<button type = "submit" name = "sendRequest" style="margin-top: 2%; font-size: 16px;">Send Request</button>
		</form>

		<p style="margin-top: 2%; font-size: 16px;"><b>Connection Request</b></p>
		<form action = "Dashboard_employer.php" method = "post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
			<tr>
				<td><b>Username</b></td>
				<td><b>Name></b></td>
			</tr>
			<?php
			viewMyRequest($_SESSION['username']);
			?>
		</table>
	</form>

	<?php 
	}
	if (isset($_GET["view_reviews"])) {
		?>
		<form action="Dashboard_employer.php">
			<p style="margin-top: 2%; font-size: 16px;">Select the company you would like to review.</p>
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
		<button type="submit" name="search_review">Search</button>
		</form>
	<?php
	}
	if (isset($_GET["search_review"])) { ?>
		<form action="Dashboard_employer.php">
			<p style="margin-top: 2%; font-size: 16px;">Select the company you would like to review.</p>
			<label for="company">Company</label>
			<select id="company" name="company">
			<?php
			$query = "SELECT * FROM Company";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			echo "<option value=\"" .$_GET['company'] . "\" selected>" .$_GET['company'] . "</option>";
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['CompanyName'];
				echo "<option value='$id'>$id</option>";
			}

			?>
		</select>
		<button type="submit" name="search_review">Search</button>
		</form>
		<?php
		viewReviews($_GET['company']);
		} ?>


</body>
</html>