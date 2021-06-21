<?php
$servername = "localhost";
$username = "root";
$password = "";

//GOTTA PREVENT SQLi!!! AND RCE!!!! HELOOOOOOOOOOOOOOOOO

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$id = $_GET['id'];
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	$stmt = $conn->prepare("DELETE FROM email_db.emails WHERE id =?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	echo 'done!';
	$conn->close();
}
?>
