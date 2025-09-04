<?php
    include('config/constants.php');
    $sn=1;

    $query = "SELECT * FROM tbl_service_jc
              WHERE payment_date >= '$start_date' AND payment_date <= '$end_date'";
    //  $query = "SELECT tbl_category.id, tbl_business.business, tbl_subcategory.category
    // FROM tbl_business INNER JOIN tbl_subcategory ON tbl_business.business = tbl_subcategory.business";
    
        
    $query_run = mysqli_query($conn, $query);
    
?>