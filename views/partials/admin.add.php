<?php
<<<<<<< HEAD
$form = <<<FORM
Add Item
<form>
=======
$form=<<<FORM
<h1>Add Item</h1>
<form class="" action="admin_add_item.php" method="post">
>>>>>>> e8d641444403c7585a749c074198a1d0e545faa8
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
<<<<<<< HEAD
	<label for='price'>Price:
		<input type='text' name='price' id='price'>
	</label></div>
<div class='formInput'>
<label for='description'>Description:
	<input type='text' name='description' id='description'>
</label></div>
=======
	<label for='description'>Description:
		<input type='text' name='description' id='description'>
	</label>
</div>
>>>>>>> e8d641444403c7585a749c074198a1d0e545faa8

<div class='formInput fileuploadholder'>
	<form enctype="multipart/form-data" action="tester.php" method="post" name="FileUploadForm" id="FileUploadForm">
	<label for='img_path'>Upload Image File
	<span class='warning'>(Must be .jpeg or .png)</span>
		<input type='file' name='img_path' id='img_path'>
	</label>
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
	<button type='submit'>Submit</button>
</div>
</form>
FORM;

print_r($form);
?>
