<?php
    include('config/constants.php');
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

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
            $commerce = $row['commerce'];
            $business = $row['business'];
            $customer_name = $row['customer_name'];
            $customer_type = $row['customer_type'];
            $company_name = $row['company_name'];
            $address = $row['address'];
            $area = $row['area'];
            $county = $row['county'];
            $city = $row['city'];
            $physical_location = $row['physical_location'];
            $google_location = $row['google_location'];
            $date_w_amc = $row['date_w_amc'];
            $contact_name_1 = $row['contact_name_1'];
            $contact_number_1 = $row['contact_number_1'];
            $contact_name_2 = $row['contact_name_2'];
            $contact_number_2 = $row['contact_number_2'];
            $sales_agent = $row['sales_agent'];
            $product_name = $row['product_name'];
            $brand = $row['brand'];
            $jc_type = $row['jc_type'];
            $last_jc_number = $row['last_jc_number'];
            $last_jc_date = $row['last_jc_date'];
            $work_statement = $row['work_statement'];
            $customer_word = $row['customer_word'];
            $amount = $row['amount'];            
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
                $newAmount = mysqli_real_escape_string($conn, $_POST['amount']);
                $newJobFinding = mysqli_real_escape_string($conn, $_POST['job_finding']);
                $newFlowPure = mysqli_real_escape_string($conn, $_POST['flow_pure']);
                $newFlowReject = mysqli_real_escape_string($conn, $_POST['flow_reject']);
                $newWorkDoneDate = mysqli_real_escape_string($conn, $_POST['work_done_date']);
                $newWorkSatisfactory = mysqli_real_escape_string($conn, $_POST['work_satisfactory']);
                $newClientSign = mysqli_real_escape_string($conn, $_POST['client_sign']);
                $newJcClosed = mysqli_real_escape_string($conn, $_POST['jc_closed']);
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
                            $updateItemQuery = "UPDATE tbl_service_jc_item 
                            SET item_quantity = '$quantity', work_done_date = '$newWorkDoneDate' 
                            WHERE service_jc_id = $jcId AND item_name = '$itemName'";
                            mysqli_query($conn, $updateItemQuery);
                        }
                    }
                }


                        // Update the customer_name in the main table
                        $updateQuery = "UPDATE tbl_service_jc SET amount = '$newAmount', job_finding='$newJobFinding', flow_pure='$newFlowPure', flow_reject='$newFlowReject', work_done_date='$newWorkDoneDate', work_satisfactory='$newWorkSatisfactory', client_sign='$newClientSign', jc_closed='$newJcClosed', hours='$newHours' WHERE id = $jcId";

                        // Execute the main table update query
                        if (mysqli_query($conn, $updateQuery)) {
                            // Redirect or display a success message after updating
                            // header("Location: close-jc-page.php");
                            echo "Updated items, products, and main table successfully.";
                            // echo '<script>window.location.href = "close-jc-page.php";</script>';
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }


                    } else {
                        echo "Job card ID not provided.";
                    }



                    // UPDATE LAST JC NUMBER, DATE, NEXT CALL IN TBL_CUSTOMER

                    // Fetch customer_id based on jc_id
                    $fetchCustomerIdQuery = "SELECT customer_id FROM tbl_service_jc WHERE id = $jcId";
                    $fetchCustomerIdResult = mysqli_query($conn, $fetchCustomerIdQuery);

                    if ($fetchCustomerIdResult && mysqli_num_rows($fetchCustomerIdResult) > 0) {
                        $row = mysqli_fetch_assoc($fetchCustomerIdResult);
                        $customerId = $row['customer_id'];

                        // Update tbl_customer
                        $updateQuery1 = "UPDATE tbl_customer AS c
                                        SET 
                                            c.jc_number = (
                                                SELECT sj.id
                                                FROM tbl_service_jc AS sj
                                                WHERE sj.customer_id = c.id 
                                                    AND sj.jc_closed = 'Closed' 
                                                    AND sj.role = 'Service' 
                                                    AND c.status = 'Active' 
                                                    AND (sj.business = 'DWS' OR sj.business = 'IWT')
                                                ORDER BY sj.id DESC
                                                LIMIT 1
                                            ),
                                            c.last_jc_date = (
                                                SELECT sj.work_done_date
                                                FROM tbl_service_jc AS sj
                                                WHERE sj.customer_id = c.id 
                                                    AND sj.jc_closed = 'Closed' 
                                                    AND sj.role = 'Service' 
                                                    AND c.status = 'Active' 
                                                    AND (sj.business = 'DWS' OR sj.business = 'IWT')
                                                ORDER BY sj.id DESC
                                                LIMIT 1
                                            ),
                                            c.next_call_date = (
                                                    SELECT CASE
                                                        WHEN c.last_jc_date IS NOT NULL AND c.last_jc_date != '' THEN
                                                            DATE_ADD(c.last_jc_date, INTERVAL c.frequency DAY)
                                                        ELSE
                                                            NULL
                                                    END
                                                )
                                        WHERE c.id = $customerId";

                        $updateResult1 = mysqli_query($conn, $updateQuery1);

                        // next call date when new job card replaces the old one

                        // $updateQuery3 = "UPDATE tbl_customer AS c2
                        //                     SET 
                        //                         c2.next_call_date = (
                        //                             SELECT CASE
                        //                                 WHEN c2.last_jc_date IS NOT NULL AND c2.last_jc_date != '' THEN
                        //                                     DATE_ADD(c2.last_jc_date, INTERVAL c2.frequency DAY)
                        //                                 ELSE
                        //                                     NULL
                        //                             END
                        //                         )
                        //                     WHERE c2.last_jc_date IS NOT NULL OR c2.last_jc_date != '' AND c2.id = $customerId";

                        // mysqli_query($conn, $updateQuery3);

                        if ($updateResult1) {
                            // Additional updates for tbl_customer
                            // Update next call date
                            $updateQuery2 = 
                            // "UPDATE tbl_customer AS c
                            //                 SET 
                            //                     c.next_call_date = (
                            //                         SELECT CASE
                            //                             WHEN c.last_jc_date IS NOT NULL AND c.last_jc_date != '' THEN
                            //                                 DATE_ADD(c.last_jc_date, INTERVAL c.frequency DAY)
                            //                             ELSE
                            //                                 NULL
                            //                         END
                            //                     )
                            //                 WHERE c.last_jc_date IS NOT NULL OR c.last_jc_date != '' AND c.id = $customerId;

                                            // -- Update date if not in the right format

                                            "UPDATE tbl_service_jc
                                            SET work_done_date = DATE_FORMAT(STR_TO_DATE(work_done_date, '%d-%m-%Y'), '%Y-%m-%d')
                                            WHERE work_done_date IS NOT NULL
                                            AND work_done_date REGEXP '^[0-9]{1,2}-[0-9]{1,2}-[0-9]{2,4}$' AND id = $jcId";

                            $updateResult2 = mysqli_multi_query($conn, $updateQuery2);

                            if ($updateResult2) {
                                echo "Successfully closed JC and performed additional updates.";
                                // echo '<script>window.location.href = "close-jc-page.php";</script>';
                            } else {
                                echo "Error updating additional data: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Error updating tbl_customer: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Error fetching customer_id: " . mysqli_error($conn);
                    }
                    // UPDATE LAST JC NUMBER, DATE, NEXT CALL IN TBL_CUSTOMER


        }


        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the job card ID is provided in the query parameter
            if (isset($_GET['jc_id'])) {
                $jcId = $_GET['jc_id'];
        
                // Fetch customer_id based on jc_id
                $fetchCustomerIdQuery = "SELECT customer_id FROM tbl_service_jc WHERE id = $jcId";
                $fetchCustomerIdResult = mysqli_query($conn, $fetchCustomerIdQuery);
        
            
                // Get the updated values for the main table
                $newAmount = mysqli_real_escape_string($conn, $_POST['amount']);
                $newJobFinding = mysqli_real_escape_string($conn, $_POST['job_finding']);
                $newFlowPure = mysqli_real_escape_string($conn, $_POST['flow_pure']);
                $newFlowReject = mysqli_real_escape_string($conn, $_POST['flow_reject']);
                $newWorkDoneDate = mysqli_real_escape_string($conn, $_POST['work_done_date']);
                $newWorkSatisfactory = mysqli_real_escape_string($conn, $_POST['work_satisfactory']);
                $newClientSign = mysqli_real_escape_string($conn, $_POST['client_sign']);
                $newJcClosed = mysqli_real_escape_string($conn, $_POST['jc_closed']);

                // Process product and item quantities
                if (isset($_POST['product_quantity']) && isset($_POST['product_name'])) {
                    // ... (existing code for product quantities)
                    $productId = mysqli_real_escape_string($conn, $productIds);
                    $productQuantities = $_POST['product_quantity'];
                    $productNames = $_POST['product_name'];

                    // Update product quantities
                    foreach ($productQuantities as $index => $quantity) {
                        $productName = mysqli_real_escape_string($conn, $productNames[$index]);

                        if ($quantity !== '' && $quantity >= 0) {
                            // Update product_quantity in the database
                            $updateProductQuery = "UPDATE tbl_service_jc_item SET product_quantity = '$quantity' WHERE service_jc_id = $jcId AND id=$productId AND product_name = '$productName'";
                            mysqli_query($conn, $updateProductQuery);
                        }
                    }
                            }
        
                            if (isset($_POST['item_quantity']) && isset($_POST['item_name'])) {
                                // ... (existing code for item quantities)
                                $itemId = mysqli_real_escape_string($conn, $itemIds); // Retrieve ID
                                $itemQuantities = $_POST['item_quantity'];
                                $itemNames = $_POST['item_name'];

                                    // Update item quantities
                                    foreach ($itemQuantities as $index => $quantity) {
                                        $itemName = mysqli_real_escape_string($conn, $itemNames[$index]);

                                        if ($quantity !== '' && $quantity >= 0) {
                                            // Update item_quantity in the database
                                            $updateItemQuery = "UPDATE tbl_service_jc_item SET item_quantity = '$quantity' WHERE service_jc_id = $jcId AND id=$itemId AND item_name = '$itemName'";
                                            mysqli_query($conn, $updateItemQuery);
                                        }
                                    }
                            }
        
                            // Update the customer_name in the main table
                            $updateQuery = "UPDATE tbl_service_jc SET amount = '$newAmount', job_finding='$newJobFinding', flow_pure='$newFlowPure', flow_reject='$newFlowReject', work_done_date='$newWorkDoneDate', work_satisfactory='$newWorkSatisfactory', client_sign='$newClientSign', jc_closed='$newJcClosed' WHERE id = $jcId";
        
                            // Execute the main table update query
                            if (mysqli_query($conn, $updateQuery)) {
                                // Redirect or display a success message after updating
                                // header("Location: close-jc-page.php");
                                echo "Updated items, products, and main table successfully.";
                                echo '<script>window.location.href = "close-jc-page.php";</script>';
                            } else {
                                echo "Error updating record: " . mysqli_error($conn);
                            }
                        
                    
               
            } else {
                echo "Job card ID not provided.";
            }

             

            
        }

        
        
        // jc costing
                        
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if the job card ID is provided in the query parameter
//     if (isset($_GET['jc_id'])) {
//         $jcId = $_GET['jc_id'];

