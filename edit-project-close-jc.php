<?php
    include('config/constants.php');

    if (isset($_GET['jc_id'])) {
        $jcId = $_GET['jc_id'];
    
        // Fetch the job card details from the tbl_service_jc table based on $jcId
        $query = "SELECT * FROM tbl_service_jc WHERE id = $jcId";
        $query_run = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
            
            // Get the customer name from the fetched data
            $jcId = $row['id'];
            $jc_create_date = $row['jc_create_date'];
            $jc_lead_by = $row['jc_lead_by'];
            $jc_assigned_to = $row['jc_assigned_to'];
            $project_id = $row['project_id'];
            $project_type = $row['project_type'];
            $customer_name = $row['customer_name'];
            $customer_type = $row['customer_type'];
            $company_name = $row['company_name'];
            $area = $row['area'];
            $address = $row['address'];
            $county = $row['county'];
            $city = $row['city'];
            $google_location = $row['google_location'];
            $date_w_amc = $row['date_w_amc'];
            $contact_name_1 = $row['contact_name_1'];
            $contact_number_1 = $row['contact_number_1'];
            $contact_name_2 = $row['contact_name_2'];
            $contact_number_2 = $row['contact_number_2'];
            $sales_agent = $row['sales_agent'];

            $site_name =$row['site_name'];
            $site_address =$row['site_address'];
            $site_city =$row['site_city'];
            $site_county =$row['site_county'];
            $site_contact_name_1 =$row['site_contact_name_1'];
            $site_contact_number_1 =$row['site_contact_number_1'];
            $site_contact_name_2 =$row['site_contact_name_2'];
            $site_contact_number_2 =$row['site_contact_number_2'];
            $site_g_location =$row['site_g_location'];
            $project_details =$row['project_details'];
            $project_name =$row['project_name'];
        
            
            $jc_type = $row['jc_type'];
            $last_jc_number = $row['last_jc_number'];
            $last_jc_date = $row['last_jc_date'];
            $work_statement = $row['work_statement'];
            $customer_word = $row['customer_word'];
            $role = $row['role'];
            $hours = $row['hours'];
                   
            $productIds = isset($_POST['product_id']) ? $_POST['product_id'] : null;
            $itemIds = isset($_POST['item_id']) ? $_POST['item_id'] : null;
    
          
        } else {
            echo "No job card found with the provided ID.";
        }
    } else {
        echo "Job card ID not provided.";
    }
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Check if the job card ID is provided in the query parameter
     if (isset($_GET['jc_id'])) {
        $jcId = $_GET['jc_id'];

        // Get the updated values for the main table
        
        $newJobFinding = mysqli_real_escape_string($conn, $_POST['job_finding']);
        $newWorkDoneDate = mysqli_real_escape_string($conn, $_POST['work_done_date']);
        $newWorkSatisfactory = mysqli_real_escape_string($conn, $_POST['work_satisfactory']);
        $newClientSign = mysqli_real_escape_string($conn, $_POST['client_sign']);
        $newJcClosed = mysqli_real_escape_string($conn, $_POST['jc_closed']);
        $newPaid = mysqli_real_escape_string($conn, $_POST['paid']);
        $newHours = mysqli_real_escape_string($conn, $_POST['hours']);

      // Process product and item quantities
if (isset($_POST['product_quantity']) && isset($_POST['product_name'])) {
    $productId = mysqli_real_escape_string($conn, $productIds);
    $productQuantities = $_POST['product_quantity'];
    $productNames = $_POST['product_name'];

    // Update product quantities
    foreach ($productQuantities as $index => $quantity) {
        $productName = mysqli_real_escape_string($conn, $productNames[$index]);

        if ($quantity !== '' && $quantity >= 0) {
            // Update product_quantity in the database
            /*$updateProductQuery = "UPDATE tbl_service_jc_item 
            SET product_quantity = '$quantity', work_done_date = '$newWorkDoneDate' 
            WHERE service_jc_id = $jcId AND product_name = '$productName'";
            WHERE service_jc_id = $jcId AND id=$productId AND product_name = '$productName'";*/

            $updateProductQuery = "UPDATE tbl_service_jc_item 
            SET product_quantity = '$quantity', work_done_date = '$newWorkDoneDate' 
            WHERE service_jc_id = $jcId AND product_name = '$productName'";
            mysqli_query($conn, $updateProductQuery);
        }
    }
}

if (isset($_POST['item_quantity']) && isset($_POST['item_name'])) {
    $itemId = mysqli_real_escape_string($conn, $itemIds); // Retrieve ID
    $itemQuantities = $_POST['item_quantity'];
    $itemNames = $_POST['item_name'];

    // Update item quantities
    foreach ($itemQuantities as $index => $quantity) {
        $itemName = mysqli_real_escape_string($conn, $itemNames[$index]);

        if ($quantity !== '' && $quantity >= 0) {
            // Update item_quantity in the database
            /*$updateItemQuery = "UPDATE tbl_service_jc_item 
            SET item_quantity = '$quantity', work_done_date = '$newWorkDoneDate' 
            WHERE service_jc_id = $jcId AND item_name = '$itemName'";
            WHERE service_jc_id = $jcId AND id=$itemId AND item_name = '$itemName'";*/

            $updateItemQuery = "UPDATE tbl_service_jc_item 
            SET item_quantity = '$quantity', work_done_date = '$newWorkDoneDate' 
            WHERE service_jc_id = $jcId AND item_name = '$itemName'";
            mysqli_query($conn, $updateItemQuery);
        }
    }
}

        // Update the customer_name in the main table
        $updateQuery = "UPDATE tbl_service_jc SET job_finding='$newJobFinding', work_done_date='$newWorkDoneDate', work_satisfactory='$newWorkSatisfactory', client_sign='$newClientSign', jc_closed='$newJcClosed', paid='$newPaid', hours='$newHours' WHERE id = $jcId";

        // Execute the main table update query
        if (mysqli_query($conn, $updateQuery)) {
            echo "Updated items, products, and main table successfully.";
            echo '<script>window.location.href = "close-jc-page.php";</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Job card ID not provided.";
    }  
}

 // MEMO
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the job card ID is provided in the query parameter
    if (isset($_GET['jc_id'])) {
        $jcId = $_GET['jc_id'];
        $newLeadBy = $_SESSION['username'];

        // Get the updated values for the main table
        $newRole = mysqli_real_escape_string($conn, $_POST['role']);
        $newCreationDate = mysqli_real_escape_string($conn, $_POST['creation_date']);
        $newBeforeDate = mysqli_real_escape_string($conn, $_POST['before_dt']);
        $newReminder = mysqli_real_escape_string($conn, $_POST['reminder']);       

        // Check if both reminder and before_dt are not empty before inserting
        if (!empty($newReminder) && !empty($newBeforeDate)) {
            // Insert data into tbl_memo with jc_id
            $insertQueryMemo = "INSERT INTO tbl_memo (memo_dt, before_dt, memo_content, memo_by, jc_id, role) 
                        VALUES ('$newCreationDate', '$newBeforeDate', '$newReminder', '$newLeadBy', '$jcId', '$newRole')";

            // Execute the insert query
            if (mysqli_query($conn, $insertQueryMemo)) {
                // Redirect or display a success message after inserting
                echo "Data inserted successfully.";
                echo '<script>window.location.href = "close-jc-page.php";</script>';
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }
        } else {
            echo "Reminder and/or Before Date fields are empty. No data inserted.";
        }
    } else {
        echo "Job card ID not provided.";
    }
}
// MEMO
if (isset($_POST['jc_id'])) {
    $jcId = $_POST['jc_id'];

    // $jcId = mysqli_insert_id($conn);

    $selectedProducts = $_POST['selected_products'];
    $selectedItems = $_POST['selected_items'];

    $insertSuccess = true;

    foreach ($selectedItems as $itemData) {
        $itemName = mysqli_real_escape_string($conn, $itemData['item']);
        $itemQuantity = (int)$itemData['quantity'];

        $itemQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '$itemName', $itemQuantity, '', 0)";

        if (!mysqli_query($conn, $itemQuery)) {
            $insertSuccess = false;
        }
    }

    foreach ($selectedProducts as $productData) {
        $productName = mysqli_real_escape_string($conn, $productData['product']);
        $productQuantity = (int)$productData['quantity'];

        $productQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '', 0, '$productName', $productQuantity)";

        if (!mysqli_query($conn, $productQuery)) {
            $insertSuccess = false;
        }
    }

    if ($insertSuccess) {
        $response = array('status' => 'success', 'message' => 'and items inserted successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Data insertion failed for close jc items');
    }
    
    echo json_encode($response);
} 
else {
    $response = array('status' => 'error', 'message' => 'Data insertion failed for close jc');
}

