<?php session_start() ?>
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
  		<li><a href="viewcart.php">Cart: <?php if(isset($_SESSION["cart"])){echo count($_SESSION["cart"]);} else {echo "0";} ?> Items</a></li>
	</ul>
	<div class="container">
			<?php 
			if(isset($_SESSION["cart"])){
			$count = 0;
				foreach($_SESSION["cart"] as $x){

					if($count % 3 == 0) {
						echo '<div class="itemholder row"><div class="item col-sm-4 first"><img class="itempic" src=' . $_SESSION["images"][(int)$x] . ' alt="table' . (int)$x . '"><h3>' . $_SESSION["items"][(int)$x] . ' Table Set </h3><p class="price">$' . $_SESSION["prices"][(int)$x] . '</p></div>';
					$count++;
					}
					else {
					echo '<div class="item col-sm-4"><img class="itempic" src=' . $_SESSION["images"][(int)$x] . ' alt="table' . (int)$x . '"><h3>' . $_SESSION["items"][(int)$x] . ' Table Set </h3><p class="price">$' . $_SESSION["prices"][(int)$x] . '</p></div>';
					if ($count % 3 == 2) {
						echo "</div>";
					}
					$count++;
					}
				}
			
			echo '<div class="itemholder row">';
				
					$sum = 0;
					foreach($_SESSION["cart"] as $x) {
						$sum += $_SESSION["prices"][(int)$x];
					}
					if($sum == 0) {
						echo "Your cart is empty.";
					}
				}
				?>
			</div>
	</div>
	
		<ul class="footer">
  			<li><a href="ponder03.php">Return to Browse</a></li>
  			<li><form action="clear.php" method="post"><input class="clear" type="submit" value="Clear Cart"></form></li>
  			<li><a>Total: $<?php echo $sum ?></a></li>
  			<li><form action="checkout.php" method="post"><input class="clear" type="submit" value="Continue"></form></li>
		</ul>
</body>
</html>
