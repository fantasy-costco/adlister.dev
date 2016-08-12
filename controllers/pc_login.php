<?php

function pageController() {
	$pageTitle = "SIGN IN";

	return [
		"pageTitle" => $pageTitle
	];
}

extract(pageController());