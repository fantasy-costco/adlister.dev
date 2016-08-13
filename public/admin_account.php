<?php

session_start();

require_once __DIR__ . '/../Models/Item.php';

function pageController() {
	$pageTitle = "FANTASY COSTCO: WHERE ALL YOUR DREAMS COME TRUE";

	return [
		"pageTitle" => $pageTitle
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
		<h1>Manage Account</h1>
		<form class="" action="admin_account.php" method="post">
			<div class="formInput">
				<label for="first_name">
					First Name<span class="warning">*</span>
				</label>
				<input type="text" maxlength="50" name="first_name" value="" placeholder="John">
			</div>

			<div class="formInput">
				<label for="last_name">
					Last Name<span class="warning">*</span>
				</label>
				<input type="text" maxlength="75" name="last_name" value="" placeholder="Doe">
			</div>

			<div class="formInput">
				<label for="email">
					Email Address<span class="warning">*</span>
				</label>
				<input type="text" maxlength="32" name="email" value="" placeholder="john.doe@gmail.com">
			</div>

			<div class="formInput">
				<label for="username">
					Username<span class="warning">*</span>
				</label>
				<input type="text" maxlength="32" name="username" value="" placeholder="john.doe">
			</div>

			<div class="formInput">
				<label for="password">
					Password<span class="warning">*</span>
				</label>
				<input type="password" maxlength="64" name="password" value="" placeholder="********">
			</div>

			<div class="formInput">
				<label for="registerPasswordConfirm">
					Confirm Password<span class="warning">*</span>
				</label>
				<input type="password" maxlength="64" name="registerPasswordConfirm" value="" placeholder="********">
			</div>

			<div class="formButton">
				<button class="submit" type="submit" name="submit" value="Edit">Edit Account</button>
			</div>

	<?php require '../views/partials/common_js.php'; ?>
</body>
</html>
