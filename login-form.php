<?php
 include('config/constants.php');

 if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    // Check if the username and password are correct
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
    // Login successful
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user'] = $row['user_type'];
    $_SESSION['username'] = $row['username'];
    // $_SESSION['user_id'] = 1;
    // $_SESSION['user'] = 'admin';
    // $_SESSION['username'] = 'adminname';
    
    

    
    // Redirect to the appropriate page based on user type
    if ($_SESSION['user'] == 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('location:'.SITEURL.'/index.php');
    
    } elseif($_SESSION['user'] == 'sales') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        // header('location:'.SITEURL.'/sales.php');
        header('location:'.SITEURL.'/index.php');
        
    } elseif($_SESSION['user'] == 'accounts') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        // header('location:'.SITEURL.'/accounts.php');
         header('location:'.SITEURL.'/index.php');
        
    } elseif($_SESSION['user'] == 'manager') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        // header('location:'.SITEURL.'/manager.php');
         header('location:'.SITEURL.'/index.php');
        
    } elseif($_SESSION['user'] == 'projects') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        // header('location:'.SITEURL.'/projects.php');
        header('location:'.SITEURL.'/index.php');
        
    }  else {
    // Login failed, display an error message
    $_SESSION['login'] = "<div class='text-center' style='color:black;'>Check Username or Password.</div>";
    header('location:'.SITEURL.'/login.php');
    }
    }

}

?>