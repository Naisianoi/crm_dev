<?php include('partials/navbar.php');
        include('edit_stock_correction.php');
        include('edit_stock_correction_product.php');
        

    ?>

    <!-----------------------------------RIGHT TAB-------------------------------------------------------------->

    <main id="main" class="main" style="margin-bottom: 0px;">
        <section>
            <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:30px;">
                
                
                <div class="tab-content" id="search">

                

                <div id="product" class="tab-pane in active">
                <h1 style="padding-top: 0px;">STOCK VIEW</h1>
                

                
                    <div class="d-flex align-items-center">
                    <h2 style="padding-top: 0px;">Item</h2>
                        <div class="ms-auto">
                            <div class="row">
                
                                <!-- <div class="col">
                                    <a  class="btn btn-info form-control" href="pdf_stock_correction.php?ACTION=VIEW" target="_blank">PDF For Stock Taking</a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    
                            <!-- <div class="ms-auto">
                                <a href="add-item-page.php" id="btn" class="btn btn-info">Add</a>
                                <a href="item-search-page.php" id="btn" class="btn btn-info"><i class="bi bi-search"></i></a>
                            </div> -->
                <!-- </div><br> -->
                <?php

                // Quantity Calculation Query with the work done date
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

                // $result_items = mysqli_query($conn, $query_items);
                $result_counts = mysqli_query($conn, $query_check_months);

                $count_data = [];
                while ($row = mysqli_fetch_assoc($result_counts)) {
                    $count_data[$row['item_id']] = $row;
                }

                ?>
                
                

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col" style="text-align: center;">S.N</th>
                            <th scope="col" style="text-align: center;">Sub-Category</th>
                            <th scope="col" style="text-align: center;">Category</th>
                            <th scope="col" style="text-align: center;">Item Name</th>
                            <!-- <th scope="col">Selling Price</th> -->
                            <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                            <th scope="col" style="text-align: center;">Pur. Price Dt.</th>
                            <th scope="col" style="text-align: center;">Stock Qty</th>
                            <th scope="col" style="text-align: center;">Min. Stock</th>
                            <th style="text-align: center;">1 Month</th>
                            <th style="text-align: center;">3 Months</th>
                            <th style="text-align: center;">6 Months</th>
                            <th scope="col"></th>
                           
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                            

        
                        if(mysqli_num_rows( $query_run) > 0)
                        {  

                            while($row = mysqli_fetch_array($query_run)){
                                $item_id = $row['id'];
                                $count_1_month = isset($count_data[$item_id]['count_1_month']) ? $count_data[$item_id]['count_1_month'] : 0;
                                $count_3_month = isset($count_data[$item_id]['count_3_month']) ? $count_data[$item_id]['count_3_month'] : 0;
                                $count_6_month = isset($count_data[$item_id]['count_6_month']) ? $count_data[$item_id]['count_6_month'] : 0;
                            ?>  
                            <tr> 
                                
                                
                                <td class="item_id" style="display:none;"><?php echo $row["id"]; ?></td>
                                <td style="text-align: center;"><?php echo $sn++; ?>.</td>
                                
        
                                <td class="sub_category"><?php echo $row["subcategory"]; ?></td>
                                <td class="category"><?php echo $row["category"]; ?></td>
                                
                                
                                <td class="item_name"><?php echo $row["item_name"]; ?></td>
                                <!-- <td class="item_name"><?php echo $row["selling_price"]; ?></td> -->
                                <td class="item_name" style="text-align: right; color: green;"><?php echo number_format($row["auto_purchase_price"],2); ?></td>
                                <td class="item_name"><?php echo $row["purchase_price_date"]; ?></td>
                                 
                                <td class="price" style="text-align: center; color: #0000FF;"><?php echo $row["stock_qty"]; ?></td> 
                                <td class="price" style="text-align: center; color: red;"><?php echo $row["min_stock"]; ?></td>
                                <td style="text-align: center;"><?php echo $count_1_month; ?></td>
                                <td style="text-align: center;"><?php echo $count_3_month; ?></td>
                                <td style="text-align: center;"><?php echo $count_6_month; ?></td>
                               
        
                                <!-- <td><a href="#" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>   -->
                                <!-- <td><a href="pdf_stock_movement_item.php?id=<?php echo $row['id']; ?>&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-arrow-left-right"></i></a></td> -->
                                <td><a href="stock-view-item-date-page.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm col-xs-2" title="Stock View"><i class="bi bi-arrow-left-right"></i></a></td>
                                
                               
                                                                                    
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

                    <!-- Add an "Update All" button at the top or bottom of your table -->
                    

                    
                    
                    <h2 style="padding-top: 0px;">Product</h2>
                        <?php
                        // Quantity Calculation Query with the work done date 
                            $query_check_months_product = "
                            SELECT 
                                sp.product_id,
                                COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_1_month,
                                COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_3_month,
                                COALESCE(SUM(CASE WHEN sp.work_done_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) THEN sp.product_quantity ELSE 0 END), 0) AS count_6_month
                            FROM 
                                tbl_service_jc_item sp
                            WHERE
                                sp.work_done_date IS NOT NULL
                            GROUP BY 
                                sp.product_id
                            ";

                            $result_counts = mysqli_query($conn, $query_check_months_product);

                            $count_data = [];
                            while ($row = mysqli_fetch_assoc($result_counts)) {
                            $count_data[$row['product_id']] = $row;
                            }
                            ?>
                            
                
                    
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          
                          <th scope="col" style="text-align: center;">S.N</th>
                        
                          <th scope="col" style="text-align: center;">Brand</th>
                          <th scope="col" style="text-align: center;">Product Name</th>  
                          <!-- <th scope="col">Selling Price</th> -->
                          <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                          <th scope="col" style="text-align: center;">Pur. Price Dt.</th>
                            <th scope="col" style="text-align: center;">Stock Qty</th>
                            <th scope="col" style="text-align: center;">Min. Stock</th>
                            <th style="text-align: center;">1 Month</th>
                            <th style="text-align: center;">3 Months</th>
                            <th style="text-align: center;">6 Months</th>
                            <th scope="col"></th>
                            
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>


                      <?php
                        
                      if(mysqli_num_rows( $query_run2) > 0)
                      {  

                        while($row = mysqli_fetch_array($query_run2)){
                                $product_id = $row['id'];
                                $count_1_month = isset($count_data[$product_id]['count_1_month']) ? $count_data[$product_id]['count_1_month'] : 0;
                                $count_3_month = isset($count_data[$product_id]['count_3_month']) ? $count_data[$product_id]['count_3_month'] : 0;
                                $count_6_month = isset($count_data[$product_id]['count_6_month']) ? $count_data[$product_id]['count_6_month'] : 0;
                          ?>  
                          <tr> 
                              
                              
                              <td class="product_id" style="display:none;"><?php echo $row["id"]; ?></td>
                              <td style="text-align: center;"><?php echo $n++; ?>.</td>
                              
                            
                              <td><?php echo $row["brand"]; ?></td>
                              <td><?php echo $row["name"]; ?></td>
                              <!-- <td><?php echo $row["selling_price"]; ?></td> -->
                              <td style="text-align: right; color: green;"><?php echo number_format($row["auto_purchase_price"],2); ?></td>
                              <td><?php echo $row["purchase_price_date"]; ?></td>
                              <td style="text-align: center; color: #0000FF;"><?php echo $row["stock_qty"]; ?></td>  
                              <td style="text-align: center; color: red;"><?php echo $row["min_stock"]; ?></td>  
                              <td style="text-align: center;"><?php echo $count_1_month; ?></td>
                              <td style="text-align: center;"><?php echo $count_3_month; ?></td>
                              <td style="text-align: center;"><?php echo $count_6_month; ?></td>
                              <!-- <td><a href="#" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>   -->
                              <td><a href="stock-view-product-date-page.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm col-xs-2" title="Stock View"><i class="bi bi-arrow-left-right"></i></a></td>
                                                                               
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
                
                    <!-- Add an "Update All" button for products -->
                    
            
        
                    
                                                                                
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

