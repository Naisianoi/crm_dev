<?php
// Step 1: Include database connection
include('config/constants.php'); // This should define $conn

// Step 2: Write the SQL query
$query = "SHOW TABLE STATUS WHERE Name = 'tbl_item'";

// Step 3: Run the query
$result = mysqli_query($conn, $query);

// Step 4: Fetch and display the engine
if ($row = mysqli_fetch_assoc($result)) {
    echo "Engine used for tbl_item: <strong>" . $row['Engine'] . "</strong>";
} else {
    echo "Table not found or error occurred.";
}
?>
