<?php 
include "DB.php";

function viewMyConnection($username) {
	global $connection;
	$query = "(SELECT * FROM connection INNER JOIN person ON connection.User_Username = person.Username";
				$query .= " WHERE connection.Connection_Username = \"" . $username . "\")";
				$query .= " UNION";
				$query .= "(SELECT * FROM connection INNER JOIN person ON connection.Connection_Username = person.Username";
				$query .= " WHERE connection.User_Username = \"" . $_SESSION['username'] . "\")";
				$result = mysqli_query($connection, $query);
				if (!$result) {
					die("Query Failed" . mysqli_error($connection));
				}
				while($row = mysqli_fetch_assoc($result)){   
					echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . $row['Physiological_Info'] . "</td><td>" . $row['Work_Experience'] . "</td><td>" . $row['Education'] . "</td></tr>";
				}
}

function viewMyRequest($username) {
	global $connection;
	$query = "SELECT * FROM request INNER JOIN person ON Sender_Username = Username";
			$query .= " WHERE Receiver_Username = \"" . $username . "\"";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Query Failed" . mysqli_error($connection));
			}
			while($row = mysqli_fetch_assoc($result)){   
				echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['Name'] . "</td>";
				echo "<td><button type = \"submit\" name = \"accept\" value = ".$row['Username'] .">Accept?</button></td>";
				echo "<td><button type = \"submit\" name = \"reject\" value = ".$row['Username'] .">Reject X</button></td></tr>";
			}
}

function viewReviews($company) {
	global $connection;
	$query = "SELECT * FROM review NATURAL JOIN person";
		$query .= " WHERE CompanyName = \"" . $company . "\"";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		} else if (mysqli_num_rows($result) <= 0) {
			echo $_GET['company'] . ' does not have any reviews yet.';
		} else {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<p style=\"margin-top: 2%; font-size: 16px;\">". $row['Username'] . " reviewed: </p>";
				echo "<p style=\"margin-top: 2%; font-size: 16px;\">Rate: ";
				for($i=0; $i< $row['Rating']; $i++) {
					echo "<img src=../View/star.png alt=\"Image\" width=20 height=20>";
				}
				echo "</p>";
				echo "<p style=\"margin-top: 2%; font-size: 16px;\">Comment: " . $row['Comment'] . "</p>";
				echo "<br><br>";
			}
		}

}