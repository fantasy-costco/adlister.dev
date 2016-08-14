<?php

require __DIR__ . '/Log.php';
require __DIR__ . '/../models/User.php';

class Auth {

	public static function attempt($username, $password) {
		if(($username == "" || $username == null) || ($password == "" || $password == null)) {
			self::logError();
			return false;
		}

		$user = User::findByUsernameOrEmail($username);

		if ($user == null) {
			self::logError();
			return false;
		}

		if (password_verify($password, $user->password) || $password === $user->password) {
			$_SESSION['IS_LOGGED_IN'] = $user->username;
			$_SESSION['LOGGED_IN_ID'] = $user->user_id;
			$_SESSION['USER_TYPE'] = $user->admin;
			return true;
		} else {
			self::logError();
			return false;
		}
	}

	public static function isLoggedIn() {
		return (isset($_SESSION['IS_LOGGED_IN']) && $_SESSION['IS_LOGGED_IN'] != "");
	}

	public static function getCurrentUserId() {
		return Auth::isLoggedIn() ? $_SESSION['LOGGED_IN_ID'] : null;
	}

	public static function getCurrentUserInstance() {
		return Auth::isLoggedIn() ? User::findByUsernameOrEmail($_SESSION['IS_LOGGED_IN']) : null;
	}

	public static function logout() {
	    session_unset();
	    session_regenerate_id(true);
	    return true;
	}

	public static function logError() {
		$_SESSION['ERROR_MESSAGE'] = "Incorrect login. Please try again.";
		$log = new Log();
		$log->error("Incorrect login. Please try again." . PHP_EOL);
	}

	public static function logInfo($message) {
		$log = new Log();
		$log->info($message);
	}
}