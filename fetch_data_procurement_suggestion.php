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
WHERE (p.min_stock - p.stock_qty) > 0";

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
WHERE (i.min_stock - i.stock_qty) > 0 ";

$item_results = mysqli_query($conn, $item_query);


?>
