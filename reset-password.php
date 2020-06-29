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
    <title>Reset Password</title>

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
<!--                  <div class="signin-content">
                      <figure><img src="login&signup/images/logo.jpg" alt="sing up image"></figure>
                        
                    </div> -->
						
                    <div class="signin-form reset"  >
                        <h2 class="form-title">Recover password</h2>
						<p>An E-mail will be send to you.</p>
						<p></p>
						<p></p>
						<p></p>
                        <form action="reset-password.php" method="POST" class="register-form" id="login-form">
						<div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Please enter your email"/>
                        </div>
                        <div class="form-group form-button">
                             <input type="submit" name="signin" id="signin" class="form-submit" value="Recover password"/>
                         </div>
                        </form>
						<?php 
							if(isset($_GET["reset"])){
								if($_GET["reset"]=="success"){
									echo '<p class="signupsuccess">Check your Email</p>';
								}
							}
						?>
						
						<p></p>
                        
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