//         // Check connection
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Update material cost
//         $updateMaterialCostQuery = "
//             UPDATE tbl_service_jc AS sj
//             SET material_cost = (
//                 SELECT SUM(total_price) AS total_cost
//                 FROM tbl_service_jc_item sji
//                 WHERE sji.service_jc_id = sj.id
//             )
//             WHERE sj.id = $jcId";
//         mysqli_query($conn, $updateMaterialCostQuery);

//         // Update fuel cost
//         $updateFuelCostQuery = "
//             UPDATE tbl_service_jc AS sj
//             SET fuel_cost = (
//                 SELECT 
//                     CASE
//                         WHEN sj.jc_assigned_to = 'Manager' THEN area.distance_KM * 2 * rates_car.rate_value
//                         WHEN sj.jc_assigned_to = 'Office' THEN area.distance_KM * 2 * rates_office.rate_value
//                         ELSE area.distance_KM * 2 * rates_bike.rate_value
//                     END AS fuel_cost
//                 FROM tbl_area AS area
//                 JOIN tbl_service_jc AS jc ON jc.area = area.area
//                 LEFT JOIN tbl_rates AS rates_car ON rates_car.rate_item = 'Car Fuel'
//                 LEFT JOIN tbl_rates AS rates_office ON rates_office.rate_item = 'Office'
//                 LEFT JOIN tbl_rates AS rates_bike ON rates_bike.rate_item = 'Bike Fuel'
//                 WHERE jc.id = sj.id 
//             )
//             WHERE sj.id = $jcId";
//         mysqli_query($conn, $updateFuelCostQuery);

