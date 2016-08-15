<header>
	<div id="links-bar">
		<div id="logo-div-top">
			<a href="/"><img id="logo-top" src="/img/Fantasy-Costco-by-Ryanphantom.png"></a>
		</div>
	</div>
	<div id="main-header-bar">
		<div id="logo-div">
			<a href="/"><img id="logo" src="/img/Fantasy-Costco-by-Ryanphantom.png"></a>
		</div>
		<div id="small-search">
			<form method="GET" style="margin-top:0px">
			<div style="display:block;position:relative;width:100%;background-color:purple;height:30px;min-width:65px;min-width:70px;max-width:70px;padding:5px;border:1px solid black">Shop
				<input type="image" id="list-icon" src="/img/interface.png" style="background-color:yellow">
			</form>
			</div>
		</div>
		<div id="search-bar-div">
			<div id="search-bar-inner-div">
			<form method="GET" style="margin-top:0px">
				<input type="text" id="searchbar" name="search">
				<input type="image" src="/img/loupe.svg" id="search-icon">
			</form>
			</div>
		</div>
		<div id="large-content-menu">
				<div id="sign-in-div">
				<span id="sign-in-span">Sign In/Register</span>
				</div>
				<div id="cart-div">
				<span id="cart-span">Cart</span>
				<img id="cart-logo" src="/img/commerce.svg">
				</div>
		</div>
		<div id="medium-content-menu">
		<div class="medium-content-item" style="">
		<img src="/img/location-pin.svg" style="position:relative;width:22px;left:40px">
		<span style="position:relative;top:10px">Locations</span>
		</div>
		<div class="medium-content-item" style="border-right:1px solid #3071a9">
			<img src="/img/user-silhouette.svg" style="position:relative;width:22px;left:40px">
			<span style="position:relative;top:10px">Account</span>
		</div>
		<div class="medium-content-item" style="">
			<img src="/img/commerce.svg" style="position:relative;width:22px;left:40px">
			<span style="position:relative;top:10px;left:12px">Cart</span>
		</div>
		</div>
	</div>
	<div id="search-div">
		<img id="list-icon" src="/img/interface.png">
		<span><a href="/?category=Consumable" class="option">Consumables</a></span>
		<span><a href="/?category=Equipment"class="option">Equipment</a></span>
		<span><a href="/?category=Misc" class="option">Misc</a></span>
		<span><a href="/?category=Weapon" class="option">Weapons</a></span>
		<span><a href="/?search=viewAll" class="option">See All Products</a></span>
	</div>
</header>
<?php
if(empty($_REQUEST)){
echo '<script>
	var test=document.getElementById("theme");
	test.play();
</script>';
}