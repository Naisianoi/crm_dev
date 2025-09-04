<?php include('partials/navbar.php'); 
    //   include('fetch_data_technician.php');
      include('fetch_data_view_all_service_jc.php');
      include('assign_jc_technician.php');

      // Retrieve customer ID from the URL
     $customerId = isset($_GET['id']) ? $_GET['id'] : null;
    
?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->
<style>
    .red-text {
        color: red;
    }
</style>
<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content" id="customer_content">

                <div  class="tab-pane in active">
                    <h1 style="padding-top: 0px;">CUSTOMER JOBCARDS</h1><br>

                    <a href="customer-page.php" class="floating-button">
                     <i class="bi bi-arrow-left-circle-fill"></i>
                    </a><!----------floating back button-------------------->

                <!-- ... Your previous code ... -->

                    <div class="table-responsive">
                        <!-- Job Card Assignment Form -->
                        <form id="assignTechnicianForm" method="POST">
                            <!-- Your form fields -->
                        </form>
                    </div>

                    <!-- Display Assigned Job Cards -->
                    <div class="table-responsive">
                
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">JC</th>
                                
                                    <th scope="col">Role</th>
                                    <!-- <th scope="col">JC Type</th> -->
                                    <th scope="col">Customer Name</th>
                                   
                                    <!-- <th scope="col">Company Name</th> -->
                                    <!-- <th scope="col">Project Name</th> -->
                                    <!-- <th scope="col">Customer Type</th> -->
                                    <!-- <th scope="col">Create Date</th> -->
                                    <!-- <th scope="col">Technician</th> -->

                                    <!-- <th scope="col">Amount</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Fuel</th>-->
                                    <th scope="col">Technician</th>

                                    <!--<th scope="col">Area</th>
                                    <th scope="col">Time</th>-->
                                    <th scope="col">Completion</th>

                                    <!-- <th scope="col">Total</th>  -->

                                    <th scope="col">JC1</th>
                                    <th scope="col">JC2</th>
                                    <th scope="col">JC3</th>
                                    <th scope="col">P</th>
                                    
                                    
                                    <th scope="col">Status</th>

                                    <th scope="col" style="text-align: right;">Amount</th>
                                    <th scope="col" style="text-align: right;">Material</th>
                                    <th scope="col" style="text-align: right;">Fuel</th>
                                    <th scope="col" style="text-align: right;">Technician</th>
                                    <th scope="col" style="text-align: right;">Total</th>
                                    <th scope="col" style="text-align: right;">% Cost</th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody> 
                            <?php
                        
                        if(mysqli_num_rows( $query_run) > 0)
                        {  
  
                          while($rowAssigned = mysqli_fetch_array($query_run)){
                             // Check if the customerId matches the row's customer_id
                             if ($rowAssigned["customer_id"] == $customerId) {
                             // Display the row with assigned technician and an "Edit" button
                             echo '<tr>';
                             echo '<td>' . $rowAssigned["id"] . '</td>';
                            //  echo '<td>' . $rowAssigned["customer_id"] . '</td>';
                             echo '<td>' . $rowAssigned["role"] . '</td>';
                            //  echo '<td>' . $rowAssigned["jc_type"] . '</td>';
                             echo '<td>' . $rowAssigned["customer_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["company_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["project_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["customer_type"] . '</td>';
                            //  echo '<td>' . $rowAssigned["jc_create_date"] . '</td>';
                             echo '<td>' . $rowAssigned["jc_assigned_to"] . '</td>';
                             
                             //echo '<td>' . $rowAssigned["area"] . '</td>';
                             //echo '<td>' . $rowAssigned["hours"] . '</td>';
                             echo '<td>' . $rowAssigned["work_done_date"] . '</td>';

                            //  echo '<td>' . $rowAssigned["total_paid_amount"] . '</td>';
                            //  echo '<td>' . $rowAssigned["material_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["fuel_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["technician_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["total_cost"] . '</td>';
                          
                             echo '<td style="display: none;">' . $rowAssigned["paid"] . '</td>';
                             echo '<td style="display: none;">' . $rowAssigned["jc_closed"] . '</td>';
                             
                             // Check if the role is 'Trading'
                             if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Service') {
                                 
                                echo '<td><a href="pdf_service_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_service_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_jc_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-currency-dollar"></i></a></td>';
                                // echo '<td><a href="pdf_jobcard_costing.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank">COST</a></td>';
                                echo '<td><b>PAID</b></td>';
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Trading') {
                                 
                                echo '<td><a href="pdf_trading_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_trading_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_jc_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-currency-dollar"></i></a></td>';
                                // echo '<td><a href="pdf_jobcard_costing.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank">COST</a></td>';
                                echo '<td><b>PAID</b></td>';
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Project') {
                                 
                              echo '<td><a href="pdf_project_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td><a href="pdf_assign_project_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td><a href="pdf_project_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td><a href="pdf_jc_project_admin_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-currency-dollar"></i></a></td>';
                              echo '<td><b>PAID</b></td>';
                           
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Admin') {
                                 
                              echo '<td><a href="pdf_admin_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td></td>';
                              echo '<td><a href="pdf_jc_project_admin_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-currency-dollar"></i></a></td>';
                              echo '<td><b>PAID</b></td>';
                           
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Cancelled') {
                                // For roles other than 'Trading'
                                
                                echo '<td><a href="pdf_service_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_trading_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_project_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_project_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             
                             } else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_admin_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Closed') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:red;">Payment ?</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] === 'Closed') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_assign_trading_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:red;">Payment ?</b></td>';
                             }  else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             
                             }else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             
                             }  else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             }
                             
                             
                             // echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                             // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                            //  echo '<td>' . $rowAssigned["percent_cost"] . '%</td>';
                            // Get the percent_cost value
                            
                             $percentCost = $rowAssigned["percent_cost"];

                             // Check if the value is less than 40
                             $colorClass = ($percentCost < 40) ? 'red-text' : '';

                             // Output the table cell with the appropriate style

                             echo '<td style="text-align: right;">' . number_format($rowAssigned["total_paid_amount"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["material_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["fuel_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["technician_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["total_cost"], 0) . '</td>';

                             echo '<td class="' . $colorClass . '" style="text-align: right;">' . $percentCost . '</td>';
                             echo '</tr>';
                            
                          }

                        }

                        
                        
                        } else {
                          echo "<h5>No Record Found</h5>";
                        }
                      
  
                           
                        ?>  
                            </tbody>
                        </table>
                        
                    </div>

                    <!-- ... Your remaining code ... -->

                    


            
                </div>

                  
                  

                  
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


<script src="js/main.js"></script>
<script src="js/assign_jc.js"></script>
<script src="js/unassign_jc.js"></script>



</body>
</html>