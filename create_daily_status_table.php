<?php
include('config/constants.php'); // Your DB connection

$sql = "CREATE TABLE IF NOT EXISTS tbl_daily_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    daily_status_date DATE UNIQUE,
    unassigned_jc INT DEFAULT 0,
    running_jc INT DEFAULT 0,
    pending_payment_jc INT DEFAULT 0,
    pending_payment_amount DECIMAL(10,2) DEFAULT 0,
    past_planned_jc INT DEFAULT 0,
    stock_qty_products INT DEFAULT 0,
    stock_value_products DECIMAL(12,2) DEFAULT 0,
    stock_qty_items INT DEFAULT 0,
    stock_value_items DECIMAL(12,2) DEFAULT 0,
    no_of_jc_created INT DEFAULT 0,
    no_of_work_done INT DEFAULT 0,
    concluded_jc INT DEFAULT 0,
    payment DECIMAL(12,2) DEFAULT 0
) ENGINE=InnoDB;";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
