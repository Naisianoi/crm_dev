<?php
    include('config/constants.php');
    $sn=1;

        
    $query = "SELECT tbl_subcategory.id, tbl_business.business, tbl_category.category, tbl_subcategory.subcategory
            FROM tbl_subcategory
            INNER JOIN tbl_business ON tbl_business.id = tbl_subcategory.business_id
            INNER JOIN tbl_category ON tbl_category.id = tbl_subcategory.category_id";

    $sub_category_results = mysqli_query($conn, $query);
   
    
    
?>