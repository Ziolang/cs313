<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Handler</title>
</head>
<body>
<?php
	for($x = 0; $x < count($_SESSION["items"]); $x++){
		if (isset($_POST[$x]) && !in_array($x, $_SESSION["cart"])){
			array_push($_SESSION["cart"], $x);
		}
	}

	header("location:ponder03.php");
?>
</body>
</html>