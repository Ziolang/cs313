<?php 
	include "connect.php";

	$db = connect();
	$lvl = $_POST['lvl'];
	$hp = $_POST['hp']; 
	$mp = $_POST['mp']; 
	$atk = $_POST['atk']; 
	$def = $_POST['def']; 
	$int = $_POST['int']; 
	$spr = $_POST['spr']; 
	$crit = 0;
	$eva = 0;
	$aaid = "";

	foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $unit) {
		$hp += $unit['hp']; 
		$mp += $unit['mp']; 
		$atk += $unit['atk']; 
		$def += $unit['def']; 
		$int += $unit['int']; 
		$spr += $unit['spr']; 
		$crit = $unit['crit'];
		$eva = $unit['eva'];
		$aaid = $unit['aability'];

		if ($lvl % 3 == 0) { $crit++; }

		if ($lvl % 3 == 1) { $eva++; }
	}

	$s1name = $_POST['s1name'];
	$s1dmg = $_POST['s1dmg'];
	$s1type = $_POST['s1type'];

	$s1stat = $_POST['s1stat'];
	$s1effect = "";
	if ($_POST['s1status'] != "0") {
		$s1effect .= "Chance of " . $_POST['s1status'] . ". ";
	}
	if ($_POST['s1buff'] != "0") {
		$s1effect .= $_POST['s1buff'] . " " . $_POST['s1buffstat'] . " by " . $_POST['s1buffamt'] . "% for 3 turns. ";
	}
	if ($_POST['s1other'] != "0") {
		$s1effect .= $_POST['s1other'] . ".";
	}
				
	$s1range = $_POST['s1range'];
	$s1mp = $_POST['s1mp'];

	//Skill slot in skillset to put skill into. Determined by adding 1 to the new level. 
	//A lvl 1 unit has 2 skills, so a lvl 2 unit needs its new skill at slot 3.
	$y = $lvl + 1;
	$skillx = "skill" . $y;

	try {
		//Update stats

		$query = "
				UPDATE Units
				SET lvl = $lvl, hp = $hp, mp = $mp, atk = $atk, def = $def, int = $int, spr = $spr, crit = $crit, eva = $eva 
				WHERE Units.id =" . $_GET['id'];
		$statement = $db->prepare($query);
		$statement->execute();

		//Add new Skill
		$query = 'INSERT INTO Skills(name, dmg, stat, effect, range, mp) VALUES(:name, :dmg, :stat, :effect, :range, :mp)';
		$statement = $db->prepare($query);

		$statement->bindValue(':name', $s1name);
		$statement->bindValue(':dmg', $s1dmg);
		$statement->bindValue(':stat', $s1type);
		$statement->bindValue(':effect', $s1effect);
		$statement->bindValue(':range', $s1range);
		$statement->bindValue(':mp', $s1mp);
		$statement->execute();

		$sk1 = $db->lastInsertId();
		$query = "
				UPDATE Skillset
				SET $skillx = $sk1 
				WHERE Units.id = $aaid";
		$statement = $db->prepare($query);
		$statement->execute();

	}
	catch (Exception $ex)
	{
		echo "Error with DB. Details: $ex";
		die();
	}

	header("Location: unit.php?id=" . $_GET['id']);
	die();
?>
