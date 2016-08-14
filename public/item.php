<!DOCTYPE html>
<html>
<head>
	<?php require __DIR__ . '/../views/partials/header.php'; ?>
</head>
<body>
	<?php require '../views/partials/navbar.php'; ?>

	<div class="container">
		<div class="flex">
			<div class="col-6">
				<img class="img-responsive" src="http://placekitten.com/525/525" alt="short description">
			</div>
			<div class="col-4">
				<h2 class="productName">Item Name</h2>
				<h3 class="price">Price</h3>
				<p class="itemDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed laoreet dui, id consectetur ex. Quisque tincidunt, tortor sit amet posuere commodo, risus felis maximus erat, in cursus diam erat eget dolor. Ut sit amet erat ac dolor efficitur commodo. Praesent eros eros, molestie sed augue iaculis, cursus mollis est. Sed ac nisi id elit aliquam porttitor. Nam porttitor lacinia porta. Nulla et pretium neque, tempus feugiat quam.</p>
				<div class="formButton">
					<button class="greenButton" type="submit" name="submit" value="addToCart">Add To Cart</button>
				</div>
			</div>
		</div>
	</div>

	<?php require __DIR__ . '/../views/partials/footer.php'; ?>
</body>
</html>