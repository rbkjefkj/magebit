<!DOCTYPE html>
<html>
<head>
<style>
	body {
		display: flex;
		flex-direction: column;
	}

	td { padding: 10px; }

	h2, td { text-align: center; }

	table, th, td {
  		border: 1px solid black;
	}

	table { width: 100%; }

	#sorter { margin: 0 30px 10px auto; }
</style>
</head>
<body>
	<script>
	 function sort(selection) {
		 //to make this work, would have to render JSON res data in a table using JS
		 //let xmlhttp = new XMLHttpRequest();
		 //xmlhttp.open("GET", "/sort.php?sortby=" + selection);
		 //xmlhttp.send();
		 location.replace('page.php?sortby=' + selection); //easier...
	 }
	</script>
<h2>SUBMITTED EMAIL ADDRESSES</h2>

<div id="sorter">
  <label for="sorter">SORT BY: </label>
  <select name="sorter" onchange="sort(this.value)">
	<option value="nothing">💎🎀</option>
    <option value="email">EMAIL</option>
    <option value="date">DATE</option>
  </select>
</div>

<table>
  <tr>
	<th>ID</th>
    <th>CREATED AT</th>
    <th>EMAIL</th>
    <th>DOMAIN</th>
	<th>DELETE</th>
	<th>EXPORT</th>
  </tr>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	if (empty($_GET)) {
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	  	$sql = "SELECT * FROM email_db.emails";
	  	foreach ($conn->query($sql) as $row) {
	    	echo "<tr>";
	    	echo "<td>" . $row['id'] . "</td>";
	    	echo "<td>" . $row['created_at'] . "</td>";
	    	echo "<td>" . $row['email'] . "</td>";
	    	echo "<td>" . $row['email_provider'] . "</td>";
			echo "<td><a class='danger' href='delete.php?id=".$row["id"]."'>DELETE</a></td>";
			echo "<td><input type='checkbox' class='export' id=" . $row["id"] . "></input></td>";
	    	echo "</tr>";
		}
	} else if (isset($_GET['sortby'])) {
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
		$sqlemail = "SELECT * FROM email_db.emails ORDER BY email";
		$sqldate = "SELECT * FROM email_db.emails ORDER BY created_at";
		if ($_GET['sortby'] === 'email' ) { $sql = $sqlemail; }
		else if ($_GET['sortby'] === 'date') { $sql = $sqldate; }
		foreach ($conn->query($sql) as $row) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['created_at'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['email_provider'] . "</td>";
			echo "<td><a class='danger' href='delete.php?id=".$row["id"]."'>DELETE</a></td>";
			echo "<td><input type='checkbox' class='export' id=" . $row["id"] . "></input></td>";
			echo "</tr>";
		}
  	}
?>

	</table>

	</body>
	</html>
