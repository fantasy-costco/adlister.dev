<?php

require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../utils/Input.php';

function grabItemFromArray ($items, $itemId) {
	foreach ($items as $item) {
		foreach ($item as $key => $value) {
			if ($key == 'item_id' && $value == $itemId) {
				return $item;
			}
		}
	}
}

function pageController() {

  if (Input::isPost() && $_REQUEST["submit"] == "update") {
    $itemId = Input::get("item");

    $item_name = Input::getString('item_name');
    $item_price = Input::getString('price');
    $item_description = Input::getString('description');
    $short_description = Input::getString('short_description');
    $img_path = $_FILES['img_path']['name'];
    $keywords = Input::getString('keywords');
    $category = Input::getString('category');

        $item = new Item;
        $item->item_id = $itemId;
				$item->item_name = $item_name;
				$item->item_price = $item_price;
				$item->item_description = $item_description;
        $item->img_path = $img_path;
				$item->short_description = $short_description;
				$item->keywords = $keywords;
				$item->category = $category;
				$item->save();
        $item->saveUploadedImage();
  }
  $itemId = Input::get("item");

  $items = Item::all();

  $item = grabItemFromArray($items, $itemId);
  var_dump($item);
	return [
		'item' => $item
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
    <h1>Edit Item</h1>
    <form class="" enctype="multipart/form-data" action="admin_edit_item.php?item=<?= $item['item_id']; ?>" method="post">
    <div class='formInput'>
    	<label for='item_name'>Item Name
    	<input type='text' name='item_name' id='item_name' value="<?= $item['item_name']?>">
    	</label>
    </div>
    <div class='formInput'>
    	<label for='price'>Price:
    		<input type='text' name='price' id='price' value="<?= $item['item_price']?>">
    	</label>
    </div>

    <div class='formInput'>
    	<label for='description'>Description:
    		<input type='text' name='description' id='description' value="<?= $item['item_description']?>">
    	</label>
    </div>

    <div class='formInput fileuploadholder'>
    				<label for="img_path">Upload Image File</label>
    			<span class="warning">(Must be .jpeg or .png)</span>
    			<input type="file" name="img_path" id="img_path" value="<?= $item['img_path']?>">
    </div>
    <img class="itemImg" src="<?= $item['img_path']?>" alt="<?= $item['short_description']?>" />

    <div class='formInput'>
    	<label for='short_description'>Short Description:
    		<input type='text' name='short_description' id='short_description' value="<?= $item['short_description']?>">
    	</label>
    </div>

    <div class='formInput'>
    	<label for='keywords'>Keywords:
    		<input type='text' name='keywords' id='keywords' value="<?= $item['keywords']?>">
    	</label>
    </div>
    <div class="formInput">
    	<label for='category'>Category:
    	<input type='text' name='category' id='category' value="<?= $item['category']?>">
    	</label>
    </div>

    <div class='formButton'>
    	<button type='submit' name="submit" value="update">Submit</button>
    </div>
    </form>
	</div>

	<?php require '../views/partials/common_js.php'; ?>
</body>
</html>
