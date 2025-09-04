<?php include('partials/navbar.php');
      include('edit_purchase_price_product.php');
      include('edit_purchase_price_item.php');
      include('fetch_data_purchase_price.php');

?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:30px;">
              
              
            <div class="tab-content" id="search">

             

              <div class="tab-pane in active">
              <h1 style="padding-top: 0px;">PURCHASE PRICE</h1>             
              

               
                <!-- Products -->

                <h2 style="padding-top: 0px;">Products</h2>
                
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="text-align: center;">S.N</th>
            <th scope="col" style="text-align: center;">Business</th>
            <th scope="col" style="text-align: center;">Brand</th>
            <th scope="col" style="text-align: center;">Product Name</th>
            <th scope="col" style="text-align: center;">Purchase Mode</th>
            <th scope="col" style="text-align: center;">Supplier</th>
            <th scope="col" style="text-align: center;">Purchase Price</th>
            <th scope="col" style="text-align: center;">Auto Purchase Price</th>
            <th scope="col" style="text-align: center;">Purchase Price Dt</th>
            <th scope="col" style="text-align: center;">Interval</th>
            <th scope="col" style="text-align: center;">Update Price</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

    <?php
                        
    if (mysqli_num_rows($query_run_product) > 0) {
        // Add an empty row before the product data
        ?>
        <tr>
            <td class="product_id" style="display:none;"></td>
            
                <td class="price" style="display:none;">
                    <button class="btn btn-info update-btn-product btn-sm">Update</button>
                </td>
        </tr>
        <?php

        while ($row = mysqli_fetch_array($query_run_product)) {
            ?>  
            <tr> 
                <td class="product_id" style="display:none;"><?php echo $row["id"]; ?></td>
                <td style="text-align: center;"><?php echo $p++; ?>.</td>
                <td><?php echo $row["business"]; ?></td>
                <td><?php echo $row["brand"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["purchase_mode"]; ?></td>  
                <td><?php $row["company_name"]; 
                          $name = explode(" ", $row['company_name']);
                          $company_name = $name[0];
                          echo $company_name?></td>
                <td style="text-align: right;"><?php echo $row["price"]; ?></td>
                <td style="text-align: right; color: green;"><?php echo number_format($row["auto_purchase_price"]); ?></td>  
                <td class="price"><?php echo $row["purchase_price_date"]; ?></td>  
                <td class="price" style="text-align: center;"><?php echo getDaysDifference($row["purchase_price_date"]); ?></td>
                <td class="price">
                    <input type="number" style="width:80px;" value="" class="form-control new-price" required>
                </td>
                <td class="price">
                    <button class="btn btn-info update-btn-product btn-sm" title="Update Price for Product">Update</button>
                </td>
            </tr> 
            <?php
        }
    } else {
        echo "<h5>No Record Found</h5>";
    }
    ?>  
                          
    </tbody>
</table>


                 <!-- Items -->

                <h1 style="padding-top: 0px;">PURCHASE PRICE</h1>             
                <h2 style="padding-top: 0px;">Items</h2>             

                <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="text-align: center;">S.N</th>
                          <th scope="col" style="text-align: center;">Business</th>
                          <th scope="col" style="text-align: center;">Category</th>
                          <th scope="col" style="text-align: center;">Sub-Category</th>
                          <th scope="col" style="text-align: center;">Brand</th>
                          <th scope="col" style="text-align: center;">Item Name</th>
                          
                          <th scope="col" style="text-align: center;">Purchase Mode</th>
                          <th scope="col" style="text-align: center;">Supplier</th>
                          <th scope="col" style="text-align: center;">Purchase Price</th>
                          <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                          <th scope="col" style="text-align: center;">Purchase Price Dt</th>
                          <th scope="col" style="text-align: center;">Interval</th>
                          <th scope="col" style="text-align: center;">Update Price</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>

                      


                      <?php
                        
                        
                      if(mysqli_num_rows( $query_run_item) > 0)
                      {  

                        while($row = mysqli_fetch_array($query_run_item)){
                          ?>  
                          <tr> 
                              
                              
                              <td class="item_id" style="display:none;"><?php echo $row["id"]; ?></td>
                              <td style="text-align: center;"><?php echo $sn++; ?>.</td>
                              
                              <td><?php echo $row["business"]; ?></td>
                              <td><?php echo $row["category"]; ?></td>
                              <td><?php echo $row["subcategory"]; ?></td>
                              <td><?php echo $row["brand"]; ?></td>
                              <td><?php echo $row["item_name"]; ?></td>
                              
                     
                              <td><?php echo $row["purchase_mode"]; ?></td> 
                              <td><?php $row["company_name"]; 
                                        $name = explode(" ", $row['company_name']);
                                        $company_name = $name[0];
                                        echo $company_name?></td> 
                              <td style="text-align: right;"><?php echo $row["price"]; ?></td>
                              <td style="text-align: right; color: green;"><?php echo number_format($row["auto_purchase_price"]); ?></td> 
                              <td class="price"><?php echo $row["purchase_price_date"]; ?></td>
                              <td class="price" style="text-align: center;"><?php echo getDaysDifference($row["purchase_price_date"]); ?></td> 

                              <td class="price">
                                <input type="number" class="form-control new-price" value="" required>
                              </td>
                              <td class="price">
                                <button class="btn btn-info update-btn btn-sm" title="Update Price for Item">Update</button>
                              </td>
                               
                              <td>
                                
                               
                                  
                              
                              </td>
                                                                                
                          </tr> 
                          <?php
                        }
                      }
                      
                      else {
                        echo "<h5>No Record Found</h5>";
                      }
                    

                         
                      ?>  
                          
                        
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

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="js/purchase-price.js"></script>
<script src="js/item-edit.js"></script>
<script src="js/main.js"></script>


</body>
</html>

