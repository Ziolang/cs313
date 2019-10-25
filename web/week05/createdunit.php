<?php include "connect.php";


				$db = connect();

				$name = $_POST['name'];
				$class = $_POST['class'];
				$aa = $_POST['aa'];
				$sa = "PENDING";
				$lvl = 1;
				$exp = 0;
				$hp = 25; $mp = 15; $atk = 4; $def = 3; $int = 2; 
				$spr = 2; $move = 3; $crit = 2; $eva = 2;

				if ($_POST['name'] == "ra"){
					$hp = 20; $mp = 20; $atk = 4; $def = 2; $int = 2; 
					$spr = 3; $move = 2; $crit = 2; $eva = 3;
				}
				if ($_POST['name'] == "sm"){
					$hp = 20; $mp = 20; $atk = 2; $def = 3; $int = 4; 
					$spr = 2; $move = 2; $crit = 1; $eva = 4;
				}
				if ($_POST['name'] == "om"){
					$hp = 15; $mp = 25; $atk = 2; $def = 2; $int = 4; 
					$spr = 3; $move = 2; $crit = 4; $eva = 1;
				}

				$w1id = 0;
				$w2id = 0;
				$arid = 0;
				$acid = 0;
				$said = 0;
				foreach ($db->query("SELECT * FROM Equips WHERE id = " . $_POST['w1']) as $w1) {
					$w1id = $w1['id'];
				}
				if ($_POST['w2'] !== 0)
				foreach ($db->query("SELECT * FROM Equips WHERE id = " . $_POST['w2']) as $w2) {
					$w2id = $w2['id'];
				}
				else { $w2id = NULL; }
				foreach ($db->query("SELECT * FROM Equips WHERE id = " . $_POST['ar']) as $ar) {
					$arid = $ar['id'];
				}
				foreach ($db->query("SELECT * FROM Equips WHERE id = " . $_POST['ac']) as $ac) {
					$acid = $ac['id'];
				}
				foreach ($db->query("SELECT * FROM Abilities WHERE id = " . $_POST['sa']) as $sa) {
					$said = $sa['id'];
				}

				$s1name = $_POST['s1name'];
				$s1dmg = "";
				if ($_POST['s1dmg'] !== 0) {
					$s1dmg = $_POST['s1dmg'] . "% ". $_POST['s1type'] ." Damage. ";
				}

				$s1stat = $_POST['s1stat'];
				$s1effect = "";
				if ($_POST['s1status'] !== 0) {
					$s1effect .= "Chance of " . $_POST['s1status'] . ". ";
				}
				if ($_POST['s1buff'] !== 0) {
					$s1effect .= $_POST['s1buff'] . " " . $_POST['s1buffstat'] . " by " . $_POST['s1buffamt'] . "%. ";
				}
				if ($_POST['s1other'] !== 0) {
					$s1effect .= $_POST['s1other'] . ".";
				}
				
				$s1range = $_POST['s1range'];
				$s1mp = $_POST['s1mp'];

				$s2name = $_POST['s2name'];
				$s2dmg = "";
				if ($_POST['s2dmg'] !== 0) {
					$s2dmg = $_POST['s2dmg'] . "% ". $_POST['s2type'] ." Damage. ";
				}

				$s2stat = $_POST['s2stat'];
				$s2effect = "";
				if ($_POST['s2status'] !== 0) {
					$s2effect .= "Chance of " . $_POST['s2status'] . ". ";
				}
				if ($_POST['s2buff'] !== 0) {
					$s2effect .= $_POST['s2buff'] . " " . $_POST['s2buffstat'] . " by " . $_POST['s2buffamt'] . "%. ";
				}
				if ($_POST['s2other'] !== 0) {
					$s2effect .= $_POST['s2other'] . ".";
				}
				$s2range = $_POST['s2range'];
				$s2mp = $_POST['s2mp'];

				try
	{
	// Add the Scripture
	// We do this by preparing the query with placeholder values
		$query = 'INSERT INTO Skills(name, dmg, stat, effect, range, mp) VALUES(:name, :dmg, :stat, :effect, :range, :mp)';
		$statement = $db->prepare($query);
		$s1damage = $_POST['s1dmg'];
		$s2damage = $_POST['s1dmg'];
	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
		$statement->bindValue(':name', $s1name);
		$statement->bindValue(':dmg', $s1damage);
		$statement->bindValue(':stat', $s1stat);
		$statement->bindValue(':effect', $s1effect);
		$statement->bindValue(':range', $s1range);
		$statement->bindValue(':mp', $s1mp);
		$statement->execute();

		$sk1 = $statement->lastInsertId();

		$query = 'INSERT INTO Skills(name, dmg, stat, effect, range, mp) VALUES(:name, :dmg, :stat, :effect, :range, :mp)';
		$statement = $db->prepare($query);
	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
		$statement->bindValue(':name', $s2name);
		$statement->bindValue(':dmg', $s2damage);
		$statement->bindValue(':stat', $s2stat);
		$statement->bindValue(':effect', $s2effect);
		$statement->bindValue(':range', $s2range);
		$statement->bindValue(':mp', $s2mp);
		$statement->execute();

		$sk2 = $statement->lastInsertId();

		$query = 'INSERT INTO SkillSet(name, skill1, skill2) VALUES(:name, :skill1, :skill2)';
		$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
		$statement->bindValue(':name', $class);
		$statement->bindValue(':dmg', $skill1);
		$statement->bindValue(':stat', $skill2);
		$statement->execute();

		$aaid = $statement->lastInsertId();

		$query = 'INSERT INTO Units(name, class, aability, sability, weapon1, weapon2, armor, accessory, lvl, exp, hp, mp, atk, def, int, spr, move, crit, eva) 
			VALUES(:name, :class, :aability, :sability, :weapon1, 
			:weapon2, :armor, :accessory, :lvl,
			:exp, :hp, :mp, :atk, :def, :int, :spr, :move, :crit, :eva)';
		$statement = $db->prepare($query);
	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
		$statement->bindValue(':name', $name);
	$statement->bindValue(':class', $class);
	$statement->bindValue(':aability', $aaid);
	$statement->bindValue(':sability', $said);
	$statement->bindValue(':weapon1', $w1id);
	$statement->bindValue(':weapon2', $w2id);
	$statement->bindValue(':armor', $arid);
	$statement->bindValue(':accessory', $acid);
	$statement->bindValue(':lvl', $lvl);
	$statement->bindValue(':exp', $exp);
	$statement->bindValue(':hp', $hp);
	$statement->bindValue(':mp', $mp);
	$statement->bindValue(':atk', $atk);
	$statement->bindValue(':def', $def);
	$statement->bindValue(':int', $int);
	$statement->bindValue(':spr', $spr);
	$statement->bindValue(':move', $move);
	$statement->bindValue(':crit', $crit);
	$statement->bindValue(':eva', $eva);
	$statement->execute();

	$id = $statement->lastInsertId();
}
catch (Exception $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}
// finally, redirect them to a new page to actually show the topics
header("Location: unit.php?id=" . $id);
die();

				
				?>
