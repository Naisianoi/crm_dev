<?php
    include('config/constants.php');
    $sn=1;
    $p=1;

    // Function to calculate the difference in days
    function getDaysDifference($purchaseDate)
    {
        $currentDate = new DateTime();
        $purchaseDate = new DateTime($purchaseDate);
        $interval = $currentDate->diff($purchaseDate);

        return $interval->days;
    }

        // Items
        $query_item = "SELECT 
            tbl_item.id, 
            tbl_business.business, 
            tbl_category.category, 
            tbl_subcategory.subcategory, 
            tbl_brand.brand, 
            tbl_item.item_name, 
            tbl_item.price, 
            tbl_item.selling_price, 
            tbl_item.min_stock, 
            tbl_item.stock_qty, 
            tbl_item.purchase_mode,
            tbl_item.purchase_price_date,
            tbl_item.auto_purchase_price,
            tbl_supplier.company_name
        FROM tbl_item
        INNER JOIN tbl_business ON tbl_business.id = tbl_item.business_id
        INNER JOIN tbl_category ON tbl_category.id = tbl_item.category_id
        INNER JOIN tbl_subcategory ON tbl_subcategory.id = tbl_item.subcategory_id
        INNER JOIN tbl_brand ON tbl_brand.id = tbl_item.brand_id
        INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_item.supplier_id
        WHERE tbl_item.purchase_price_date <= DATE_SUB(CURDATE(), INTERVAL 90 DAY) ORDER BY purchase_price_date ASC";


        $query_run_item = mysqli_query($conn, $query_item);
        // Items

        // Products
        $query_product = "SELECT 
            tbl_product.id, 
            tbl_business.business, 
            tbl_brand.brand, 
            tbl_product.name, 
            tbl_product.price, 
            tbl_product.selling_price, 
            tbl_product.min_stock, 
            tbl_product.stock_qty, 
            tbl_product.purchase_mode,
            tbl_product.purchase_price_date,
            tbl_product.auto_purchase_price,
            tbl_supplier.company_name
        FROM tbl_product
        INNER JOIN tbl_business ON tbl_business.id = tbl_product.business_id
        INNER JOIN tbl_brand ON tbl_brand.id = tbl_product.brand_id
        INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_product.supplier_id
        WHERE tbl_product.purchase_price_date <= DATE_SUB(CURDATE(), INTERVAL 90 DAY) ORDER BY purchase_price_date ASC";


        $query_run_product = mysqli_query($conn, $query_product);
        // Products

    
?>