
<?php

include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

include_once 'includes/form.php';
echo "<strong>Search by Last Name, Tournament Name or Game ID</strong></br>";
echo "Browse</br>";
echo "<a href=\"players.php\">Players</a></br>";
echo "<a href=\"games.php\">Games</a></br>";
echo "<a href=\"tournaments.php\">Tournaments</a></br>";
include_once 'includes/footer.php';

?>