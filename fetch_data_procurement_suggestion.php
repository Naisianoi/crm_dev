<?php
include('config/constants.php'); 

// // Query for Products
// $product_query = "SELECT
//     p.id,
//     p.stock_qty,
//     p.name,
//     p.min_stock,
//     p.price,
//     p.supplier_name,
//     p.purchase_mode
// FROM tbl_product p
// LEFT JOIN tbl_supplier s ON p.supplier_id = s.id";

// $product_results = mysqli_query($conn, $product_query);

// // Query for Items
// $item_query = "SELECT
//     i.id,
//     i.stock_qty,
//     i.item_name,
//     i.min_stock,
//     i.price,
//     i.supplier_name,
//     i.purchase_mode
// FROM tbl_item i
// LEFT JOIN tbl_supplier s ON i.supplier_id = s.id";

// $item_results = mysqli_query($conn, $item_query);
 
// Query for Products
// Query for Products with Supplier's Company Name
// Query for Products with Supplier's Company Name
$product_query = "SELECT
    p.id,
    p.stock_qty,
    p.name,
    p.min_stock,
    p.price,
    p.supplier_name,
    p.purchase_mode,
    p.auto_purchase_price,
    s.company_name
FROM tbl_product p
LEFT JOIN tbl_supplier s ON p.supplier_id = s.id
WHERE CAST(p.stock_qty AS SIGNED) < CAST(p.min_stock AS SIGNED)";
//WHERE p.stock_qty < p.min_stock"; Modified WHERE clause: Only include if stock_qty is less than min_stock

$product_results = mysqli_query($conn, $product_query);

// Query for Items with Supplier's Company Name
$item_query = "SELECT
    i.id,
    i.stock_qty,
    i.item_name,
    i.min_stock,
    i.price,
    i.supplier_name,
    i.purchase_mode,
    i.auto_purchase_price,
    s.company_name
FROM tbl_item i
LEFT JOIN tbl_supplier s ON i.supplier_id = s.id
WHERE CAST(i.stock_qty AS SIGNED) < CAST(i.min_stock AS SIGNED)";
//WHERE i.stock_qty < i.min_stock"; // Modified WHERE clause: Only include if stock_qty is less than min_stock

$item_results = mysqli_query($conn, $item_query);

?>
