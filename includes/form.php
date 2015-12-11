<!DOCTYPE html>
<?php 
if (isset($_POST['name'])) { 
	$name = $_POST['name'];
} else { 
	$name = "(Not entered)";
}
?>
<html>
<head>
<title>Form Test</title>
</head>
<body>
<form method="post" action="formtest.php">
<select name="source">
  <option value="Player" selected>Player</option>
  <option value="Game">Game</option>
  <option value="Tournament">Tournament</option>
</select>
<input type="text" name="name">
<input type="submit">
</form>



</body>
</html>