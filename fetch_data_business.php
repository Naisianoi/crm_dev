<?php
    include('config/constants.php');
    $sn=1;

    //$query = "SELECT * FROM tbl_business";
    $query = "SELECT tbl_business.id, tbl_business.business_name, tbl_business.business
               FROM tbl_business";
    $query_run = mysqli_query($conn, $query);
    
?>