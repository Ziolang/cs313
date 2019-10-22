<!DOCTYPE html>
<head>
</head>
<body>
	<h1>Scripture Resources</h1>
<?php
	
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

	foreach ($db->query("SELECT Scriptures.*, topic.* 
				FROM Scriptures 
				JOIN ScriptureToTopics 
				ON Scriptures.id = ScriptureToTopics.scripture_id 
				JOIN topic
				ON ScriptureToTopics.topic_id = topic.id") as $row) {
		echo "<b>" . $row['Scriptures.book'] . " " . $row['Scriptures.chapter'] . ":" . $row['Scriptures.verse'] . " - </b>";
        echo '"' . $row['Scriptures.content'] . '"<br><br>';
	}

?>
</body>