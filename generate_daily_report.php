<?php
include('config/constants.php'); // DB connection

// Check DB connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set timezone
date_default_timezone_set('Africa/Nairobi');

// Use report date from request or default to yesterday
$report_date = $_REQUEST['report_date'] ?? date('Y-m-d', strtotime('-1 day'));

// Prevent duplicate entries
$check = mysqli_query($conn, "SELECT * FROM tbl_daily_status WHERE daily_status_date = '$report_date'");
if (mysqli_num_rows($check) > 0) {
    echo "Report for $report_date already exists.";
    exit;
}

// Helper functions
function getCount($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

function getSum($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row ? floatval($row['total']) : 0;
}

// 1. Unassigned Job Cards (not date-dependent)
$unassigned_jc = getCount("SELECT id FROM tbl_service_jc WHERE jc_assigned_to IS NULL OR jc_assigned_to = ''");

// 2. Running Job Cards (not date-dependent)
$running_jc = getCount("SELECT id FROM tbl_service_jc WHERE jc_assigned_to IS NOT NULL AND jc_assigned_to <> '' 
                      AND jc_closed IS NULL AND paid IS NULL");

// 3. Pending Payment Job Cards (not date-dependent)
$pending_payment_jc = getCount("SELECT id FROM tbl_service_jc WHERE jc_closed = 'Closed' AND (paid IS NULL OR paid != 'Paid')");

// 4. Pending Payment Amount (not date-dependent)
$pending_payment_amount = getSum("SELECT SUM(amount) AS total FROM tbl_service_jc WHERE jc_closed = 'Closed' AND (paid IS NULL OR paid != 'Paid')");

// 5. Past Planned JC (compare against report date)
$past_planned_jc = getCount("SELECT id FROM tbl_service_jc 
    WHERE proposed_work_date < '$report_date' 
    AND work_done_date IS NULL 
    AND jc_assigned_to IS NOT NULL AND jc_assigned_to <> '' 
    AND jc_closed IS NULL AND paid IS NULL");

// 6. Stock Qty: Products
$stock_qty_products = getSum("SELECT SUM(stock_qty) AS total FROM tbl_product");

// 7. Stock Value: Products
$stock_value_products = getSum("SELECT SUM(stock_qty * auto_purchase_price) AS total FROM tbl_product");

// 8. Stock Qty: Items
$stock_qty_items = getSum("SELECT SUM(stock_qty) AS total FROM tbl_item");

// 9. Stock Value: Items
$stock_value_items = getSum("SELECT SUM(stock_qty * auto_purchase_price) AS total FROM tbl_item");

// 10. JC Created (based on jc_create_date in dd-mm-YYYY format)
$no_of_jc_created = getCount("SELECT id FROM tbl_service_jc 
    WHERE STR_TO_DATE(jc_create_date, '%d-%m-%Y') = '$report_date'");

// 11. Work Done
$no_of_work_done = getCount("SELECT id FROM tbl_service_jc 
    WHERE work_done_date = '$report_date'");

// 12. Concluded JC
$concluded_jc = getCount("SELECT id FROM tbl_service_jc 
    WHERE jc_conclude_date = '$report_date'");

// 13. Payment Received
$payment = getSum("SELECT SUM(total_paid_amount) AS total 
    FROM tbl_service_jc 
    WHERE payment_date = '$report_date'");

// Insert into tbl_daily_status
$insert = "
    INSERT INTO tbl_daily_status (
        daily_status_date,
        unassigned_jc, running_jc, pending_payment_jc, pending_payment_amount,
        past_planned_jc, stock_qty_products, stock_value_products,
        stock_qty_items, stock_value_items, no_of_jc_created,
        no_of_work_done, concluded_jc, payment
    ) VALUES (
        '$report_date',
        $unassigned_jc, $running_jc, $pending_payment_jc, $pending_payment_amount,
        $past_planned_jc, $stock_qty_products, $stock_value_products,
        $stock_qty_items, $stock_value_items, $no_of_jc_created,
        $no_of_work_done, $concluded_jc, $payment
    )
";

if (mysqli_query($conn, $insert)) {
    echo "Daily status report inserted for $report_date.";
} else {
    echo "Error inserting report: " . mysqli_error($conn);
}
?>
