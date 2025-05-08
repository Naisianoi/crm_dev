<?php include('partials/navbar.php');
      include('add_item.php');
      include('edit_item.php');
      include('delete_item.php');
      include('fetch_data_item.php');

?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:30px;">
              
              
            <div class="tab-content" id="search">

             

              <div id="product" class="tab-pane in active">
              <h1 style="padding-top: 0px;">ITEM</h1>

              <!-- <div class="d-flex align-items-center">
                  <div class="search-bar">
                  <div class="row"> -->
                   <!--    <div class="col-3">
                          <form action="<?php echo SITEURL; ?>/business-search-item.php" method="POST" class="search-form d-flex align-items-center" id="business-search-form">
                              
                              <select class="form-select business" name="business" onchange="submitForm()">
                                <option selected="selected" disabled value="">Business</option>
                                <?php

                                      

                                      
                                      $query1 = "SELECT * FROM tbl_business ORDER BY business ASC";
                                      $result1 = mysqli_query($conn, $query1);

                                      // Populate options
                                      while ($row1 = mysqli_fetch_assoc($result1)) {
                                        echo '<option value="' . $row1['business'] . '">' . $row1['business'] . '</option>';
                                        
                                      }

                                ?>
                              </select>
                          
                          </form>  -->
                          <!----------search business--------------------->

                      <!-- </div>  -->
                      
                     <!--  <div class="col-5">
                          <form action="<?php echo SITEURL; ?>/category-search-item.php" method="POST" class="search-form d-flex align-items-center" id="category-search-form">
                              
                              <select class="form-select category" name="category" onchange="submitForm2()">
                                <option selected="selected" disabled value="">Category</option>
                                <?php

                                      

                                      // Fetch data from database
                                      $query1 = "SELECT * FROM tbl_category ORDER BY category ASC";
                                      $result1 = mysqli_query($conn, $query1);

                                      // Populate options
                                      while ($row1 = mysqli_fetch_assoc($result1)) {
                                        echo '<option value="' . $row1['category'] . '">' . $row1['category'] . '</option>';
                                        
                                      }

                                      // Close connection
                                        //mysqli_close($conn);
                                ?>
                              </select>
                          
                          </form> -->
                          <!----------search category--------------------->

                      <!-- </div>  -->

                      <!-- <div class="col-4">
                          <form action="<?php echo SITEURL; ?>/subcategory-search-item.php" method="POST" class="search-form d-flex align-items-center" id="subcategory-search-form">
                              
                              <select class="form-select subcategory" name="subcategory" onchange="submitForm3()">
                                <option selected="selected" disabled value="">Sub-Category</option>
                                <?php

                                      

                                      // Fetch data from database
                                      $query1 = "SELECT * FROM tbl_subcategory ORDER BY subcategory ASC";
                                      $result1 = mysqli_query($conn, $query1);

                                      // Populate options
                                      while ($row1 = mysqli_fetch_assoc($result1)) {
                                        echo '<option value="' . $row1['subcategory'] . '">' . $row1['subcategory'] . '</option>';
                                        
                                      }

                                      // Close connection
                                        //mysqli_close($conn);
                                ?>
                              </select>
                          
                          </form> -->
                          <!----------search customer type--------------------->
                      <!-- </div> -->
              
                      

                      

                   <!-- </div>
                </div> -->

                <div class="d-flex align-items-center">
                    <div class="ms-auto">
                        <div class="row">
                            
                            <div class="col">
                                <a href="item-search-page.php" class="btn btn-info form-control" title="Search"><i class="bi bi-search"></i></a>
                            </div>
                            <div class="col">
                                <a href="add-item-page.php" class="btn btn-info form-control">Add</a>
                            </div>
                        </div>
                    </div>
                </div>

              

                <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="text-align: center;">S.N</th>
                          <th scope="col" style="text-align: center;">Business</th>
                          <th scope="col" style="text-align: center;">Category</th>
                          <th scope="col" style="text-align: center;">Sub-Category</th>
                          <th scope="col" style="text-align: center;">Brand</th>
                          <th scope="col" style="text-align: center;">Item Name</th>
                          <!--<th scope="col" style="text-align: right;">Purchase Price</th>-->
                          <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                          <!--<th scope="col" style="text-align: right;">Selling Price</th>-->
                          <th scope="col" style="text-align: center;">Auto Selling Price</th>
                          <th scope="col" style="text-align: center;">Min. Stock</th>
                          <th scope="col" style="text-align: center;">Stock Qty</th>
                          <th scope="col" style="text-align: right;">Total Cost</th>
                          <th scope="col" style="text-align: center;">Purchase Mode</th>
                          <th scope="col" style="text-align: center;">Supplier</th>
                          <th scope="col" style="text-align: center;"></th>
                          <th scope="col" style="text-align: center;"></th>
                        </tr>
                      </thead>
                      <tbody>


                      <?php
                      
                      $totalCost = 0;
                    
                      if(mysqli_num_rows( $query_run) > 0)
                      {  

                        while($row = mysqli_fetch_array($query_run)){
                            $totalCostForRow = $row["stock_qty"] * $row["auto_purchase_price"]; // Calculate total cost for the row
                            $totalCost += $totalCostForRow; // Add to the total cost
                          ?>  
                          <tr> 
                              
                          
                              <td class="item_id" style="display:none;"><?php echo $row["id"]; ?></td>
                              <td style="text-align: center;"><?php echo $sn++; ?>.</td>
                              
                              <td class="business"><?php echo $row["business"]; ?></td>
                              <td class="category"><?php echo $row["category"]; ?></td>
                              <td class="subcategory"><?php echo $row["subcategory"]; ?></td>
                              <td class="brand"><?php echo $row["brand"]; ?></td>
                              <td class="item_name"><?php echo $row["item_name"]; ?></td>
                              <!--<td class="price" style="text-align: right;"><?php //echo number_format($row["price"]); ?></td>--> 
                              <td class="price" style="text-align: right; color: green;"><?php echo number_format($row["auto_purchase_price"]); ?></td> 
                              <!--<td class="price" style="text-align: right;"><?php //echo $row["selling_price"]; ?></td>-->
                              <td class="price" style="text-align: right; color: #6C3BAA;"><?php echo number_format($row["auto_selling_price"]); ?></td> 
                              <!--<td class="price" style="color: red;"><?php //echo $row["min_stock"]; ?></td>-->
                              <td class="price" style="color: red; text-align: center;"><?php echo $row["min_stock"]; ?></td> 
                              <td class="price" style="color: #0000FF; text-align: center;"><?php echo $row["stock_qty"]; ?></td>
                              <td style="text-align: right;"><?php echo number_format($totalCostForRow); ?></td> 
                              <td class="price"><?php echo $row["purchase_mode"]; ?></td> 
                              <td class="price"><?php $row["company_name"]; 
                                                      $name = explode(" ", $row['company_name']);
                                                      $company_name = $name[0];
                                                      echo $company_name?></td> 
                               
                              <td id="table-data">
                                
                              <a href="#" class="btn btn-info edit_item_btn btn-sm col-xs-2" title="Edit"><i class="bi bi-pen"></i></a> 
                                  
                              
                              </td>
                                                                                
                          </tr> 
                          <?php
                        }
                      }
                      
                      else {
                        echo "<h5>No Record Found</h5>";
                      }
                    

                         
                      ?> 
                      
                      <tr>
              
                          <td colspan="9"><b>Total:</b></td>
                          <td style="color: #0000FF;"><?php echo number_format($totalStock); ?></td>
                          <td style="color: red; text-align: right;"><?php echo number_format($totalCost); ?></td> <!-- Display total cost for all rows -->
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                          
                        
                      </tbody>
                </table>
                
                                                                             
              </div><!------------------end view data---------------------------->

                <div id="category-form">
                      
                <div class="modal fade" aria-hidden="true">
                    <select class="form-select" name="business" id="edit_business_select_item" required>
                    </select>
                </div>
                        
                    <!-----------------------Delete data Item form from database------------------------------------->

                    <div class="modal fade" id="deleteitemmodal" tabindex="-1" role="dialog" aria-labelledby="deleteproductmodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deletecategorymodal">Delete Item</h5>
                            
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="delete_item_id" id="delete_item_id">
                                <h5>Are you sure you want to delete this data?</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deleteitemmodal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_item">Yes, Delete</button>
                                
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-----------------------Delete data Item form from database------------------------------------->
   </div>
               

                


        
        
      </section>

      

  </main><!-- End #main -->

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

<script src="js/item-add.js"></script>
<script src="js/item-edit.js"></script>
<script src="js/main.js"></script>


</body>
</html>

