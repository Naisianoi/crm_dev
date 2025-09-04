<?php
    include('config/constants.php');
    $sn=1;

    
    // $query = "SELECT tbl_brand.id, tbl_business.business, tbl_brand.brand
    //            FROM tbl_business INNER JOIN tbl_brand ON tbl_business.business = tbl_brand.business";
    // $query_run = mysqli_query($conn, $query);


    $query = "SELECT tbl_brand.id, tbl_business.business, tbl_brand.brand
                FROM tbl_brand
                INNER JOIN tbl_business ON tbl_business.id = tbl_brand.business_id";
                $brand_results = mysqli_query($conn, $query);
    
?>