<?php
$_ENV = include __DIR__ . '/../../env.php';
require_once __DIR__ . '/../db_connect.php';
$query='CREATE TABLE IF NOT EXISTS items(
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		item_name VARCHAR(100) NOT NULL,
		item_price INT NOT NULL,
		item_description TEXT,
		img_path VARCHAR(100) NOT NuLL,
		short_description VARCHAR(200),
		PRIMARY KEY(id)
);';
$dbc->exec($query);