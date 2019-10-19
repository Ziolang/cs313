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
			<div class="col-sm-2">


			</div>
			<div class="search col-sm-8">
				<?php
				$db = connect();

				
				foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $unit) {
					echo "<h1>" . $unit['name'] . "</h1><br/>Level: " . $unit['lvl'] . "<br/>Experience: " . $unit['exp'] . "<br/>Class: " . $unit['class'] . "<br/>Weapon: ";
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon1']) as $w1) {
						echo $w1['name'] . " (" . $w1['effect'] . ")";
					}
					if ($unit['weapon2'] != NULL)
						foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon2']) as $w2) {
							echo "<br/>Weapon2: " . $w2['name'] . " (" . $w2['effect'] . ")";
						}
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['armor']) as $ar) {
						echo "<br/>Armor: " . $ar['name'] . " (" . $ar['effect'] . ")";
					}
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['armor']) as $ac) {
						echo "<br/>Accessory: " . $ac['name'] . " (" . $ac['effect'] . ")";
					}
					foreach ($db->query("SELECT * FROM SkillSet WHERE SkillSet.id =" . $unit['A_Ability']) as $aa) {
						echo "<br/>A-Ability: " . $aa['name'];

						
					}
					
				}
				?>
			</div>
			<div class="col-sm-2">


			</div>
		</div>

	</div>
</body>