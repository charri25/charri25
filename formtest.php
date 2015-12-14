<?php

require_once 'includes/login.php';
require_once 'includes/functions.php';
include_once 'includes/header.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['name']) && isset($_POST['source']))
{
	if ($_POST['source']=="Player") { 
	$name = sanitizeMySQL($conn, $_POST['name']);
	$query = 'SELECT * FROM players NATURAL JOIN fide NATURAL JOIN uscf WHERE name_last="'.$name.'"';
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
	} }
 elseif ($_POST['source']=="Game") {
 $name = sanitizeMySQL($conn, $_POST['name']);
	$query = 'SELECT * FROM games WHERE date="'.$name.'"';
	$result = $conn->query($query);
	if (!$result) die ("Invalid search term.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No game found with id of $name<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
		echo '<h1>Game Information</h1>';
			echo "<table><tr> <th>Player White</th><th>Player Black</th><th>Winner</th><th>Date</th><th>Time</th><th>Game</th>
		<th>Tournament</th></tr>";
		echo '<tr>';
	echo "<td>"."<a href=\"viewplayer.php?id=".$row["player_id"]."\">".$row["player_white"]."</td><td>";
	echo "<a href=\"viewplayer.php?id=".$row["player_id"]."\">".$row["player_black"]."</td>";
	echo "<td>".$row["winner"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td>";
	echo "<td>".$row["game_id"]."</td><td>";
	echo "<a href=\"viewtournament.php?id=".$row["tournament_id"]."\">".$row["tournament_id"]."</td>";		
	echo '</tr></table>';	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} } 
elseif ($_POST['source']=="Tournament") {
 $name = sanitizeMySQL($conn, $_POST['name']);
	$query = 'SELECT * FROM tournaments WHERE name="'.$name.'"';
	$result = $conn->query($query);
	if (!$result) die ("Invalid search term.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No tournament found with id of $name<br>";
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
	}} }
include_once 'includes/footer.php';
?>