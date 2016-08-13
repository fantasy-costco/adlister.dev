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
<<<<<<< HEAD
<?php var_dump($_GET);?>
=======
	<?php var_dump($_GET);?>
>>>>>>> e8d641444403c7585a749c074198a1d0e545faa8
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