//         // Update technician cost
//         $updateTechnicianCostQuery = "
//             UPDATE tbl_service_jc AS sjc
//             SET technician_cost = (
//                 SELECT 
//                     CASE
//                         WHEN sjc.jc_assigned_to = 'Manager' THEN sjc.hours * r_manager.rate_value
//                         WHEN sjc.jc_assigned_to = 'Office' THEN sjc.hours * r_office.rate_value
//                         ELSE sjc.hours * r_technician.rate_value
//                     END AS total_cost
//                 FROM tbl_rates AS r_technician
//                 LEFT JOIN tbl_rates AS r_manager ON r_manager.rate_item = 'Hitesh'
//                 LEFT JOIN tbl_rates AS r_office ON r_office.rate_item = 'Office'
//                 WHERE r_technician.rate_item = 'Technician'
//             )
//             WHERE sjc.id = $jcId";
//         mysqli_query($conn, $updateTechnicianCostQuery);

//         // Update price in tbl_service_jc_item
//         $updatePriceQuery = "
//             UPDATE tbl_service_jc_item AS sji
//             SET price = (
//                 SELECT 
//                     CASE 
//                         WHEN sji.item_id IS NOT NULL THEN i.price
//                         WHEN sji.product_id IS NOT NULL THEN p.price
//                         ELSE NULL  -- Handle the case when both item_id and product_id are NULL
//                     END AS new_price
//                 FROM tbl_item i
//                 LEFT JOIN tbl_product p ON sji.product_id = p.id
//                 WHERE i.id = sji.item_id OR p.id = sji.product_id
//                 LIMIT 1
//             )
//             WHERE sji.service_jc_id = $jcId";
//         mysqli_query($conn, $updatePriceQuery);

