<?php
    include('config/constants.php');
    $n=1;

// Products
    $query_product = "SELECT tbl_product.id, tbl_brand.brand, tbl_product.name, tbl_product.stock_qty, tbl_product.min_stock, 
    tbl_product.price, tbl_product.selling_price, tbl_product.purchase_price_date, tbl_product.auto_purchase_price
            FROM tbl_product
            INNER JOIN tbl_brand ON tbl_brand.id = tbl_product.brand_id";
                    
    $product_results = mysqli_query($conn, $query_product);

    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the JSON data sent from the client
        $jsonProducts = json_decode($_POST['products'], true);
    
        if ($jsonProducts) {
            // Include your database connection code here
            // include('config.php');
    
            // Initialize an array to collect response messages
            $response = array();
    
            // Loop through the products and update the database
            foreach ($jsonProducts as $product) {
                $productId = $product['product_id'];
                $newMinPStock = $product['new_min_p_stock'];
                $newStockPQty = $product['new_stock_p_qty'];
    
                // Initialize SQL query
                $sql = '';
    
                /*// Check which values need to be updated and build the SQL query accordingly
                if (!empty($newMinPStock) && !empty($newStockPQty)) {
                    // Both newMinPStock and newStockPQty are provided
                    $sql = "UPDATE tbl_product SET min_stock = $newMinPStock, stock_qty = $newStockPQty WHERE id = $productId";
                } elseif (!empty($newMinPStock)) {
                    // Only newMinPStock is provided
                    $sql = "UPDATE tbl_product SET min_stock = $newMinPStock WHERE id = $productId";
                } elseif (!empty($newStockPQty)) {
                    // Only newStockPQty is provided
                    $sql = "UPDATE tbl_product SET stock_qty = $newStockPQty WHERE id = $productId";
                }*/

                // Check which values need to be updated and build the SQL query accordingly
                if (isset($newMinPStock) && $newMinPStock !== '' && isset($newStockPQty) && $newStockPQty !== '') {
                    // Both newMinPStock and newStockPQty are provided
                    $sql = "UPDATE tbl_product SET min_stock = $newMinPStock, stock_qty = $newStockPQty WHERE id = $productId";
                } elseif (isset($newMinPStock) && $newMinPStock !== '') {
                    // Only newMinPStock is provided
                    $sql = "UPDATE tbl_product SET min_stock = $newMinPStock WHERE id = $productId";
                } elseif (isset($newStockPQty) && $newStockPQty !== '') {
                    // Only newStockPQty is provided
                    $sql = "UPDATE tbl_product SET stock_qty = $newStockPQty WHERE id = $productId";
                }

    
                if (!empty($sql)) {
                    // Execute the SQL query
                    $result = mysqli_query($conn, $sql);
    
                    // Handle any error checking or result handling as needed
                    if ($result) {
                        // Individual update was successful
                        $response[] = "Product updated successfully.";
                    } else {
                        // Individual update failed
                        $response[] = "Error updating product: " . mysqli_error($conn);
                    }
                }
            }
    
            // Close the database connection if necessary
            // mysqli_close($conn);
    
            // Return the response as a JSON object
            echo json_encode($response);
        } else {
            // Handle JSON decoding error
            echo json_encode(array("error" => "Error decoding JSON data."));
        }
    } else {
        // Handle invalid request method (not a POST request)
        echo json_encode(array("error" => "Invalid request method."));
    }
    


?>