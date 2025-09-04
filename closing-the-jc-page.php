<?php include('partials/navbar.php');
      // include('add_product.php');
      include('edit-close-jc.php');
      // include('add_back_to_stock.php');
      // include('edit_jc_costing.php');

      // include('edit-close-jc-service-calls.php');
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
                                  <hr>
                                  <!-- FETCH FROM TBL ITEMS AND PRODUCT -->

                                  
                                      <!-- Button to add product or item page -->
                                      <p>To add a new product or item click the button below:</p>
                                      
                                      <a href="closing-the-jc-product-item.php?jc_id=<?php echo isset($_GET['jc_id']) ? $_GET['jc_id'] : ''; ?>"> <button class="btn btn-primary">Add New Product/Item</button></a>
                                      <br/><br/>
                                      <!-- Button to add product or item page -->
                                  
                                  <!-- FORM START -->
                                  <form method="post" action="" onsubmit="return validateFormCloseJC()">
                                  <!-- PRODUCT AND ITEMS EDIT-->
                                  
                                  <p><b>Edit Existing Product and Item</b></p>

                                      
                                      <!-- TESTING -->
                                      <?php
                                      // Check connection
                                      if ($conn->connect_error) {
                                          die("Connection failed: " . $conn->connect_error);
                                      }

                                      // Fetch products and items with quantity greater than 0 (either product or item)
                                      $sql = "SELECT * FROM tbl_service_jc_item WHERE service_jc_id = $jcId AND (product_quantity > 0 OR item_quantity > 0)";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                          echo '<form method="post" action="edit-close-jc.php">';
                                          echo '<h2>Products</h2>';
                                          echo '<table>';
                                          echo '<tbody>';
                                          echo '<tr class="data">';
                                          echo '<td><strong style="width: 500px;">Name</strong></td>';
                                          echo '<td><strong>Quantity</strong></td>';
                                          echo '</tr>';

                                          while ($row = $result->fetch_assoc()) {
                                              $id = $row['id'];
                                              $productName = $row['product_name'];
                                              $productQuantity = $row['product_quantity'];

                                              // Check if product quantity is greater than 0
                                              if ($productQuantity > 0 && !empty($productName)) {
                                                  echo '<tr class="data">';
                                                  echo '<td style="width: 500px;">' . $productName . '</td>';
                                                  
                                                  echo "<input class='form-control' type='hidden' name='product_name[]' value='$productName'>";
                                                  
                                                  echo '<td>';
                                                  echo "<input class='form-control ' type='text' name='product_quantity[]' value='$productQuantity'>";
                                                  // echo '<input class="form-control" type="text" name="product_quantity[]" value="' . $productQuantity . '">';
                                                  echo '</td>';

                                                  echo '<td>';
                                                  echo "<input type='hidden' name='product_id' value='$id'>"; // Add hidden input for ID
                                                  // echo '<input class="form-control" type="text" name="product_quantity[]" value="' . $productQuantity . '">';
                                                  echo '</td>';
                                                  echo '</tr>';
                                              }
                                          }

                                          echo '</tbody>';
                                          echo '</table>';

                                          // Reset the result pointer to go through the items
                                          mysqli_data_seek($result, 0);

                                          echo '<h2>Items</h2>';
                                          echo '<table>';
                                          echo '<tbody>';
                                          echo '<tr class="data">';
                                          echo '<td><strong style="width: 500px;">Name</strong></td>';
                                          echo '<td><strong>Quantity</strong></td>';
                                          echo '</tr>';

                                          while ($row = $result->fetch_assoc()) {
                                              $id = $row['id'];
                                              $itemName = $row['item_name'];
                                              $itemQuantity = $row['item_quantity'];

                                              // Check if item quantity is greater than 0
                                              if ($itemQuantity > 0 && !empty($itemName)) {
                                                  echo '<tr class="data">';
                                                  echo '<td style="width: 500px;">' . $itemName . '</td>';
                                                  // echo "<input type='hidden' name='item_id[]' value='$id'>"; // Add hidden input for ID
                                                  echo "<input class='form-control' type='hidden' name='item_name[]' value='$itemName'>";
                                                  echo '<td>';
                                                  // echo '<input class="form-control" type="text" name="item_quantity[]" value="' . $itemQuantity . '">';
                                                  echo "<input class='form-control ' type='text' name='item_quantity[]' value='$itemQuantity'>";
                                                  echo '</td>';

                                                  echo '<td>';
                                                  echo "<input type='hidden' name='item_id' value='$id'>"; // Add hidden input for ID
                                                  // echo '<input class="form-control" type="text" name="product_quantity[]" value="' . $productQuantity . '">';
                                                  echo '</td>';

                                                  echo '</tr>';
                                              }
                                          }

                                          echo '</tbody>';
                                          echo '</table>';
                                          
                                          // echo '<br><div class="row">';
                                          // echo '<div class="col-2">';
                                          // echo '<input type="submit" class="btn btn-primary" value="Close JC">';
                                          // echo '</div>';
                                          // echo '<div class="col">';
                                          // echo '<button class="btn btn-outline-secondary"><a href="close-jc-page.php">Close</a></button>';
                                          // echo '</div>';
                                          // echo '</div>';
                                          // echo '</form>';
                                      } else {
                                          echo '<br><div class="row">';
                                          // echo '<div class="col-2">';
                                          // echo '<input type="submit" class="btn btn-primary" value="Close JC">';
                                          // echo '</div>';
                                          // echo '<div class="col">';
                                          // echo '<button class="btn btn-outline-secondary"><a href="close-jc-page.php">Close</a></button>';
                                          // echo '</div>';
                                          // echo '</div>';
                                          // echo '</form>';
                                          echo 'No products or items found with quantity greater than 0.<br>';
                                      }

                                      // Close the database connection
                                      // $conn->close();
                                      ?>


                                      <hr>

                                  <!-- FETCH FROM TBL ITEMS AND PRODUCT -->
                                 
                                  <br/>
                                  <div class="row ">
                                        <div class="col-4">
                                            <div class="form-group">
                                            <b>To be Filled By Technician </b>
                                            <p>
                                              <!-- Work Done Date: <input class="form-control" type="date" name="work_done_date" id="work_done_date" required> -->
                                              <p class="form-control-static"><b>Work Done Date : </b></p>
                                            <input class="form-control" type="date" name="work_done_date" id="work_done_date" required>
                                            </p>
                                                
                                            </div>
                                        </div>

                                        <!-- <div class="col-3">
                                            <div class="form-group">
                                            <br/>
                                            <p >
                                              Time Started: <input class="form-control">
                                            </p>
                                                
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-3">
                                            <div class="form-group">
                                            <br/>
                                            <p >
                                              Time Completed: <input class="form-control">
                                            </p>
                                                
                                            </div>
                                        </div> -->
                                  </div>

                                  <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                            <br/>
                                            <p >
                                              Job Description/Findings: <textarea class="form-control" row="9"  name="job_finding" id="job_finding" required></textarea>
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>

                                  <!-- REMINDER (MEMO) -->
                                  <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                            <br/>
                                            <p >
                                              Reminder: <textarea class="form-control" row="9" name="reminder" id="reminder"></textarea>
                                            </p>
                                                
                                            </div>
                                        </div>

                                      

                                        <div class="col-2">
                                            <div class="form-group">
                                            <br/>
                                            <p >
                                              Done Before Date: <input name="before_dt" id="before_dt" type="date" class="form-control" >
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>

                                  
                                      <input type="hidden" name="jc_lead_by" id="jc_lead_by" value="<?php echo $jc_lead_by; ?>">
                                      <input type="hidden" name="role" id="role" value="<?php echo $role; ?>">
                                      <input type="hidden" name="creation_date" id="creation_date" value="<?php echo date('Y-m-d'); ?>">
                                      
                                  <!-- REMINDER (MEMO) -->

                                  <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                            <b>Flow of Water (500ml):</b>
                                            <p>
                                              
                                              Pure Water: (Sec)<input class="form-control" name="flow_pure" id="flow_pure">
                                            </p>
                                                
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                            <br/>
                                            <p>
                                              
                                              Reject Water: (Sec)<input class="form-control" name="flow_reject" id="flow_reject">
                                            </p>
                                                
                                            </div>
                                        </div>
                                  </div>

                                  <div class="row">
                                      <div class="form-group col-3">
                                          <label>Amount </label>
                                          <input class="form-control" type="number" name="amount" id="amount" value="<?php echo $amount; ?>">
                                      </div>

                                      <div class="form-group col-3">
                                          <label>Hours </label>
                                          <input class="form-control" type="text" name="hours" id="hours" required>
                                      </div>
                                  </div>

                                  <div class="row">
                                  
                                        <div class="col-3">
                                          
                                            <div class="form-group">
                                            <br/>
                                            <p>
                                                Work Done Satisfactory:</p>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="work_satisfactory" id="work_satisfactory1" value="Yes">
                                                <label class="form-check-label">
                                                  Yes
                                                </label>
                                              </div>
                                                 
                                            </div>
                                        </div>

                                        <div class="col-3">
                                          
                                            <div class="form-group">
                                            <br/><br/><br/>
                                            
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="work_satisfactory" id="work_satisfactory2" value="No">
                                                <label class="form-check-label">
                                                 No
                                                </label>
                                              </div>
                                                 
                                            </div>
                                        </div>
                                  </div>
               

                                  <div class="row">
                                  
                                        <div class="col-3">
                                          
                                            <div class="form-group">
                                            <br/>
                                            <p>
                                                Client Sign:</p>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="client_sign" id="client_sign1" value="Yes">
                                                <label class="form-check-label">
                                                  Yes
                                                </label>
                                              </div>
                                                 
                                            </div>
                                        </div>

                                        <div class="col-3">
                                          
                                            <div class="form-group">
                                            <br/><br/><br/>
                                            
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="client_sign" id="client_sign2" value="No">
                                                <label class="form-check-label">
                                                 No
                                                </label>
                                              </div>
                                                 
                                            </div>
                                        </div>
                                  </div><br/>
                                  <input type="hidden" name="jc_closed" id="jc_closed" value="Closed">

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
                                    <div class="col-2">
                                      <input type="submit" class="btn btn-primary" name="closeJcButton" value="Close JC">
                                    </div>
                                        
                                    <div class="col">
                                      <button class="btn btn-outline-secondary"><a href="close-jc-page.php">Close</a></button>
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