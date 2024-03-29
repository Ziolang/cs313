<?php include "connect.php";
$db = connect();?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="week05.css">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  	<script src="newunit.js"></script>
</head>
<body>
	<div class="container">
  		<div class="row">
			<?php include "navbar.php";?>
		</div>
	</div>
	<div class="container">
  		<div class="row">
			<div class="search col-sm-12">
				<form action="createdunit.php" method="post">
					<h1>Create new level 1 unit.</h1>
					Unit Name: <input type="text" name="name" required><br/><br/>
					Unit Class: <input type="text" name="class" required> Ex: Archer, Thief, Shadow Knight, etc.<br/><br/>
					Base Stat Type: <select name="stats">
						<option value="fa">Frontline Atk (HP: 25 MP: 15 Atk: 4 Def: 3 Int: 2 Spr: 2)</option>
						<option value="ra">Support Atk (HP: 20 MP: 20 Atk: 4 Def: 2 Int: 2 Spr: 3)</option>
						<option value="sm">Support Magic (HP: 20 MP: 20 Atk: 2 Def: 3 Int: 4 Spr: 2)</option> 
						<option value="om">Aggro Magic (HP: 15 MP: 25 Atk: 2 Def: 2 Int: 4 Spr: 3)</option>
					</select><br/><br/>
					Activated-Ability Name: <input type="text" name="aa" required> Ex: an Archer might have an A-Ability named "Archery"<br/><br/>
					Support-Ability: <select name="sa">
					<?php 
						foreach ($db->query("SELECT * FROM Abilities") as $sa) {
							echo '<option value="' . $sa['id'] . '">' . $sa['name'] . ": " . $sa['effect'] . "</option>";
						}
					?>
					</select><br/><br/>
					Reaction-Ability: None. (Level 1 units do not start with Reaction Abilities.)
			</div>
		</div>
		<div class="row">
			<div class="search col-sm-12">
				<h2>Equipment</h2>
				Weapon: <select name="w1">
					<?php 
						foreach ($db->query("SELECT * FROM Equips WHERE type = 'Weapon'") as $w1) {
							echo '<option value="' . $w1['id'] . '">' . $w1['name'] . " (" . $w1['effect'] . ")</option>";
						}
					?>
					</select><br/><br/>
				If unit has Dual Wield, A second weapon may be used.
				Weapon2: <select name="w2">
					<option value="0">No Dual Wield</option>
					<?php 
						foreach ($db->query("SELECT * FROM Equips WHERE type = 'Weapon'") as $w2) {
							echo '<option value="' . $w2['id'] . '">' . $w2['name'] . " (" . $w2['effect'] . ")</option>";
						}
					?>
					</select><br/><br/>
				Armor: <select name="ar">
					<?php 
						foreach ($db->query("SELECT * FROM Equips WHERE type = 'Armor'") as $ar) {
							echo '<option value="' . $ar['id'] . '">' . $ar['name'] . " (" . $ar['effect'] . ")</option>";
						}
					?>
					</select><br/><br/>
				Accessory: <select name="ac">
					<?php 
						foreach ($db->query("SELECT * FROM Equips WHERE type = 'Accessory'") as $ac) {
							echo '<option value="' . $ac['id'] . '">' . $ac['name'] . " (" . $ac['effect'] . ")</option>";
						}
					?>
					</select><br/><br/>
			</div>
		</div>
		<div class="row">
			<div class="search col-sm-12">
					<h2>First Starting Skill</h2>
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
			</div>
		</div>
		<div class="row">
			<div class="search col-sm-12">			
					<h2>Second Starting Skill</h2>
					Name: <input type="text" name="s2name" onchange="calculateMP()" required><br/><br/>
					Damage in Percent (If non-damaging skill, set to 0): <input type="number" name="s2dmg" min="0" max="1000" step="10" value="100" size="6" onchange="calculateMP()"><br/><br/>
					Damage type: <select name="s2type" onchange="calculateMP()">
						<option value="atk">Attack stat damage</option>s
						<option value="int">Intelligence stat damage</option>
					</select><br/><br/>
					Effect(s): Chance of Status Affliction: <select name="s2status" onchange="calculateMP()">
						<option value="0" selected>None</option>
						<option value="Bleed">Bleed</option>
						<option value="Poison">Poison</option>
						<option value="Burn">Burn</option>
						<option value="Stun">Stun</option>
						<option value="Freeze">Freeze</option>
						<option value="Immobilize">Immobilize</option>
						<option value="Disable">Disable</option>
					</select><br/><br/>
					Buffs/Debuffs: <select name="s2buff" onchange="calculateMP()">
						<option value="0" selected>None</option>
						<option value="Increase">Increase</option>
						<option value="Decrease">Decrease</option>
					</select> <select name="s2buffstat" onchange="calculateMP()">
						<option value="Atk" selected>Atk</option>
						<option value="Def">Def</option>
						<option value="Int">Int</option>
						<option value="Spr">Spr</option>
						<option value="Atk and Def">Atk and Def</option>
						<option value="Int and Spr">Int and Spr</option>
						<option value="Def and Spr">Def and Spr</option>
					</select>
					by <input type="number" name="s2buffamt" min="0" max="100" step="10" value="0" size="3" onchange="calculateMP()">% for 3 turns.
					<br/><br/>
					Other Effects: <select name="s2other" onchange="calculateMP()">
						<option value="0" selected>None</option>
						<option value="Knockback">Knockback</option>
						<option value="Hits 2 times">Hits 2 times</option>
						<option value="1 cell AoE">1 cell AoE</option>
						<option value="2 cell AoE">2 cell AoE</option>
						<option value="Line-shape area">Line-shape area.</option>
						<option value="Cone-shape area">Cone-shape area.</option>
					</select><br/><br/>
					Range: <input type="number" name="s2range" min="0" max="99" step="1" value="0" size="2" onchange="calculateMP()" required> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/><br/>
					MP: <span id="s2mpview">0</span>. (MP is auto-defined as you go.) <input name="s2mp" style="visibility:hidden;">

					<input type="submit">
				</form>
			</div>
		</div>

	</div>
</body>