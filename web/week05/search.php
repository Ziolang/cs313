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
				<form action="search.php" method="post">
					<h1 class="center">Search Units by Name</h1><br/> 
					<input type="text" name="name"><br/>
					<input type="submit" name="byName">
				</form>
			</div>
			<div class="search col-sm-6">
				<form action="search.php" method="post">
					<h1 class="center">Search Units by Stat</h1><br/> 
					<select name="stat">
						<option value="lvl">Level</option>
						<option value="atk">Attack</option>
						<option value="def">Defense</option>
						<option value="int">Intelligence</option>
						<option value="spr">Spirit</option>
						<option value="crit">Critical</option>
						<option value="eva">Evasion</option>
					</select> &nbsp&nbsp&nbsp
					<input type="text" name="statNum"><br/>
					<input type="submit" name="byStat">
				</form>
			</div>
		</div>

	</div>
</body>

<?php 
					$db = connect();

					foreach ($db->query("SELECT * FROM Units") as $unit) {
						$url = "result.php?" ."id=" . $unit['id'];
						echo "<a href=\"$url\">" . $unit['name'] . "</a>";
					}
				?>