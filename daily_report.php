<?php
session_start();
include('config/constants.php');
include('partials/navbar.php');

// Only allow admin to view
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'admin') {
    echo "<p style='color:red;'>Access denied. Only admin can view this page.</p>";
    exit;
}

// Set timezone and check if it's past 11:30 PM
date_default_timezone_set('Africa/Nairobi');
$currentTime = date('H:i');
if ($currentTime < '14:00') {
    echo "<p style='color:orange;'>Daily report is only available after 11:30 PM.</p>";
    exit;
}

// Fetch today's report from the table
$today = date('Y-m-d');
$query = "SELECT * FROM daily_status_report_test WHERE daily_status_date = '$today'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    echo "<h2 style='margin-top:30px; color:#1997D4;'>Daily Status Report for $today</h2>";
    echo "<table class='table table-bordered' style='font-size:16px; width: 100%;'>
            <thead class='thead-dark'>
                <tr>
                    <th>Unassigned JC</th>
                    <th>Running JC</th>
                    <th>Pending Payment JC</th>
                    <th>Pending Payment Amount</th>
                    <th>Past Planned JC</th>
                    <th>JC Created</th>
                    <th>Work Done</th>
                    <th>Concluded JC</th>
                    <th>Payments Received</th>
                    <th>Product Qty</th>
                    <th>Product Value</th>
                    <th>Item Qty</th>
                    <th>Item Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{$row['unassigned_jc']}</td>
                    <td>{$row['running_jc']}</td>
                    <td>{$row['pending_payment_jc']}</td>
                    <td style='color:red;'>" . number_format($row['pending_payment_amount'], 2) . "</td>
                    <td>{$row['past_planned_jc']}</td>
                    <td>{$row['no_of_jc_created']}</td>
                    <td>{$row['no_of_work_done']}</td>
                    <td>{$row['concluded_jc']}</td>
                    <td style='color:green;'>" . number_format($row['payment'], 2) . "</td>
                    <td>{$row['stock_qty_products']}</td>
                    <td>" . number_format($row['stock_value_products'], 2) . "</td>
                    <td>{$row['stock_qty_items']}</td>
                    <td>" . number_format($row['stock_value_items'], 2) . "</td>
                </tr>
            </tbody>
        </table>";
} else {
    echo "<p class='text-muted'>No report found for today. Please ensure <code>generate_daily_report.php</code> has been run.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<script src="js/main.js"></script>



</body>
</html>
