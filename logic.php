<?php
$servername = "localhost";
$username = "root";
$password = "";

//XSS protection
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS email_db";
if ($conn->query($sql) === TRUE) {
 echo "Database created successfully";
} else {
 echo "Error creating database: " . $conn->error;
}

//Create table
$sql = "CREATE TABLE IF NOT EXISTS email_db.emails (
   id INT AUTO_INCREMENT,
   email VARCHAR(255) NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   email_provider VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) {
 echo "Table created successfully";
} else {
 echo "Error creating table: " . $conn->error;
}


$email = $checkbox = "";
$emailErr = $checkboxErr = "";
$valid = true;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
			$valid = false;
		} else {
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //idk wut the orange ting
	  	 		$emailErr = "Invalid email format";
				$valid = false;
			}
		}

		if (!isset($_POST["checkbox"])) {
			$checkboxErr = "You must agree to terms of service";
			$valid = false;
		}

		if ($valid) {
			$rex = "/(?<=\@)(.*?)(?=\.)/";
			$matches = array();
			preg_match($rex, $email, $matches);
			$emailProvider = $matches[0];

			$stmt = $conn->prepare("INSERT INTO email_db.emails(email, email_provider)
			VALUES(?, ?)");
			$stmt->bind_param("ss", $email, $emailProvider);
			$stmt->execute();
			$stmt->close();
			echo "Success!";
/*
			if ($conn->query($sql) === TRUE) {
				echo "New email address added";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}*/
		}

		//$stmt->close();
}
?>
