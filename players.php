<?php

include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT name_last, name_first, state, sex, b_year, player_id, fide_id, fide_score, uscf_id, uscf_score
 FROM players NATURAL JOIN fide NATURAL JOIN uscf;";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

echo "<table><tr> <th>Id</th> <th>Last Name</th><th>First Name</th><th>Sex</th><th>Birth Year</th><th>Fide ID</th><th>Fide Rating</th>
		<th>USCF ID</th><th>USCF Rating</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>".$row["player_id"]."</td><td>";
	echo "<a href=\"viewplayer.php?id=".$row["player_id"]."\">".$row["name_last"]."</a></td>";
	echo "<td>".$row["name_first"]."</td><td>".$row["sex"]."</td><td>".$row["b_year"]."</td>";
	echo "<td>".$row["fide_id"]."</td><td>".$row["fide_score"]."</td><td>".$row["uscf_id"]."</td><td>".$row["uscf_score"]."</td>";		
	echo '</tr>';
}

echo "</table>";

include_once 'includes/form.php';


?>