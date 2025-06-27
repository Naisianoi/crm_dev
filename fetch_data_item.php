<?php
    include('config/constants.php');
    $sn=1;

    // $query = "SELECT tbl_item.id, tbl_business.business, tbl_category.category, tbl_subcategory.subcategory, tbl_brand.brand, 
    // tbl_item.item_name, tbl_item.price, tbl_item.selling_price, tbl_item.min_stock, tbl_item.stock_qty, tbl_item.purchase_mode 
    //         FROM tbl_item
    //         INNER JOIN tbl_business ON tbl_business.id = tbl_item.business_id
    //         INNER JOIN tbl_category ON tbl_category.id = tbl_item.category_id
    //         INNER JOIN tbl_subcategory ON tbl_subcategory.id = tbl_item.subcategory_id
    //         INNER JOIN tbl_brand ON tbl_brand.id = tbl_item.brand_id";

    // $query_run = mysqli_query($conn, $query);

         $query = "SELECT 
            tbl_item.id, 
            tbl_business.business, 
            tbl_category.category, 
            tbl_subcategory.subcategory, 
            tbl_brand.brand, 
            tbl_item.item_name, 
            tbl_item.price, 
            tbl_item.auto_purchase_price, 
            tbl_item.selling_price, 
            tbl_item.auto_selling_price, 
            tbl_item.min_stock, 
            tbl_item.stock_qty, 
            tbl_item.purchase_mode,
            tbl_item.purchase_price_date,
            tbl_supplier.company_name
        FROM tbl_item
        INNER JOIN tbl_business ON tbl_business.id = tbl_item.business_id
        INNER JOIN tbl_category ON tbl_category.id = tbl_item.category_id
        INNER JOIN tbl_subcategory ON tbl_subcategory.id = tbl_item.subcategory_id
        INNER JOIN tbl_brand ON tbl_brand.id = tbl_item.brand_id
        INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_item.supplier_id";

        $query_run = mysqli_query($conn, $query);

        // Sum stock quantity
        // Query to fetch the total sum of stock_qty from tbl_item
        $query = "SELECT SUM(stock_qty) AS total_stock FROM tbl_item";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($result);
            
            // Extract the total stock quantity
            $totalStock = $row['total_stock'];
            
            // echo "Total Stock: $" . $totalStock;
        } else {
            // Handle the case where the query fails
            echo "Error: " . mysqli_error($conn);
        }
    
    
?>