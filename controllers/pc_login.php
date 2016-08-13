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
			if (!$errors) {
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
				var_dump($_SESSION);
			}
		} else {
			$message = "Your passwords don't match.";
			Auth::logError($message);
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
		if(Auth::attempt($username, $password)) {
			header("Location: index.php");
		} else {
			Auth::logError("Incorrect Login. Please try again.");
		}
	}
			
	return [
		"pageTitle" => $pageTitle,
	];
}

extract(pageController());