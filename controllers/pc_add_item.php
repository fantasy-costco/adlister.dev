<?php

require __DIR__ . "/../utils/Input.php";
require __DIR__ . "/../models/Item.php";

session_start();

function pageController() {
	$pageTitle = "Add New Item";
	$message = "";
	if (Input::isPost() && $_REQUEST["submit"] == "add_new_item") {

    $item_name = Input::getString('item_name');
    $item_price = Input::getString('price');
    $item_description = Input::getString('description');
    $img_path = $_FILES['img_path']['name'];
    $keywords = Input::getString('keywords');
    $category = Input::getString('category');


				$item = new Item;
				$item->item_name = $item_name;
				$item->item_price = $item_price;
				$item->item_description = $item_description;
        $item->img_path = $img_path;
        var_dump(isset($_FILES['img_path']));
				$item->short_description = NULL;
				$item->keywords = $keywords;
				$item->category = $category;
				var_dump($item->attributes);
				$item->save();
        $item->saveUploadedImage();
	}


	return [
		"pageTitle" => $pageTitle,
	];
}

extract(pageController());
