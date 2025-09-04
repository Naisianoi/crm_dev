<?php
include('partials/navbar.php');
include('add_project_payment.php');
    //   include('edit_project_update.php');
   
?>

<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container-sm">
               

                
                <h1 style="padding-top: 0px;">PROJECT PAYMENT</h1><br>
                               
                              <!-- Add Customer Form -->
                    
                              <form method="POST" action="">
                              
                                    <div class="row">

                                      
                                       

                                        <div class="col-4">
                                            <div class="form-group">
                                                <p class="form-control-static">
                                                <b>Project Lead By:</b> <span><?php echo $project_created_by; ?></span>
                                                <input type="hidden" name="project_created_by" id="project_created_by" value="<?php echo $project_created_by?>">
                                                </p>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    
                                    <div class="row">
                                            

                                            <div class="col-6">
                                                        <div class="form-group">
                                                            
                                                            <p class="form-control-static">
                                                            <b>Project Name:</b> <span><?php echo $project_name; ?></span>
                                                            <input type="hidden" value="<?php echo $project_name; ?>" name="project_name" id="project_name">
                                                            </p>
                                                        </div>
                                            </div>

                                            
                                      </div>

                                      <div class="row">
                                            

                                            <div class="col-6">
                                                        <div class="form-group">
                                                            
                                                            <p class="form-control-static">
                                                            <b>Customer Name: </b> <span><?php echo $customer_name; ?></span>
                                                            <input type="hidden" value="<?php echo $customer_name; ?>" name="customer_name" id="customer_name">
                                                            </p>
                                                        </div>
                                            </div>

                                            
                                      </div>

                                      <!-- Input fields for customer details -->
                                      <div class="row">
                                            

                                            

                                            <div class="col-6">
                                                <div class="form-group">
                                                    
                                                    <p class="form-control-static">
                                                    <b>Company Name:</b> <span><?php echo $company_name; ?></span>
                                                    <input type="hidden" value="<?php echo $company_name; ?>" name="company_name" id="company_name">
                                                    </p>
                                                </div>
                                            </div>

                                      </div>

                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <p class="form-control-static">
                                                    <b>Address: </b> <span><?php echo $address; ?></span>
                                                    <input type="hidden" value="<?php echo $address; ?>" name="address" id="address">
                                                </p>
                                                
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                    <p class="form-control-static">
                                                     <b>County:</b> <span><?php echo $county; ?></span>
                                                     <input type="hidden" value="<?php echo $county; ?>" name="county" id="county">
                                                    </p>
                                                
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <p class="form-control-static">
                                                    <b>City:</b> <span><?php echo $city; ?></span>
                                                    <input type="hidden" value="<?php echo $city; ?>" name="city" id="city">
                                                </p>
                                                
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <p class="form-control-static">
                                                    <b>Google Location:</b> <span><?php echo $google_location; ?></span>
                                                    <input type="hidden" value="<?php echo $google_location; ?>" name="google_location" id="google_location">
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-4">
                                            <div class="mb-3">
                                                    <p class="form-control-static">
                                                      <b>Contact Name:</b> <span><?php echo $contact_name_one; ?></span>
                                                      <input type="hidden" value="<?php echo $contact_name_one; ?>" name="contact_name_one" id="contact_name_one">
                                                    </p>
                                                
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="mb-3">
                                                <p class="form-control-static">
                                                    <b>Contact Phone:</b> <span><?php echo $contact_phone_one; ?></span>
                                                    <input type="hidden" value="<?php echo $contact_phone_one; ?>" name="contact_phone_one" id="contact_phone_one">
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <p class="form-control-static">
                                                    <b>Contact Name 2:</b> <span><?php echo $contact_name_two; ?></span>
                                                    <input type="hidden" value="<?php echo $contact_name_two; ?>" name="contact_name_two" id="contact_name_two">
                                                </p>
                                            
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="mb-3">
                                            <p class="form-control-static">
                                                    <b>Contact Phone 2:</b> <span><?php echo $contact_phone_two; ?></span>
                                                    <input type="hidden" value="<?php echo $contact_phone_two; ?>" name="contact_phone_two" id="contact_phone_two">
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                     

                                    <div class="row">
                                        <div class="col-6">
                                          <div class="mb-3">
                                            <label><b>Site Name:</b></label> <span><?php echo $site_name; ?></span>
                                            <input type="hidden" class="form-control" name="site_name" id="site_name" value="<?php echo $site_name; ?>">
                                          </div>
                                           
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                           <div class="mb-3">
                                                <label><b>Site Address:</b></label> <span><?php echo $site_address; ?></span>
                                                <input type="hidden" class="form-control" name="site_address" id="site_address" value="<?php echo $site_address; ?>">
                                           </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    
                                       <hr>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Amount</th>
                                                    <th>Payment Code</th>
                                                    <th>Payment Type</th>
                                                    <th>Part Final</th>
                                                    <th>Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($paymentData as $payment): ?>
                                                <tr> 
                                                    <td><?php echo $sn++; ?>.</td>
                                                    <td><?php echo $payment['amount']; ?></td>
                                                    <td><?php echo $payment['payment_code']; ?></td>
                                                    <td><?php echo $payment['payment_type']; ?></td>
                                                    <td><?php echo $payment['part_final']; ?></td>
                                                    <td><?php echo $payment['payment_date']; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                                                                

                                    </div><br>

                                    

                                    

                                    <!-- DATA ADDED TO DATABASE -->

                                    <div class="row">
                                    
                                            <div class="mb-3">
                                                <div class="col-4">
                                                    <label>Payment Type:</label>
                                                    <select class="form-select jc_type" name="payment_type" id="payment_type" required>
                                                      <option selected="selected" disabled value="">Choose Payment Type</option>
                                                      <option value="Invoice">Invoice</option>
                                                      <option value="Till">Till</option>
                                                      <option value="Paybill">Paybill</option>
                                                      <option value="Mpesa">Mpesa</option>
                                                      <option value="Cash">Cash</option>
                                                      <option value="Cheque">Cheque</option>
                                                    
                                                  
                                                  </select>
                                                </div>
                                                  
                                            </div>
                                    </div><br/>

                                    <div class="row ">
                                        <div class="col-4">
                                            <div class="form-group">
                                        
                                              
                                              <input class="form-control" type="hidden" name="payment_post_date" id="payment_post_date" value="<?php echo date('Y-m-d'); ?>">
                                            
                                            </div>
                                        </div>
                                    
                                       
                                        
                                  </div>


                                    
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label>Payment Date:</label>
                                                <input  class="form-control" type="date" name="payment_date" id="payment_date" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label>Payment Code:</label>
                                                <input type="text" class="form-control" name="payment_code" id="payment_code" value="" required>
                                            </div>
                                        </div>
                                    </div><br/>

                                    <div class="row">
                                        

                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label>Amount:</label>
                                                <input type="text" class="form-control" name="amount" id="amount" required>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <label>Payment Status:</label>
                                                   <select class="form-select" name="payment_status" id="payment_status" required>
                                                      <option selected="selected" disabled value="">Choose Payment</option>
                                                      <option value="Part-payment">Part-payment</option>
                                                      <option value="Full-payment">Full-payment</option>
                                                    
                                                   </select>
                                        </div>
                                              

                                    </div><br/>
                                        
                                             
                                    <input type="hidden" value="<?php echo $id; ?>" name="project_id" id="project_id">
                                                    
                                      

                                      
                                    </div><br>

                                

                                    
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'project-page.php'">Close</button>
                                      &nbsp;&nbsp;
                                      <button type="submit" class="btn btn-primary add-project-payment"  name="add-project-payment">Add Payment</button></a>
                                      
                                     
                                
                                    
                                    
                              </form>

                
                        
                </div><!-- End Add Form---->

           
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

<script src="js/project_form.js"></script>
<script src="js/customer_options_select_add.js"></script>

<script src="js/main.js"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script> -->



</body>
</html>

