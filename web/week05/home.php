<?php 
	include "connect.php";
	$db = connect();
?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="week05.css">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
  		<div class="row">
			<?php include "navbar.php";?>
		</div>
	</div>
	<div class="container">
		<div class="row">
	<?php 
		$count = 0;
		foreach ($db->query("SELECT * FROM Units") as $row) {
			if ($count == 3) { echo  '</div><div class="row">';}
			$url = "result.php?" ."id=" . $row['id'];
			echo "<div class=\"select col-sm-4\"><h1>
				<a class=\"centered unitresult\" href=\"$url\">" . 
				$row['name'] . "</h1>The Level " . 
				$row['lvl'] . " " . 
				$row['class'] . "</a><br/></div>";

			$count++;
		}
	?>

		</div>

	</div>
</body>