//         // Update total price multiplication in tbl_service_jc_item
//         $updateTotalPriceQuery = "
//             UPDATE tbl_service_jc_item
//             SET total_price = (
//                 CASE
//                     WHEN item_name IS NULL OR item_name = '' THEN product_quantity * price
//                     WHEN product_name IS NULL OR product_name = '' THEN item_quantity * price
//                     ELSE 0  -- Handle the case when both item_name and product_name are not empty or NULL
//                 END
//             )
//             WHERE item_name IS NULL OR product_name IS NULL OR item_name = '' OR product_name = ''
//                 AND service_jc_id = $jcId";
//         mysqli_query($conn, $updateTotalPriceQuery);

//         // Close the database connection
//         $conn->close();

//         // Redirect or perform any other action after the updates
//         echo "Job Card Costing successful.";
//         // echo '<script>window.location.href = "close-jc-page.php";</script>';
//     } else {
//         echo "Job card Costing not unsuccessful.";
//         $conn->error;
//     }
// }

        
        // jc costing

        


        //  // PRODUCT AND ITEM INSERT IN CLOSE JC         
        //  if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     // Check if the job card ID is provided in the query parameter
           
        //         // $jcId = $_GET['jc_id'];
        
        //     $jcId = $_POST['jc_id'];
        //     $selectedProducts = $_POST['selected_products'];
        //     $selectedItems = $_POST['selected_items'];
        
        //     $insertSuccess = true;
        
        //     foreach ($selectedItems as $itemData) {
        //         $itemName = mysqli_real_escape_string($conn, $itemData['item']);
        //         $itemQuantity = (int)$itemData['quantity'];
        
        //         $itemQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '$itemName', $itemQuantity, '', 0)";
        
        //         if (!mysqli_query($conn, $itemQuery)) {
        //             $insertSuccess = false;
        //         }
        //     }
        
        //     foreach ($selectedProducts as $productData) {
        //         $productName = mysqli_real_escape_string($conn, $productData['product']);
        //         $productQuantity = (int)$productData['quantity'];
        
        //         $productQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '', 0, '$productName', $productQuantity)";
        
        //         if (!mysqli_query($conn, $productQuery)) {
        //             $insertSuccess = false;
        //         }
        //     }
        
        //     if ($insertSuccess = true || $insertSuccess = false) {
        //         $response = array('status' => 'success', 'message' => 'Products and items inserted successfully');
        //     } else {
        //         $response = array('status' => 'error', 'message' => 'Data insertion failed for jc');
        //     }
        // } else {
        //     $response = array('status' => 'error', 'message' => 'Data insertion failed for closing jc');
        // }
        
        // echo json_encode($response);
        
        

        
        // PRODUCT AND ITEM INSERT IN CLOSE JC




        // MEMO

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     // Check if the job card ID is provided in the query parameter
        //     if (isset($_GET['jc_id'])) {
        //         $jcId = $_GET['jc_id'];
        //         $newLeadBy = $_SESSION['username'];

        //         // Get the updated values for the main table
        //         $newRole = mysqli_real_escape_string($conn, $_POST['role']);
        //         $newCreationDate = mysqli_real_escape_string($conn, $_POST['creation_date']);
        //         $newBeforeDate = mysqli_real_escape_string($conn, $_POST['before_dt']);
        //         $newReminder = mysqli_real_escape_string($conn, $_POST['reminder']);

        //         // Check if both reminder and before_dt are not empty before inserting
        //         if (!empty($newReminder) && !empty($newBeforeDate)) {
        //             // Insert data into tbl_memo with jc_id
        //             $insertQueryMemo = "INSERT INTO tbl_memo (memo_dt, before_dt, memo_content, memo_by, jc_id, role) 
        //                         VALUES ('$newCreationDate', '$newBeforeDate', '$newReminder', '$newLeadBy', '$jcId', '$newRole')";

        //             // Execute the insert query
        //             if (mysqli_query($conn, $insertQueryMemo)) {
        //                 // Redirect or display a success message after inserting
        //                 echo "Data inserted successfully.";
        //                 // echo '<script>window.location.href = "close-jc-page.php";</script>';
        //             } else {
        //                 echo "Error inserting record: " . mysqli_error($conn);
        //             }
        //         } else {
        //             echo "Reminder and/or Before Date fields are empty. No data inserted.";
        //         }
        //     } else {
        //         echo "Job card ID not provided.";
        //     }
        // }
        // MEMO



        // PRODUCT AND ITEM INSERT IN CLOSE JC

        // if (isset($_POST['jc_id'])) {
        //     $jcId = $_POST['jc_id'];

        //     // $jcId = mysqli_insert_id($conn);

        //     $selectedProducts = $_POST['selected_products'];
        //     $selectedItems = $_POST['selected_items'];

        //     $insertSuccess = true;

        //     foreach ($selectedItems as $itemData) {
        //         $itemName = mysqli_real_escape_string($conn, $itemData['item']);
        //         $itemQuantity = (int)$itemData['quantity'];

        //         $itemQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '$itemName', $itemQuantity, '', 0)";

        //         if (!mysqli_query($conn, $itemQuery)) {
        //             $insertSuccess = false;
        //         }
        //     }

        //     foreach ($selectedProducts as $productData) {
        //         $productName = mysqli_real_escape_string($conn, $productData['product']);
        //         $productQuantity = (int)$productData['quantity'];

        //         $productQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_name, item_quantity, product_name, product_quantity) VALUES ($jcId, '', 0, '$productName', $productQuantity)";

        //         if (!mysqli_query($conn, $productQuery)) {
        //             $insertSuccess = false;
        //         }
        //     }

        //     if ($insertSuccess) {
        //         $response = array('status' => 'success', 'message' => 'and items inserted successfully');
        //     } else {
        //         $response = array('status' => 'error', 'message' => 'Data insertion failed for close jc items');
        //     }
            
        //     echo json_encode($response);
        // } 
        // else {
        //     $response = array('status' => 'error', 'message' => 'Data insertion failed for close jc');
        // }

        // echo json_encode($response);

        


        // UPDATE STOCK 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['closeJcButton'])) {
            // Handle form submission
        
            // Retrieve the form data
            // $productNames = $_POST['product_name'];
            // $productQuantities = $_POST['product_quantity'];
            // $itemNames = $_POST['item_name'];
            // $itemQuantities = $_POST['item_quantity'];
            // Retrieve the form data
            $productIds = isset($_POST['product_id']) ? $_POST['product_id'] : null;
            $productNames = isset($_POST['product_name']) ? $_POST['product_name'] : null;
            $productQuantities = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : null;
           
            $itemIds = isset($_POST['item_id']) ? $_POST['item_id'] : null;
            $itemNames = isset($_POST['item_name']) ? $_POST['item_name'] : null;
            $itemQuantities = isset($_POST['item_quantity']) ? $_POST['item_quantity'] : null;
        
        
            // Process product data if not null
            if ($productNames !== null && $productQuantities !== null) {
                // Loop through the product data and update stock
                for ($i = 0; $i < count($productNames); $i++) {
                    // $productId = mysqli_real_escape_string($conn, $productIds[$i]); // Retrieve ID
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
                    // $itemId = mysqli_real_escape_string($conn, $itemIds[$i]); // Retrieve ID
                    $itemName = mysqli_real_escape_string($conn, $itemNames[$i]);
                    $itemQuantity = (int)$itemQuantities[$i];
            
                    if (!empty($itemName) && $itemQuantity > 0) {
                        // Update stock for items
                        $updateItemQuery = "UPDATE tbl_item SET stock_qty = stock_qty - $itemQuantity WHERE item_name = '$itemName'";
                        mysqli_query($conn, $updateItemQuery);
                    }
                }
           }
        
            // Close the database connection if necessary
            // mysqli_close($conn);
        
            // Provide a response to indicate success or failure
            echo "Stock updates were successful.";
        }

        // JOB CARD COSTING
        
                // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //     // Check if the job card ID is provided in the query parameter
                //     if (isset($_GET['jc_id'])) {
                //         $jcId = $_GET['jc_id'];

                      
                //         // Check connection
                //         if ($conn->connect_error) {
                //             die("Connection failed: " . $conn->connect_error);
                //         }

                //         // Update material cost
                //         $updateMaterialCostQuery = "
                //             UPDATE tbl_service_jc AS sj
                //             SET material_cost = (
                //                 SELECT SUM(total_price) AS total_cost
                //                 FROM tbl_service_jc_item sji
                //                 WHERE sji.service_jc_id = sj.id
                                
                //             )
                //             WHERE sj.id = $jcId";
                //         $conn->query($updateMaterialCostQuery);

                //         // Update fuel cost
                //         $updateFuelCostQuery = "
                //             UPDATE tbl_service_jc AS sj
                //             SET fuel_cost = (
                //                 SELECT 
                //                     CASE
                //                         WHEN sj.jc_assigned_to = 'Manager' THEN area.distance_KM * 2 * rates_car.rate_value
                //                         WHEN sj.jc_assigned_to = 'Office' THEN area.distance_KM * 2 * rates_office.rate_value
                //                         ELSE area.distance_KM * 2 * rates_bike.rate_value
                //                     END AS fuel_cost
                //                 FROM tbl_area AS area
                //                 JOIN tbl_service_jc AS jc ON jc.area = area.area
                //                 LEFT JOIN tbl_rates AS rates_car ON rates_car.rate_item = 'Car Fuel'
                //                 LEFT JOIN tbl_rates AS rates_office ON rates_office.rate_item = 'Office'
                //                 LEFT JOIN tbl_rates AS rates_bike ON rates_bike.rate_item = 'Bike Fuel'
                //                 WHERE jc.id = sj.id 
                //             )
                //             WHERE sj.id = $jcId";
                //         $conn->query($updateFuelCostQuery);

                //         // Update technician cost
                //         $updateTechnicianCostQuery = "
                //             UPDATE tbl_service_jc AS sjc
                //             SET technician_cost = (
                //                 SELECT 
                //                     CASE
                //                         WHEN sjc.jc_assigned_to = 'Manager' THEN sjc.hours * r_manager.rate_value
                //                         WHEN sjc.jc_assigned_to = 'Office' THEN sjc.hours * r_office.rate_value
                //                         ELSE sjc.hours * r_technician.rate_value
                //                     END AS total_cost
                //                 FROM tbl_rates AS r_technician
                //                 LEFT JOIN tbl_rates AS r_manager ON r_manager.rate_item = 'Hitesh'
                //                 LEFT JOIN tbl_rates AS r_office ON r_office.rate_item = 'Office'
                //                 WHERE r_technician.rate_item = 'Technician'
                                
                //             )
                //             WHERE sjc.id = $jcId";
                //         $conn->query($updateTechnicianCostQuery);

                //         // Update price in tbl_service_jc_item
                //         $updatePriceQuery = "
                //             UPDATE tbl_service_jc_item AS sji
                //             SET price = (
                //                 SELECT 
                //                     CASE 
                //                         WHEN sji.item_id IS NOT NULL THEN i.price
                //                         WHEN sji.product_id IS NOT NULL THEN p.price
                //                         ELSE NULL  -- Handle the case when both item_id and product_id are NULL
                //                     END AS new_price
                //                 FROM tbl_item i
                //                 LEFT JOIN tbl_product p ON sji.product_id = p.id
                //                 WHERE i.id = sji.item_id OR p.id = sji.product_id
                //                 LIMIT 1
                //             )
                //             WHERE sji.service_jc_id = $jcId";
                //         $conn->query($updatePriceQuery);

                //         // Update total price multiplication in tbl_service_jc_item
                //         $updateTotalPriceQuery = "
                //             UPDATE tbl_service_jc_item
                //             SET total_price = (
                //                 CASE
                //                     WHEN item_name IS NULL OR item_name = '' THEN product_quantity * price
                //                     WHEN product_name IS NULL OR product_name = '' THEN item_quantity * price
                //                     ELSE 0  -- Handle the case when both item_name and product_name are not empty or NULL
                //                 END
                //             )
                //             WHERE item_name IS NULL OR product_name IS NULL OR item_name = '' OR product_name = ''
                //                 AND service_jc_id = $jcId";
                //         $conn->query($updateTotalPriceQuery);

                //         // Close the database connection
                //         $conn->close();

                //         // Redirect or perform any other action after the updates
                //         // header("Location: your_redirect_page.php");
                //         // exit();
                //         echo "Job Card Costing successful.";
                //         // echo '<script>window.location.href = "close-jc-page.php";</script>';
                //     }
                //     else {
                //         echo "Job card Costing not unsuccessful.";
                //         $conn->error;
                //     }
                // }

                
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if the job card ID is provided in the query parameter
//     if (isset($_GET['jc_id'])) {
//         $jcId = $_GET['jc_id'];

