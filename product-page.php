<?php include('partials/navbar.php');
      include('add_product.php');
      include('edit_product.php');
      include('delete_product.php');
      include('fetch_data_product.php');

?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->


<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
      <div class="tab-content" id="search">
        <div id="product" class="tab-pane in active">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="m-0">PRODUCT</h1>
            <div>
              <a href="add-product-page.php" id="btn" class="btn btn-info">Add New Product</a>
            </div>
          </div>

          <div class="d-flex align-items-center mb-3">
            <!-- Future filter dropdowns (Business, Brand) -->
          </div>

         <?php
// Fetch distinct business abbreviations from products
$business_query = "SELECT DISTINCT business FROM tbl_product";
$business_results = mysqli_query($conn, $business_query);

// Fetch full business names from tbl_business
$full_names_query = "SELECT business, business_name FROM tbl_business";
$full_names_results = mysqli_query($conn, $full_names_query);

// Create map: business => full business name
$businessNames = [];
while ($row = mysqli_fetch_assoc($full_names_results)) {
    $short = $row['business'];       // e.g. IWT
    $full = $row['business_name'];     // e.g. Industrial Water Treatment
    $businessNames[$short] = "$full ($short)";
}

$grandTotalProducts = 0;
$grandTotalMinStock = 0;
$grandTotalValue = 0;
$grandTotalStock = 0;
$grandTotalCost = 0;
$businessTotals = []; // Store totals for summary table

while ($business_row = mysqli_fetch_assoc($business_results)) {
    $currentBusiness = $business_row['business'];
    $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

    echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

    $product_query = "SELECT tbl_product.*, tbl_supplier.company_name 
                      FROM tbl_product 
                      LEFT JOIN tbl_supplier ON tbl_supplier.id = tbl_product.supplier_id 
                      WHERE business = '$currentBusiness' 
                      ORDER BY name ASC";
    $product_results = mysqli_query($conn, $product_query);

    $sn = 1;
    $businessTotalProducts = 0;
    $businessTotalMinStock = 0;
    $businessTotalValue = 0;
    $businessTotalStock = 0;
    $businessTotalCost = 0;

    echo '<table class="table">
            <thead class="thead-dark">
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">S.N</th>
                    <th style="text-align: center;">Product Name</th>
                    <th style="text-align: center;">Brand</th>
                    <th style="text-align: center;">Auto Purchase Price</th>
                    <th style="text-align: center;">Auto Selling Price</th>
                    <th style="text-align: center;">Min. Stock</th>
                    <th style="text-align: center;">Stock Qty</th>
                    <th style="text-align: right;">Total Cost</th>
                    <th style="text-align: center;">Purchase Mode</th>
                    <th style="text-align: center;">Supplier</th>
                    <th style="text-align: center;"></th>
                </tr>
            </thead>
            <tbody>';

    if (mysqli_num_rows($product_results) > 0) {
        while ($row = mysqli_fetch_assoc($product_results)) {
            $rowTotal = $row['stock_qty'] * $row['auto_purchase_price'];
            $businessTotalProducts += 1;
            $businessTotalMinStock += $row['min_stock'];
            $businessTotalValue += $row['min_stock'] * $row['auto_purchase_price'];
            $businessTotalCost += $rowTotal;
            $businessTotalStock += $row['stock_qty'];

            $grandrowTotal = $row['stock_qty'] * $row['auto_purchase_price'];
            $grandTotalProducts += 1;
            $grandTotalMinStock += $row['min_stock'];
            $grandTotalValue += $row['min_stock'] * $row['auto_purchase_price'];
            $grandTotalCost += $grandrowTotal;
            $grandTotalStock += $row['stock_qty'];

            $formatted_price = number_format($row['auto_purchase_price']);
            $formatted_selling_price = number_format($row['auto_selling_price']);
            $formatted_row_total = number_format($rowTotal);
            $company_name_short = explode(" ", $row['company_name'])[0];

            echo <<<HTML
                <tr>
                    <td class="product_id">{$row["id"]}</td>
                    <td class="text-center">{$sn}.</td>
                    <td class="text-start product_name">{$row["name"]}</td>
                    <td class="text-start brand">{$row["brand"]}</td>
                    <td class="text-end text-success">$formatted_price</td>
                    <td class="text-end" style="color: #6C3BAA;">$formatted_selling_price</td>
                    <td class="text-center text-danger" style="color: red;">{$row['min_stock']}</td>
                    <td class="text-center text-primary" style="color: #0000FF;">{$row['stock_qty']}</td>
                    <td class="text-end text-dark">$formatted_row_total</td>
                    <td class="purchase_mode text-center">{$row["purchase_mode"]}</td>
                    <td class="company_name text-center">{$company_name_short}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-info edit_product_btn btn-sm" title="Edit">
                            <i class="bi bi-pen"></i>
                        </a>
                    </td>
                </tr>
            HTML;

            $sn++;
        }
      } else {
        echo "<tr><td colspan='12' class='text-center'>No products found for $businessName</td></tr>";
    }

        // Show total for this business
        echo "<tr>
                <td colspan='7'><b>Total:</b></td>
                <td style='text-align: center; color: #0000FF;'>" . number_format($businessTotalStock) . "</td>
                <td style='text-align: right; color: red;'>" . number_format($businessTotalCost) . "</td>
                <td colspan='3'></td>
              </tr>";

    echo '</tbody></table>';

    // Store business total
    $businessTotals[] = [
        'business' => $businessName,
        'products' => $businessTotalProducts,
        'min_stock' => $businessTotalMinStock,
        'value' => $businessTotalValue,
        'stock' => $businessTotalStock,
        'cost' => $businessTotalCost
    ];
}

