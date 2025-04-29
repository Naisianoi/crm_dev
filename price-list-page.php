<?php include('partials/navbar.php');
      include('price_list_queries.php');
      include('fetch_data_price_list.php');
?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:30px;">
              
              
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

               
                <!-- Products -->

                
                                
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Business</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Purchase Mode</th>
                            <th scope="col">Supplier</th>
                            <th scope="col" style="text-align: right;">INR Purchase Price</th>
                            <th scope="col" class="weight-column">Weight</th>
                            <th scope="col" style="text-align: right;">Auto Purchase Price</th>
                            <!--<th scope="col" class="weight-column" style="text-align: right;">Manual Purchase Price</th>-->
                            <th scope="col" class="weight-column">Margin</th>
                            <th scope="col" style="text-align: right;">Auto Selling Price</th>
                            <!--<th scope="col" style="text-align: right;">Manual Selling Price</th>-->                      
                            <th scope="col" style="text-align: right;">Price List Price</th>
                            <th scope="col"></th>                            
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
                                <td><?php echo $p++; ?>.</td>
                                <td><?php echo $row["business"]; ?></td>
                                <td><?php echo $row["brand"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["purchase_mode"]; ?></td>  
                                <td><?php $row["company_name"]; 
                                          $name = explode(" ", $row['company_name']);
                                          $company_name = $name[0];
                                          echo $company_name?></td>
                                <td style="text-align: right;"><?php echo $row["INR_purchase_price"] ?></td> 
                                <td class="weight-column" style="text-align: center;"><?php echo $row["weight"]; ?></td>                                   
                                <td style="text-align: right;"><?php echo number_format($row["auto_purchase_price"],2); ?></td> 
                                <!--<td class="weight-column" style="text-align: right;"><?php //echo number_format($row["price"]); ?></td>-->
                                <td class="weight-column" style="text-align: center;"><?php echo $row["margin"]; ?></td>
                                <td style="text-align: right;"><?php echo number_format($row["auto_selling_price"],2); ?></td>
                               <!-- <td style="text-align: right;"><?php //echo $row["selling_price"]; ?></td>-->
                                <td style="text-align: right;"><?php echo number_format($row["price_list_price"]); ?></td>
                                <td id="table-data"><a href="#" class="btn btn-info edit_product_btn btn-sm col-xs-2" title="Edit Product"><i class="bi bi-pen"></i></a></td>
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

                <h1 style="padding-top: 0px;">PRICE LIST</h1>             
                <h2 style="padding-top: 0px;">Items</h2>             

                <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">S.N</th>
                          <th scope="col">Business</th>
                          <th scope="col">Category</th>
                          <th scope="col">Sub-Category</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Item Name</th>                          
                          <th scope="col">Purchase Mode</th>
                          <th scope="col">Supplier</th>
                          <th scope="col" style="text-align: right;">INR Purchase Price</th>
                          <th scope="col" class="weight-column">Weight</th>
                          <th scope="col" style="text-align: right;">Auto Purchase Price</th>
                          <!--<th scope="col" class="weight-column" style="text-align: right;">Manual Purchase Price</th>-->
                          <th scope="col" class="weight-column">Margin</th>
                          <th scope="col" style="text-align: right;">Auto Selling Price</th>
                          <!--<th scope="col" style="text-align: right;">Manual Selling Price</th>-->                          
                          <th scope="col" style="text-align: right;">Price List Price</th>
                          <th scope="col"></th>                          
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
                              <td><?php echo $sn++; ?>.</td>                              
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
                              <td style="text-align: right;"><?php echo $row["INR_purchase_price"]; ?></td> 
                              <td class="weight-column" style="text-align: center;"><?php echo $row["weight"]; ?></td>                                
                              <td style="text-align: right;"><?php echo number_format($row["auto_purchase_price"],2); ?></td> 
                              <!--<td class="weight-column" style="text-align: right;"><?php //echo number_format($row["price"]); ?></td>-->
                              <td class="weight-column" style="text-align: center;"><?php echo $row["margin"]; ?></td>
                              <td style="text-align: right;"><?php echo number_format($row["auto_selling_price"],2); ?></td>
                              <!--<td style="text-align: right;"><?php //echo $row["selling_price"]; ?></td>-->   
                              <td style="text-align: right;"><?php echo number_format($row["price_list_price"]); ?></td>  
                               
                                
                              <td>
                                
                                <a href="#" class="btn btn-info edit_item_btn btn-sm col-xs-2" title="Edit Item"><i class="bi bi-pen"></i></a> 
                              
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

<script src="js/price-list.js"></script>
<script src="js/purchase-price.js"></script>
<!-- <script src="js/item-edit.js"></script> -->
<script src="js/main.js"></script>


</body>
</html>

