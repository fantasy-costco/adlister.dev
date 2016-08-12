<?php

require __DIR__ . "/../utils/Input.php";
require __DIR__ . "/../utils/Auth.php";

session_start();

function pageController() {
	$pageTitle = "SIGN IN";
	$message = "";

	if (Input::isPost() && $_REQUEST["submit"] == "register") {
		$errors = [];

		try {
			$firstName = Input::getString('first_name');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		try {
			$lastName = Input::getString('last_name');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		try {
			$email = Input::getString('email');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		try {
			$username = Input::getString('username');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		try {
			$password = Input::getString('password');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		try {
			$registerPasswordConfirm = Input::getString('registerPasswordConfirm');
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
		}

		var_dump($errors);

		if ($password == $registerPasswordConfirm) {
			if (count($errors) == 0) {
				$user = new User();
				var_dump($user);
				$user->first_name = $firstName;
				$user->last_name = $lastName;
				$user->email = $email;
				$user->username = $username;
				$user->password = $password;
				$user->save();
				$_SESSION["CART"] = [];
			}
			header("Location: http://www.yahoo.com");
		} else {
			$message = "Your passwords don't match.";
			Auth::logError($message);
		}
	}
	// !User::findByUserNameOrEmail($username)

	return [
		"pageTitle" => $pageTitle,
		"message" => $message
	];
}

extract(pageController());