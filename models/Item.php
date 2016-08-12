<?php

require_once __DIR__ . '/Model.php';

class Item extends Model {

	public static function all() {
		self::dbConnect();
		$select = "SELECT * FROM items";
		$stmt = self::$dbc->query($select);
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Item');
		$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $items;
	}

}
