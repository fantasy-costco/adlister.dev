<?php

$_ENV = include __DIR__ . '/../../env.php';
require_once __DIR__ . '/../db_connect.php';

$dbc->exec('DROP TABLE IF EXISTS purchase_orders');

$query = 'CREATE TABLE purchase_orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    qty INT NOT NULL,
    purchase_date DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
)';

$dbc->exec($query);

$query = 'ALTER TABLE purchase_orders AUTO_INCREMENT=1001';

$dbc->exec($query);
