<?php 
        include('includes/header.php');
        include('includes/navbar.php');

    ?>
     <link rel="stylesheet" href="login&signup/fonts/material-icon/css/material-design-iconic-font.min.css">
     <title>Register Employee</title>

<!-- Main css -->
<link rel="stylesheet" href="login&signup/css/style.css">
<link rel="stylesheet" href="CustomStyle/style.css">
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

           
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello Admin</span>
                <img class="img-profile rounded-circle" src="upload/admin.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
        </div>
      </li>

    </ul>

  </nav>
  <!-- End of Topbar -->

 
</head>
<body>

    <div class="main">
 <!-- Sign up form -->
 <section class="signup">
				
            <div class="container signup_custom">
                <div class="signup-content">
                    <div class="signup-form">
					<div id="outputDiv"></div>
                        <h2 class="form-title">Employee Registration</h2>
						
                        <form action="validate_regemp.php" method="post" class="register-form" id="register-form" ">
                            <div class="form-group">
							
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="empname" id="name" placeholder="Employee Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="name" placeholder="Employee Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="emp_number" id="name" placeholder="Employee Number" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="name" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                               <input type="password" name="cpass" id="name" placeholder="Repeat your password" required/>
                            </div>
							<div class="form-group">
                                <label for="imgUpload"><i class="zmdi zmdi-image"></i></label>
                                <input type="file" name="file"  id="name"required/>
                            </div> 
                           
                           <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
						`	</div>
                        </form>
						  
                    </div>
                </div>
            </div>
        </section>
        </div>

<!-- JS -->

<?php 
    include('includes/scripts.php');
    include('includes/footer.php');
?>
 <script> 
    $(document).ready(function() { 
         
		var options = { 
		target: '#outputDiv', 
		success: function(data) { 
			//alert('Thanks for your comment!'); 
			} 
		}; 
	$('#register-form').ajaxForm(options);
    }); 
</script>
