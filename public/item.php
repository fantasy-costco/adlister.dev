<?php require_once __DIR__ . '/../controllers/pc_item.php'; ?>
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
				<img class="img-responsive" src="<?= $item["img_path"] ?>" 
					alt="<?= $item["short_description"] ?>">
			</div>
			<div class="col-4">
				<h2 class="productName"><?= $item["item_name"] ?></h2>
				<h3 class="goldPrice"><?= $item["category"] ?></h2>
				<h3 class="price"><?= $item["item_price"] ?> Gold</h3>
				<p class="itemDescription"><?= $item["item_description"] ?></p>
				<div class="formButton">
					<button class="greenButton" type="submit" name="submit" value="<?= $item["item_id"] ?>">Add To Cart</button>
				</div>
			</div>
		</div>
	</div>
	<?php require __DIR__ . '/../views/partials/footer.php'; ?>
</body>
</html>