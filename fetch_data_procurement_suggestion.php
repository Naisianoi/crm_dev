<?php
include('config/constants.php'); 

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

<?php
// Products in Buffer Zone (Air Freight or Sea Freight, 100% <= stock_qty < 120%)
$product_query_freight_buffer = "
    SELECT 
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
    WHERE (p.purchase_mode = 'Air Freight' OR p.purchase_mode = 'Sea Freight')
    AND p.stock_qty >= p.min_stock
    AND p.stock_qty < (p.min_stock * 1.2)
    AND p.id NOT IN (
        SELECT id FROM tbl_product WHERE CAST(stock_qty AS SIGNED) < CAST(min_stock AS SIGNED)
    )
";
$product_results_freight_buffer = mysqli_query($conn, $product_query_freight_buffer);


// Items in Buffer Zone
$item_query_freight_buffer = "
    SELECT 
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
    WHERE (i.purchase_mode = 'Air Freight' OR i.purchase_mode = 'Sea Freight')
    AND i.stock_qty >= i.min_stock
    AND i.stock_qty < (i.min_stock * 1.2)
    AND i.id NOT IN (
        SELECT id FROM tbl_item WHERE CAST(stock_qty AS SIGNED) < CAST(min_stock AS SIGNED)
    )
";
$item_results_freight_buffer = mysqli_query($conn, $item_query_freight_buffer);

?>
