<?php require __DIR__ . "/../controllers/pc_login.php"; ?>

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
						<label for="logonPassword">
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
						<button class="blueButton" type="submit" name="login">Log In</button>
					</div>
				</form>
			</div>

			<div class="col-6">
				<h2>Register A New Account</h2>
				<p>Enter your email address and create your new account!</p>
				
				<form name="register" action="" method="post">

					<div class="formInput">
						<label for="registerEmail">
							Email Address<span class="warning">*</span>
						</label>
						<input type="text" maxlength="32" name="registerEmail" value="" placeholder="john.doe@gmail.com">
					</div>

					<div class="formInput">
						<label for="registerPassword">
							Password<span class="warning">*</span>
						</label>
						<input type="password" maxlength="64" name="registerPassword" value="" placeholder="********">
					</div>

					<div class="formInput">
						<label for="registerPasswordConfirm">
							Confirm Password<span class="warning">*</span>
						</label>
						<input type="password" maxlength="64" name="registerPasswordConfirm" value="" placeholder="********">
					</div>

					<div class="formButton">
						<button class="blueButton" type="submit" name="register">Register</button>
					</div>

				</form>
				<p class="finePrint">By registering or purchasing from FantasyCostco.com, you are agreeing to the <a href="#">Terms and Conditions</a> of use.</p>
			</div>
			
		</div>
	</div>
	<?php require __DIR__ . '/../views/partials/footer.php'; ?>
</body>
</html>
