<?php
    // $_SESSION['user_id'] = 1;
    // $_SESSION['user'] = 'admin';
    // $_SESSION['username'] = 'adminname';
  include('config/constants.php');
//   include('timeout.php');
  include('login-check.php');    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
   
    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Aquashine - CRM</title>
</head>
<body>



<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">


<div class="d-flex align-items-center justify-content-between">
  <a href="#" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">IWT - CRM</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>End Search Bar -->

    <!-- <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
      </ul>
    </nav>End Search Icon -->


<nav class="header-nav ms-auto">
  
      <div style="float: left;">
      <span > 
          
                <?php

                // $_SESSION['user'] = 'admin';
                // $_SESSION['username'] = 'adminname';

              if(isset($_SESSION['username'])) //if user session is set 
              {
                
                  $query = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username='$_SESSION[username]' ") ;
                  $fetch = mysqli_fetch_array($query);
           
                  
                  echo '<i>WELCOME :</i> <br>'.$fetch['username']; 

              } 
                    // if(isset($_GET['id']))
                    // {
                    //     echo '<i>Welcome</i> <br>'.$_GET['id'];
                        
                    // }
                ?><!---------End Admin name----->

      </span> 

      </div>



  <ul class="d-flex align-items-center">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <li class="nav-item d-block d-lg-none">
      <!-- <a class="nav-link nav-icon search-bar-toggle " href="#"> -->
      
        <!-- <i class="bi bi-search"></i> -->
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item  pe-3">


      

      
      <!-- End Profile Image Icon -->

        <div class="dropdown pb-4">
                    <?php
                            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
                            $image = $fetch["image_name"];
                            $userType = $fetch["user_type"];

                            // Define the default image folder
                            $imageFolder = "sales";

                            if ($userType === "admin") {
                                // If the user is an admin, set the image folder accordingly
                                $imageFolder = "admin-images";
                                
                            } elseif ($userType === "sales"){
                                $imageFolder = "sales";
                            }
                            elseif ($userType === "manager"){
                                $imageFolder = "manager";

                            } elseif ($userType === "projects"){
                                $imageFolder = "projects";
                            } elseif ($userType === "accounts"){
                                $imageFolder = "accounts";
                            }
                    ?>

                    <a href="#" class="d-flex align-items-center text text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle"> -->
                    
                    <!-- Sales -->
                    <?php if (empty($image) && $userType === "sales") { ?>
                        <!-- <img src="images/sales/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder; ?>/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } elseif(!empty($image) && $userType === "sales") { ?>
                        <!-- <img src="images/sales/<?php echo $image; ?>" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle">
                    
                     <!-- Admin -->
                    <?php }elseif (empty($image) && $userType === "admin") { ?>
                        <!-- <img src="images/admin/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder; ?>/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } elseif(!empty($image) && $userType === "admin") { ?>
                        <!-- <img src="images/admin/<?php echo $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle">
                    
                    
                    <!-- Manager -->
                    <?php } elseif (empty($image) && $userType === "manager") { ?>
                        <!-- <img src="images/admin/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder; ?>/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } elseif(!empty($image) && $userType === "manager") { ?>
                        <!-- <img src="images/admin/<?php echo $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle">
                    
                    
                    <!-- Projects -->
                    <?php } elseif (empty($image) && $userType === "projects") { ?>
                        <!-- <img src="images/sales/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder; ?>/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } elseif(!empty($image) && $userType === "projects") { ?>
                        <!-- <img src="images/sales/<?php echo $image; ?>" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle">
                

                    <!-- Accounts -->
                    <?php } elseif (empty($image) && $userType === "accounts") { ?>
                        <!-- <img src="images/sales/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder; ?>/default-p.png" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } elseif(!empty($image) && $userType === "accounts") { ?>
                        <!-- <img src="images/sales/<?php echo $image; ?>" width="30" height="30" class="rounded-circle" > -->
                        <img src="images/<?php echo $imageFolder . '/' . $image; ?>" alt="User Image" width="30" height="30" class="rounded-circle">
                    <?php } ?>
                    
                        
                    </a>


                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="color:black;">
                    <?php
                        if ($userType === "admin") {
                            // If the user is an admin, set the image folder accordingly
                            echo '<li><a class="dropdown-item" href="profile-admin.php">Profile</a></li>';
                        } elseif ($userType === "sales"){
                            
                            echo '<li><a class="dropdown-item" href="profile-sales.php">Profile</a></li>';
                        }
                        elseif ($userType === "manager"){
                        
                            echo '<li><a class="dropdown-item" href="profile-manager.php">Profile</a></li>';
        
                        } elseif ($userType === "projects"){
                            
                            echo '<li><a class="dropdown-item" href="profile-projects.php">Profile</a></li>';
                        } elseif ($userType === "accounts"){
                            
                            echo '<li><a class="dropdown-item" href="profile-accounts.php">Profile</a></li>';
                        }
                    ?>
                       
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
        </div>

        
    
      
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script src="main.js"></script>
<!-- ======= Sidebar ======= -->


