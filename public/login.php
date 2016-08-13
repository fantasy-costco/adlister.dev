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
			
		<div class="flex">
			<div class="col-6">
				<h2>Registered Shoppers - Sign In</h2>
				<p>Please provide your email address and password to access your account.</p>
				<p class="warning small">* Required fields.</p>
				<form name="login" action="" method="post">

					<div class="formInput">
						<label for="email">
							Email Address<span class="warning">*</span>
						</label>
						<input type="text" name="email" maxlength="254" value="" placeholder="john.doe@gmail.com">
					</div>

					<div class="formInput">
						<label for="password">
							Password<span class="warning">*</span>
						</label>
						<input type="text" name="password" maxlength="254" placeholder="********">
					</div>
					
					<div class="formCheckbox">
						<label>
						<input type="checkbox" name="remember" value="rememberMe">
						Remember Me</label>
					</div>

					<!-- <input type="hidden" name="submitButton" value="signIn"> -->
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
						<input type="password" maxlength="64" name="password" value="" placeholder="********">
					</div>

					<div class="formInput">
						<label for="registerPasswordConfirm">
							Confirm Password<span class="warning">*</span>
						</label>
						<input type="password" maxlength="64" name="registerPasswordConfirm" value="" placeholder="********">
					</div>

					<div class="formButton">
						<button class="blueButton" type="submit" name="submit" value="register">Register</button><p class="warning message"><?= $message ?></p>
					</div>

				</form>
				<p class="finePrint">By registering or purchasing from FantasyCostco.com, you are agreeing to the <a href="#">Terms and Conditions</a> of use.</p>
			</div>
			
		</div>
	</div>
	<?php require __DIR__ . '/../views/partials/footer.php'; ?>
</body>
</html>
