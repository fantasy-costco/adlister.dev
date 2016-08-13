<?php

$_ENV = include __DIR__ . '/../../env.php';
require_once __DIR__ . '/../db_connect.php';

$dbc->exec('DROP TABLE IF EXISTS users');

$query = 'CREATE TABLE users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(75) NOT NULL,
    current_balance DOUBLE PRECISION(6,2) NOT NULL,
    email VARCHAR(100) NOT NULL,
    username VARCHAR(32) NOT NULL,
    password VARCHAR(64) NOT NULL,
    admin TINYINT(1) NOT NULL,
    PRIMARY KEY (user_id)
)';

$dbc->exec($query);