<aside id="sidebar" class="sidebar" style="width: 200px;">
<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
    
        <?php
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
            
            $userType = $fetch["user_type"];


                    // Check the user's user_type (SALES OR OFFICE)
                    if ($userType === "admin") {
                        // Display the database-related links
                        echo '
                        <li class="subcategory">
                            <a href="#dashboard" data-bs-toggle="collapse" class="nav-link px-0 align-middle subcategory" role="tab" data-toggle="tab">
                                <!-- <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#dashboard"> <span class="d-none d-sm-inline">Dashboard</span></a> -->
                                
                                <b><a href="index.php" style="color:#0D6EFD;"> Dashboard</a></b></a>
                                
                        </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "accounts") {
                        // Display the database-related links
                        echo '
                        <li class="subcategory">
                            <a href="#dashboard" data-bs-toggle="collapse" class="nav-link px-0 align-middle subcategory" role="tab" data-toggle="tab">
                                <!-- <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#dashboard"> <span class="d-none d-sm-inline">Dashboard</span></a> -->
                                
                                <b><a href="accounts.php" style="color:#0D6EFD;"> Dashboard</a></b></a>
                                
                        </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "projects") {
                        // Display the database-related links
                        echo '
                        <li class="subcategory">
                            <a href="#dashboard" data-bs-toggle="collapse" class="nav-link px-0 align-middle subcategory" role="tab" data-toggle="tab">
                                <!-- <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#dashboard"> <span class="d-none d-sm-inline">Dashboard</span></a> -->
                                
                                <b><a href="projects.php" style="color:#0D6EFD;"> Dashboard</a></b></a>
                                
                        </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "manager") {
                        // Display the database-related links
                        echo '
                        <li class="subcategory">
                            <a href="#dashboard" data-bs-toggle="collapse" class="nav-link px-0 align-middle subcategory" role="tab" data-toggle="tab">
                                <!-- <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#dashboard"> <span class="d-none d-sm-inline">Dashboard</span></a> -->
                                
                                <b><a href="manager.php" style="color:#0D6EFD;"> Dashboard</a></b></a>
                                
                        </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "sales") {
                        // Display the database-related links
                        echo '
                        <li class="subcategory">
                            <a href="#dashboard" data-bs-toggle="collapse" class="nav-link px-0 align-middle subcategory" role="tab" data-toggle="tab">
                                <!-- <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#dashboard"> <span class="d-none d-sm-inline">Dashboard</span></a> -->
                                
                                <b><a href="sales.php" style="color:#0D6EFD;"> Dashboard</a></b></a>
                                
                        </li> <!-- End Manage Nav -->
                        ';
                    }

                ?>

            <?php
              $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
              
              $userType = $fetch["user_type"];


                    // Check the user's user_type (SALES OR OFFICE)
                    if ($userType === "admin" || $userType === "manager") {
                        // Display the database-related links
                        echo '
                        <li>
                        <a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <b>New Job Card</b></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu" data-bs-parent="#menu">
                           <li class="subcategory">
                                <a href="supplier-admin-jc-page.php" class="nav-link px-0" style="color: grey;">Admin</a>
                            </li>
                            <li class="subcategory">
                                <a href="amc-jobcard-page.php" class="nav-link px-0" style="color: red;">AMC</a>
                            </li>
                            <li class="subcategory">
                                <a href="project-jobcard-page.php" class="nav-link px-0" style="color: orange;">Project</a>
                            </li>
                            <li class="subcategory">
                                <a href="customers-service-jc-page.php"  class="nav-link px-0">Service</a>
                            </li>
                            <li class="subcategory">
                                <a href="customers-trading-jc-page.php" class="nav-link px-0" style="color: green;">Trading</a>
                            </li>
                            
                            
                        </ul>
                    </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "projects") {
                          // Display the database-related links
                        echo '
                        <li>
                            <a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <b>New Job Card</b></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu" data-bs-parent="#menu">
                              <li class="subcategory">
                                    <a href="supplier-admin-jc-page.php" class="nav-link px-0" style="color: grey;">Admin</a>
                                </li>
                                <li class="subcategory">
                                    <a href="amc-jobcard-page.php" class="nav-link px-0" style="color: red;">AMC</a>
                                </li>
                                <li class="subcategory">
                                    <a href="project-jobcard-page.php" class="nav-link px-0" style="color: orange;">Project</a>
                                </li>
                                
                                
                                
                            </ul>
                        </li> <!-- End Manage Nav -->
                        ';
                    } elseif ($userType === "sales") {
                      // Display the database-related links
                    echo '
                    <li>
                        <a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <b>New Job Card</b></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu" data-bs-parent="#menu">
                          
                           
                            <li class="subcategory">
                                <a href="customers-service-jc-page.php"  class="nav-link px-0">Service</a>
                            </li>
                            <li class="subcategory">
                                <a href="customers-trading-jc-page.php" class="nav-link px-0" style="color: green;">Trading</a>
                            </li>
                            
                            
                        </ul>
                    </li> <!-- End Manage Nav -->
                    ';
                } 
                
                ?>
                
                <?php
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
                        
                        $userType = $fetch["user_type"];

                                if($userType === "admin") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Manage JC</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                            <i><li class="subcategory">
                                                <a href="assign-jc-page.php"  class="nav-link px-0">Assign</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="close-jc-page.php" class="nav-link px-0">Close/Cancel</a>
                                            </li>
                                        
                                            <li class="subcategory">
                                                <a href="payment-page.php" class="nav-link px-0">Payment</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="jobcard-edit-page.php" class="nav-link px-0">Edit Jobcard</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="planner-page.php" class="nav-link px-0">Planner</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ';
                                } elseif($userType === "manager") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Manage JC</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                            <i><li class="subcategory">
                                                <a href="assign-jc-page.php"  class="nav-link px-0">Assign</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="close-jc-page.php" class="nav-link px-0">Close/Cancel</a>
                                            </li>
                                        
                                            <li class="subcategory">
                                                <a href="payment-page.php" class="nav-link px-0">Payment</a>
                                            </li>
                                            
                                            <li class="subcategory">
                                                <a href="planner-page.php" class="nav-link px-0">Planner</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ';
                                } elseif($userType === "sales") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Manage JC</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                            <i><li class="subcategory">
                                                <a href="assign-jc-page.php"  class="nav-link px-0">Assign</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="close-jc-page.php" class="nav-link px-0">Close/Cancel</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="payment-page.php" class="nav-link px-0">Payment</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="planner-page.php" class="nav-link px-0">Planner</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ';
                                } elseif($userType === "projects") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Manage JC</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                            
                                            <li class="subcategory">
                                                <a href="close-jc-page.php" class="nav-link px-0">Close/Cancel</a>
                                            </li>
                                        
                                        </ul>
                                    </li>
                                    ';
                                } elseif($userType === "accounts") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Manage JC</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                           
                                            <li class="subcategory">
                                                <a href="payment-page.php" class="nav-link px-0">Payment</a>
                                            </li>
                                        
                                        </ul>
                                    </li>
                                    ';
                                }
                ?>
                
                <?php
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
                
                $userType = $fetch["user_type"];


                        // Check the user's user_type (SALES OR OFFICE) 

                        // <li class="subcategory">
                        //                 <a href="amc-service-page.php"  class="nav-link px-0">AMC Services</a>
                        //             </li>
                        
                        if ($userType === "admin" || $userType === "manager") {
                            // Display the database-related links
                            echo '
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <b>Manage</b></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="subcategory">
                                        <a href="amc-view-page.php"  class="nav-link px-0">AMC</a>
                                    </li>
                                    
                                    <li class="subcategory">
                                        <a href="customer-page.php"  class="nav-link px-0">Customers</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="project-page.php" class="nav-link px-0">Projects</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="purchase-price-page.php" class="nav-link px-0">Purchase Price</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="receive-material-supplier.php" class="nav-link px-0">Receive Material</a>
                                    </li>
                                   
                                    <li class="subcategory">
                                        <a href="service-calls-page.php" class="nav-link px-0">Service Calls</a>
                                    </li>
                                    
                                </ul>
                            </li> <!-- End Manage Nav -->
                            ';
                        }  elseif ($userType === "sales") {
                                // Display the database-related links
                            echo '
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <b>Manage</b></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="subcategory">
                                        <a href="amc-view-page.php"  class="nav-link px-0">AMC</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="customer-page.php"  class="nav-link px-0">Customers</a>
                                    </li>
                                    
                                    <li class="subcategory">
                                        <a href="service-calls-page.php" class="nav-link px-0">Service Calls</a>
                                    </li>
                                    
                                </ul>
                            </li> <!-- End Manage Nav -->
                            ';
                        } elseif ($userType === "projects") {
                        // Display the database-related links
                                echo '
                                <li>
                                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                        <b>Manage</b></a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                        <li class="subcategory">
                                            <a href="amc-view-page.php"  class="nav-link px-0">AMC</a>
                                        </li>
                                        <li class="subcategory">
                                            <a href="customer-page.php"  class="nav-link px-0">Customers</a>
                                        </li>
                                        <li class="subcategory">
                                            <a href="project-page.php" class="nav-link px-0">Projects</a>
                                        </li>
                                        <li class="subcategory">
                                           <a href="purchase-price-page.php" class="nav-link px-0">Purchase Price</a>
                                        </li>
                                        <li class="subcategory">
                                            <a href="receive-material-page.php" class="nav-link px-0">Receive Material</a>
                                        </li>
                                        
                                        
                                    </ul>
                                </li> <!-- End Manage Nav -->
                                ';
                            } elseif ($userType === "accounts") {
                                // Display the database-related links
                                echo '
                                <li>
                                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                        <b>Manage</b></a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                        
                                        <li class="subcategory">
                                            <a href="project-page.php" class="nav-link px-0">Projects</a>
                                        </li>
                                                                                
                                    </ul>
                                </li> <!-- End Manage Nav -->
                                ';
                            } 
                    ?>

                    <?php
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
                        
                        $userType = $fetch["user_type"];


                                // Check the user's user_type (SALES OR OFFICE) 
                                if ($userType === "admin" || $userType === "manager") {
                                    // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Reports & Views</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                            
                                            <li class="subcategory">
                                                <a href="collection-report-page.php"  class="nav-link px-0">Collection Report</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="pdf_stock_correction.php?ACTION=VIEW" target="_blank"  class="nav-link px-0">PDF For Stock</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="price-list-page.php"  class="nav-link px-0">Price List</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="procurement-suggestion-page.php" class="nav-link px-0">Procurement Suggestion</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="stock-view-page.php"  class="nav-link px-0">Stock View</a>
                                            </li>
                                            <li class="subcategory">
                                            <a href="technician-report-page.php"  class="nav-link px-0">Technician Report</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="view-all-service-jc-page.php"  class="nav-link px-0">View All JC</a>
                                            </li>

                                        
                                        
                                        </ul>
                                    </li>
                                    ';
                                } elseif ($userType === "sales") {
                                        // Display the database-related links
                                    echo '
                                    <li>
                                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Reports & Views</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                            <li class="subcategory">
                                                <a href="price-list-page.php"  class="nav-link px-0">Price List</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="stock-view-page.php"  class="nav-link px-0">Stock View</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="view-all-service-jc-page.php"  class="nav-link px-0">View All JC</a>
                                            </li>
                                            
                                        
                                        
                                        </ul>
                                    </li>
                                    ';
                                } elseif ($userType === "projects") {
                                // Display the database-related links
                                        echo '
                                        <li>
                                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <b>Reports & Views</b></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                            
                                            
                                            <li class="subcategory">
                                                <a href="pdf_stock_correction.php?ACTION=VIEW" target="_blank"  class="nav-link px-0">PDF For Stock</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="price-list-page.php"  class="nav-link px-0">Price List</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="procurement-suggestion-page.php" class="nav-link px-0">Procurement Suggestion</a>
                                            </li>
                                            <li class="subcategory">
                                                <a href="stock-view-page.php"  class="nav-link px-0">Stock View</a>
                                            </li>
                                            
                                            <li class="subcategory">
                                                <a href="view-all-service-jc-page.php"  class="nav-link px-0">View All JC</a>
                                            </li>

                                        
                                        
                                        </ul>
                                    </li>
                                        ';
                                    } elseif ($userType === "accounts") {
                                        // Display the database-related links
                                        echo '
                                        <li>
                                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                                <b>Reports & Views</b></a>
                                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                                
                                                <li class="subcategory">
                                                    <a href="collection-report-page.php"  class="nav-link px-0">Collection Report</a>
                                                </li>
                                                <li class="subcategory">
                                                    <a href="pdf_stock_correction.php?ACTION=VIEW" target="_blank"  class="nav-link px-0">PDF For Stock</a>
                                                </li>
                                                <li class="subcategory">
                                                    <a href="price-list-page.php"  class="nav-link px-0">Price List</a>
                                                </li>
                                                <li class="subcategory">
                                                    <a href="stock-view-page.php"  class="nav-link px-0">Stock View</a>
                                                </li>
                                                
                                                <li class="subcategory">
                                                    <a href="view-all-service-jc-page.php"  class="nav-link px-0">View All JC</a>
                                                </li>
                        
                                            
                                            
                                            </ul>
                                        </li>
                                        ';
                                    } 
                            ?>

      

            <?php
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
                
                $userType = $fetch["user_type"];


                        // Check the user's user_type (SALES OR OFFICE) 
                        if ($userType === "admin") {
                            // Display the database-related links
                            echo '
                            <li>
                                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <b>Database</b></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu" >
                                    <li class="subcategory">
                                        <a href="area-page.php" class="nav-link px-0 subcategory">Area</a>
                                    </li>
                                    <li class="subcategory">
                                        <a class="nav-link px-0 subcategory" href="brand-page.php">Brand</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="business-page.php" class="nav-link px-0 subcategory">Business</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="category-page.php" class="nav-link px-0 subcategory">Category</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="commerce-page.php" class="nav-link px-0 subcategory" >Commerce</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="item-page.php" class="nav-link px-0">Items</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="mpesa-page.php" class="nav-link px-0">Mpesa</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="product-page.php" class="nav-link px-0">Products</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="rates-page.php" class="nav-link px-0">Rates</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="sales-agents-page.php" class="nav-link px-0">Sales Agents</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="stock-correction-page.php" class="nav-link px-0">Stock Correction</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="subcategory-page.php" class="nav-link px-0">Sub-category</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="supplier-page.php" class="nav-link px-0">Supplier</a>
                                    </li>
                                
                                    <li class="subcategory">
                                        <a href="technician-page.php" class="nav-link px-0">Technician</a>
                                    </li>
                                    <li class="subcategory">
                                        <a href="unit-of-measurement-page.php" class="nav-link px-0">Unit of Measurement</a>
                                    </li>
                                
                                </ul>
                            </li><!-- End Jobcard Nav -->


                            <li class="subcategory">
                                <a href="manage-users.php" class="nav-link px-0 align-middle">
                                    <span><b>Users</b></span>
                                </a>
                            </li>

                            
                            ';
                        } elseif ($userType === "manager") {
                                // Display the database-related links
                            echo '
                            <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <b>Database</b></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu" >
                            
                                <li class="subcategory">
                                    <a href="item-page.php" class="nav-link px-0">Items</a>
                                </li>
                                <li class="subcategory">
                                    <a href="mpesa-page.php" class="nav-link px-0">Mpesa</a>
                                </li>
                                <li class="subcategory">
                                    <a href="product-page.php" class="nav-link px-0">Products</a>
                                </li>
                                
                                <li class="subcategory">
                                    <a href="sales-agents-page.php" class="nav-link px-0">Sales Agents</a>
                                </li>

                                <li class="subcategory">
                                    <a href="supplier-page.php" class="nav-link px-0">Supplier</a>
                                </li>
                            
                            
                            </ul>
                        </li><!-- End Jobcard Nav -->

                            ';
                        } 
                    ?>

      

    

  
</ul>

</aside><!-- End Sidebar-->