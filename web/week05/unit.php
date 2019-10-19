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
			<div class="col-sm-2">


			</div>
			<div class="search col-sm-8">
				<?php
				$unit = $db->query("
					SELECT Units.*, SkillSet.* 
					FROM Units
					INNER JOIN SkillSet
					ON Units.A_Ability = SkillSet.ID
					WHERE Unit.id = $_GET['id']");
				$weapon1 = $db->query("SELECT Equips.* FROM Equips, Units WHERE Equips.id =" . $unit['Units.weapon1']);
				$weapon2 = $db->query("SELECT Equips.* FROM Equips, Units WHERE Equips.id =" . $unit['Units.weapon2']);
				$armor = $db->query("SELECT Equips.* FROM Equips, Units WHERE Equips.id =" . $unit['Units.armor']);
				$accessory = $db->query("SELECT Equips.* FROM Equips, Units WHERE Equips.id =" . $unit['Units.accessory']);
				
				echo $unit['Units.name'];
				?>
			</div>
			<div class="col-sm-2">


			</div>
		</div>

	</div>
</body>