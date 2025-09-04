<?php
include('config/constants.php');

// TESTING
if (isset($_POST['submit_service_jc'])) {
    $customerName = $_POST['customer_name'];
    $customerId = $_POST['edit_customer_id'];
    $companyName = $_POST['company_name'];
    $jcType = $_POST['jc_type'];
    $jcLeadBy = $_POST['jc_lead_by'];
    $amount = $_POST['amount'];

    $customerType = $_POST['customer_type'];
    $jcCreateDate = $_POST['jc_create_date'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $salesAgent = $_POST['sales_agent'];
    $contactNameOne = $_POST['contact_name_one'];
    $contactPhoneOne = $_POST['contact_phone_one'];
    $contactNameTwo = $_POST['contact_name_two'];
    $contactPhoneTwo = $_POST['contact_phone_two'];
    $commerce = $_POST['commerce'];
    $productName = $_POST['product_name_static'];
    $brandName = $_POST['brand_name_static'];
    $business = $_POST['business_name_static'];
    $datewamc = $_POST['date_w_amc'];
    $googleLocation = $_POST['google_location'];
    $physicalLocation = $_POST['physical_location'];
    $workStatement = $_POST['work_statement'];
    $customerWord = $_POST['customer_word'];
    $lastJcNumber = $_POST['last_jc_number'];
    $lastJcDate = $_POST['last_jc_date'];
    $lastJcType = $_POST['last_jc_type'];
    $lastAssignedTo = $_POST['last_assigned_to'];
    $role = $_POST['role'];

    // JC Number
    // Add code to retrieve last_jc_number and last_jc_date
    $customer_id = mysqli_real_escape_string($conn, $_POST['edit_customer_id']); // Replace with your actual field name

    $lastJobQuery = "
    SELECT 
    jc.id AS last_jc_number,
    jc.jc_create_date AS last_jc_date,
    jc.jc_type AS last_jc_type, 
    jc.jc_assigned_to AS last_assigned_to
        FROM tbl_service_jc jc
        JOIN (
            SELECT MAX(id) AS max_id
            FROM tbl_service_jc
            WHERE customer_id = '$customer_id'
        ) subquery
        ON jc.id = subquery.max_id";

    $lastJobResult = mysqli_query($conn, $lastJobQuery);

    $lastJcNumber = ""; // Initialize with a default value
    $lastJcDate = ""; // Initialize with an empty string
    $lastJcType = ""; // Initialize with a default value
    $lastAssignedTo = ""; // Initialize with an empty string

    if ($lastJobResult) {
        $row = mysqli_fetch_assoc($lastJobResult);
        $lastJcNumber = $row['last_jc_number'] ?? null;
        $lastJcDate = $row['last_jc_date'] ?? null;
        $lastJcType = $row['last_jc_type'] ?? null;
        $lastAssignedTo = $row['last_assigned_to'] ?? null;
    }

    // JC Number

    // product and item
    $selectedProducts = $_POST['selected_products'];
    $selectedItems = $_POST['selected_items'];

    if(!empty($jcType)){ //Checking if jcType is empty

    // Initialize flags and arrays
    $belowRequiredQuantity = false;
    $insufficientStock = false;
    $insufficientStockItems = array();

    // Check stock quantity for selected items
    foreach ($selectedItems as $itemData) {
        $itemName = mysqli_real_escape_string($conn, $itemData['item']);
        $itemQuantity = (int)$itemData['quantity'];

        // Check both databases for item
        $getItemInfoQueryItem = "SELECT id, stock_qty FROM tbl_item WHERE item_name = '$itemName'";
        $getItemInfoResultItem = mysqli_query($conn, $getItemInfoQueryItem);

        if ($getItemInfoResultItem) {
            $row = mysqli_fetch_assoc($getItemInfoResultItem);
            $stockQty = $row['stock_qty'];

            // Check if item quantity is below required quantity
            if ($itemQuantity > $stockQty) {
                $insufficientStock = true;
                $insufficientStockItems[] = $itemName;
            }
        }
    }

    // Check stock quantity for selected products
    foreach ($selectedProducts as $productData) {
        $productName = mysqli_real_escape_string($conn, $productData['product']);
        $productQuantity = (int)$productData['quantity'];

        // Check both databases for product
        $getProductInfoQuery = "SELECT id, stock_qty FROM tbl_product WHERE name = '$productName'";
        $getProductInfoResult = mysqli_query($conn, $getProductInfoQuery);

        if ($getProductInfoResult) {
            $row = mysqli_fetch_assoc($getProductInfoResult);
            $stockQty = $row['stock_qty'];

            // Check if product quantity is below required quantity
            if ($productQuantity > $stockQty) {
                $insufficientStock = true;
                $insufficientStockItems[] = $productName;
            }
        }
    }

    // If there is insufficient stock, show a pop-up and exit
    if ($insufficientStock) {
        $response = array('status' => 'error', 'message' => 'Insufficient stock', 'insufficient_stock' => $insufficientStock, 'insufficient_stock_items' => $insufficientStockItems);
        echo json_encode($response);
        exit();
    }

    // If there is no insufficient stock, proceed with data insertion
    // Insert data into tbl_service_jc
    $insertQueryServiceJc = "INSERT INTO tbl_service_jc (jc_type, customer_type, jc_create_date, customer_name, jc_lead_by, company_name, city, sales_agent, address, area, county, contact_name_1, contact_number_1, contact_name_2, contact_number_2, product_name, business, brand, physical_location, google_location, commerce, date_w_amc, last_jc_number, last_jc_date, work_statement, customer_word, amount, customer_id, role, last_jc_type, last_assigned_to ) VALUES 
    ('$jcType', '$customerType', '$jcCreateDate','$customerName','$jcLeadBy', '$companyName', '$city', '$salesAgent', '$address', '$area', '$county', '$contactNameOne', '$contactPhoneOne', '$contactNameTwo', '$contactPhoneTwo', '$productName', '$business', '$brandName', '$physicalLocation', '$googleLocation', '$commerce', '$datewamc', '$lastJcNumber', '$lastJcDate', '$workStatement', '$customerWord', '$amount' ,'$customerId', '$role', '$lastJcType', '$lastAssignedTo')";

    if (mysqli_query($conn, $insertQueryServiceJc)) {
        $serviceJcId = mysqli_insert_id($conn);

        $insertSuccess = true;

        // Insert data into tbl_service_jc_item for items
        foreach ($selectedItems as $itemData) {
            $itemName = mysqli_real_escape_string($conn, $itemData['item']);
            $itemQuantity = (int)$itemData['quantity'];

            // Retrieve the id of the item based on the item_name
            $getItemIdQuery = "SELECT id FROM tbl_item WHERE item_name = '$itemName'";
            $getItemIdResult = mysqli_query($conn, $getItemIdQuery);

            if ($getItemIdResult) {
                $row = mysqli_fetch_assoc($getItemIdResult);
                $itemId = $row['id'];

                // Insert data into tbl_service_jc_item for items
                $itemQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_id, item_name, item_quantity, product_name, product_quantity) VALUES ($serviceJcId, $itemId, '$itemName', $itemQuantity, '', 0)";

                if (!mysqli_query($conn, $itemQuery)) {
                    $insertSuccess = false;
                }
            }
        }

        // Insert data into tbl_service_jc_item for products
        foreach ($selectedProducts as $productData) {
            $productName = mysqli_real_escape_string($conn, $productData['product']);
            $productQuantity = (int)$productData['quantity'];

            // Retrieve the id of the product based on the product_name
            $getProductIdQuery = "SELECT id FROM tbl_product WHERE name = '$productName'";
            $getProductIdResult = mysqli_query($conn, $getProductIdQuery);

            if ($getProductIdResult) {
                $row = mysqli_fetch_assoc($getProductIdResult);
                $productId = $row['id'];

                // Insert data into tbl_service_jc_item for products
                $productQuery = "INSERT INTO tbl_service_jc_item (service_jc_id, item_id, item_name, item_quantity, product_id, product_name, product_quantity) VALUES ($serviceJcId, 0, '', 0, $productId, '$productName', $productQuantity)";

                if (!mysqli_query($conn, $productQuery)) {
                    $insertSuccess = false;
                }
            }
        }

        if ($insertSuccess) {
            $response = array('status' => 'success', 'message' => 'Service JC data and items inserted successfully', 'service_jc_id' => $serviceJcId);
        } else {
            $response = array('status' => 'error', 'message' => 'Data insertion failed for service jc items');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Data insertion failed for service jc');
    }


    
    
   } else {
    $response = array('status' => 'error jc type', 'message' => 'Choose Jc Type');
   }

   echo json_encode($response);
}
// TEST

// LAST JC FETCH DATA MODAL
if (isset($_POST['lastJC'])) {

    // Extract data from the AJAX request
    $customerName = $_POST['customer_name'];
    $role = $_POST['role'];


    $sql = "SELECT 
    jc.id,
    jc.jc_create_date,
    jc.jc_type,
    jc.jc_assigned_to,
    jc.work_statement,
    jc.job_finding
    FROM tbl_service_jc jc
    JOIN (
    SELECT MAX(id) AS max_id
    FROM tbl_service_jc
    WHERE customer_name = '$customerName' AND role = '$role'
    ) subquery
    ON jc.id = subquery.max_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data
        $rowData = $result->fetch_assoc();

        // Return the data as JSON
        echo json_encode(['status' => 'success', 'id' => $rowData['id'], 'jc_assigned_to' => $rowData['jc_assigned_to'], 
            'jc_type' => $rowData['jc_type'], 'jc_create_date' => $rowData['jc_create_date'], 'job_finding' => $rowData['job_finding'], 'work_statement' => $rowData['work_statement']]);
    } else {
        // No matching data found
        echo json_encode(['status' => 'error']);
    }

    $conn->close();
}
// LAST JC FETCH DATA MODAL

?>
