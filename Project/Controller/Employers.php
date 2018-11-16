<?php include "DB.php";
session_start();

// debugged
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


function registerCompany() {
	global $connection;
	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}

	if(isset($_POST["submit"])) {
		$companyName = mysqli_real_escape_string($connection, $_POST['companyName']);
		$size = mysqli_real_escape_string($connection, $_POST['size']);
		$contactInfo = mysqli_real_escape_string($connection, $_POST['contactInfo']);
		$field = mysqli_real_escape_string($connection, $_POST['field']);
	}

	if (isset($companyName) && isset($size) && isset($contactInfo) && isset($field)) {
		$sql = "INSERT INTO Company (companyName, size, contactInfo, field)
			VALUES ('$companyName', '$size', '$contactInfo', '$field')";
	} else {
		echo 'Must enter all fields';
	}

	if(mysqli_query($connection, $sql)) {
		echo "Record created successfully";
	} else {
		echo "Failed to register company: ".mysqli_error($connection);
	}
}

function createJobs() {
	global $connection;
	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}

	if(isset($_POST["submit"])) {
		$jobID = mysqli_real_escape_string($connection, $_POST['Job ID']);
		$requirement = mysqli_real_escape_string($connection, $_POST['Requirement']);
		$description = mysqli_real_escape_string($connection, $_POST['Desrciption']);
		$location = mysqli_real_escape_string($connection, $_POST['Location']);
		$type = mysqli_real_escape_string($connection, $_POST['Type']);
		$salary = mysqli_real_escape_string($connection, $_POST['Salary']);
		$employerSIN = mysqli_real_escape_string($connection, $_POST['Employer SIN']);
	}

	if (isset($jobID) && isset($requirement) && isset($description) && isset($location) && isset($type) && isset($salary) && isset($employerSIN)) {
		$sql = "INSERT INTO PostedJob (jobID, requirement, description, location, type, salary, employerSIN)
			VALUES ('$jobID', '$requirement', '$description', '$location', '$type', '$salary', '$employerSIN')";
	} else {
		echo 'Must enter all fields';
	}

	if(mysqli_query($connection, $sql)) {
		echo "Record created successfully";
	} else {
		echo "Failed to register company: ".mysqli_error($connection);
	}
}

function updateJobs() {
	global $connection;

	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}

	if(isset($_POST["submit"])) {
		$jobID = mysqli_real_escape_string($connection, $_POST['Job ID']);
		$jobidQuery = "SELECT * FROM PostedJob WHERE JobID = $jobid";

		if (!mysqli_query($connection, $jobidQuery)) {
			die('Failed to find Job ID: '. $jobID);
		} else {
			$requirement = mysqli_real_escape_string($connection, $_POST['Requirement']);
			$description = mysqli_real_escape_string($connection, $_POST['Desrciption']);
			$location = mysqli_real_escape_string($connection, $_POST['Location']);
			$type = mysqli_real_escape_string($connection, $_POST['Type']);
			$salary = mysqli_real_escape_string($connection, $_POST['Salary']);
			$employerSIN = mysqli_real_escape_string($connection, $_POST['Employer SIN']);
		}
	}

	$sql = "UPDATE PostedJob SET Requirement = $requirement, Desrciption = $description, Location = $location, Type = $type, Salary = $salary, EmployerSIN = $employerSIN, WHERE JobID = $jobID";

	if (mysqli_query($connection, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: ". mysqli_error($connection);
	}

}

function setEvaluation() {
	global $connection;

	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}

	if(isset($_POST["submit"])) {
		$evaluationID = mysqli_real_escape_string($connection, $_POST['Evaulation ID']);
		$length = mysqli_real_escape_string($connection, $_POST['Length']);
		$date = mysqli_real_escape_string($connection, $_POST['Date']);
		$time = mysqli_real_escape_string($connection, $_POST['time']);
		$employerSIN = mysqli_real_escape_string($connection, $_POST['Employer SIN']);
		$applicationID = mysqli_real_escape_string($connection, $_POST['Application ID']);
	}

	if (isset($evaluationID) && isset($length) && isset($date) && isset($time) && isset($employerSIN) && isset($applicationID)) {
		$sql = "INSERT INTO Evaulation (Evaulation ID, Length, EDate, ETime, Employer SIN, Application ID) 
		VALUES ('$evaluationID', '$length', '$date', '$time', '$employerSIN', '$applicationID')";
	} else {
		echo 'Must enter all fields';
	}

	if (mysqli_query($connection, $sql)) {
		echo "Record created successfully";
	} else {
		echo "Error creating evaluation: ". mysqli_error($connection);
	}
}

function giveOffer() {
	global $connection;

	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}

	if(isset($_POST["submit"])) {
		$offerID = mysqli_real_escape_string($connection, $_POST['Offer ID']);
		$salary = mysqli_real_escape_string($connection, $_POST['Salary']);
		$startDate = mysqli_real_escape_string($connection, $_POST['Start Date']);
	}

	if (isset($offerID) && isset($salary) && isset($startDate)) {
		$sql = "INSERT INTO Offer (Offer ID, Salary, StartDate)
			VALUES ('$offerID', '$salary', '$startDate')";
	} else {
		echo 'Must enter all fields';
	}

	if (mysqli_query($connection, $sql)) {
		echo "Record created successfully";
	} else {
		echo "Error creating evaluation: ". mysqli_error($connection);
	}
}

function viewReview() {
	global $connection;

	if (!$connection) {
		die('Failed to connect: ' . mysqli_error());
	}
	if(isset($_POST['review'])) {
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

?>
