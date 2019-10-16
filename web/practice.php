<!DOCTYPE html>
<head>
</head>
<body>
	<p>Testing 1</p> 

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
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

	foreach ($db->query('SELECT * FROM Scriptures') as $row)
	{
  		echo $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '<br/>"' . $row['content'] . '"<br/>';
	}

?>


<p>Testing 2</p>
</body>