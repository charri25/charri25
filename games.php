<?php

include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM games NATURAL JOIN players;";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

echo "<table><tr> <th>Player White</th><th>Player Black</th><th>Winner</th><th>Date</th><th>Time</th><th>Game</th>
		<th>Tournament</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td><a href=\"viewplayer.php?id=".$row["player_id"]."\">".$row["player_white"]."</a></td>";
	echo "<td><a href=\"viewplayer.php?id=".$row["player_id"]."\">".$row["player_black"]."</a></td>";
	echo "<td>".$row["winner"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td><td>";
	echo "<a href=\"viewgame.php?id=".$row["game_id"]."\">".$row["game_id"]."</a><td>";
	echo "<a href=\"viewtournament.php?id=".$row["tournament_id"]."\">".$row["tournament_id"]."</td>";		
	echo '</tr>';
}

echo "</table>";

include_once 'includes/form.php';


?>