<?php
 session_start();
include("db_connection.php");
if(isset($_SESSION['logged'])){
	 header("location: dashboard.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="login&signup/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="login&signup/css/style.css">
</head>
<body>

    <div class="main">

             <!-- Sing in  Form -->
             <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="login&signup/images/logo.jpg" alt="sing up image"></figure>
                        
                    </div>
						
                    <div class="signin-form"  >
                        <h2 class="form-title">Hello, Welcome Admin.</h2>
                        <form action="validate_login.php" method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Enter Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="your_pass" placeholder="Enter Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
							<?php
								if(isset($GET["newpwd"])){
									if($_GET["newpwd"]=="passwordupdated"){}
										echo '<p class="signupsuccess">pssword reset</p>';
								}
							?>
							<a href="reset-password.php">Forget Password?</a>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>

        </div>

<!-- JS -->
<script src="login&signup/vendor/jquery/jquery.min.js"></script>
<script src="login&signup/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
