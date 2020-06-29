<?php 
        include('includes/header.php');
        include('includes/navbar.php');
        include("db_connection.php");
        // session_start(); 
        //$sql = "SELECT * FROM employee";
        //$query = mysqli_query($conn, $sql);
		 session_start();
		$id = $_GET['id'];
		$select_id = "SELECT FROM employee WHERE id= '$id' ";
		$select_string = "SELECT * FROM jobs INNER JOIN client ON client.id = jobs.client_id INNER JOIN employee ON employee.id = jobs.emp_id WHERE jobs.emp_id =$id ORDER BY jobs.dated DESC";
		$query = mysqli_query($conn, $select_string);
?>
 <title>Jobs Deatials</title>
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
         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello Admin</span>
                <img class="img-profile rounded-circle" src="">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SR#</th>
                      <th>Employer</th>
                      <th>Filer Name</th>
                      <th>Job Description</th>
                      <th>Job Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>SR#</th>
                      <th>Employer</th>
                      <th>Filer Name</th>
                      <th>Job Description</th>
                      <th>Job Status</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   <?php
	              	  $counter = 1;
                    while($row = mysqli_fetch_array($query) ) {
			
		                $id= $row['id'];
                    echo'
                      <tr>
                        <td>'.$counter.'</td>
                        <td>'.$row['empname'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['description'].'</td>
						<td>'.$row['status'].'</td>
                       <td>'.$row['dated'].'</td>
                      </tr>';
                    $counter = $counter +1;
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>

<?php 
    include('includes/scripts.php');
    include('includes/footer.php');
?>