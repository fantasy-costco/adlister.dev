<?php

require_once __DIR__ . '/../../models/User.php';

$user = new User;
$user->first_name = 'Randi';
$user->last_name = 'Mays';
$user->current_balance = 0;
$user->email = 'admin@codeup.com';
$user->username = "cool_admin";
$user->password = $_ENV['ADMIN_PASS'];
$user->admin = 1;
$user->save();
