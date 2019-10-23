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
				$db = connect();

				$name = $_POST['name'];
				$class = $_POST['class'];
				$aa = $_POST['aa'];
				$sa = "PENDING";
				$w1 = "";
				$w2 = "";
				$ar = "";
				$ac = "";
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

				echo "$name<br/>$class<br/>$lvl<br/>$exp<br/>
				$hp<br/>$mp<br/>$atk<br/>$def<br/>$int<br/>
				$spr<br/>$move<br/>$crit<br/>$eva<br/>";

				$s1name = $_POST['s1name'];
				$s1dmg = "";
				if ($_POST['s1dmg'] != 0) {
					$s1dmg = $_POST['s1dmg'] . "% ". $_POST['s1type'] ." Damage. ";
				}
				$s1stat = $_POST['s1stat'];
				$s1effect = "";
				if ($_POST['s1status'] != "None") {
					$s1effect += "Chance of " . $_POST['s1status'] . ". ";
				}
				if ($_POST['s1buff'] != "None") {
					$s1effect += $_POST['s1buff'] . " " . $_POST['s1buffstat'] . " by " . $_POST['s1buffamt'] . ".% ";
				}
				if ($_POST['s1other'] != "None") {
					$s1effect += $_POST['s1other'] . ".";
				}
				$s1range = $_POST['s1range'];
				$s1mp = $_POST['s1mp'];

				echo "<b>+ $s1name:</b> $s1dmg $s1effect Range: $s1range. $s1mp MP.<br/>";

				$s2name = $_POST['s2name'];
				$s2dmg = "";
				if ($_POST['s2dmg'] != 0) {
					$s2dmg = $_POST['s2dmg'] . "% ". $_POST['s2type'] ." Damage. ";
				}
				$s2stat = $_POST['s2stat'];
				$s2effect = "";
				if ($_POST['s2status'] != "None") {
					$s2effect += "Chance of " . $_POST['s2status'] . ". ";
				}
				if ($_POST['s2buff'] != "None") {
					$s2effect += $_POST['s2buff'] . " " . $_POST['s2buffstat'] . " by " . $_POST['s2buffamt'] . ".% ";
				}
				if ($_POST['s2other'] != "None") {
					$s2effect += $_POST['s2other'] . ".";
				}
				$s2range = $_POST['s2range'];
				$s2mp = $_POST['s2mp'];

				echo "<b>+ $s2name:</b> $s2dmg $s2effect Range: $s2range. $s2mp MP.<br/>";
				
				?>
			</div>
			<div class="col-sm-2">


			</div>
		</div>

	</div>
</body>