<?php 

//Start Session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Message</title>
</head>
<body>

    <!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">





        





       

<main id="main" class="main">
 <section>
    <div class="container-lg text-center" style="padding-top: 0px;">
        <?php
            
            //$result = mysqli_query($conn, "SELECT * FROM tbl_brand");
            $success = "";
            $sn=1;

            
            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
            ?>
                <h5 class="text-sucess"><?php echo $_SESSION['status']; ?></h5>
            <?php
            
            unset($_SESSION['status']);
            }
            

            

                
                
                
            

            
            
        ?>
    </div>
 </section>
</main>
    
</body>
</html>



