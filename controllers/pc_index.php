<?php

// Page controller for index.php

session_start();

function pageController() {
	$pageTitle = "FANTASY COSTCO: WHERE ALL YOUR DREAMS COME TRUE";

	var_dump($_SESSION);

	return [
		"pageTitle" => $pageTitle
	];
}

extract(pageController());