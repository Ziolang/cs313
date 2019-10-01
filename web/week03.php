<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form action="week03.php" method="post">
			Name: <input type="text" name="name"><br/>
			Email: <input type="email" name="name"><br/>
			Degree:<br/>
			<?php 
				$major = array("cs" => "Computer Science", "wdd" => "Web Design and Development", "cit" => "Computer Information Technology", "ce" => "Computer Engineering");

				foreach($major as $x => $x_value){
				echo '<input type="radio" name="major" value="$x"> $x_value<br/>';
			}
			?>
			Comment:<br/>
			<textarea name="comment" rows="4" cols="50" placeholder="Write a comment..."></textarea><br/>
			<input type="submit">
		</form>
	</body>
</html>