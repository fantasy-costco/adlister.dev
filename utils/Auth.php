<?php

require_once __DIR__ . '/Log.php';
require_once __DIR__ . '/../models/User.php';

class Auth {

	public static function attempt($username, $password) {
		$error = "Incorrect login. Please try again.";

		if(($username == "" || $username == null) || ($password == "" || $password == null)) {
			$_SESSION['ERROR_MESSAGE'] = $error;
			$this->logError($error);
			return false;
		}

		$user = User::findByUsernameOrEmail($username);
		if ($user == null) {
			$_SESSION['ERROR_MESSAGE'] = $error;
			$this->logError($error);
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['IS_LOGGED_IN'] = $user->username;
			$_SESSION['LOGGED_IN_ID'] = $user->user_id;
			return true;
		} else {
			$_SESSION['ERROR_MESSAGE'] = $error;
			$this->logError($error);
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

	private static function logError($error) {
		$log = new Log();
		$log->error($error . PHP_EOL);
	}
}

?>