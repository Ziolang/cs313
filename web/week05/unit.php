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
			<div class="col-sm-1">


			</div>
			<div class="search col-sm-10">
				<?php

				
				foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $unit) {
					echo "<h1>" . $unit['name'] . "</h1></div><div class=\"col-sm-1\"></div></div>
						<div class=\"row\">
							<div class=\"col-sm-1\"></div>
							<div class=\"search col-sm-5\">
							<strong>Level:</strong> " . $unit['lvl'] . "<br/><strong>Experience:</strong> " . $unit['exp'] . "<br/><strong>Class:</strong> " . $unit['class'] . "<br/><strong>Weapon:</strong> ";
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon1']) as $w1) {
						echo $w1['name'] . " (" . $w1['effect'] . ")";
					}
					if ($unit['weapon2'] != NULL)
						foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon2']) as $w2) {
							echo "<br/><strong>Weapon2:</strong> " . $w2['name'] . " (" . $w2['effect'] . ")";
						}
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['armor']) as $ar) {
						echo "<br/><strong>Armor:</strong> " . $ar['name'] . " (" . $ar['effect'] . ")";
					}
					foreach ($db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['accessory']) as $ac) {
						echo "<br/><strong>Accessory:</strong> " . $ac['name'] . " (" . $ac['effect'] . ")";
					}

					foreach ($db->query("SELECT * FROM Abilities WHERE Abilities.id =" . $unit['sability']) as $sa) {
						echo "<br/><strong>S-Ability:</strong> " . $sa['name'] . ": " . $sa['effect'];
					}

					echo "<br/><strong>R-Ability:</strong> ";
					if ($unit['rability'] != NULL) {
						foreach ($db->query("SELECT * FROM Abilities WHERE Abilities.id =" . $unit['rability']) as $ra) {
							echo $ra['name'] . ": " . $ra['effect'];
						}
					}
					else {
						echo "None.";
					}
					echo "</div><div class=\"search col-sm-3\">";
					echo "<strong>HP:</strong> " . $unit['hp'] .
						"<br/><strong>MP:</strong> " . $unit['mp'] .
						"<br/><strong>Atk:</strong> " . $unit['atk'] .
						"<br/><strong>Def:</strong> " . $unit['def'] .
						"<br/><strong>Int:</strong> " . $unit['int'] .
						"<br/><strong>Spr:</strong> " . $unit['spr'] .
						"<br/><strong>Crit:</strong> " . $unit['crit'] .
						"<br/><strong>Eva:</strong> " . $unit['eva'] .
						"<br/><strong>Move:</strong> " . $unit['move'] . 
						"</div>
								<div class=\"search col-sm-2\">
									<a class=\"unitbtn\" href=\"levelup.php?id=\"" . $_GET['id'] . ">LEVEL UP</a>
									<br/>
									<br/>
									<br/>
									<a class=\"unitbtn\" href=\"delete.php\">DELETE UNIT</a>
								</div>
								<div class=\"col-sm-1\"></div>
							</div>
							<div class=\"row\">
								<div class=\"col-sm-1\"></div>
								<div class=\"search col-sm-10\">";

					foreach ($db->query("SELECT * FROM SkillSet WHERE SkillSet.id =" . $unit['aability']) as $aa) {
						echo "<br/><strong>A-Ability:</strong> " . $aa['name'];

						$skillx = "skill";
						for ($x = 1; $x < 10; $x++) {
							$skillx .= $x;

							if (!is_null($aa[$skillx])) {
								foreach ($db->query("SELECT * FROM Skills WHERE Skills.id =" . $aa[$skillx]) as $sk) {
									echo "<br/><br/><strong>+ " . $sk['name'] . ":</strong> ";
								
									if ($sk['dmg'] > 0)
										echo $sk['dmg'] . "% " . $sk['stat'] . " Damage. ";
								
									if ($sk['effect'] != NULL)
										echo $sk['effect'] . " ";
								
									echo "Range: " . $sk['range'] . ". " . $sk['mp'] . " MP.";
								}
							}
							$skillx = "skill";
						}
					}
					echo "</div><div class=\"col-sm-1\"></div></div>";
					
				}
				?>
			</div>
	</div>
</body>