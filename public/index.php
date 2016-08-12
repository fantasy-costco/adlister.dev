<?php

session_start();

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
    <audio id="theme">
		<source src="audio/Fantasy Costco Theme.mp3" type="audio/ogg">
	</audio>
</head>
<body>
    <?php require '../views/partials/navbar.php'; ?>
    <?php require '../views/partials/table.php'; ?>
    <?=generateBodyHTML($dbc)?>
    <?php require '../views/partials/footer.php'; ?>
    <?php require '../views/partials/common_js.php'; ?>
</body>
</html>