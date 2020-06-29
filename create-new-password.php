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
                    <?php
						$selector = $_GET["selector"];
						$validator = $_GET["validator"];
						
						if(empty($selector) || empty($validator)){
							echo "could not validate your request!";
						}else{
							if(ctype_xdigit($selector) !==false && ctype_xdigit($validator) !==false){
								
								?>
								
								<form action="reset-request.inc.php" method="POST" class="register-form" id="login-form">
									<div class="form-group">
										<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
										<input type="hidden" name="selector" id="your_name" value="<?php echo $selector; ?>"/>
									</div>
									<div class="form-group">
										<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
										<input type="hidden" name="selector" id="your_name" value="<?php echo $validator; ?>"/>
									</div>
									<div class="form-group">
										<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
										<input type="password" name="pwd" id="your_name" placeholder="Please enter a new password."/>
									</div>
									<div class="form-group">
										<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
										<input type="password" name="pwd-repeat" id="your_name" placeholder="Please rewrite the new password."/>
									</div>
									 <div class="form-group form-button">
										<input type="submit" name="reset-password-submit" id="signin" class="form-submit" value="Reset password"/>
									</div>
								</form>	
								<?php
								
								
							}
						}
					?>    
						
                        
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
