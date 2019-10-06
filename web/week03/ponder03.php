<?php session_start();
	if(!isset($_SESSION["cart"])){
		$_SESSION["cart"] = array();
	}
	if(!isset($_SESSION["items"])){
		$_SESSION["items"] = array("Round", "Kitchen", "Glass", "Child", "Folding", "Picnic", "Outdoor", "Casual", "Black");
	}
	if(!isset($_SESSION["prices"])) {
		$_SESSION["prices"] = array(250, 120, 300, 100, 85, 115, 410, 190, 210);
	}

	if(!isset($_SESSION["images"])) {
		$_SESSION["images"] = array("round2.jpeg", "kitchentable.jpeg", "glass.jpeg", "child.jpeg", "portable.jpeg", "outdoor.jpeg", "woodwicker.jpeg", "round.jpeg", "round2.jpeg");
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Ponder 03</title>
	<link rel="stylesheet" type="text/css" href="ponder03.css">
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<ul class="header">
  		<li><a href="ponder03.php">Home</a></li>
  		<li><a>About Us</a></li>
  		<li><a>Contact</a></li>
  		<li><a href="viewcart.php">Cart: <?php if(isset($_SESSION["cart"])){ echo count($_SESSION["cart"]);} else {echo "0";} ?> Items</a></li>
	</ul>
	
			<form action="handler.php" method="post">
	<div class="container">
			<?php 
			$count = 0;
				foreach($_SESSION["items"] as $x){

					if($count % 3 == 0) {
						echo '<div class="itemholder row"><div class="item col-sm-4 first">
						<img class="itempic" src=' . 
						$_SESSION["images"][$count] . 
						' alt="table' . 
						$count . 
						'"><h3>' . 
						$x . 
						' Table Set </h3><p class="price">$' . 
						$_SESSION["prices"][$count] . 
						'&nbsp&nbspAdd to Cart: <input type="checkbox" name="' .
						$count .'" value="' .
						$x .'"></p></div>';
					$count++;
					}
					else {
					echo '<div class="item col-sm-4"><img class="itempic" src=' . 
						$_SESSION["images"][$count] . 
						' alt="table' . 
						$count . 
						'"><h3>' . 
						$x . 
						' Table Set </h3><p class="price">$' . 
						$_SESSION["prices"][$count] . 
						'&nbsp&nbspAdd to Cart: <input type="checkbox" name="' .
						$count .'" value="' .
						$x .'"></p></div>';
					if ($count % 3 == 2) {
						echo "</div>";
					}
					$count++;
					}
				}
			?>
			
	</div>

			<ul class="footer">
  			<li><a href="ponder03.php">Return to Top</a></li>
  			<li><input class="clear" type="submit" value="Add to Cart"/></form></li>
		</ul>
</body>
</html>