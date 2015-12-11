<?php

require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['name']))
{
	$name = sanitizeMySQL($conn, $_POST['name']);
	$query = "SELECT * FROM players WHERE name_last=".$name;
	$result = $conn->query($query);
	if (!$result) die ("Invalid search term.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No player found with id of $name<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Player Informtation</h1>';
			echo "<table><tr> <th>Id</th> <th>Last Name</th><th>First Name</th><th>Sex</th><th>Birth Year</th><th>Fide ID</th><th>Fide Rating</th>
		<th>USCF ID</th><th>USCF Rating</th></tr>";
		echo '<tr>';
	echo "<td>".$row["player_id"]."</td><td>";
	echo $row["name_last"]."</td>";
	echo "<td>".$row["name_first"]."</td><td>".$row["sex"]."</td><td>".$row["b_year"]."</td>";
	echo "<td>".$row["fide_id"]."</td><td>".$row["fide_score"]."</td><td>".$row["uscf_id"]."</td><td>".$row["uscf_score"]."</td>";		
	echo '</tr></table>';			
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} 

?>