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
			<div class="search col-sm-12">
				<form>
					<h1>Create new level 1 unit.</h1>
					Name: <input type="text" name="name"><br/>
					Class: <input type="text" name="class"><br/>
					Stat Style: <select name="stats">
						<option value="fa">Fast Attacker</option>
						<option value="ra">Ranged Attacker</option>
						<option value="da">Defensive Attacker</option>
						<option value="sm">Support Magic</option> 
						<option value="bm">Balanced Magic</option>
						<option value="gc">Glass Cannon</option> 
					</select><br/>
					A-Ability: <input type="text" name="aa"><br/>
					First Starting Skill: Name: <input type="text" name="s1name"><br/>
					Damage in Percent (If non-damaging skill, set to 0): <input type="number" name="s1damage" min="0" max="1000" step="10" value="100" size="6"><br/>
					Damage type: <select name="s1type">
						<option value="atk">Attack stat damage</option>
						<option value="int">Intelligence stat damage</option>
						<option value="nds">Non-damaging skill</option>
					</select><br/>
					Effect(s): Chance of Status Affliction: <select name="s1status">
						<option value="none" selected>None.</option>
						<option value="Bleed">Bleed</option>
						<option value="Poison">Poison</option>
						<option value="Burn">Burn</option>
						<option value="Stun">Stun</option>
						<option value="Freeze">Freeze</option>
						<option value="Immobilize">Immobilize</option>
						<option value="Disable">Disable</option>
					</select><br/>
					Buffs/Debuffs: <select name="s1buff">
						<option value="none" selected>None.</option>
						<option value="Increase">Increase</option>
						<option value="Decrease">Decrease</option>
					</select> <select>
						<option value="none" selected>None.</option>
						<option value="Atk">Atk</option>
						<option value="Def">Def</option>
						<option value="Int">Int</option>
						<option value="Spr">Spr</option>
						<option value="Atk and Def">Atk and Def</option>
						<option value="Int and Spr">Int and Spr</option>
						<option value="Def and Spr">Def and Spr</option>
					</select>
					by <input type="number" name="s1buffamt" min="0" max="100" step="5" value="0" size="5">%.
					<br/>
					Range: <input type="number" name="s1range" min="0" max="99" step="1" value="0" size="2"> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/>

					Second Starting Skill:Name: <input type="text" name="s2name"><br/>
					Damage in Percent (If non-damaging skill, set to 0): <input type="number" name="s2damage" min="0" max="1000" step="10" value="100" size="6"><br/>
					Damage type: <select name="s2type">
						<option value="atk">Attack stat damage</option>
						<option value="int">Intelligence stat damage</option>
						<option value="nds">Non-damaging skill</option>
					</select><br/>
					Effect(s): Chance of Status Affliction: <select name="s2status">
						<option value="none" selected>None.</option>
						<option value="Bleed">Bleed</option>
						<option value="Poison">Poison</option>
						<option value="Burn">Burn</option>
						<option value="Stun">Stun</option>
						<option value="Freeze">Freeze</option>
						<option value="Immobilize">Immobilize</option>
						<option value="Disable">Disable</option>
					</select><br/>
					Buffs/Debuffs: <select name="s2buff">
						<option value="none" selected>None.</option>
						<option value="Increase">Increase</option>
						<option value="Decrease">Decrease</option>
					</select> <select>
						<option value="none" selected>None.</option>
						<option value="Atk">Atk</option>
						<option value="Def">Def</option>
						<option value="Int">Int</option>
						<option value="Spr">Spr</option>
						<option value="Atk and Def">Atk and Def</option>
						<option value="Int and Spr">Int and Spr</option>
						<option value="Def and Spr">Def and Spr</option>
					</select>
					by <input type="number" name="s2buffamt" min="0" max="100" step="5" value="0" size="5">%.
					<br/>
					Range: <input type="number" name="s2range" min="0" max="99" step="1" value="0" size="2"> (Range of 0 means it can only target the user; any range higher than 9 is superfluous and will be treated as infinite range) <br/>
				</form>
			</div>
		</div>

	</div>
</body>