echo json_encode($response);

// jc costing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the job card ID is provided in the query parameter
    if (isset($_GET['jc_id'])) {
       $jcId = $_GET['jc_id'];

                // jc costing

                // Update fuel cost
                $updateFuelCostQuery = "
                UPDATE tbl_service_jc AS sj
                SET fuel_cost = (
                    SELECT 
                        CASE
                            WHEN sj.jc_assigned_to = 'Manager' THEN area.distance_KM * 2 * rates_car.rate_value
                            WHEN sj.jc_assigned_to = 'Office' THEN area.distance_KM * 0 * rates_office.rate_value
                            ELSE area.distance_KM * 2 * rates_bike.rate_value
                        END AS fuel_cost
                    FROM (
                        SELECT jc.id, jc.area, jc.jc_assigned_to
                        FROM tbl_service_jc AS jc
                        WHERE jc.id = $jcId AND jc.jc_closed = 'Closed'
                    ) AS sj
                    JOIN tbl_area AS area ON sj.area = area.area
                    LEFT JOIN tbl_rates AS rates_car ON rates_car.rate_item = 'Car Fuel'
                    LEFT JOIN tbl_rates AS rates_office ON rates_office.rate_item = 'Office'
                    LEFT JOIN tbl_rates AS rates_bike ON rates_bike.rate_item = 'Bike Fuel'
                )
                WHERE sj.id = $jcId";
                mysqli_query($conn, $updateFuelCostQuery);

                // Update technician cost
                $updateTechnicianCostQuery = "
                UPDATE tbl_service_jc AS sjc
                SET technician_cost = (
                    SELECT 
                        CASE
                            WHEN sjc.jc_assigned_to = 'Manager' THEN sjc.hours * r_manager.rate_value
                            WHEN sjc.jc_assigned_to = 'Office' THEN sjc.hours * r_office.rate_value
                            ELSE sjc.hours * r_technician.rate_value
                        END AS total_cost
                    FROM (
                        SELECT jc.id, jc.jc_assigned_to, sjc.hours
                        FROM tbl_service_jc AS jc
                        JOIN tbl_service_jc AS sjc ON jc.id = sjc.id
                        WHERE jc.id = $jcId AND sjc.jc_closed = 'Closed'
                    ) AS sjc
                    LEFT JOIN tbl_rates AS r_technician ON r_technician.rate_item = 'Technician'
                    LEFT JOIN tbl_rates AS r_manager ON r_manager.rate_item = 'Hitesh'
                    LEFT JOIN tbl_rates AS r_office ON r_office.rate_item = 'Office'
                )
                WHERE sjc.id = $jcId";
                mysqli_query($conn, $updateTechnicianCostQuery);   

                // Update price in tbl_service_jc_item - Item
                $updatePriceItemQuery = "
                UPDATE tbl_service_jc_item AS sji
                    LEFT JOIN tbl_item AS i ON sji.item_id = i.id
                    SET sji.price_item = i.price,
                        sji.auto_purchase_item = i.auto_purchase_price
                WHERE sji.service_jc_id = $jcId";
                mysqli_query($conn, $updatePriceItemQuery);

                // Update price in tbl_service_jc_item - Product
                $updatePriceProductQuery = "
                UPDATE tbl_service_jc_item AS sji
                    LEFT JOIN tbl_product AS p ON sji.product_id = p.id
                    SET sji.price_product = p.price,
                        sji.auto_purchase_product = p.auto_purchase_price
                WHERE sji.service_jc_id = $jcId";
                mysqli_query($conn, $updatePriceProductQuery);

                // Update total price multiplication in tbl_service_jc_item
                $updateTotalPriceQuery = "
                UPDATE tbl_service_jc_item
                SET total_price = (
                    CASE
                        WHEN item_name IS NULL OR item_name = '' THEN product_quantity * price_product
                        WHEN product_name IS NULL OR product_name = '' THEN item_quantity * price_item
                        ELSE 0
                    END
                )
                WHERE (item_name IS NULL OR item_name = '' OR product_name IS NULL OR product_name = '')
                    AND service_jc_id = $jcId";
                mysqli_query($conn, $updateTotalPriceQuery);

                // Update total price multiplication in tbl_service_jc_item (auto purchase)
                $updateTotalAutoPriceQuery = "
                UPDATE tbl_service_jc_item
                SET total_purchase_cost = (
                    CASE
                        WHEN item_name IS NULL OR item_name = '' THEN product_quantity * auto_purchase_product
                        WHEN product_name IS NULL OR product_name = '' THEN item_quantity * auto_purchase_item
                        ELSE 0
                    END
                )
                WHERE (item_name IS NULL OR item_name = '' OR product_name IS NULL OR product_name = '')
                    AND service_jc_id = $jcId";
                mysqli_query($conn, $updateTotalAutoPriceQuery);

                // Update Material Cost
                $updateMaterialCostQuery = "
                UPDATE tbl_service_jc AS sj
                SET sj.material_cost = (
                    SELECT IFNULL(SUM(total_purchase_cost), 0)
                    FROM tbl_service_jc_item sji
                    WHERE sji.service_jc_id = sj.id
                )
                WHERE sj.id = $jcId AND sj.jc_closed = 'Closed';
                ";
                mysqli_query($conn, $updateMaterialCostQuery);

                // Sum Costs (Material, Technician, Fuel)
                $updateTotalCostQuery = "
                UPDATE tbl_service_jc AS sj
                SET 
                    sj.material_cost = COALESCE(sj.material_cost, 0),
                    sj.technician_cost = COALESCE(sj.technician_cost, 0),
                    sj.fuel_cost = COALESCE(sj.fuel_cost, 0),
                    sj.total_cost = COALESCE(sj.material_cost, 0) + COALESCE(sj.technician_cost, 0) + COALESCE(sj.fuel_cost, 0)
                WHERE sj.id = $jcId AND sj.jc_closed = 'Closed';
                ";
                mysqli_query($conn, $updateTotalCostQuery);
   
    echo "JC Costing Done Successfully.";    
   } else {
       echo "JC Costing Not Done Successfully.";
   } 
}

