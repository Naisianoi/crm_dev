<?php 
include('partials/navbar.php');
include('edit_stock_correction.php');
//include('edit_stock_correction_product.php');
?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
    <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:30px;">
            <div class="tab-content" id="search">
                <div id="product" class="tab-pane in active">
                <h1 style="padding-top: 0px;">STOCK MOVEMENT</h1>
                <!-- <h2 style="padding-top: 30px;">Product</h2> -->

<?php
// Get usage data for products based on work_done_date
/*$query_check_months_product = "
    SELECT 
        sp.product_id,
        COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_1_month,
        COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_3_month,
        COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_6_month
    FROM tbl_service_jc_item sp
    WHERE sp.work_done_date IS NOT NULL
    GROUP BY sp.product_id
";

$result_counts = mysqli_query($conn, $query_check_months_product);

// Store monthly usage by product_id
$count_data = [];
while ($row = mysqli_fetch_assoc($result_counts)) {
    $count_data[$row['product_id']] = $row;
}

// Get all distinct business types
$business_query = "SELECT DISTINCT business FROM tbl_product";
$business_results = mysqli_query($conn, $business_query);

// Friendly business names
$businessNames = [
    "DWS" => "Drinking Water System (DWS)",
    "IEL" => "Industrial Electrical (IEL)",
    "IWT" => "Industrial Water Treatment (IWT)",
    "WTW" => "Water Treatment Wholesale (WTW)"
];

// Declare $sn before looping through businesses to make it continuous
$sn = 1;

// Loop through businesses
while ($business_row = mysqli_fetch_assoc($business_results)) {
    $currentBusiness = $business_row['business'];
    $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

    echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

    $product_query = "
        SELECT * 
        FROM tbl_product 
        WHERE business = '$currentBusiness' 
        ORDER BY name ASC
    ";

    $product_results = mysqli_query($conn, $product_query);

    if (mysqli_num_rows($product_results) > 0) {
        echo "
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th style='text-align: center;'>ID</th>
                    <th style='text-align: center;'>S.N</th>
                    <th style='text-align: center;'>Product Name</th>
                    <th style='text-align: center;'>Brand</th>
                    <th style='text-align: center;'>Auto Purchase Price</th>
                    <th style='text-align: center;'>Pur. Price Dt.</th>
                    <th style='text-align: center;'>Stock Qty</th>
                    <th style='text-align: center;'>Min. Stock</th>
                    <th style='text-align: center;'>1 Month</th>
                    <th style='text-align: center;'>3 Months</th>
                    <th style='text-align: center;'>6 Months</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        ";

        $sn = 1;
        while ($row = mysqli_fetch_array($product_results)) {
            $product_id = $row['id'];
            $count_1_month = $count_data[$product_id]['count_1_month'] ?? 0;
            $count_3_month = $count_data[$product_id]['count_3_month'] ?? 0;
            $count_6_month = $count_data[$product_id]['count_6_month'] ?? 0;

            echo "
                <tr>
                    <td class='product_id text-center'>{$row["id"]}</td>
                    <td class='text-center'>{$sn}.</td>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td class='text-center'>" . htmlspecialchars($row["brand"]) . "</td>
                    <td style='text-align: right; color: green;'>" . number_format($row["auto_purchase_price"], 2) . "</td>
                    <td class='text-center'>" . htmlspecialchars($row["purchase_price_date"]) . "</td>
                    <td class='text-center' style='color: #0000FF;'>" . htmlspecialchars($row["stock_qty"]) . "</td>
                    <td class='text-center' style='color: red;'>" . htmlspecialchars($row["min_stock"]) . "</td>
                    <td class='text-center'>$count_1_month</td>
                    <td class='text-center'>$count_3_month</td>
                    <td class='text-center'>$count_6_month</td>
                    <td class='text-center'>
                        <a href='stock-view-product-date-page.php?id={$row['id']}' class='btn btn-primary btn-sm col-xs-2' title='Stock View'>
                            <i class='bi bi-arrow-left-right'></i>
                        </a>
                    </td>
                </tr>
            ";
            $sn++; // increment globally
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='text-center text-muted'>No records found for $businessName</p>";
    }
}*/
?>
                    <!-- Add an "Update All" button for products -->

<div class="d-flex align-items-center">
    <h2 style="padding-top: 30px;">Item</h2>
    <div class="ms-auto">
        <div class="row">
            <!-- Optional action buttons can be placed here -->
        </div>
    </div>
</div>

<?php
// Query to calculate item quantity usage over 1, 3, and 6 months
$query_check_months = "
    SELECT 
        si.item_id,
        COALESCE(SUM(CASE WHEN si.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) THEN si.item_quantity ELSE 0 END), 0) AS count_1_month,
        COALESCE(SUM(CASE WHEN si.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) THEN si.item_quantity ELSE 0 END), 0) AS count_3_month,
        COALESCE(SUM(CASE WHEN si.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) THEN si.item_quantity ELSE 0 END), 0) AS count_6_month
    FROM 
        tbl_service_jc_item si
    WHERE
        si.work_done_date IS NOT NULL
    GROUP BY 
        si.item_id
";
$result_counts = mysqli_query($conn, $query_check_months);

// Store usage data in array for quick lookup
$count_data = [];
while ($row = mysqli_fetch_assoc($result_counts)) {
    $count_data[$row['item_id']] = $row;
}

// Business-wise loop
$business_query = "SELECT DISTINCT business FROM tbl_item";
$business_results = mysqli_query($conn, $business_query);

$businessNames = [
    "DWS" => "Drinking Water System (DWS)",
    "IEL" => "Industrial Electrical (IEL)",
    "IWT" => "Industrial Water Treatment (IWT)",
    "WTW" => "Water Treatment Wholesale (WTW)"
];

