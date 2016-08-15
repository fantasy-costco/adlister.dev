<?php

// session_start();

 // require __DIR__ . "/../controllers/pc_add_item.php";


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
    <h1>Item Name</h1>
    <form class="" enctype="multipart/form-data" action="admin_add_item.php" method="post">
    <div class='formInput'>
    	<label for='item_name'>Item Name
    	<input type='text' name='item_name' id='item_name'>
    	</label>
    </div>
    <div class='formInput'>
    	<label for='price'>Price:
    		<input type='text' name='price' id='price'>
    	</label>
    </div>

    <div class='formInput'>
    	<label for='description'>Description:
    		<input type='text' name='description' id='description'>
    	</label>
    </div>

    <div class='formInput fileuploadholder'>
    				<label for="img_path">Upload Image File</label>
    			<span class="warning">(Must be .jpeg or .png)</span>
    			<input type="file" name="img_path" id="img_path">
    </div>

    <div class='formInput'>
    	<label for='short_description'>Short Description:
    		<input type='text' name='short_description' id='short_description'>
    	</label>
    </div>

    <div class='formInput'>
    	<label for='keywords'>Keywords:
    		<input type='text' name='keywords' id='keywords'>
    	</label>
    </div>
    <div class="formInput">
    	<label for='category'>Category:
    	<input type='text' name='category' id='category'>
    	</label>
    </div>

    <div class='formButton'>
    	<button type='submit' name="submit" value="edit_item">Submit</button>
    </div>
    </form>
	</div>

	<?php require '../views/partials/common_js.php'; ?>
</body>
</html>
