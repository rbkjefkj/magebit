<?php
$servername = "localhost";
$username = "root";
$password = "";
//$sql = "SELECT DISTINCT email_provider FROM email_db.emails";
//THIS JSON WORKS WOOHOO
if (isset($_GET['x'])) {
	if ($_GET['x'] === 'email') {
		$conn = new mysqli($servername, $username, $password);
		$stmt = $conn->prepare("SELECT * FROM email_db.emails");
		//$stmt->bind_param("s", $_GET['x']);
		$stmt->execute();
		$result = $stmt->get_result();
		$outp = $result->fetch_all(MYSQLI_ASSOC);
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		echo json_encode($outp);
	}
}
?>
