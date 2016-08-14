<?php

// Page controller for index.php

session_start();

function pageController() {
	$pageTitle = "FANTASY COSTCO: WHERE ALL YOUR DREAMS COME TRUE";

	return [
		"pageTitle" => $pageTitle
	];
}

extract(pageController());