while ($business_row = mysqli_fetch_assoc($business_results)) {
    $currentBusiness = $business_row['business'];
    $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

    echo "<h1 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h1>";

    echo "
    <table class='table'>
        <thead class='thead-dark'>
            <tr>
                <th style='text-align: center;'>ID</th>
                <th style='text-align: center;'>S.N</th>
                <th style='text-align: center;'>Item Name</th>
                <th style='text-align: center;'>Brand</th>
                <th style='text-align: center;'>Purchase Mode</th>
                <th style='text-align: center;'>Pur. Price Dt.</th>
                <th style='text-align: center;'>Stock Qty</th>
                <th style='text-align: center;'>Min. Stock</th>
                <th style='text-align: center;'>1 Month</th>
                <th style='text-align: center;'>3 Months</th>
                <th style='text-align: center;'>6 Months</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    ";

    $category_query = "SELECT DISTINCT category FROM tbl_item WHERE business = '$currentBusiness' ORDER BY category ASC";
    $category_results = mysqli_query($conn, $category_query);

    $sn = 1;

    while ($category_row = mysqli_fetch_assoc($category_results)) {
        $currentCategory = $category_row['category'];

        $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE category = '$currentCategory' AND business = '$currentBusiness' ORDER BY sub_category ASC";
        $sub_category_results = mysqli_query($conn, $sub_category_query);

        while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
            $currentSubCategory = $sub_category_row['sub_category'];
            echo "<tr><td colspan='12' style='font-size:18px;'><strong style='color: #1997D4;'>$currentCategory</strong>: <span style='color: green;'>$currentSubCategory</span></td></tr>";

            $item_query = "
                SELECT * 
                FROM tbl_item  
                WHERE category = '$currentCategory' AND sub_category = '$currentSubCategory' AND business = '$currentBusiness' 
                ORDER BY item_name ASC
            ";
            $item_results = mysqli_query($conn, $item_query);

            if (mysqli_num_rows($item_results) > 0) {
                while ($row = mysqli_fetch_array($item_results)) {
                    $item_id = $row['id'];
                    $count_1 = $count_data[$item_id]['count_1_month'] ?? 0;
                    $count_3 = $count_data[$item_id]['count_3_month'] ?? 0;
                    $count_6 = $count_data[$item_id]['count_6_month'] ?? 0;

                    echo "
                        <tr>
                            <td class='item_id text-center'>{$row["id"]}</td>
                            <td style='text-align: center;'>$sn.</td>
                            <td>" . htmlspecialchars($row["item_name"]) . "</td>
                            <td class='brand' style='text-align: center;'>{$row["brand"]}</td>
                            <td style='text-align: center;'>" . htmlspecialchars($row["purchase_mode"]) . "</td>
                            <td style='text-align: center;'>" . $row["purchase_price_date"] . "</td>
                            <td style='text-align: center; color: #0000FF;'>" . $row["stock_qty"] . "</td>
                            <td style='text-align: center; color: red;'>" . $row["min_stock"] . "</td>
                            <td style='text-align: center;'>$count_1</td>
                            <td style='text-align: center;'>$count_3</td>
                            <td style='text-align: center;'>$count_6</td>
                            <td style='text-align: center;'>
                                <a href='stock-view-item-date-page.php?id={$row['id']}' class='btn btn-primary btn-sm col-xs-2' title='Stock View'>
                                    <i class='bi bi-arrow-left-right'></i>
                                </a>
                            </td>
                        </tr>
                    ";
                    $sn++;
                }
            } else {
                echo "<tr><td colspan='12' class='text-center text-muted'>No items found in $currentSubCategory</td></tr>";
            }
        }
    }

    echo "</tbody></table>";
}
?>


                    <!-- Add an "Update All" button at the top or bottom of your table -->
                                                                                                    
                </div><!------------------end view data---------------------------->

                    <div id="category-form">
                        
                    <div class="modal fade" aria-hidden="true">
                        <select class="form-select" name="business" id="edit_business_select_item" required>
                        </select>
                    </div>
                            
                        <!-----------------------Updated Pop Up for Stock------------------------------------->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modalTitle"></h4>
                                    </div>
                                    <div class="modal-body" id="modalBody">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-----------------------Updated Pop Up for Stock------------------------------------->

                        
                    
    </div>
                

                    


            
            
        </section>

        

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <!--<footer id="footer" class="footer">
        <div class="copyright">
        &copy; Copyright <strong><span>Aquashine</span></strong>. All Rights Reserved 2023
        </div>
    </footer>
     End Footer -->

    <!-- Template Main JS File -->

    <?php
        if(isset($_FILES["image"]["name"])){
            $id = $_POST["id"];
            $name = $_POST["name"];
    
            $imageName = $_FILES["image"]["name"];
            $imageSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
    
            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){
            echo
            "
            <script>
                alert('Invalid Image Extension');
                document.location.href = '../aquashine';
            </script>
            ";
            }
            elseif ($imageSize > 1200000){
            echo
            "
            <script>
                alert('Image Size Is Too Large');
                //document.location.href = '../aquashine';
            </script>
            ";
            }
            else{
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
            $newImageName .= '.' . $imageExtension;
            $query = "UPDATE tbl_admin SET image_name = '$newImageName' WHERE id = $id";
            mysqli_query($conn, $query);
            move_uploaded_file($tmpName, 'images/admin-images/' . $newImageName);
            echo
            
            "
            <script>
            document.location.href = '../aquashine/general-manager.php'?id='.$id;
            </script>
            ";
            }
        }

        
        ?>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


    <script src="js/stock_correction.js"></script>
    
    <script src="js/main.js"></script>


    </body>
    </html>

