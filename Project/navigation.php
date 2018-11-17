<?php
	
	if(isset($_GET["employer"])) {
		header("Location:View/Login_employer.php");
		exit;
	}
	if(isset($_GET["applicant"])) {
		header("Location:View/Login_applicant.php");
		exit;
	}

	?>


<!DOCTYPE html>
<html>
<head>
	<title>navigation</title>
</head>
<body background="../image/123.jpg" style="background-repeat:no-repeat; background-size: 110%">

<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}
.bgimg {
    background-position: center;
    background-size: cover;

    min-height: 75%;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 18px 120px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
p {
	text-align: middle;
}
</style>

<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a class="about" href="#about">About</a></li>
</ul>
<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:6%;margin-bottom:0%; border-radius: 12px; color: #808000; font-size: 79px;text-align: center"><i>MasterJobs</i></h1>

        

	<form action = "navigation.php">
	  <p align="center">
<input type="submit" name = "applicant" value = "APPLICANT" style="background-color:#9370DB;margin-left:auto;margin-right:auto;display:block;margin-top:10%;margin-bottom:0%; border: 4px solid black; color: white; font-size: 30px;border-radius: 12px">



		
		
</p>
		<p align="center">
		<input type="submit" name = "employer" value = "EMPLOYER" style="background-color:#9370DB;margin-left:auto;margin-right:auto;display:block;margin-top:10%;margin-bottom:0%; border: 4px solid black; color: white; font-size: 30px;border-radius: 12px"></input>
	</form>


	<div  class="about" id="about" style="margin-top:22%;max-width:700px;background-color: #FFF8DC" >
    <h5><i>ABOUT THE PORJECT</i></h5>
    <p>This Site is made by CPSC304 project group16</p>
    <p>The functionalities of our job searching system are but not limited to: matching applicants with jobs that satisfy their predetermined requirements (ex position, salary), allowing companies to post job openings, setting up the interviews with potential employers, building networks, etc.
    <img src="../image/1234.jpg" style="width:30%;max-width:1000px;" align= "right"> Applicants need to fill in their personal information, such as education background, age, gender, preferred location, contact information. They can specify their job preferences, expected salary, working hours, company welfare and so on. In addition, applicants can submit their own resumes to apply for any unfilled job. Our platform allows applicants to link up with their colleagues or friends, and establish new connections with other users on the platform.</p>
    
</div>

</body>
</html>