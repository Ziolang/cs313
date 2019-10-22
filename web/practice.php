<?php
require "connect.php";
$db = get_db();
?>

<!DOCTYPE html>
<head>
</head>
<body>
	<h1>Scripture Resources</h1>
<?php

	foreach ($db->query("SELECT * FROM Scriptures WHERE Scriptures.book = '$book'") as $row) {
		$url = "result.php?" ."id=" . $row['id'];
		echo "<b><a href=\"$url\">" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - </a></b><br/>";
	}

?>

	<form name="search" action="practice.php" method="post">
		Search Book: <input type="text" name="book" /> <input type="submit" value="Search"><br/>
	</form>
</body>