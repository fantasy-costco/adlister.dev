<?php
$_ENV = include __DIR__ . '/../../env.php';
require_once __DIR__ . '/../db_connect.php';
$query='DROP TABLE IF EXISTS  fantasy_db.items';
$dbc->exec($query);
$query='CREATE TABLE IF NOT EXISTS fantasy_db.items(
		item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		item_name VARCHAR(100) NOT NULL,
		item_price INT NOT NULL,
		item_description TEXT,
		img_path VARCHAR(100) NOT NULL,
		short_description VARCHAR(200),
		keywords VARCHAR(100),
		category VARCHAR(100),
		PRIMARY KEY(item_id)
);';
$dbc->exec($query);
