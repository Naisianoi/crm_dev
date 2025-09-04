<?php
    include('config/constants.php');
    $sn=1;

    // $query = "SELECT tbl_product.id, tbl_business.business, tbl_brand.brand, tbl_product.name, tbl_product.price, tbl_product.selling_price, 
    // tbl_product.min_stock, tbl_product.stock_qty, tbl_product.purchase_mode            FROM tbl_product
    //         INNER JOIN tbl_business ON tbl_business.id = tbl_product.business_id
    //         INNER JOIN tbl_brand ON tbl_brand.id = tbl_product.brand_id";
                    
    // $query_run = mysqli_query($conn, $query);

    $query = "SELECT 
    tbl_product.id, 
    tbl_business.business, 
    tbl_brand.brand, 
    tbl_product.name, 
    tbl_product.price, 
    tbl_product.auto_purchase_price, 
    tbl_product.selling_price, 
    tbl_product.auto_selling_price, 
    tbl_product.min_stock, 
    tbl_product.stock_qty, 
    tbl_product.purchase_mode,
    tbl_supplier.company_name
FROM tbl_product
INNER JOIN tbl_business ON tbl_business.id = tbl_product.business_id
INNER JOIN tbl_brand ON tbl_brand.id = tbl_product.brand_id
INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_product.supplier_id";

$product_results = mysqli_query($conn, $query);

        
         // Sum stock quantity
        // Query to fetch the total sum of stock_qty from tbl_item
        $query = "SELECT SUM(stock_qty) AS total_stock FROM tbl_product";

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