// UPDATE STOCK
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['closeJcButton'])) {
    $productNames = isset($_POST['product_name']) ? $_POST['product_name'] : null;
    $productQuantities = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : null;
    $itemNames = isset($_POST['item_name']) ? $_POST['item_name'] : null;
    $itemQuantities = isset($_POST['item_quantity']) ? $_POST['item_quantity'] : null;

    // Process product data if not null
    if ($productNames !== null && $productQuantities !== null) {
        // Loop through the product data and update stock
        for ($i = 0; $i < count($productNames); $i++) {
            // $productId = mysqli_real_escape_string($conn, $productIds[$i]);
            $productName = mysqli_real_escape_string($conn, $productNames[$i]);
            $productQuantity = (int)$productQuantities[$i];

            if (!empty($productName) && $productQuantity > 0) {
                // Update stock for products
                $updateProductQuery = "UPDATE tbl_product SET stock_qty = stock_qty - $productQuantity WHERE name = '$productName'";
                mysqli_query($conn, $updateProductQuery);
            }
        }
    }

    // Process item data if not null
    if ($itemNames !== null && $itemQuantities !== null) {
        // Loop through the item data and update stock
        for ($i = 0; $i < count($itemNames); $i++) {
            // $itemId = mysqli_real_escape_string($conn, $itemIds[$i]);
            $itemName = mysqli_real_escape_string($conn, $itemNames[$i]);
            $itemQuantity = (int)$itemQuantities[$i];

            if (!empty($itemName) && $itemQuantity > 0) {
                // Update stock for items
                $updateItemQuery = "UPDATE tbl_item SET stock_qty = stock_qty - $itemQuantity WHERE item_name = '$itemName'";
                mysqli_query($conn, $updateItemQuery);
            }
        }
    }
    echo "Stock updates were successful.";
}
?>


