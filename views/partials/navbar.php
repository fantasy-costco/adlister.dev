<header>
	<div id="main-header-bar">
		<div id="logo-div">
			<a href="/"><img id="logo" src="/img/Fantasy-Costco-by-Ryanphantom.png"></a>
		</div>
		<div id="search-bar-div">
			<div id="search-bar-inner-div">
			<form method="GET" style="margin-top:0px">
				<input type="text" id="searchbar" name="search">
				<input type="image" src="/img/loupe.svg" id="search-icon">
			</form>
			</div>
		</div>
		<div id="medium-content-menu">
			<div class="iconDiv pin">
				<img class="icon" src="/img/location-pin.svg">
				<span class="iconText">Locations</span>
			</div>
			<div class="iconDiv user">
				<img class="icon" src="/img/user-silhouette.svg">
				<span class="iconText">Account</span>
			</div>
			<div class="iconDiv cart">
				<img class="icon" src="/img/commerce.svg">
				<span class="iconText">Cart</span>
			</div>
		</div>
	</div>
	<div id="search-div">
		<div class="leftMenu">
			<a href="/?category=Consumable" class="option">Consumables</a>
			<a href="/?category=Equipment" class="option">Equipment</a>
			<a href="/?category=Weapon" class="option">Weapons</a>
			<a href="/?category=Misc" class="option">Misc</a>
		</div>
		<div class="rightMenu">
			<a href="#" class="option">Welcome, <?=$_SESSION['IS_LOGGED_IN']?></p>
			<?php if (isset($_SESSION["LOGGED_IN_ID"])) : ?>
				<a href="logout.php" class="option">Log Out</a>
			<?php endif; ?>
		</div>
	</div>
</header>
<?php
if(empty($_GET)){
echo '<script>
	var test=document.getElementById("theme");
	test.play();
</script>';
}