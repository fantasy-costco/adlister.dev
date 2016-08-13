<?php

$_ENV = include __DIR__ . '/../../env.php';
require_once __DIR__ . '/../db_connect.php';

$dbc->exec('DROP TABLE IF EXISTS purchases');

$query = 'CREATE TABLE purchases (
    item_id INT UNSIGNED NOT NULL,
    po_id INT UNSIGNED NOT NULL,
    current_cost DOUBLE PRECISION(6,2) NOT NULL,
    PRIMARY KEY (po_id, item_id),
    FOREIGN KEY (item_id) REFERENCES items (id),
    FOREIGN KEY (po_id) REFERENCES purchase_orders (id)
)';

$dbc->exec($query);
