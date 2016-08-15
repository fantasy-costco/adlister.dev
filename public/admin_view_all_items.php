<?php

session_start();

require_once __DIR__ . '/../Models/Item.php';
require __DIR__ . "/../utils/Input.php";


function pageController() {
	$pageTitle = "FANTASY COSTCO: WHERE ALL YOUR DREAMS COME TRUE";

	if (Input::isPost() && $_REQUEST["submit"] == "delete") {
		$item = new Item;
		$item->item_id = $_REQUEST['id'];
		$item->delete();
	} elseif (Input::isPost() && $_REQUEST["submit"] == "edit"){
		$item_id = $_REQUEST['id'];
		header("Location: admin_edit_item.php?item={$item_id}");
	}

	$items = Item::all();

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
		<?php include __DIR__ . "/../views/partials/admin.manage-items.phtml" ?>
	</div>

	<?php require '../views/partials/common_js.php'; ?>
</body>
</html>
