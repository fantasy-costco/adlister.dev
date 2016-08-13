<?php

session_start();

require_once __DIR__ . '/../Models/Item.php';

function pageController() {
	$pageTitle = "FANTASY COSTCO: WHERE ALL YOUR DREAMS COME TRUE";
	$items = Item::all();
	// var_dump($items);

	return [
		"pageTitle" => $pageTitle,
		"items" => $items
	];
}
extract(pageController());

?>

<!DOCTYPE html>
<html>
<head>
	<?php require '../views/partials/header.php'; ?>
</head>
<body>
	<?php require '../views/partials/navbar.php'; ?>
	<?php include __DIR__ . "/../views/partials/admin.sidebar.phtml" ?>

	<div class="container">
		<?php include __DIR__ . "/../views/partials/admin.add.php" ?>
	</div>

	<?php require '../views/partials/common_js.php'; ?>
</body>
</html>
