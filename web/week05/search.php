<?php include "connect.php";?>

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
			<div class="search col-sm-6">
				<form action="search.php?id=1" method="post">
					<h1 class="center">Search Units by Name</h1><br/> 
					<input type="text" name="name" placeholder="Enter a name..."><br/>
					<input type="submit" name="byName" value="Search">
				</form>
				<br/>
				<br/>

				<?php 
					if (isset($_GET["id"]))
						if ($_GET["id"] = 1) {
							$db = connect();
							$name = $_POST['name'];

							foreach ($db->query("SELECT * FROM Units WHERE Units.name = '$name'") as $row) {
								$url = "result.php?" ."id=" . $row['id'];
								echo "<b><a class=\"unitresult\" href=\"$url\">" . $row['name'] . " the Level " . $row['lvl'] . " " . $row['class'] . "</a></b><br/>";
							}
						}
				?>
			</div>
			<div class="search col-sm-6">
				<form action="search.php?id=2" method="post">
					<h1 class="center">Search Units by Stat</h1><br/> 
					Stat: <select name="stat">
						<option value="lvl">Level</option>
						<option value="atk">Attack</option>
						<option value="def">Defense</option>
						<option value="int">Intelligence</option>
						<option value="spr">Spirit</option>
						<option value="crit">Critical</option>
						<option value="eva">Evasion</option>
					</select> &nbsp&nbsp&nbsp
					Amount: <input type="text" name="statNum" placeholder="Enter a number..."><br/>
					<input type="submit" name="byStat" value="Search">
				</form>
				<?php 
					if (isset($_GET["id"]))
						if ($_GET["id"] = 2) {
							$db = connect();
							$stat = $_POST['stat'];
							$x = $_POST['statNum'];

							foreach ($db->query("SELECT * FROM Units WHERE Units.$stat = $x") as $row) {
								$url = "unit.php?" ."id=" . $row['id'];
								echo "<b><a class=\"unitresult\" href=\"$url\">" . $row['name'] . " the Level " . $row['lvl'] . " " . $row['class'] . "</a></b><br/>";
							}
						}
				?>
			</div>
		</div>

	</div>
</body>