<?php 
	include "connect.php";

	$db = connect();


	try	{
		$query = 'DELETE FROM Units WHERE Units.id = ' . $_GET['id'];
		$statement = $db->prepare($query);

		$statement->execute();
	}
	catch (Exception $ex)
	{
		echo "Error with DB. Details: $ex";
		die();
	}

	header("Location: search.php");
	die();
?>

