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
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

	foreach ($db->query("SELECT * FROM Scriptures WHERE Scriptures.book = '$book'") as $row) {
	}

?>

	<form name="insert" action="practice.php" method="post">
		Add Scripture: Book: <input type="text" name="book" /> Chapter: <input type="text" name="chapter" /> Verse: <input type="text" name="verse" /> <br/>
		Comment: <input type="textarea" name="comment" />
		Topic: 
		<?php
			foreach ($db->query("SELECT * FROM topic") as $row) {
				echo "test";
				echo '<input type="checkbox" name="topic' . $row['id'] . '" value="' . $row['name'] . '" ><br/>';
		}
		?>

		<br/><input type="submit" value="Search"><br/>
	</form>
</body>