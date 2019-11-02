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
  	<script src="checklvlup.js"></script>
  	<script src="calcmp.js"></script>
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
			<div class="search col-sm-6">
				<?php 
				echo '<form onsubmit="return checklvlup()" action="finalizelvlup.php?id=' . $_GET['id'] . '" method="post">
					<h1>Level Up</h1>'
					
					$newlvl = 1;
					$unit = "";
					
					foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $x) {
						$unit = $x;
						echo '<input name="id" style="visibility:hidden;" value="' . $x['id'] . '">';
						echo '<input name="lvl" style="visibility:hidden;" value="' . $x['lvl'] . '">';
					}
					$newlvl += $unit['lvl'];
					echo "<h2>New Level: $newlvl</h2><br/> <h3 id=\"statpts\">3 Stat Points gained</h3><br/>";

					echo "
							<span id=\"caption\">3</span> Stat Points Remaining
						<table>
  							<tr>
    							<th>Current --- </th>
    							<th>Stats</th>
    							<th> --- </th>
    							<th>Add</th>
    							<th> --- </th>
    							<th>New Value</th>
    						</tr>
    						<tr>
    							<td>HP</td>
    							<td>" . $unit['hp'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('hp')\">+</button></td>
    							<td>+<span id=\"hp\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('hp')\">-</button></td>
    							<td><input id=\"hp2\" name=\"hp\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>MP</td>
    							<td>" . $unit['mp'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('mp')\"> +</button></td>
    							<td>+<span id=\"mp\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('mp')\">-</button></td>
    							<td><input id=\"mp2\" name=\"mp\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Atk</td>
    							<td>" . $unit['atk'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('atk')\">+</button></td>
    							<td>+<span id=\"atk\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('atk')\">-</button></td>
    							<td><input id=\"atk2\" name=\"atk\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Def</td>
    							<td>" . $unit['def'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('def')\">+</button></td>
    							<td>+<span id=\"def\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('def')\">-</button></td>
    							<td><input id=\"def2\" name=\"def\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Int</td>
    							<td>" . $unit['int'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('int')\">+</button></td>
    							<td>+<span id=\"int\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('int')\">-</button></td>
    							<td><input id=\"int2\" name=\"int\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
    						<tr>
    							<td>Spr</td>
    							<td>" . $unit['spr'] . "</td>
    							<td><button type=\"button\" onclick=\"upStat('spr')\">+</button></td>
    							<td>+<span id=\"spr\">0</span></td>
    							<td><button type=\"button\" onclick=\"downStat('spr')\">-</button></td>
    							<td><input id=\"spr2\" name=\"spr\" style=\"visibility:hidden;\" value=\"0\"></td>
    						</tr>
						</table>";

						
					?>	
				</div>
			</div>
			<div class="row">
				<div class="search col-sm-12">
						<h2>Create New Skill</h2>
						Name: <input type="text" name="s1name" onchange="calculateMP()" required><br/><br/>
						Damage in Percent (If non-damaging skill, set to 0): <input type="number" name="s1dmg" min="0" max="1000" step="10" value="100" size="6" onchange="calculateMP()"><br/><br/>
						Damage type: <select name="s1type" onchange="calculateMP()">
							<option value="atk">Attack stat damage</option>s
							<option value="int">Intelligence stat damage</option>
						</select><br/><br/>
						Effect(s): Chance of Status Affliction: <select name="s1status" onchange="calculateMP()">
							<option value="0" selected>None</option>
							<option value="Bleed">Bleed</option>
							<option value="Poison">Poison</option>
							<option value="Burn">Burn</option>
							<option value="Stun">Stun</option>
							<option value="Freeze">Freeze</option>
							<option value="Immobilize">Immobilize</option>
							<option value="Disable">Disable</option>
						</select><br/><br/>
						Buffs/Debuffs: <select name="s1buff" onchange="calculateMP()">
							<option value="0" selected>None</option>
							<option value="Increase">Increase</option>
							<option value="Decrease">Decrease</option>
						</select> <select name="s1buffstat" onchange="calculateMP()">
							<option value="Atk" selected>Atk</option>
							<option value="Def">Def</option>
							<option value="Int">Int</option>
							<option value="Spr">Spr</option>
							<option value="Atk and Def">Atk and Def</option>
							<option value="Int and Spr">Int and Spr</option>
							<option value="Def and Spr">Def and Spr</option>
						</select>
						by <input type="number" name="s1buffamt" min="0" max="100" step="10" value="0" size="3" onchange="calculateMP()">% for 3 turns.
						<br/><br/>
						Other Effects: <select name="s1other" onchange="calculateMP()">
							<option value="0" selected>None</option>
							<option value="Knockback">Knockback</option>
							<option value="Hits 2 times">Hits 2 times</option>
							<option value="1 cell AoE">1 cell AoE</option>
							<option value="2 cell AoE">2 cell AoE</option>
							<option value="Line-shape area">Line-shape area.</option>
							<option value="Cone-shape area">Cone-shape area.</option>
						</select><br/><br/>
						Range: <input type="number" name="s1range" min="0" max="99" step="1" value="0" size="2" onchange="calculateMP()" required> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/><br/>
						MP: <span id="s1mpview">0</span>. (MP is auto-defined as you go.) <input name="s1mp" style="visibility:hidden;">
						<input type="submit">
				</div>
			</div>
		</form>

	</div>
</body>