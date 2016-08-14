<?php

require __DIR__ . "/../utils/Auth.php";

function pageController() {
	session_start();
	Auth::logInfo("User {$_SESSION['IS_LOGGED_IN']} logged out.");
	Auth::logout();
	header("Location: login.php");
}

pageController();

?>