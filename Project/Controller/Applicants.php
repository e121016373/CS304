<?php include "DB.php";
session_start();

//Allows new user to create new account
function createApplicant() {
	if(isset($_POST["register"])) {
		global $connection;
		if(!$connection) {
			die("Database connection fails");
		}

		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		$sin = mysqli_real_escape_string($connection, $_POST['sin']);
		$contact_info = mysqli_real_escape_string($connection, $_POST['contact_info']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$physiological_info = mysqli_real_escape_string($connection, $_POST['physiological_info']);
		$work_experience = mysqli_real_escape_string($connection, $_POST['work_experience']);
		$education = mysqli_real_escape_string($connection, $_POST['education']);
		$industry = mysqli_real_escape_string($connection, $_POST['industry']);

		$_SESSION['username'] = $username;
		$_SESSION['name'] = $name;
		$_SESSION['sin'] = $sin;

		$query = 'INSERT INTO Person(SIN, Password, Username, Name, Contact_info, Physiological_Info, Work_Experience, Education)';
		$query .= "VALUES ('$sin','$password', '$username','$name','$contact_info','$physiological_info','$work_experience','$education')";
		
		$result = mysqli_query($connection, $query);
		$result2 = mysqli_query($connection, "INSERT INTO applicant(SIN, Industry) VALUES ('$sin', '$industry')");
		
		if (!$result or !$result2) {
			die("Query Failed" . mysqli_error($connection));
		} else {
			echo "Record Created";
			return true;
		}
	}
}

//Allows applicants to view all available postings
function viewPostings() {
	global $connection;
	if(!$connection) {
		die("Database connection fails");
	}
	
	if(isset($_POST["view"])) {

		$query = 'SELECT * FROM postedjob';

		echo mysqli_query($connection, $query);
	}
}

//Create applications
function createApplication() {
	if(isset($_POST["submit"])){
	global $connection;
	if(!$connection) {
		die("Database connection fails");
	}
	
	$jobid = mysqli_real_escape_string($connection, $_POST['job_ID']);
	$coverletter = mysqli_real_escape_string($connection, $_POST['cover_letter']);
	$resume = mysqli_real_escape_string($connection, $_POST['resume']);
	$sin = $_SESSION['sin'];
	$applicationID = rand(0, 10000);
	
	$query = 'INSERT INTO application(ApplicationID, Applicant_SIN, JobID, CoverLetter, Resume)';
	$query .= "VALUES ('$applicationID', '$sin','$jobid', '$coverletter', '$resume')";
	
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Application failed. " . mysqli_error($connection));
	} else {
		return true;
	}
	}
}

//Allows applicants view all his or her offers
function viewOffers() {
	if(isset($_POST["submit"])){
		global $connection;
		if(!$connection) {
			die("Database connection fails");
			}
	
		$sin = $_SESSION['sin'];
		
		$applications = mysqli_query($connection, "SELECT ApplicationID FROM application WHERE Applicant_SIN='$sin'");
		$evaluation = mysqli_query($connection, "SELECT EvaluationID FROM evaluation WHERE ApplicationID IN '$applications'");
		$result = mysqli_query($connection, "SELECT * FROM offer WHERE EvaluationID IN '$evaluation'");

		echo $result; 
		
	}
}

//Allows applicant to view the evaluation time for the for evaluations
function viewEvalTime() {
	if(isset($_POST["search"])) {
		global $connection;
		if(!$connection) {
			die("Database connection fails");
			}
		
		$sin = $_SESSION['sin'];
		
		$applications = mysqli_query($connection, "SELECT ApplicationID FROM application WHERE Applicant_SIN='$sin'");
		$evaluation = mysqli_query($connection, "SELECT EvaluationID FROM evaluation WHERE ApplicationID IN '$applications'");
			
		echo $evaluation;
		
	}
}
//Allows applicant to search job that matches his criteria
function searchJob() {
	if(isset($_POST["search"])) {
		global $connection;
		if(!$connection) {
			die("Database connection fails");
		}
		
		$companyName = mysqli_real_escape_string($connection, $_POST['companyName']);
		$location = mysqli_real_escape_string($connection, $_POST['location']);
		$type = mysqli_real_escape_string($connection, $_POST['type']);
		$salary = mysqli_real_escape_string($connection, $_POST['salary']);
		
		
		$query = "SELECT * FROM postedjob";
		$query .= "WHERE CompanyName='%$companyName%' AND Location='%$location%' AND Type='%$type%' AND Salary='%$salary%'";
		
		$result = mysqli_query($connection, $query);
		
	if (!$result) {
		die("Search failed. " . mysqli_error($connection));
	} else {
		echo $result;
		}				
	}
}

function deleteApplication() {
	if(isset($_POST['cancel_job'])){
		global $connection;
		if(!$connection){
			die("Database connection fails");
		}
			
		$job_id = $_POST['cancel_job'];
		$sin = $_SESSION['sin'];
		$result = mysqli_query($connection, "DELETE FROM application where ApplicationID='$job_id' AND Applicant_SIN='$sin'");
			
		if($result){ 
			echo "Application dropped";
			
		}
	}
}

function writeReview($companyName) {
	if(isset($_POST['write_review'])) {
		global $connection;
		if(!$connection) {
			die("Failed to connect database: " . mysqli_error($connection));
		}

		$sin = $_SESSION['sin'];
		$rating = mysqli_real_escape_string($connection, $_POST['star']);
		$comment = mysqli_real_escape_string($connection, $_POST['comment']);
		$sql = "INSERT INTO Review (SIN, CompanyName, Rating, Comment) VALUES ('$sin', '$companyName', '$rating', '$comment')";
		$result = mysqli_query($connection, $sql);
		if (!$result) {
			die('Failed to query: ' . mysqli_error($connection));
		} else {
			echo 'Review is stored successfully.';
			return true;
		}

	}
}

?>