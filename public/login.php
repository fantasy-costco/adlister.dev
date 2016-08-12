<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/order_stylesheet.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../css/col.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../css/4cols.css" media="screen" type="text/css">
  </head>

  <body>
    <div class="main_container_wrapper">
      <div class="sign_in" id="main_content">
        <h1>Sign In or Create a New Account</h1>


        <div class="sign_in_col_1 col span_2_of_5">
          <h2>REGISTERED SHOPPERS</h2>
          <p>
            Please provide your email address and password to access your account.
            <br>
            <span class="asterisk" id="required">*Required fields.</span>
          </p>
          <form name="LogonForm" action="Logon" id="LogonForm" method="post">
            <div class="form-item">
              <label for="logonId">
                Email Address <span class="asterisk">*</span>
              </label>
              <input type="text" name="logonId" maxlength="254" title="Email Address" value="">
              <br>
            </div>
            <div class="form-item">
              <label for="logonPassword">
                Password <span class="asterisk">*</span>
              </label>
              <input type="text" name="logonPassword" maxlength="254" title="Password" value="">
              <br>
            </div>
            <div class="form-item">
              <input type="checkbox" name="option1" id="option1">
              <label for="option1">Remember me</label>
            </div>
            <input type="hidden" name="submitButton" value="signIn">
            <div class="form-item">
              <button type="submit" class="submit costco-button" title="Sign in">
                <span class="s1">
                  <span class="s2">Sign in</span>
                </span>
              </button>
            </div>
          </form>
        </div>


        <div class="sign_in_col_2 col span_3_of_5">
          <h2>NOT YET REGISTERED FOR FANTASYCOSTCO.COM?</h2>
          <p>
            Enter your email address and create your new account!
          </p>
          <form class="" action="index.html" method="post">
            <div class="form-item">
              <label for="register_email">
                Email Address <span class="asterisk">*</span>
              </label>
              <input type="text" title="Register Email Address" maxlength="32" id="regiter_email" name="email1" value="">
            </div>
            <div class="form-item">
              <label for="register_password">
                Password
              </label>
              <input class="passwordField" type="password" title="Register Password" maxlength="64" id="register_password" name="password1" value="">
            </div>
            <div class="form-item">
              <label for="regitster_passwordVerify">
                Confirm Password <span class="asterisk">*</span>
              </label>
              <input class="passwordConfirmField" type="password" title="Confirm Password" maxlength="64" id="register_passwordConfirm" name="password2"value="">
            </div>
            <div class="form-item">
              <button type="submit" name="register" title="Register" class="submit costco-button">
                <span class="s1">
                  <span class="s2">Register</span>
                </span>
              </button>
            </div>
          </form>
          <div class="disclaimer">
            <p>
              By registering or purchasing from Costco.com, you are agreeing to the <a href="#">terms and conditions</a> of use.
            </p>
          </div>


        </div>
      </div>
    </div>


  </body>
</html>
