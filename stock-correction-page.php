<?php
include('config/constants.php');
include('partials/navbar.php');
include('edit_stock_correction.php');
include('edit_stock_correction_product.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #1997D4;
        }
        .section-title {
            color: red;
            font-size: 16px;
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 8px;
            font-size: 13px;
            line-height: 1.5;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<main id="main" class="main" style="margin-bottom: 0px;">
    <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
                <div id="product" class="tab-pane in active">
                    <h1>STOCK CORRECTION</h1>

                    <?php
                    // Retrieve the selected business's ID from the URL parameter
                    $selectedBusiness = isset($_GET['id']) ? (int)$_GET['id'] : 0;

                    // Fetch the business name from tbl_business
                    $business_query = "SELECT business FROM tbl_business WHERE id = $selectedBusiness";
                    $business_result = mysqli_query($conn, $business_query);
                    $business_name = '';

                    if ($business_result && mysqli_num_rows($business_result) > 0) {
                        $row = mysqli_fetch_assoc($business_result);
                        $business_name = $row['business'];
                    }    
                    ?>

                    <!--<div class='ms-auto'>
                        <a href='stock-correction-business-page.php' style='color: black; align'><button class='btn btn-info'>Back</button></a>
                    </div>-->

                    <div style="text-align: right; margin-top: 10px;">
                        <a href="stock-correction-business-page.php"><button class="btn btn-info">Back</button></a>
                    </div>


                    <h4 class="section-title">PRODUCTS (<?= htmlspecialchars($business_name) ?>)</h4>

                    <?php
                    $brand_query = "SELECT DISTINCT brand FROM tbl_product WHERE business_id = '$selectedBusiness' ORDER BY brand ASC";
                    $brand_results = mysqli_query($conn, $brand_query);

                    while ($brand_row = mysqli_fetch_assoc($brand_results)) {
                        $currentBrand = $brand_row['brand'];
                        echo '<h5><span style="color: #1997D4;">' . htmlspecialchars($currentBrand) . '</span></h5>';

                        $product_query = "SELECT id, name, stock_qty FROM tbl_product WHERE brand = '$currentBrand' AND business_id = '$selectedBusiness' ORDER BY name ASC";
                        $product_results = mysqli_query($conn, $product_query);

                        if (mysqli_num_rows($product_results) > 0) {
                            echo '<style>
                                        .product-stock-table th {
                                            text-align: center;
                                            font-size: 15px;
                                            line-height: 1;
                                        }
                                    </style>

                                    <table class="product-stock-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">S.N</th>
                                                <th width="50%">Product Name</th>
                                                <th width="15%">Stock Qty</th>
                                                <th width="15%">New Stock Qty</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    ';
                            $sn = 1;
                            while ($row = mysqli_fetch_assoc($product_results)) {
                                echo '<style>
                                            .product-stock-row td {
                                                font-size: 15px;
                                                line-height: 1;
                                                text-align: center;
                                            }
                                            .product-stock-row td.name-product {
                                                text-align: left;
                                            }
                                        </style>

                                        <tr class="product-stock-row">
                                            <td class="product_id" style="display:none;">' . $row["id"] . '</td>
                                            <td width="5%">' . $sn++ . '</td>
                                            <td class="name-product" width="50%">' . $row['name'] . '</td>
                                            <td width="15%">' . $row['stock_qty'] . '</td>
                                            <td width="15%"><input type="number" style="width: 80px;" name="new_stock_p_qty_' . $row['id'] . '"></td>
                                        </tr>';
                            }
                            echo '</tbody></table>';
                        }
                    }
                    ?>

                    <button id="updateAllProductButton" class="btn btn-primary" style="margin-top: 10px;">Update Products</button>

                    <h4 class="section-title">ITEMS (<?= htmlspecialchars($business_name) ?>)</h4>

                    <?php
                    $category_query = "SELECT DISTINCT category FROM tbl_item WHERE business_id = '$selectedBusiness' ORDER BY category ASC";
                    $category_results = mysqli_query($conn, $category_query);

                    while ($category_row = mysqli_fetch_assoc($category_results)) {
                        $currentCategory = $category_row['category'];

                        $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE category = '$currentCategory' AND business_id = '$selectedBusiness' ORDER BY sub_category ASC";
                        $sub_category_results = mysqli_query($conn, $sub_category_query);

                        while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
                            $currentSubCategory = $sub_category_row['sub_category'];
                            echo '<h5><span style="color: #1997D4;">' . htmlspecialchars($currentCategory) . '</span>: <span style="color: green;">' . htmlspecialchars($currentSubCategory) . '</span></h5>';

                            $item_query = "SELECT id, item_name, brand, stock_qty FROM tbl_item WHERE category = '$currentCategory' AND sub_category = '$currentSubCategory' AND business_id = '$selectedBusiness' ORDER BY item_name ASC";
                            $item_results = mysqli_query($conn, $item_query);

                            if (mysqli_num_rows($item_results) > 0) {
                                echo '<style>
                                        .item-stock-table th {
                                            text-align: center;
                                            font-size: 15px;
                                            line-height: 1;
                                        }
                                    </style>

                                    <table class="item-stock-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">S.N</th>
                                                <th width="50%">Item Name</th>
                                                <th width="15%">Brand</th>
                                                <th width="15%">Stock Qty</th>
                                                <th width="15%">New Stock Qty</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    ';
                                $sn = 1;
                                while ($item_row = mysqli_fetch_assoc($item_results)) {
                                    echo '<style>
                                            .item-stock-row td {
                                                font-size: 15px;
                                                line-height: 1;
                                                text-align: center;
                                            }
                                            .item-stock-row td.name-item {
                                                text-align: left;
                                            }
                                        </style>

                                        <tr class="item-stock-row">
                                            <td class="item_id" style="display:none;">' . $item_row["id"] . '</td>
                                            <td width="5%">' . $sn++ . '</td>
                                            <td class="name-item" width="50%">' . $item_row['item_name'] . '</td>
                                            <td width="15%">' . $item_row['brand'] . '</td>
                                            <td width="15%">' . $item_row['stock_qty'] . '</td>
                                            <td width="15%"><input type="number" style="width: 80px;" name="new_stock_qty_' . $item_row['id'] . '"></td>
                                        </tr>';
                                }
                                echo '</tbody></table>';
                            }
                        }
                    }
                    ?>

                    <button id="updateAllItemButton" class="btn btn-primary" style="margin-top: 10px;">Update Items</button>
                </div>
        </div>
    </section>
</main>

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
