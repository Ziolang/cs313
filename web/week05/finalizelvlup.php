<?php include "connect.php";


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
		$lvl = 1 + $unit['lvl'];
		$hp += $unit['hp']; 
		$mp += $unit['mp']; 
		$atk += $unit['atk']; 
		$def += $unit['def']; 
		$int += $unit['int']; 
		$spr += $unit['spr']; 

		if ($lvl % 3 == 0) { $crit = 1 + $unit['crit']; }

		if ($lvl % 3 == 1) { $eva = 1 + $unit['eva']; }

	}

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
