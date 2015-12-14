<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT * FROM games JOIN players ON player_id WHERE game_id=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid game id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No game found with id of $id<br>";
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
	echo '</tr></table>';			
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} else {
	echo "No game id passed";
}
include_once 'includes/form.php';
include_once 'includes/footer.php';
?>
