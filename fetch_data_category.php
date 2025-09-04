<?php
    include('config/constants.php');
    $sn=1;

    //$query = "SELECT * FROM tbl_category";
    // $query = "SELECT tbl_category.id, tbl_business.business, tbl_category.category
    //            FROM tbl_business INNER JOIN tbl_category ON tbl_business.business = tbl_category.business";
    // $query_run = mysqli_query($conn, $query);

    $query = "SELECT tbl_category.id, tbl_business.business, tbl_category.category
            FROM tbl_category
            INNER JOIN tbl_business ON tbl_business.id = tbl_category.business_id"; // Assuming the column names are 'id' in tbl_business and 'business_id' in tbl_category
            $category_query = mysqli_query($conn, $query);
    
?>