<?php

require __DIR__ . "/../utils/Input.php";
require __DIR__ . "/../utils/Auth.php";

session_start();

function pageController() {
	$pageTitle = "SIGN IN";
	$message = "";

	// register form
	if (Input::isPost() && $_REQUEST["submit"] == "register") {
		$errors = [];

		// retrieve all values from register form
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

		// if password matches password confirm, create new user and store in db. if not, log error and return user an error message.
		if ($password == $registerPasswordConfirm) {
			if (count($errors) == 0) {
				$user = new User;
				$user->first_name = $firstName;
				$user->last_name = $lastName;
				$user->current_balance = 2000;
				$user->email = $email;
				$user->username = $username;
				$user->password = password_hash($password, PASSWORD_DEFAULT);
				$user->admin = (bool) 0;
				$user->save();
				$_SESSION["CART"] = [];
				header("Location: index.php");
			}
		} else {
			incorrectLogin();
		}

	// login form
	} elseif (Input::isPost() && $_REQUEST["submit"] == "login") {
		// retrieve login form values
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

		// run creds through Auth for verification
		if (Auth::attempt($username, $password)) {
			unset($_SESSION['ERROR_MESSAGE']);
			if ($_SESSION['USER_TYPE']) {
				header("Location: admin_account.php");
			} else {
				header("Location: index.php");
			}
		} elseif (!Auth::attempt($username, $password)) {
			Auth::logError();
		}
	}
			
	return [
		"pageTitle" => $pageTitle
	];
}

extract(pageController());
