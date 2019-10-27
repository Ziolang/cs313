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
  	<script src="levelup.js"></script>
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
				<?php
				$db = connect();

				
				foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $unit) {
					echo "<h1>" . $unit['name'] . "</h1><br/><strong>Level:</strong> " . $unit['lvl'] . "<br/><strong>Experience:</strong> " . $unit['exp'] . "<br/><strong>Class:</strong> " . $unit['class'] . "<br/><strong>Weapon:</strong> ";
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
					foreach ($db->query("SELECT * FROM SkillSet WHERE SkillSet.id =" . $unit['aability']) as $aa) {
						echo "<br/><strong>A-Ability:</strong> " . $aa['name'];

						foreach ($db->query("SELECT * FROM Skills WHERE Skills.id =" . $aa['skill1']) as $sk1) {
							echo "<br/><strong>+ " . $sk1['name'] . ":</strong> ";
							if ($sk1['dmg'] > 0)
								echo $sk1['dmg'] . "% " . $sk1['stat'] . " Damage. ";
							if ($sk1['effect'] != NULL)
								echo $sk1['effect'] . " ";
							echo "Range: " . $sk1['range'] . ". " . $sk1['mp'] . " MP.";
						}

						foreach ($db->query("SELECT * FROM Skills WHERE Skills.id =" . $aa['skill2']) as $sk2) {
							echo "<br/><strong>+ " . $sk2['name'] . ":</strong> ";
							if ($sk2['dmg'] > 0)
								echo $sk2['dmg'] . "% " . $sk2['stat'] . " Damage. ";
							if ($sk2['effect'] != NULL)
								echo $sk2['effect'] . " ";
							echo "Range: " . $sk2['range'] . ". " . $sk2['mp'] . " MP.";
						}
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

					echo "<br/><strong>HP:</strong> " . $unit['hp'] .
						"<br/><strong>MP:</strong> " . $unit['mp'] .
						"<br/><strong>Atk:</strong> " . $unit['atk'] .
						"<br/><strong>Def:</strong> " . $unit['def'] .
						"<br/><strong>Int:</strong> " . $unit['int'] .
						"<br/><strong>Spr:</strong> " . $unit['spr'] .
						"<br/><strong>Crit:</strong> " . $unit['crit'] .
						"<br/><strong>Eva:</strong> " . $unit['eva'] .
						"<br/><strong>Move:</strong> " . $unit['move'];
				}
				?>
			</div>
			<div class="col-sm-6">
				<form>
					<h1>Level Up</h1>
					<?php 
					$newlvl = 1;
					$unit = "";
					foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $x) {
						$unit = $x;
					}
					echo "<h2>New Level: $newlvl</h2><br/> <h3 id=\"statpts\">3 Stat Points gained</h3><br/>";

					echo "
						<table>
							<caption><span id=\"caption\">3</span> Stat Points Remaining</caption>
  							<tr>
    							<th>Stat</th>
    							<th>Current</th>
    							<th>Use Points</th>
    							<th>Points Added</th>
    						</tr>
    						<tr>
    							<td>HP</td>
    							<td>" . $unit['hp'] . "</td>
    							<td><button onclick=\"upStat(\"hp\")\"><button onclick=\"downStat(\"hp\")\"></td>
    							<td>+<span id=\"hp\">0</span><input id=\"hp2\" name=\"hp\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>MP</td>
    							<td>" . $unit['mp'] . "</td>
    							<td><button onclick=\"upStat(\"mp\")\"><button onclick=\"downStat(\"mp\")\"></td>
    							<td>+<span id=\"mp\">0</span><input id=\"mp2\" name=\"mp\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Atk</td>
    							<td>" . $unit['atk'] . "</td>
    							<td><button onclick=\"upStat(\"atk\")\"><button onclick=\"downStat(\"atk\")\"></td>
    							<td>+<span id=\"atk\">0</span><input id=\"atk2\" name=\"atk\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Def</td>
    							<td>" . $unit['def'] . "</td>
    							<td><button onclick=\"upStat(\"def\")\"><button onclick=\"downStat(\"def\")\"></td>
    							<td>+<span id=\"def\">0</span><input id=\"def2\" name=\"def\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Int</td>
    							<td>" . $unit['int'] . "</td>
    							<td><button onclick=\"upStat(\"int\")\"><button onclick=\"downStat(\"int\")\"></td>
    							<td>+<span id=\"int\">0</span><input id=\"int2\" name=\"int\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Spr</td>
    							<td>" . $unit['spr'] . "</td>
    							<td><button onclick=\"upStat(\"spr\")\"><button onclick=\"downStat(\"spr\")\"></td>
    							<td>+<span id=\"spr\">0</span><input id=\"spr2\" name=\"spr\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
						</table>"
					?>	

			</div>
		</div>

	</div>
</body>