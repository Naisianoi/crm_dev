<?php
include('config/constants.php'); // adjust if your DB connection is defined elsewhere

// Run the sync query once
$update_query = "
    UPDATE tbl_service_jc_item i
    JOIN tbl_service_jc j ON i.service_jc_id = j.id
    SET i.work_done_date = j.work_done_date
    WHERE i.work_done_date IS NULL AND j.work_done_date IS NOT NULL
";

if (mysqli_query($conn, $update_query)) {
    $affected_rows = mysqli_affected_rows($conn);
    echo "<h3 style='color:green;'>✔️ Sync complete. $affected_rows rows updated.</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Error: " . mysqli_error($conn) . "</h3>";
}
?>
