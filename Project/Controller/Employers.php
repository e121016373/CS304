<?php include "DB.php";
session_start();

// debugged
// create an employer and insert it into both person and employer table
function createEmployer() {
	if(isset($_POST["register"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		$sin = mysqli_real_escape_string($connection, $_POST['sin']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$contactinfo = mysqli_real_escape_string($connection, $_POST['contact_info']);
		$physiologicalinfo = mysqli_real_escape_string($connection, $_POST['physiological_info']);
		$workexperience = mysqli_real_escape_string($connection, $_POST['work_experience']);
		$education = mysqli_real_escape_string($connection, $_POST['education']);
		$company = mysqli_real_escape_string($connection, $_POST['company']);

		if(isset($username) && isset($name) && isset($sin)) {
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $name;
			$_SESSION['sin'] = $sin;
		}

		$sql = "INSERT INTO person(SIN, Password, Username, Name, Contact_info, Physiological_Info, Work_Experience, Education) VALUES ('$sin', '$password', '$username', '$name', '$contactinfo','$physiologicalinfo','$workexperience','$education')";
		
		
		$result = mysqli_query($connection, $sql);
		$result2 = mysqli_query($connection, "INSERT INTO employer(SIN, CompanyName) VALUES ('$sin', '$company')");
	
		if ($result and $result2) {
			echo "Employer created successfully";
			return true;
		} else {
			die("Query Failed: " . mysqli_error($connection));
		}
	}
}

//debugged
function registerCompany() {
	if(isset($_POST["register_company"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$companyName = mysqli_real_escape_string($connection, $_POST['companyName']);
		$size = mysqli_real_escape_string($connection, $_POST['companySize']);
		$companyInfo = mysqli_real_escape_string($connection, $_POST['company_Info']);
		$field = mysqli_real_escape_string($connection, $_POST['field']);
		
		$sql = "INSERT INTO company(CompanyName, CompanySize, Company_Info, Field)
			VALUES ('$companyName', '$size', '$companyInfo', '$field')";

		$result = mysqli_query($connection, $sql);

		if(!$result) {
			die("Failed to register company: ".mysqli_error($connection));
		} else {
			echo "Record created successfully";
			return true;
		}
	}
}

// debugged
// companyName must exist in Company table
function createJobs() {
	if(isset($_POST["post_job"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$jobID = mysqli_real_escape_string($connection, $_POST['jobid']);
		$companyName = mysqli_real_escape_string($connection, $_POST['companyName']);
		$requirement = mysqli_real_escape_string($connection, $_POST['requirements']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		$location = mysqli_real_escape_string($connection, $_POST['location']);
		$type = mysqli_real_escape_string($connection, $_POST['type']);
		$salary = mysqli_real_escape_string($connection, $_POST['salary']);
		$employerSIN = mysqli_real_escape_string($connection, $_SESSION['sin']);

		// refactor this in the future
		if (!mysqli_query($connection, "SELECT * FROM Company WHERE CompanyName = '$companyName'")) {
			echo "Company does not exist.";
		} else {
			$sql = "INSERT INTO PostedJob (JobID, CompanyName, Requirements, Description, Location, Type, Salary, Employer_SIN) VALUES ('$jobID', '$companyName', '$requirement', '$description', '$location', '$type', '$salary', '$employerSIN')";
		}

		if(mysqli_query($connection, $sql)) {
			echo "New Job posted successfully";
			return true;
		} else {
			echo "Failed to register company: ".mysqli_error($connection);
		}
	}
}

//debugged
function updateJobs($jobid, $companyName, $requirement, $description, $location, $type, $salary) {
	if(isset($_POST['update_job'])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$jobidQuery = "SELECT * FROM PostedJob WHERE JobID = '$jobid'";
		$result = mysqli_query($connection, $jobidQuery);

		if (!$result && mysqli_num_rows($result) <= 0) {
			die('Failed to find Job ID: '. $jobID);
		} 

		$sql = "UPDATE postedjob SET CompanyName = '$companyName', Requirements = '$requirement', Description = '$description', Location = '$location', Type = '$type', Salary = '$salary' WHERE JobID = '$jobid'";

		if (mysqli_query($connection, $sql)) {
			echo "Job updated successfully";
			return true;
		} else {
			echo "Error updating job: ". mysqli_error($connection);
		}
	}
}

//debugged
// cannot delete the job once it has application
function deleteJob() {
	if (isset($_POST['delete_job'])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$jobid = mysqli_real_escape_string($connection, $_POST['delete_job']);
		$sql = "DELETE FROM PostedJob WHERE JobID = '$jobid'";
		$result = mysqli_query($connection, $sql);
		if(!$result) {
			die('Could not delete Job: ' . mysqli_error($connection));
		} else {
			echo "Deleted job successfully.";
			return true;
		}
	}
}

function setEvaluation() {
	if(isset($_POST["submit"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$evaluationID = mysqli_real_escape_string($connection, $_POST['Evaulation ID']);
		$length = mysqli_real_escape_string($connection, $_POST['Length']);
		$date = mysqli_real_escape_string($connection, $_POST['Date']);
		$time = mysqli_real_escape_string($connection, $_POST['time']);
		$employerSIN = mysqli_real_escape_string($connection, $_POST['Employer SIN']);
		$applicationID = mysqli_real_escape_string($connection, $_POST['Application ID']);
	

		if (isset($evaluationID) && isset($length) && isset($date) && isset($time) && isset($employerSIN) && isset($applicationID)) {
			$sql = "INSERT INTO Evaulation (EvaulationID, Length, Date, Time, Employer_SIN, ApplicationID) VALUES ('$evaluationID', '$length', '$date', '$time', '$employerSIN', '$applicationID')";
		} else {
			echo 'Must enter all fields';
		}

		if (mysqli_query($connection, $sql)) {
			echo "Record created successfully";
		} else {
			echo "Error creating evaluation: ". mysqli_error($connection);
		}
	}
}

function giveOffer() {
	if(isset($_POST["submit"])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$offerID = mysqli_real_escape_string($connection, $_POST['offerid']);
		$evaluationID = mysqli_real_escape_string($connection, $_POST['evaluationid']);
		$salary = mysqli_real_escape_string($connection, $_POST['salary']);
		$startDate = mysqli_real_escape_string($connection, $_POST['startDate']);
	
		if (isset($offerID) && isset($salary) && isset($startDate)) {
			$sql = "INSERT INTO Offer (OfferID, EvaluationID, Salary, StartDate) VALUES ('$offerID', '$evaluationID', '$salary', '$startDate')";
		} else {
			echo 'Must enter all fields';
		}

		if (mysqli_query($connection, $sql)) {
			echo "Record created successfully";
		} else {
			echo "Error creating evaluation: ". mysqli_error($connection);
		}
	}
}

function viewReview() {
	if(isset($_POST['review'])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error());
		}

		$companyName = mysqli_real_escape_string($connection, $_POST['CompanyName']);
		$sql = "SELECT *
			FROM Review
			WHERE CompanyName = '$companyName'";
		$result = mysqli_query($connection, $sql);
		if (!$result) {
			echo "Company not found";
		} else if(mysqli_num_rows($result) <= 0) {
			echo "Company has no review";
		} else {
			while ($row = mysqli_fetch_row($result)) {
				echo $row[0] . $row[1] . $row[2] . $row[3];
			}
		}
	}	
}

//debugged
function setupInterview($applicationID) {
	if(isset($_POST['setup_Interview'])) {
		global $connection;
		if (!$connection) {
			die('Failed to connect: ' . mysqli_error($connection));
		}

		$eResult = mysqli_query($connection, "SELECT Max(EvaluationID) AS MaxID FROM Interview");
		$row = mysqli_fetch_assoc($eResult);
		$evaluationID = $row['MaxID'] + 1;
		$length = mysqli_real_escape_string($connection, $_POST['length']);
		$date = mysqli_real_escape_string($connection, $_POST['date']);;
		$time = mysqli_real_escape_string($connection, $_POST['time']);
		$employerSIN = mysqli_real_escape_string($connection, $_SESSION['sin']);
		$type = mysqli_real_escape_string($connection, $_POST['type']);
		$form = mysqli_real_escape_string($connection, $_POST['form']);

		$sql = "INSERT INTO Interview (EvaluationID, Length, Date, Time, Employer_SIN, ApplicationID, Type, Form) VALUES('$evaluationID', '$length', '$date', '$time', '$employerSIN', '$applicationID', '$type', '$form')";
		$result = mysqli_query($connection, $sql);
		if(!$result) {
			die('Failed to query: ' . mysqli_error($connection));
		}
		echo 'Interview is set up successfully.';
		return true;
	}
}

?>
