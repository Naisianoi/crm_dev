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
        <div class="container" style="padding: 0px 30px;">
            <div id="product" class="tab-pane in active">
                <h1>STOCK CORRECTION</h1>

                <?php
                $business_id = $_GET['business_id'];
                $business_query = "SELECT DISTINCT business FROM tbl_business WHERE id = $business_id";
                $business_results = mysqli_query($conn, $business_query);

                while ($business_row = mysqli_fetch_assoc($business_results)) {
                    $business_name = $business_row['business'];
                    echo "<h4>$business_name</h4>";
                    echo "<div class='ms-auto mb-3'>
                            <a href='stock-correction-page.php'><button class='btn btn-info'>Back</button></a>
                          </div>";

                    // PRODUCTS SECTION
                    echo '<div class="section-title">PRODUCTS</div>';

                    $brand_query = "SELECT DISTINCT brand FROM tbl_product WHERE business_id = $business_id ORDER BY brand ASC";
                    $brand_results = mysqli_query($conn, $brand_query);

                    while ($brand_row = mysqli_fetch_assoc($brand_results)) {
                        $currentBrand = $brand_row['brand'];
                        echo "<h5>$business_name - <span style='color:#1997D4;'>$currentBrand</span></h5>";

                        $product_query = "SELECT id, name, stock_qty FROM tbl_product WHERE business_id = $business_id AND brand = '$currentBrand' ORDER BY name ASC";
                        $product_results = mysqli_query($conn, $product_query);

                        if (mysqli_num_rows($product_results) > 0) {
                            echo '<table>
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">S.N</th>
                                            <th style="text-align:center;">Product Name</th>
                                            <th style="text-align:center;">Stock Qty</th>
                                            <th style="text-align:center;">New Stock Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            $sn = 1;
                            while ($row = mysqli_fetch_assoc($product_results)) {
                                echo "<tr>
                                        <td style='text-align:center;'>$sn</td>
                                        <td>{$row['name']}</td>
                                        <td style='text-align:center;'>{$row['stock_qty']}</td>
                                        <td style='text-align:center;'><input type='number' style='width:80px;' name='new_stock_p_qty_{$row['id']}'></td>
                                      </tr>";
                                $sn++;
                            }
                            echo '</tbody></table>';
                        }
                    }

                    echo '<button id="updateAllProductButton" class="btn btn-primary mt-2 mb-4">Update Products</button>';

                    // ITEMS SECTION
                    echo '<div class="section-title">ITEMS</div>';

                    $category_query = "SELECT DISTINCT category FROM tbl_item WHERE business_id = $business_id ORDER BY category ASC";
                    $category_results = mysqli_query($conn, $category_query);

                    while ($category_row = mysqli_fetch_assoc($category_results)) {
                        $currentCategory = $category_row['category'];
                        $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE business_id = $business_id AND category = '$currentCategory' ORDER BY sub_category ASC";
                        $sub_category_results = mysqli_query($conn, $sub_category_query);

                        while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
                            $currentSubCategory = $sub_category_row['sub_category'];
                            echo "<h5>$business_name - <span style='color:#1997D4;'>$currentCategory</span>: <span style='color:green;'>$currentSubCategory</span></h5>";

                            $item_query = "SELECT id, item_name, stock_qty FROM tbl_item WHERE business_id = $business_id AND category = '$currentCategory' AND sub_category = '$currentSubCategory' ORDER BY item_name ASC";
                            $item_results = mysqli_query($conn, $item_query);

                            if (mysqli_num_rows($item_results) > 0) {
                                echo '<table>
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">S.N</th>
                                                <th style="text-align:center;">Item Name</th>
                                                <th style="text-align:center;">Stock Qty</th>
                                                <th style="text-align:center;">New Stock Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                $sn = 1;
                                while ($item_row = mysqli_fetch_assoc($item_results)) {
                                    echo "<tr>
                                            <td style='text-align:center;'>$sn</td>
                                            <td>{$item_row['item_name']}</td>
                                            <td style='text-align:center;'>{$item_row['stock_qty']}</td>
                                            <td style='text-align:center;'><input type='number' style='width:80px;' name='new_stock_i_qty_{$item_row['id']}'></td>
                                          </tr>";
                                    $sn++;
                                }
                                echo '</tbody></table>';
                            }
                        }
                    }

                    echo '<button id="updateAllItemButton" class="btn btn-primary mt-2">Update Items</button>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<!-- Stock Update Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Upload Image Handling -->
<?php
if (isset($_FILES["image"]["name"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>alert('Invalid Image Extension');</script>";
    } elseif ($imageSize > 1200000) {
        echo "<script>alert('Image Size Is Too Large');</script>";
    } else {
        $newImageName = "$name - " . date("Y.m.d - h.i.sa") . '.' . $imageExtension;
        $query = "UPDATE tbl_admin SET image_name = '$newImageName' WHERE id = $id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'images/admin-images/' . $newImageName);
        echo "<script>document.location.href = '../aquashine/general-manager.php?id=$id';</script>";
    }
}
?>

<!-- Scripts -->
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
