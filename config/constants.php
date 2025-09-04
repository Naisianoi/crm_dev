<?php 

//Start Session
if(!isset($_SESSION)) 
    {
        session_set_cookie_params(3600); // 1 hour   
        session_start();
    } 


if (!defined('SITEURL')) define('SITEURL', '');
if (!defined('LOCALHOST')) define('LOCALHOST', '');
if (!defined('DB_USERNAME')) define('DB_USERNAME', '');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', '');


 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) /*or die(mysqli_error())*/; //Database connection
 $db_select = mysqli_select_db($conn, DB_NAME) ;/*or die(mysqli_error());*/ //Selecting database
 
if($conn === false)
{
    die("ERROR: Could not connect. " .mysqli_connect_error());
}


?>
