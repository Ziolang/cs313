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
	session_unset();
	header("location:ponder03.php");
?>
</body>
</html>