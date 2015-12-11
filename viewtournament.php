<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT * FROM tournaments WHERE tournament_id=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid tournament id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No tournament found with id of $id<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Tournament Information</h1>';
			echo "<table><tr> <th>Id</th> <th>Name</th><th>Director</th><th>State</th><th>City</th>
					<th>Start Date</th><th>End Date</th>";
	echo '<tr>';
	echo "<td>".$row["tournament_id"]."</td><td>";
	echo $row["name"]."</a></td>";
	echo "<td>".$row["director"]."</td><td>".$row["location_state"]."</td><td>".$row["location_city"]."</td>";
	echo "<td>".$row["date_start"]."</td><td>".$row["date_end"]."</td>";	
	echo '</tr></table>';			
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} else {
	echo "No pet id passed";
}

?>
