<?php
    include('config/constants.php');
    $sn=1;
    $n=1;

    // Items
    $query_item = "SELECT tbl_item.id, tbl_category.category, tbl_item.item_name, tbl_subcategory.subcategory, 
    tbl_item.stock_qty, tbl_item.min_stock, tbl_item.price, tbl_item.selling_price, tbl_item.purchase_price_date, 
    tbl_item.auto_purchase_price
            FROM tbl_item
            INNER JOIN tbl_subcategory ON tbl_subcategory.id = tbl_item.subcategory_id
            INNER JOIN tbl_category ON tbl_category.id = tbl_item.category_id";

   
    $item_results = mysqli_query($conn, $query_item);
    // CHECK COUNT IN MONTHS

// Include your database connection code here
// include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the JSON data sent from the client
    $jsonItems = json_decode($_POST['items'], true);

    if ($jsonItems) {
        // Include your database connection code here
        // include('config.php');

        // Initialize an array to collect response messages
        $response = array();

        // Loop through the items and update the database
        foreach ($jsonItems as $item) {
            $itemId = $item['item_id'];
            $newMinStock = $item['new_min_stock'];
            $newStockQty = $item['new_stock_qty'];

            // Initialize SQL query
            $sql = '';

            // Check which values need to be updated and build the SQL query accordingly
            if (isset($newMinStock) && $newMinStock !== '' && isset($newStockQty) && $newStockQty !== '') {
                // Both newMinStock and newStockQty are provided
                $sql = "UPDATE tbl_item SET min_stock = $newMinStock, stock_qty = $newStockQty WHERE id = $itemId";
            } elseif (isset($newMinStock) && $newMinStock !== '') {
                // Only newMinStock is provided
                $sql = "UPDATE tbl_item SET min_stock = $newMinStock WHERE id = $itemId";
            } elseif (isset($newStockQty) && $newStockQty !== '') {
                // Only newStockQty is provided
                $sql = "UPDATE tbl_item SET stock_qty = $newStockQty WHERE id = $itemId";
            }

            if (!empty($sql)) {
                // Execute the SQL query
                $result = mysqli_query($conn, $sql);

                // Handle any error checking or result handling as needed
                if ($result) {
                    // Individual update was successful
                    $response[] = "Item updated successfully.";
                } else {
                    // Individual update failed
                    $response[] = "Error updating item." . mysqli_error($conn);
                }
            }
        }

        // Close the database connection if necessary
        // mysqli_close($conn);

        // Return the response as a JSON object
        echo json_encode($responses);
    } else {
        // Handle JSON decoding error
        echo json_encode(array("error" => "Error decoding JSON data."));
    }
} else {
    // Handle invalid request method (not a POST request)
    echo json_encode(array("error" => "Invalid request method."));
}

    
?>

    