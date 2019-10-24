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
					Name: <input type="text" name="name"><br/><br/>
					Class: <input type="text" name="class"><br/><br/>
					Stat Style: <select name="stats">
						<option value="fa">Fast Attacker</option>
						<option value="ra">Ranged Attacker</option>
						<option value="sm">Support Magic</option> 
						<option value="om">Offensive Magic</option>
					</select><br/><br/>
					Activated-Ability Name: <input type="text" name="aa"> Ex: an Archer might have an A-Ability named "Archery"<br/><br/>
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
					<h2>First Starting Skill</h2>
					Name: <input type="text" name="s1name" onchange="calculateMP()"><br/><br/>
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
					by <input type="number" name="s1buffamt" min="0" max="100" step="10" value="0" size="3" onchange="calculateMP()">%.
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
					Range: <input type="number" name="s1range" min="0" max="99" step="1" value="0" size="2" onchange="calculateMP()"> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/><br/>
					MP: <span id="s1mpview">0</span>. (MP is auto-defined as you go.) <input name="s1mp" style="visibility:hidden;">
			</div>
		</div>
		<div class="row">
			<div class="search col-sm-12">			
					<h2>Second Starting Skill</h2>
					Name: <input type="text" name="s2name" onchange="calculateMP()"><br/><br/>
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
					by <input type="number" name="s2buffamt" min="0" max="100" step="10" value="0" size="3" onchange="calculateMP()">%.
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
					Range: <input type="number" name="s2range" min="0" max="99" step="1" value="0" size="2" onchange="calculateMP()"> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/><br/>
					MP: <span id="s2mpview">0</span>. (MP is auto-defined as you go.) <input name="s2mp" style="visibility:hidden;">

					<input type="submit">
				</form>
			</div>
		</div>

	</div>
</body>