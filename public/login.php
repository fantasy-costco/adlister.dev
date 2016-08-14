<?php require __DIR__ . "/../controllers/pc_login.php";?>

<!DOCTYPE html>
<html>
<head>
	<?php require __DIR__ . '/../views/partials/header.php'; ?>
</head>
<body>
	<?php require __DIR__ . '/../views/partials/navbar.php'; ?>
	<div class="container">
		<h1>Sign In or Create Account</h1>
		<p class="errorMessage"><?= isset($_SESSION["ERROR_MESSAGE"]) ? $_SESSION["ERROR_MESSAGE"] : null ?></p>
			
		<!-- if user is logged in, show option to log out -->
		<?php if (isset($_SESSION['IS_LOGGED_IN']))	: ?>
			<div class="flex">
				<div class="col-2 middle">
					<h3 class="centered">You are already logged in.</h3>
					<form action="logout.php">
						<input class="redButton" type="submit"  value="Log Out">
					</form>
				</div>
			</div>
		<!-- if user is not logged in, show login/register -->
		<?php else : ?>

		<div class="flex">
			<div class="col-6">
				<h2>Registered Shoppers - Sign In</h2>
				<p>Please provide your username and password to access your account.</p>
				<p class="warning small">* Required fields.</p>
				<form name="login" action="" method="post">
					<div class="formInput">
						<label for="username">
							Username<span class="warning">*</span>
						</label>
						<input type="text" name="username" maxlength="254" value="" placeholder="john.doe">
					</div>
					<div class="formInput">
						<label for="password">
							Password<span class="warning">*</span>
						</label>
						<input type="password" name="password" maxlength="254" placeholder="********">
					</div>
					<div class="formCheckbox">
						<label>
						<input type="checkbox" name="remember" value="rememberMe">
						Remember Me</label>
					</div>
					<div class="formButton">
						<button class="blueButton" type="submit" name="submit" value="login">Log In</button>
					</div>
				</form>
			</div>

			<div class="col-6">
				<h2>Register A New Account</h2>
				<p>Enter your information below to create your new account!</p>
				<form name="register" action="login.php" method="post">
					<div class="formInput">
						<label for="first_name">
							First Name<span class="warning">*</span>
						</label>
						<input type="text" maxlength="50" name="first_name" value="" placeholder="John">
					</div>
					<div class="formInput">
						<label for="last_name">
							Last Name<span class="warning">*</span>
						</label>
						<input type="text" maxlength="75" name="last_name" value="" placeholder="Doe">
					</div>
					<div class="formInput">
						<label for="email">
							Email Address<span class="warning">*</span>
						</label>
						<input type="text" maxlength="32" name="email" value="" placeholder="john.doe@gmail.com">
					</div>
					<div class="formInput">
						<label for="username">
							Username<span class="warning">*</span>
						</label>
						<input type="text" maxlength="32" name="username" value="" placeholder="john.doe">
					</div>
					<div class="formInput">
						<label for="password">
							Password<span class="warning">*</span>
						</label>
						<input type="password" maxlength="64" name="password" placeholder="********">
					</div>
					<div class="formInput">
						<label for="registerPasswordConfirm">
							Confirm Password<span class="warning">*</span>
						</label>
						<input type="password" maxlength="64" name="registerPasswordConfirm" placeholder="********">
					</div>
					<div class="formButton">
						<button class="blueButton" type="submit" name="submit" value="register">Register</button>
					</div>
				</form>

				<p class="finePrint">By registering or purchasing from FantasyCostco.com, you are agreeing to the <a href="#">Terms and Conditions</a> of use.</p>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
	<?php require __DIR__ . '/../views/partials/footer.php'; ?>
</body>
</html>
