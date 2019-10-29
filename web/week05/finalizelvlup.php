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

	foreach ($db->query("SELECT * FROM Units WHERE Units.id =" . $_GET['id']) as $unit) {
		$hp += $unit['hp']; 
		$mp += $unit['mp']; 
		$atk += $unit['atk']; 
		$def += $unit['def']; 
		$int += $unit['int']; 
		$spr += $unit['spr']; 
		$crit = $unit['crit'];
		$eva = $unit['eva'];

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
		$query = "
				UPDATE Units
				SET lvl = $lvl, hp = $hp, mp = $mp, atk = $atk, def = $def, int = $int, spr = $spr, crit = $crit, eva = $eva 
				WHERE Units.id = $_GET['id']";
		$statement = $db->prepare($query);
		$statement->execute();

		
	}
	catch (Exception $ex)
	{
		echo "Error with DB. Details: $ex";
		die();
	}
	// finally, redirect them to a new page to actually show the topics
	header("Location: unit.php?id=" . $unitid);
	die();
?>
