<?php include('partials/navbar.php');
      // include('add_product.php');
      include('edit-payment-jc.php');
      // include('delete_customer.php');
      // include('fetch_data_customer.php');

?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content">

              <!-- DASHBOARD PHP -->
              
              <!--- END DASHBOARD PHP---- -->
              
              <!-- BRAND PHP -->

              <div id="commerce" class="tab-pane in active">
              <h1>CLOSE JOBCARD</h1>
                    
                    <div class="row">        
                                  <div class="col-4">
                                      <div class="form-group">
                                          <p class="form-control-static"><b>JOB CARD #: </b><span name="id" id="id"><?php echo $jcId; ?></span></p>
                                          
                                      </div>
                                  </div>

                                  <div class="col">
                                      <div class="form-group">
                                          <p class="form-control-static"><b>Jobcard Create Date :</b><span><?php echo $jc_create_date; ?></span></p>
                                         
                                      </div>
                                  </div>

                                </div> 

                                <div class="row">        
                                
                                    <div class="col">
                                        <div class="mb-3">
                                            <p class="form-control-static">
                                            <b>Business:</b> <span name="business" id="business"><?php echo $business; ?></span>
                                            </p>
                                            
                                        </div>
                                    </div>

                                    <div class="col">
                                      <div class="mb-3">
                                          <p class="form-control-static">
                                              <b>Commerce:</b> <span name="commerce" id="commerce"><?php echo $commerce; ?></span>
                                          </p>
                                                                                  
                                      </div>
                                    </div>
                                    
                                    <div class="col">
                                      <div class="form-group">
                                          <p class="form-control-static">
                                          <b>Jobcard Lead By:</b> <span name="jc_lead_by" id="jc_lead_by"><?php echo $jc_lead_by; ?></span>
                                          
                                          </p>
                                          
                                      </div>
                                    </div>

                                </div> 

                                <div class="row">
                                      <div class="col-8">
                                          <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Customer Name:</b> <span name="customer_name" id="customer_name"><?php echo $customer_name; ?></span>
                                              </p>
                                              
                                          </div>
                                      </div>

                                      <div class="col"> 
                                        <div class="form-group">
                                            <p class="form-control-static">
                                            <b>Company Name:</b> <span name="company_name" id="company_name"><?php echo $company_name; ?></span>
                                            </p>
                                            
                                        </div>
                                      </div>
                                </div>

                                <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                          <b>Address:</b> <span name="address" id="address"><?php echo $address; ?></span>
                                          </p>
                                        </div>
                                      </div>
                                </div>

                                <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                          <b>Area:</b> <span name="area" id="area"><?php echo $area; ?></span>
                                          </p>
                                                
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                              <p class="form-control-static">
                                              <b>County:</b> <span name="county" id="county"><?php echo $county; ?></span>
                                              </p>
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                          <b>City:</b> <span name="city" id="city"><?php echo $city; ?></span>
                                          </p>
                                            
                                        </div>
                                      </div>
                                </div>

                                <div class="row">

                                      <div class="col">
                                        <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Contact Name:</b> <span name="contact_name_1" id="contact_name_1"><?php echo $contact_name_1; ?></span>
                                              </p>
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Contact Phone:</b> <span name="contact_number_1" id="contact_number_1"><?php echo $contact_number_1; ?></span>
                                              </p>
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                          <div class="form-group">
                                              
                                          <p class="form-control-static">
                                          <b>Customer Type:</b> <span name="customer_type" id="customer_type"><?php echo $customer_type; ?></span>
                                          </p>
                          
                                          </div>
                                      </div>


                                </div>

                                <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Contact Name 2:</b> <span name="contact_name_2" id="contact_name_2"><?php echo $contact_name_2; ?></span>
                                              </p>
                                            
                                        </div>
                                      </div>

                                      <div class="col">           
                                        <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Contact Phone 2:</b> <span name="contact_number_2" id="contact_number_2"></span>
                                              </p>
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                            <b>Sales Agent:</b> <span name="sales_agent" id="sales_agent"><?php echo $sales_agent; ?></span>
                                          </p>
                                        </div>
                                      </div>
                                </div>

                                <div class="row">
                                      <div class="col">
                                          <div class="mb-3">
                                              <p class="form-control-static">
                                                <b>Product:</b> <span name="product_name" id="product_name"><?php echo $product_name; ?></span>
                                              </p>
                                              
                                              
                                          </div>
                                      </div>

                                      <div class="col-4">
                                          <div class="mb-3">
                                              <p class="form-control-static">
                                              <b>Brand:</b> <span name="brand" id="brand"><?php echo $brand; ?></span>
                                              </p>
                                              
                                          </div>
                                      </div>
                                </div>

                                <div class="row">
                                      <div class="col-4">
                                          <div class="form-group">
                                              <p class="form-control-static">
                                               <b>Last Jobcard Number:</b> <span name="last_jc_number" id="last_jc_number"><?php echo $last_jc_number; ?></span>
                                              </p>
                                              
                                          </div>
                                      </div>

                                      <div class="col">
                                          <div class="form-group">
                                              <p class="form-control-static">
                                              <b>Last Jobcard Date:</b> <span name="last_jc_date" id="last_jc_date"><?php echo $last_jc_date; ?></span>
                                              </p>
                                              
                                          </div>
                                      </div>

                                </div>

                                <div class="row">
                                      <div class="col-4">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                             <b>Physical Location:</b> <span name="physical_location" id="physical_location"><?php echo $physical_location; ?></span>
                                          </p>  
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                              <b>Google Location:</b> <span name="google_location" id="google_location"><?php echo $google_location; ?></span>
                                          </p>
                                        
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                              <b>End date of Warranty/AMC:</b> <span name="date_w_amc" id="date_w_amc"><?php echo $date_w_amc; ?></span>
                                          </p>
                                        
                                        </div>
                                      </div>
                                </div>
                                

                                <!-- SERVICE JOB CARD -->
                            
                                  <div class="row ">
                                        <div class="col-4">
                                            <div class="form-group">
                                                
                                            <p class="form-control-static">
                                              <b>Job Type:</b> <span name="jc_type" id="jc_type"><?php echo $jc_type; ?></span>
                                            </p>
                                                
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                
                                            <p class="form-control-static">
                                              <b>Jobcard Assigned To:</b> <span name="jc_assigned_to" id="jc_assigned_to"><?php echo $jc_assigned_to; ?></span>
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>

                                  <div class="row ">
                                        <div class="col-4">
                                            <div class="form-group">
                                                
                                            <p class="form-control-static">
                                              <b>Work Statement:</b> <span name="work_statement" id="work_statement"><?php echo $work_statement; ?></span>
                                            </p>
                                                
                                            </div>
                                        </div>

                                        
                                  </div>
                                  
                                  <div class="row ">
                                        <div class="col-8">
                                            <div class="form-group">
                                                
                                            <p class="form-control-static">
                                              <b>Extra Word/Request By Client:</b> <span name="customer_word" id="customer_word"><?php echo $customer_word; ?></span>
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>

                                  <div class="row ">
                                        <div class="col-8">
                                            <div class="form-group">
                                                
                                            <p class="form-control-static">
                                              <b>Amount:</b> <span name="amount" id="amount"><?php echo $amount; ?></span>
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>
                                  <hr>
                                  <!-- FETCH FROM TBL ITEMS AND PRODUCT -->
                                  <p><b>Existing Product and Item:</b></p>
                                  <?php
                                 
                                 $jc_id = isset($_GET['jc_id']) ? $_GET['jc_id'] : null;
                                 
                                 if ($jc_id !== null) {
                                     // Initialize $content variable
                                     $content = '';
                                 
                                     // Table header for products
                                     $content .= '<table>';
                                     $content .= '<tbody>';
                                     $content .= '<tr class="data">';
                                     $content .= '<td colspan="2"><strong>PRODUCTS</strong></td>';
                                     $content .= '</tr>';
                                     $content .= '<tr class="data">';
                                     $content .= '<td><strong style="width: 500px;">Name</strong></td>';
                                     $content .= '<td><strong>Quantity</strong></td>';
                                     $content .= '</tr>';
                                 
                                     // Fetch products from tbl_service_jc_item for the specified jc_id
                                     $query_products = "SELECT * FROM tbl_service_jc_item WHERE service_jc_id = $jc_id AND product_quantity > 0";
                                     $result_products = mysqli_query($conn, $query_products);
                                 
                                     while ($product_row = mysqli_fetch_assoc($result_products)) {
                                         $content .= '<tr class="data">';
                                         $content .= '<td style="width: 500px;">' . $product_row['product_name'] . '</td>';
                                         $content .= '<td>' . $product_row['product_quantity'] . '</td>';
                                         $content .= '</tr>';
                                         
                                     }
                                 
                                     // Table header for items
                                     
                                     $content .= '<tr class="data">';
                                     $content .= '<td colspan="2"><strong>ITEMS</strong></td>';
                                     $content .= '</tr>';
                                     $content .= '<tr class="data">';
                                     
                                     $content .= '<td><strong style="width: 500px;">Name</strong></td>';
                                     $content .= '<td><strong>Quantity</strong></td>';
                                     $content .= '</tr>';
                                 
                                     // Fetch items from tbl_service_jc_item for the specified jc_id
                                     $query_items = "SELECT * FROM tbl_service_jc_item WHERE service_jc_id = $jc_id AND item_quantity > 0";
                                     $result_items = mysqli_query($conn, $query_items);
                                 
                                     while ($item_row = mysqli_fetch_assoc($result_items)) {
                                         $content .= '<tr class="data">';
                                         $content .= '<td style="width: 500px;">' . $item_row['item_name'] . '</td>';
                                         $content .= '<td>' . $item_row['item_quantity'] . '</td>';
                                         $content .= '</tr>';
                                     }
                                 
                                     // Close the table
                                     $content .= '</tbody>';
                                     $content .= '</table>';
                                 
                                     // Output or use $content as needed
                                     echo $content;
                                 } else {
                                     echo "jc_id parameter not provided in the URL.";
                                 }
                                 
                                 // Close the database connection if needed
                                 // mysqli_close($conn);
                                 
                                  ?>

                                  <!-- Button to add product or item page -->
                                  
                                 
                                  <!-- Button to add product or item page -->

                                  <!-- FORM START -->
                                  <form method="post" action="">
                                  
                                      <hr>

                        
                                 
                                  <br/>
                                  <div class="row ">
                                        <div class="col-4">
                                            <div class="form-group">
                                        
                                              
                                              <input class="form-control" type="hidden" name="jc_conclude_date" id="jc_conclude_date" value="<?php echo date('Y-m-d'); ?>">
                                            
                                            </div>
                                        </div>
                                    
                                       
                                        
                                  </div>

                                  
                                  <div class="row ">
                                       
                                        <div class="col-4">
                                            <div class="form-group">
                                           
                                            
                                              <!-- Work Done Date: <input class="form-control" type="date" name="work_done_date" id="work_done_date" required> -->
                                              <p class="form-control-static"><b>Payment Date : </b></p>
                                            <input class="form-control" type="date" name="payment_date" id="payment_date" required>
                                            
                                                
                                            </div>
                                        </div>

                                        
                                  </div>

                                  
                                 <br/>

                                 <div>
                                  <?php
                                      $query = "SELECT * FROM tbl_mpesa_number";
                                        $query_run = mysqli_query($conn, $query);
                                  ?>

                                      <table class="table">
                                                <thead class="thead-dark">
                                                  <tr>
                                                    
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Number</th>
                                                
                                                  </tr>
                                                </thead>
                                                <tbody>


                                                <?php
                                                  
                                                if(mysqli_num_rows( $query_run) > 0)
                                                {  

                                                  while($row = mysqli_fetch_array($query_run)){
                                                    ?>  
                                                    <tr> 
                                                        
                                                        
                                                        <td class="rates_id" style="display:none;"><?php echo $row["id"]; ?></td>
                                                      
                                                        
                                                        <td><?php echo $row["name"]; ?></td>
                                                        <td><?php echo $row["number"]; ?></td>
                                                                                                  
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
                                 </div><br/>

                                  <div class="row">
                                        <div class="col-3">
                                              <div class="form-group">
                                                  Payment Type:
                                                  <select class="form-select jc_type" name="payment_type" id="payment_type" required>
                                                      <option selected="selected" disabled value="">Choose Payment Type</option>
                                                      <option value="Invoice">Invoice</option>
                                                      <option value="Till">Till</option>
                                                      <option value="Paybill">Paybill</option>
                                                      <option value="M1">M1</option>
                                                      <option value="M2">M2</option>
                                                      <option value="Cash">Cash</option>
                                                      <option value="Cheque">Cheque</option>
                                                    
                                                  
                                                  </select>
                                                  
                                              </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                            Payment Code:
                                            <p>
                                              
                                              <input class="form-control" name="payment_code" id="payment_code" required>
                                            </p>
                                                
                                            </div>
                                        </div>

                                
                                        <div class=" col-3">
                                            <label>Total Paid Amount: </label>
                                            <input class="form-control" type="number" name="total_paid_amount" id="total_paid_amount" required>
                                        </div>
                                        

                                       
                                  </div>

                                  

                                  <br/>
               

                                  
                                  <input type="hidden" name="paid" id="paid" value="Paid">

                                  <!-- PRODUCT AND ITEMS -->

                                  <!-- <div class="row">
                                      <div class="col-4">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                             <b>Product:</b> <span name="product_name" id="product_name"><?php echo $product_name; ?></span>
                                             <input class="form-control" type="text" name="product_name" id="product_name" value="<?php echo $product_name; ?>">
                                          </p>  
                                            
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <p class="form-control-static">
                                              <b>Item:</b> <span name="item_name" id="item_name"><?php echo $item_name; ?></span>
                                              <input class="form-control" type="text" name="item_name" id="item_name" value="<?php echo $item_name; ?>">
                                          </p>
                                        
                                        </div>
                                      </div>

                                      
                                </div> -->

                               
                                <div class="row">
                                    <div class="col-1">
                                      <input type="submit" class="btn btn-primary" value="Paid">
                                    </div>
                                        
                                    <div class="col">
                                      <button class="btn btn-outline-secondary"><a href="payment-page.php">Close</a></button>
                                   </div>
                                </div>
                                   
                                                    
                      
                    </form><br>

                   
                    

                    
                                                                             
              </div><!------------------end view data---------------------------->

                
                
        </div>
                  

                  


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

<script src="js/close_jc.js"></script>
<script src="js/main.js"></script>
<script src="js/service_jc_filter_item.js"></script>
<script src="js/service_jc_filter_product.js"></script>


</body>
</html>