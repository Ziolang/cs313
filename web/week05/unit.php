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
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['accessory']) as $ac) {
						echo "<br/>Accessory: " . $ac['name'] . " (" . $ac['effect'] . ")";
					}
					foreach ($db->query("SELECT * FROM SkillSet WHERE SkillSet.id =" . $unit['aability']) as $aa) {
						echo "<br/>A-Ability: " . $aa['name'];

						foreach ($db->query("SELECT * FROM Skills WHERE Skills.id =" . $aa['skill1']) as $sk1) {
							echo "<br/>+ " . $sk1['name'] . ": ";
							if ($sk1['stat'] != NULL)
								echo $sk1['dmg'] . " " . $sk1['stat'] . " Damage. ";
							if ($sk1['effect'] != NULL)
								echo $sk1['effect'] . " ";
							echo "Range: " . $sk1['range'] . ". " . $sk1['mp'] . " MP.";
						}

						foreach ($db->query("SELECT * FROM Skills WHERE Skills.id =" . $aa['skill2']) as $sk2) {
							echo "<br/>+ " . $sk2['name'] . ": ";
							if ($sk2['stat'] != NULL)
								echo $sk2['dmg'] . " " . $sk2['stat'] . " Damage. ";
							if ($sk2['effect'] != NULL)
								echo $sk2['effect'] . " ";
							echo "Range: " . $sk2['range'] . ". " . $sk2['mp'] . " MP.";
						}
					}
					
				}
				?>
			</div>
			<div class="col-sm-2">


			</div>
		</div>

	</div>
</body>