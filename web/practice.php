<!DOCTYPE html>
<head>
</head>
<body>
	<h1>Scripture Resources</h1>
<?php
	

	/*foreach ($db->query('SELECT * FROM Scriptures') as $row)
	{
  		echo "<b>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - </b>";
            echo '"' . $row['content'] . '"<br><br>';
	}*/

	if (isset($_POST['book'])) {
		try
	{
  		$dbUrl = getenv('DATABASE_URL');

  		$dbOpts = parse_url($dbUrl);

  		$dbHost = $dbOpts["host"];
  		$dbPort = $dbOpts["port"];
  		$dbUser = $dbOpts["user"];
  		$dbPassword = $dbOpts["pass"];
  		$dbName = ltrim($dbOpts["path"],'/');

  		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$book = $_POST['book'];
		$url = "result.php?" ."id=" . $row['id'];
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

	foreach ($db->query("SELECT * FROM Scriptures WHERE Scriptures.book = '$book'") as $row) {
		echo "<b><a href=\"$url\">" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - </a></b><br/>";
	}
}

?>

	<form name="search" action="practice.php" method="post">
		Search Book: <input type="text" name="book" /> <input type="submit" value="Search"><br/>
	</form>
</body>