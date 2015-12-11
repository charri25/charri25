<?php

include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM tournaments;";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

echo "<table><tr> <th>Id</th> <th>Name</th><th>Director</th><th>State</th><th>City</th>
					<th>Start Date</th><th>End Date</th>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>".$row["tournament_id"]."</td><td>";
	echo "<a href=\"viewtournament.php?id=".$row["tournament_id"]."\">".$row["name"]."</a></td>";
	echo "<td>".$row["director"]."</td><td>".$row["location_state"]."</td><td>".$row["location_city"]."</td>";
	echo "<td>".$row["date_start"]."</td><td>".$row["date_end"]."</td>";		
	echo '</tr>';
}

echo "</table>";

include_once 'includes/form.php';


?>