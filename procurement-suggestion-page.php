<?php include('partials/navbar.php');
      include('fetch_data_procurement_suggestion.php');
      include('fetch_data_product.php');
      include('fetch_data_item.php');
      // include('generate-spreadsheet.php');
      
?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content" id="search">

             

              <div id="product" class="tab-pane in active">
              <h1 style="padding-top: 0px;">Procurement Suggestion</h1>

              

              <?php

                                        
                  // Define the function to process stock summary
                  function processStockSummary($results) {
                    $stock_summary = [];

                    while ($row = mysqli_fetch_assoc($results)) {
                        $purchase_mode = $row['purchase_mode'];
                        $supplier_name = $row['company_name'];

                        if (!isset($stock_summary[$purchase_mode])) {
                            $stock_summary[$purchase_mode] = [];
                        }

                        if (!isset($stock_summary[$purchase_mode][$supplier_name])) {
                            $stock_summary[$purchase_mode][$supplier_name] = [];
                        }

                        $stock_summary[$purchase_mode][$supplier_name][] = $row;
                    }

                    return $stock_summary;
                  }

                                        // Process stock summary for Products
                  $stock_summary_product = processStockSummary($product_results);

                  // Process stock summary for Items
                  $stock_summary_item = processStockSummary($item_results);

                      $stock_summary_combined = [];

                    foreach ($stock_summary_product as $product_purchase_mode => $product_purchase_mode_groups) {
                        foreach ($product_purchase_mode_groups as $product_supplier_name => $product_supplier_groups) {
                            $stock_summary_combined[$product_purchase_mode][$product_supplier_name]['products'] = $product_supplier_groups;
                        }
                    }

                    foreach ($stock_summary_item as $item_purchase_mode => $item_purchase_mode_groups) {
                        foreach ($item_purchase_mode_groups as $item_supplier_name => $item_supplier_groups) {
                            if (!isset($stock_summary_combined[$item_purchase_mode][$item_supplier_name])) {
                                $stock_summary_combined[$item_purchase_mode][$item_supplier_name] = [];
                            }

                            $stock_summary_combined[$item_purchase_mode][$item_supplier_name]['items'] = $item_supplier_groups;
                        }
                    }

                    // Display the combined stock summary table if either products or items are present
                    if (!empty($stock_summary_combined)) {
                        echo '<table style="width: 100%; font-size: 13px;">'; // Adjust the font size as needed

                        foreach ($stock_summary_combined as $combined_purchase_mode => $combined_purchase_mode_groups) {
                            if (empty($combined_purchase_mode)) {
                                continue;
                            }

                            // Your existing code for displaying stock summary
                            echo '<tr>';
                            echo '<td colspan="7" style="font-size: 15px;"><strong>PURCHASE MODE: <span style="color: #0d6efd;">' . $combined_purchase_mode . '</span></strong></td>';
                            echo '</tr>';

                            foreach ($combined_purchase_mode_groups as $combined_supplier_name => $combined_data) {
                                echo '<tr>';
                                echo '<td colspan="7" style="font-size: 15px;"><strong>COMPANY NAME: ' . $combined_supplier_name . '</strong></td>';
                                echo '</tr>';

                              

                                // Display Products
                                if (!empty($combined_data['products'])) {
                                    echo '<tr>';
                                    echo '<th style="width: 2%; text-align: center;"><strong>sn</strong></th>';
                                    echo '<th style="width: 20%; text-align: center;"><strong>Product</strong></th>';
                                    echo '<th style="width: 10%; text-align: center;"><strong>Stock Qty</strong></th>';
                                    echo '<th style="width: 10%; text-align: center;"><strong>Min. Stock</strong></th>';
                                    echo '<th style="width: 15%; text-align: center;"><strong>Purchase Price</strong></th>';
                                    echo '<th style="width: 15%; text-align: center;"><strong>Auto Purchase Price</strong></th>';
                                    // Add more columns as needed
                                    echo '</tr>';

                                    // Display Products if available
                                    $counter = 1;
                                    foreach ($combined_data['products'] as $row) {
                                        echo '<tr>';
                                        echo '<td style="text-align: center;">' . $counter++ . '.</td>';
                                        echo '<td>' . $row['name'] . '</td>';
                                        echo '<td style="text-align: center;">' . $row['stock_qty'] . '</td>';
                                        echo '<td style="text-align: center;">' . $row['min_stock'] . '</td>';
                                        echo '<td style="text-align: right;">' . $row['price'] . '</td>';
                                        echo '<td style="text-align: right; color: green;">' . $row['auto_purchase_price'] . '</td>';
                                        // Add more columns as needed
                                        echo '</tr>';
                      
                                    }

                                    
                                    // Add line break
                                    echo '<tr><td colspan="7"><br></td></tr>';
                                }

                                // Display Items
                                if (!empty($combined_data['items'])) {
                                    echo '<tr>';
                                    echo '<th style="width: 2%; text-align: center;" ><strong>sn</strong></th>';
                                    echo '<th style="width: 20%; text-align: center;"><strong>Item</strong></th>';
                                    echo '<th style="width: 10%; text-align: center;"><strong>Stock Qty</strong></th>';
                                    echo '<th style="width: 10%; text-align: center;"><strong>Min. Stock</strong></th>';
                                    echo '<th style="width: 15%; text-align: center;"><strong>Purchase Price</strong></th>';
                                    echo '<th style="width: 15%; text-align: center;"><strong>Auto Purchase Price</strong></th>';
                                    // Add more columns as needed
                                    echo '</tr>';

                                    // Display Products if available
                                    $counter = 1;
                                    foreach ($combined_data['items'] as $row) {
                                        echo '<tr>';
                                        echo '<td style="text-align: center;">' . $counter++ . '.</td>';
                                        echo '<td>' . $row['item_name'] . '</td>';
                                        echo '<td style="text-align: center;">' . $row['stock_qty'] . '</td>';
                                        echo '<td style="text-align: center;">' . $row['min_stock'] . '</td>';
                                        echo '<td style="text-align: right;">' . $row['price'] . '</td>';
                                        echo '<td style="text-align: right; color: green;">' . $row['auto_purchase_price'] . '</td>';
                                        // Add more columns as needed
                                        echo '</tr>';
                                    }
                                }

                                // Add horizontal line
                                echo '<tr><td colspan="7"><hr></td></tr>';
                            }
                        }

                        echo '</table>';
                    } else {
                        echo '<p>No data available.</p>';
                    }



              ?>
                  <!-- HTML form to trigger Excel generation -->
                  <!-- HTML form to trigger Excel generation -->
                  <!-- <form action="generate-spreadsheet.php" method="post" enctype="multipart/form-data">
                      <button type="submit" name="generate">Generate Excel</button>
                  </form> -->


                  <?php
                  // include('procurement-suggestion-page.php');



                  ?>

  
                
                                                                             
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


<script src="js/main.js"></script>


</body>
</html>

