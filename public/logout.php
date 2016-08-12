<?php

require_once "../../src/Log.php";
require_once "../../src/Auth.php";

function pageController() {
	session_start();
	Log::info("User $username logged out.");
	Auth::logout();
}

pageController();

?>