<?php 
include "../Controller/DB.php";
include "../Controller/Applicants_ReadData.php";
include "../Controller/General_ReadData.php";
include "../Controller/Applicants.php";
include "../Controller/General.php";
//session_start();

deleteApplication();
if (acceptRequest()) header("Location:Dashboard_applicant.php?view_my_connection=");
if (rejectRequest()) header("Location:Dashboard_applicant.php?view_my_connection=");


?>
<link rel="stylesheet" type="text/css" href="template3.css"/>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard_applicant</title>
</head>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 55px;text-align: center">
		<?php
		echo "Welcome! " . $_SESSION['name'];
		?>
		
	</h1>
	<form action = "Dashboard_applicant.php">
		<button type = "submit" name = "view_job">View Job Postings</button>
		<button type = "submit" name = "view_my_application">View My Application</button>
		<button type = "submit" name = "view_my_schedule">View My Schedule</button>
		<button type = "submit" name = "view_my_connection">View My Connection</button>
		<button type = "submit" name = "view_reviews">View Reviews</button>
	</form>
	
    
	<?php
	if(isset($_GET['view_job'])) { ?>
		<form action="Dashboard_applicant.php" method ="post">
			<label for="field">Field</label>
			<select id="field" name="field">	
				<option value="Type">
					Type
				</option>
				<option value="Location">
					Location
				</option>
				<option value="CompanyName">
					CompanyName
				</option>
			</select>
			IS
			<input type="text" name="input">
			<br>
			<button type="submit" name="search_job">Search</button>
		</form>

		
		<form action ="apply_job.php" method ="post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
		<tr>
			<td><b>JobID</b></td>
			<td><b>CompanyName</b></td>
			<td><b>Requirements</b></td>
			<td><b>Description</b></td>
			<td><b>Location</b></td>
			<td><b>Type</b></td>
			<td><b>Salary</b></td>
			<td><b>Next Step</b></td>
		</tr>

		<?php showJobPostings($_SESSION['sin']); ?>

		</table>
		</form>
		<?php 
	}

	if(isset($_POST['search_job'])) {
		?>
		<from action="Dashboard_applicant.php">
			<label for="field">Field</label>
			<select id="field" name="field">	
				<option value="Type">
					Type
				</option>
				<option value="Location">
					Location
				</option>
				<option value="CompanyName">
					CompanyName
				</option>
			</select>
			IS
			<input type="text" name="input">
			<br>
			<button type="submit" name="search_job">Search</button>
		</from>

		
		<form action ="apply_job.php" method ="post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
		<tr>
			<td><b>JobID</b></td>
			<td><b>CompanyName</b></td>
			<td><b>Requirements</b></td>
			<td><b>Description</b></td>
			<td><b>Location</b></td>
			<td><b>Type</b></td>
			<td><b>Salary</b></td>
			<td><b>Next Step</b></td>
		</tr>

		<?php 
		searchJobPostings($_SESSION['sin'], $_POST['field'], $_POST['input']); ?>

		</table>
		</form>
		<?php 

	}


	if (isset($_GET["view_my_application"])) { ?>
		
		<form action ="Dashboard_applicant.php" method ="post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>

		<tr>
			<td><b>Job ID</td>
			<td><b>Company Name</td>
			<td><b>Employer Cantact_info</td>
			<td><b>Status</td>
			<td><b>Next Step</td>
		</tr>

		<?php viewMyApplication($_SESSION['sin']); ?>
		</table>
		</form>
		<?php
		
	}


	if (isset($_GET["view_my_schedule"])) { ?>
		<form action = "write_review.php" method = "post">
		<table border=2 cellspacing=0 cellpading=0 width=1200 align=center>
		<tr>
			<td><b>Job ID</td>
			<td><b>Company Name</td>
			<td><b>Interviewer</td>
			<td><b>Date</td>
			<td><b>Time</td>
			<td><b>Length</td>
			<td><b>Type</td>
			<td><b>Form</td>
			<td><b>Next Step</td>
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
		<form action="Dashboard_applicant.php">
			<p style="margin-top: 2%; font-size: 16px;">Which company do you like to look their reviews?</p>
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