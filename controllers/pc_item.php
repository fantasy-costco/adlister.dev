<?php

require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../utils/Input.php';

function grabItemFromArray ($items, $itemName) {
	foreach ($items as $item) {
		foreach ($item as $key => $value) {
			if ($key == 'item_name' && $value == $itemName) {
				return $item;
			}
		}
	}
}

function pageController() {
	$items = Item::all();
	$itemName = Input::get("item");
	$item = grabItemFromArray($items, $itemName);
	return [
		'item' => $item
	];
}

extract(pageController());