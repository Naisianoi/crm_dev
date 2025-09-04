<?php include('partials/navbar.php');
      include('price_list_queries.php');
      include('fetch_data_price_list.php');
?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->
<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px; padding-right:30px;">
      <div class="tab-content" id="search">
        <div class="tab-pane in active">
          <h1 style="padding-top: 0px;">PRICE LIST</h1>
          <div class="d-flex align-items-center">
            <h2 style="padding-top: 0px;">Products</h2>
            <div class="ms-auto">
              <a href="pdf_price_list.php?ACTION=VIEW" id="btn-pdf-price-list" class="btn btn-info" target="_blank">Create PDF</a>
              <a href="#" id="btn-execute-queries" class="btn btn-info">Update</a>
            </div>
          </div>

          <?php
          // Fetch all businesses and their full names
          $business_query = "SELECT DISTINCT business FROM tbl_product";
          $business_results = mysqli_query($conn, $business_query);

          $full_names_query = "SELECT business, business_name FROM tbl_business";
          $full_names_results = mysqli_query($conn, $full_names_query);

          $businessNames = [];
          while ($row = mysqli_fetch_assoc($full_names_results)) {
              $short = $row['business'];
              $full = $row['business_name'];
              $businessNames[$short] = "$full ($short)";
          }

          // Store all business codes to reuse later for items section
          $business_codes = [];
          while ($business_row = mysqli_fetch_assoc($business_results)) {
              $currentBusiness = $business_row['business'];
              $business_codes[] = $currentBusiness;
              $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

              echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

              $product_query = "SELECT tbl_product.*, tbl_supplier.company_name 
                                FROM tbl_product 
                                LEFT JOIN tbl_supplier ON tbl_supplier.id = tbl_product.supplier_id 
                                WHERE business = '$currentBusiness' 
                                ORDER BY name ASC";
              $query_run_product = mysqli_query($conn, $product_query);

              echo '<table class="table">
                      <thead class="thead-dark">
                          <tr>
                              <th scope="col" style="text-align: center;">S.N</th>
                              <th scope="col" style="text-align: center;">Product Name</th>
                              <th scope="col" style="text-align: center;">Brand</th>
                              <th scope="col" style="text-align: center;">Purchase Mode</th>
                              <th scope="col" style="text-align: center;">Supplier Company Name</th>
                              <th scope="col" style="text-align: center;">INR Purchase Price</th>
                              <th scope="col" style="text-align: center;" class="weight-column">Weight</th>
                              <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                              <th scope="col" style="text-align: center;" class="weight-column">Margin</th>
                              <th scope="col" style="text-align: center;">Auto Selling Price</th>
                              <th scope="col" style="text-align: center;">Price List Price</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>';

              $sn = 1;
              if (mysqli_num_rows($query_run_product) > 0) {

                echo '<tr>
                            <td class="product_id" style="display:none;"></td>
                            
                                <td class="price" style="display:none;">
                                    <button class="btn btn-info update-btn-product btn-sm">Update</button>
                                </td>                                
                        </tr>';
                        
                  while ($row = mysqli_fetch_assoc($query_run_product)) {
                      $company_name = explode(" ", $row['company_name'])[0];
                      echo '<tr>
                              <td class="product_id" style="display:none;">' . $row["id"] . '</td>
                              <td style="text-align: center;">' . $sn++ . '</td>
                              <td>' . $row["name"] . '</td>
                              <td>' . $row["brand"] . '</td>
                              <td>' . $row["purchase_mode"] . '</td>
                              <td>' . $company_name . '</td>
                              <td style="text-align: right;">' . $row["INR_purchase_price"] . '</td>
                              <td class="weight-column" style="text-align: center;">' . $row["weight"] . '</td>
                              <td style="text-align: right; color: green;">' . number_format($row["auto_purchase_price"], 2) . '</td>
                              <td class="weight-column" style="text-align: center;">' . $row["margin"] . '</td>
                              <td style="text-align: right; color: #6C3BAA;">' . number_format($row["auto_selling_price"], 2) . '</td>
                              <td style="text-align: right; color: #6C3BAA;">' . number_format($row["price_list_price"], 2) . '</td>
                              <td id="table-data"><a href="#" class="btn btn-info edit_product_btn btn-sm col-xs-2" title="Edit Product"><i class="bi bi-pen"></i></a></td>
                          </tr>';
                  }
              } else {
                  echo '<tr><td colspan="13" class="text-center">No Record Found</td></tr>';
              }

              echo '</tbody></table>';
          }

          // ITEM SECTION
          echo "<h1 style='padding-top: 40px;'>PRICE LIST</h1>";
          echo "<h2 style='padding-top: 0px;'>Items</h2>";

          foreach ($business_codes as $currentBusiness) {
              $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;
              echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

              echo '<table class="table">
                      <thead class="thead-dark">
                          <tr>
                              <th scope="col" style="text-align: center;">S.N</th>
                              <th scope="col" style="text-align: center;">Item Name</th>
                              <th scope="col" style="text-align: center;">Brand</th>
                              <th scope="col" style="text-align: center;">Purchase Mode</th>
                              <th scope="col" style="text-align: center;">Supplier Company Name</th>
                              <th scope="col" style="text-align: center;">INR Purchase Price</th>
                              <th scope="col" style="text-align: center;" class="weight-column">Weight</th>
                              <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                              <th scope="col" style="text-align: center;" class="weight-column">Margin</th>
                              <th scope="col" style="text-align: center;">Auto Selling Price</th>
                              <th scope="col" style="text-align: center;">Price List Price</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>';

              $category_query = "SELECT DISTINCT category FROM tbl_item WHERE business = '$currentBusiness' ORDER BY category ASC";
              $category_results = mysqli_query($conn, $category_query);
              $sn = 1;

              while ($category_row = mysqli_fetch_assoc($category_results)) {
                  $currentCategory = $category_row['category'];
                  $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE category = '$currentCategory' AND business = '$currentBusiness' ORDER BY sub_category ASC";
                  $sub_category_results = mysqli_query($conn, $sub_category_query);

                  while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
                      $currentSubCategory = $sub_category_row['sub_category'];
                      echo '<tr><td colspan="14" style="font-size:18px;">
                              <strong style="color: #1997D4;">' . htmlspecialchars($currentCategory) . '</strong>: 
                              <span style="color: green;">' . htmlspecialchars($currentSubCategory) . '</span>
                            </td></tr>';

                      $item_query = "SELECT tbl_item.*, tbl_supplier.company_name 
                                     FROM tbl_item 
                                     INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_item.supplier_id 
                                     WHERE category = '$currentCategory' AND sub_category = '$currentSubCategory' AND business = '$currentBusiness' 
                                     ORDER BY item_name ASC";
                      $query_run_item = mysqli_query($conn, $item_query);

                      if (mysqli_num_rows($query_run_item) > 0) {
                          while ($row = mysqli_fetch_assoc($query_run_item)) {
                              $company_name = explode(" ", $row['company_name'])[0];
                              echo '<tr>
                                      <td class="item_id" style="display:none;">' . $row["id"] . '</td>
                                      <td style="text-align: center;">' . $sn++ . '</td>
                                      <td>' . $row["item_name"] . '</td>
                                      <td>' . $row["brand"] . '</td>
                                      <td>' . $row["purchase_mode"] . '</td>
                                      <td>' . $company_name . '</td>
                                      <td style="text-align: right;">' . $row["INR_purchase_price"] . '</td>
                                      <td class="weight-column" style="text-align: center;">' . $row["weight"] . '</td>
                                      <td style="text-align: right; color: green;">' . number_format($row["auto_purchase_price"], 2) . '</td>
                                      <td class="weight-column" style="text-align: center;">' . $row["margin"] . '</td>
                                      <td style="text-align: right; color: #6C3BAA;">' . number_format($row["auto_selling_price"], 2) . '</td>
                                      <td style="text-align: right; color: #6C3BAA;">' . number_format($row["price_list_price"], 2) . '</td>
                                      <td><a href="#" class="btn btn-info edit_item_btn btn-sm col-xs-2" title="Edit Item"><i class="bi bi-pen"></i></a></td>
                                    </tr>';
                          }
                      } else {
                          echo '<tr><td colspan="15"><h5>No Record Found</h5></td></tr>';
                      }
                  }
              }

              echo '</tbody></table>';
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- ======= Footer ======= -->
<!--<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Aquashine</span></strong>. All Rights Reserved 2023
    </div>
</footer> End Footer -->

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

<script src="js/price-list.js"></script>
<script src="js/purchase-price.js"></script>
<!-- <script src="js/item-edit.js"></script> -->
<script src="js/main.js"></script>


</body>
</html>

