<?php
require __DIR__ . "/../controllers/pc_index.php";
?>
<!DOCTYPE html>
<html>
<head>
    <?php require __DIR__ . '/../views/partials/header.php'; ?>
    <audio id="theme">
      <source src="audio/Fantasy Costco Theme.mp3" type="audio/ogg"></audio>
</head>
<body>
   <?php require '../views/partials/navbar.php'; ?>
	<div style="position:relative;display:flex;width:100%;height:100px;flex-direction:row;background-color:red">
		<div class="col-1" style="border:1px solid black">
			<img src="img/1.png" style="width:80px;height:80px">
		</div>
		<div class="col-1" style="border:1px solid black">
			<img src="img/1.png" style="width:80px;height:80px">
		</div>
		<div class="col-1" style="border:1px solid black">
			<img src="img/1.png" style="width:80px;height:80px">
		</div>
		<div class="col-1" style="border:1px solid black">
			<img src="img/1.png" style="width:80px;height:80px">
		</div>
		<div class="col-1" style="border:1px solid black">
			<img src="img/1.png" style="width:80px;height:80px">
		</div>
	</div>
   <?php require_once '../views/partials/table.php'; ?>
   <?php require '../views/partials/footer.php'; ?>
   <?php require '../views/partials/common_js.php'; ?>
</body>
</html>