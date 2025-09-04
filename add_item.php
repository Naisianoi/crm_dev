<?php
        include('config/constants.php');
            
            $success = "";
            $sn=1;
    
            if (isset($_POST['add-item'])) {
                $business = $_POST['business'];
                $category = $_POST['category'];
                $sub_category = $_POST['sub_category'];
                $brand = $_POST['brand'];
                $item_name = $_POST['item_name'];
                $price = $_POST['price'];
                $sellingPrice = $_POST['selling_price'];
                $stockQty = $_POST['stock_qty'];
                $minStock = $_POST['min_stock'];
                $supplierName = $_POST['supplier_name'];
                $purchaseMode = $_POST['purchase_mode'];
                $purchaseDate = $_POST['purchase_price_date'];

                $inrPurchasePrice = $_POST['INR_purchase_price'];
                $weight = $_POST['weight'];
                $margin = $_POST['margin'];
                
            
                // Check if the provided 'business' exists in 'tbl_business'
                $query_business = "SELECT id FROM tbl_business WHERE business = '$business'";
                $result_business = mysqli_query($conn, $query_business);
            
                // Check if the provided 'category' exists in 'tbl_category'
                $query_category = "SELECT id FROM tbl_category WHERE category = '$category'";
                $result_category = mysqli_query($conn, $query_category);
            
                // Check if the provided 'sub_category' exists in 'tbl_subcategory'
                $query_subcategory = "SELECT id FROM tbl_subcategory WHERE subcategory = '$sub_category'";
                $result_subcategory = mysqli_query($conn, $query_subcategory);
            
                // Check if the provided 'brand' exists in 'tbl_brand'
                $query_brand = "SELECT id FROM tbl_brand WHERE brand = '$brand'";
                $result_brand = mysqli_query($conn, $query_brand);

                // Check if the provided 'brand' exists in 'tbl_supplier'
                $query_supplier = "SELECT id FROM tbl_supplier WHERE supplier_name = '$supplierName'";
                $result_supplier = mysqli_query($conn, $query_supplier);
            
                if ($result_business && mysqli_num_rows($result_business) > 0 &&
                    $result_category && mysqli_num_rows($result_category) > 0 &&
                    $result_subcategory && mysqli_num_rows($result_subcategory) > 0 &&
                    $result_brand && mysqli_num_rows($result_brand) > 0 &&
                    $result_supplier && mysqli_num_rows($result_supplier) > 0 ) {
                    
                    $row_business = mysqli_fetch_assoc($result_business);
                    $business_id = $row_business['id'];
            
                    $row_category = mysqli_fetch_assoc($result_category);
                    $category_id = $row_category['id'];
            
                    $row_subcategory = mysqli_fetch_assoc($result_subcategory);
                    $subcategory_id = $row_subcategory['id'];
            
                    $row_brand = mysqli_fetch_assoc($result_brand);
                    $brand_id = $row_brand['id'];

                    $row_supplier = mysqli_fetch_assoc($result_supplier);
                    $supplier_id = $row_supplier['id'];
            
                    // Now that you have the required IDs, you can insert the data into 'tbl_item'
                    $query_insert_item = "INSERT INTO tbl_item (business_id, brand, category, business, sub_category, category_id, 
                    subcategory_id, brand_id, item_name, price, stock_qty, min_stock, supplier_name, supplier_id, purchase_mode, purchase_price_date,
                    INR_purchase_price, weight, margin, selling_price)
                    VALUES ('$business_id', '$brand', '$category', '$business','$sub_category', '$category_id', 
                    '$subcategory_id', '$brand_id', '$item_name', $price, $stockQty, $minStock, '$supplierName', '$supplier_id', '$purchaseMode', '$purchaseDate',
                    '$inrPurchasePrice', '$weight', '$margin','$sellingPrice')";
            
                    $query_run = mysqli_query($conn, $query_insert_item);
            
                    /*if ($query_run) {
                        $_SESSION['status'] = "Successfully saved";
                        header("Location:".SITEURL.'/item-page.php');
                        exit;
                    }*/if ($query_run) {
                        $_SESSION['status'] = "Successfully saved";
                        header("Location:" . SITEURL . "/item-page.php?reload=1");
                        exit;
                    } else {
                        $_SESSION['status'] = "Data not saved";
                        header("Location:".SITEURL.'/item-page.php');
                        exit;
                    }
                } else {
                    // The provided 'business', 'category', 'sub_category', or 'brand' does not exist
                    echo '<script>
                            alert("Please choose valid business, category, sub-category, and brand");
                            window.location.href = "'.SITEURL.'/item-page.php";
                          </script>';
                    exit;
                }
            }
                      
            
            
        ?>
    


