<?php
$servername = "localhost";
$username = "root";
$password = "";


if (isset($_GET['all'])) {
	$conn = new mysqli($servername, $username, $password);
	$stmt = $conn->prepare("SELECT * FROM email_db.emails");
	$stmt->execute();
	$res = $stmt->get_result(); //necessary to print results 9___9
	$outp = $res->fetch_all(MYSQLI_ASSOC);  //necessary to print results 9___9
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	//var_dump(array('obj1' => $outp, 'obj2' => $outp2)); //throws err if uncommented together w the json header
	echo json_encode($outp);
	$conn->close();
}

if (isset($_GET['distinct'])) {
	$conn = new mysqli($servername, $username, $password);
	$stmt = $conn->prepare("SELECT DISTINCT email_provider FROM email_db.emails");
	$stmt->execute();
	$res = $stmt->get_result();
	$outp = $res->fetch_all(MYSQLI_ASSOC);
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	echo json_encode($outp);
	$conn->close();
}


if (isset($_GET['filter'])) {
	$domain = $_GET['filter'];
	$conn = new mysqli($servername, $username, $password);
	$stmt = $conn->prepare("SELECT * FROM email_db.emails WHERE email_provider = ?");
	$stmt->bind_param("s", $domain);
	$stmt->execute();
	$res = $stmt->get_result();
	$outp = $res->fetch_all(MYSQLI_ASSOC);
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	//var_dump($outp);
	echo json_encode($outp);
	$conn->close();
}


if (isset($_GET['sortby'])) {
	$sortby = $_GET['sortby'];
   	$conn = new mysqli($servername, $username, $password);
   	if($sortby === 'email') { $stmt = $conn->prepare("SELECT * FROM email_db.emails ORDER BY email"); }
	else if($sortby === 'created_at') { $stmt = $conn->prepare("SELECT * FROM email_db.emails ORDER BY created_at"); } //binding didn't work here idk y. If the computer says no that means no.
   	else { die("Can't sort by this param :@"); }
   	$stmt->execute();
   	$res = $stmt->get_result();
   	$outp = $res->fetch_all(MYSQLI_ASSOC);
   	//var_dump($outp);
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	echo json_encode($outp);
	$conn->close();
}

if (isset($_GET['search'])) {
	$q = $_GET['search'];
	$conn = new mysqli($servername, $username, $password);
	$stmt = $conn->prepare("SELECT * FROM email_db.emails WHERE email LIKE CONCAT('%', ?, '%')");
	$stmt->bind_param("s", $q);
 	$stmt->execute();
	$res = $stmt->get_result();
	$outp = $res->fetch_all(MYSQLI_ASSOC);
	if (count($outp) === 0) { echo "No results found";}
	else {
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		echo json_encode($outp);
	}
	$conn->close();
}

/*if(isset($_GET)) {
	$q = $_GET['search'];
	$sortby = $_GET['sortby'];
	$filter = $_GET['filter'];
	$conn = new mysqli($servername, $username, $password);


	if($sortby === 'email') { $stmt = $conn->prepare("SELECT * FROM email_db.emails ORDER BY email"); }
	else if($sortby === 'created_at') { $stmt = $conn->prepare("SELECT * FROM email_db.emails ORDER BY created_at"); } //binding didn't work here idk y. If the computer says no that means no.
}*/

?>