//         // Check connection
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Update material cost
//         $updateMaterialCostQuery = "
//             UPDATE tbl_service_jc AS sj
//             SET material_cost = (
//                 SELECT SUM(total_price) AS total_cost
//                 FROM tbl_service_jc_item sji
//                 WHERE sji.service_jc_id = sj.id
//             )
//             WHERE sj.id = $jcId";
//         mysqli_query($conn, $updateMaterialCostQuery);

//         // Update fuel cost
//         $updateFuelCostQuery = "
//             UPDATE tbl_service_jc AS sj
//             SET fuel_cost = (
//                 SELECT 
//                     CASE
//                         WHEN sj.jc_assigned_to = 'Manager' THEN area.distance_KM * 2 * rates_car.rate_value
//                         WHEN sj.jc_assigned_to = 'Office' THEN area.distance_KM * 2 * rates_office.rate_value
//                         ELSE area.distance_KM * 2 * rates_bike.rate_value
//                     END AS fuel_cost
//                 FROM tbl_area AS area
//                 JOIN tbl_service_jc AS jc ON jc.area = area.area
//                 LEFT JOIN tbl_rates AS rates_car ON rates_car.rate_item = 'Car Fuel'
//                 LEFT JOIN tbl_rates AS rates_office ON rates_office.rate_item = 'Office'
//                 LEFT JOIN tbl_rates AS rates_bike ON rates_bike.rate_item = 'Bike Fuel'
//                 WHERE jc.id = sj.id 
//             )
//             WHERE sj.id = $jcId";
//         mysqli_query($conn, $updateFuelCostQuery);