// Grand Total Summary Table
echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>Grand Total Summary</h2>";

echo '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="text-align: center;">Business</th>
                <th scope="col" style="text-align: center;">Total Products</th>
                <th scope="col" style="text-align: center;">Total Min. Stock</th>
                <th scope="col" style="text-align: center;">Total Stock Value</th>
                <th scope="col" style="text-align: center;">Total Stock Qty</th>
                <th scope="col" style="text-align: center;">Total Stock Cost</th>
            </tr>
        </thead>
        <tbody>';

foreach ($businessTotals as $summary) {
    echo "<tr>
            <td style='text-align: left;'>{$summary['business']}</td>
            <td style='text-align: center;'>" . number_format($summary['products']) . "</td>
            <td style='text-align: center; color: red;'>" . number_format($summary['min_stock']) . "</td>
            <td class='text-end text-success'>" . number_format($summary['value']) . "</td>
            <td style='text-align: center; color: #0000FF;'>" . number_format($summary['stock']) . "</td>
            <td style='text-align: right; color: red;'>" . number_format($summary['cost']) . "</td>
          </tr>";
}

echo "<tr>
        <td style='text-align: left;'><strong>GRAND TOTAL</strong></td>
        <td style='text-align: center;'>" . number_format($grandTotalProducts) . "</td>
        <td style='text-align: center; color: red;'>" . number_format($grandTotalMinStock) . "</td>
        <td class='text-end text-success'>" . number_format($grandTotalValue) . "</td>
        <td style='text-align: center; color: #0000FF;'>" . number_format($grandTotalStock) . "</td>
        <td style='text-align: right; color: red;'>" . number_format($grandTotalCost) . "</td>
      </tr>";

echo '</tbody></table>';
?>

        </div>
      </div>

                     <!--<tr>
              
                          <td colspan="7"><b>Total:</b></td>
                          <td style="color: #0000FF;"><?php echo number_format($totalStock); ?></td>
                          <td style="color: red; text-align: right;"><?php echo number_format($totalCost); ?></td>  Display total cost for all rows 
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                  
                        
                      </tbody>
                </table>-->
                
                                                                             
              </div><!------------------end view data---------------------------->

                <div id="category-form">
                
                
                <div class="modal fade" aria-hidden="true">

                      <!-- Edit Product Modal -->
                    
                              <!-- <form method="POST" action="#" onsubmit="return validateEditBrand()"> -->
                                    <!-- <div class="mb-3"> -->
                                      <select class="form-select" name="business" id="edit_business_select_product" required>
                                        <!-- <option selected="selected" disabled value="">Choose Business</option> -->
                                        
                                      </select>
                                                                
                    </div>
                    <!-- End Modal--->

                    <!-----------------------Edit data Product form to database------------------------------------->


                    <!-----------------------Delete data Product form from database------------------------------------->

                    <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteproductmodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deletecategorymodal">Delete Product</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="delete_product_id" id="delete_product_id">
                                <h5>Are you sure you want to delete this data?</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deleteproductmodal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_product">Yes, Delete</button>
                                
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-----------------------Delete data Product form from database------------------------------------->
   </div>
               

                


        
        
      </section>

      

  </main><!-- End #main -->

<!-- ======= Footer ======= -->
<!--<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Aquashine</span></strong>. All Rights Reserved 2023
    </div>
</footer><!-- End Footer -->

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

<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="js/product-edit.js"></script>
<script src="js/main.js"></script>


</body>
</html>

