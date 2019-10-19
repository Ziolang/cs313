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
				$unit = $db->query("SELECT * FROM Units WHERE Unit.id =" . $_GET['id']);
				$skillset = $db->query("SELECT * FROM SkillSet WHERE SkillSet.id =" . $unit['A_Ability']);
				$weapon1 = $db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon1']);
				$weapon2 = $db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['weapon2']);
				$armor = $db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['armor']);
				$accessory = $db->query("SELECT * FROM Equips WHERE Equips.id =" . $unit['accessory']);
				
				echo $unit['name'];
				?>
			</div>
			<div class="col-sm-2">


			</div>
		</div>

	</div>
</body>