//         // Update technician cost
//         $updateTechnicianCostQuery = "
//             UPDATE tbl_service_jc AS sjc
//             SET technician_cost = (
//                 SELECT 
//                     CASE
//                         WHEN sjc.jc_assigned_to = 'Manager' THEN sjc.hours * r_manager.rate_value
//                         WHEN sjc.jc_assigned_to = 'Office' THEN sjc.hours * r_office.rate_value
//                         ELSE sjc.hours * r_technician.rate_value
//                     END AS total_cost
//                 FROM tbl_rates AS r_technician
//                 LEFT JOIN tbl_rates AS r_manager ON r_manager.rate_item = 'Hitesh'
//                 LEFT JOIN tbl_rates AS r_office ON r_office.rate_item = 'Office'
//                 WHERE r_technician.rate_item = 'Technician'
//             )
//             WHERE sjc.id = $jcId";
//         mysqli_query($conn, $updateTechnicianCostQuery);

//         // Update price in tbl_service_jc_item
//         $updatePriceQuery = "
//             UPDATE tbl_service_jc_item AS sji
//             SET price = (
//                 SELECT 
//                     CASE 
//                         WHEN sji.item_id IS NOT NULL THEN i.price
//                         WHEN sji.product_id IS NOT NULL THEN p.price
//                         ELSE NULL  -- Handle the case when both item_id and product_id are NULL
//                     END AS new_price
//                 FROM tbl_item i
//                 LEFT JOIN tbl_product p ON sji.product_id = p.id
//                 WHERE i.id = sji.item_id OR p.id = sji.product_id
//                 LIMIT 1
//             )
//             WHERE sji.service_jc_id = $jcId";
//         mysqli_query($conn, $updatePriceQuery);

//         // Update total price multiplication in tbl_service_jc_item
//         $updateTotalPriceQuery = "
//             UPDATE tbl_service_jc_item
//             SET total_price = (
//                 CASE
//                     WHEN item_name IS NULL OR item_name = '' THEN product_quantity * price
//                     WHEN product_name IS NULL OR product_name = '' THEN item_quantity * price
//                     ELSE 0  -- Handle the case when both item_name and product_name are not empty or NULL
//                 END
//             )
//             WHERE item_name IS NULL OR product_name IS NULL OR item_name = '' OR product_name = ''
//                 AND service_jc_id = $jcId";
//         mysqli_query($conn, $updateTotalPriceQuery);

//         // Close the database connection
//         $conn->close();

//         // Redirect or perform any other action after the updates
//         echo "Job Card Costing successful.";
//         // echo '<script>window.location.href = "close-jc-page.php";</script>';
//     } else {
//         echo "Job card Costing not unsuccessful.";
//         $conn->error;
//     }
// }


        // JOB CARD COSTING
        

       

?>


