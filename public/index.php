<?php

require __DIR__ . "/../controllers/pc_index.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<?php require __DIR__ . '/../views/partials/header.php'; ?>
	<audio id="theme">
		<source src="audio/Fantasy Costco Theme.mp3" type="audio/ogg">
	</audio>
</head>
<body>

	<?php var_dump($_GET);?>
    <?php require '../views/partials/navbar.php'; ?>
    <?php require '../views/partials/table.php'; ?>
    <?=populateSidebar($dbc)?>
    <div class='container'>
    <?=generateBodyHTML($dbc)?>
    </div>
    <?php require '../views/partials/footer.php'; ?>
    <?php require '../views/partials/common_js.php'; ?>
</body>
</html>
