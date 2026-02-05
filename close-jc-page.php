<?php include('partials/navbar.php'); 
      include('fetch_data_technician.php');
    //   include('fetch_data_service_jobcard.php');
      include('fetch_data_close_jc.php');
      include('config/constants.php');
      include('login-check.php');
?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content" id="customer_content">

                <div  class="tab-pane in active">
                    <h1 style="padding-top: 0px;">CLOSING JOB CARD</h1><br>

                    


                <!-- ... Your previous code ... -->

                    <div class="table-responsive">
                        <!-- Job Card Assignment Form -->
                        <form id="assignTechnicianForm" method="POST">
                            <!-- ... Your form fields ... -->
                        </form>
                    </div>

                    <!-- Display Assigned Job Cards -->
                    <div class="table-responsive">
                  
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">JC</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">JC Type</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Customer Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Technician</th>
                                    
                                    <th scope="col">Close Jc</th>
                                    <th scope="col">Cancel Jc</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_admin"));
            
                                    $userType = $fetch["user_type"];
                                // Fetch and display assigned job cards with technicians
                                // Modify your query to fetch data with assigned technicians
                                while ($rowAssigned = mysqli_fetch_array($query_run_assigned)) {
                                    // Display the row with assigned technician and an "Edit" button
                                    echo '<tr>';
                                    echo '<td>' . $rowAssigned["id"] . '</td>';
                                    echo '<td>' . $rowAssigned["role"] . '</td>';
                                    echo '<td>' . $rowAssigned["jc_type"] . '</td>';
                                    echo '<td>' . $rowAssigned["customer_name"] . '</td>';
                                    echo '<td>' . $rowAssigned["company_name"] . '</td>';
                                    echo '<td>' . $rowAssigned["project_name"] . '</td>';
                                    echo '<td>' . $rowAssigned["customer_type"] . '</td>';
                                    echo '<td>' . $rowAssigned["jc_create_date"] . '</td>';
                                    echo '<td>' . $rowAssigned["jc_assigned_to"] . '</td>';
                                
                                    $canCancel = in_array($userType, ['admin', 'accounts', 'manager']);

                                    // Check if the role is 'Trading'
                                    if ($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_closed"] !== 'Closed') {
                                        echo '<td><a class="btn btn-success" href="closing-the-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Close Trading JC">Close</a></td>';
                                        if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-success"
                                                    href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '"
                                                    title="Cancel Trading JC">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                        // echo '<td><button class="btn btn-success" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                        
                                    } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["jc_type"] !== 'AMC Service') {
                                        // For roles other than 'Trading'
                                        // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                        echo '<td><a class="btn btn-primary" href="closing-the-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Close Service JC">Close</a></td>';
                                        if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-primary"
                                                    href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '"
                                                    title="Cancel Service JC">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                        // echo '<td><a class="btn btn-primary" href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Cancel Service JC">Cancel</a></td>';
                                        // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                        
                                    } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["jc_type"] === 'AMC Service') {
                                      // For roles other than 'Trading'
                                      // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                      echo '<td><a class="btn btn-danger" href="closing-the-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Close AMC JC">Close</a></td>';
                                      if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-danger"
                                                    href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '"
                                                    title="Cancel AMC JC">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                      // echo '<td><a class="btn btn-danger" href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Cancel AMC JC">Cancel</a></td>';
                                      // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                      
                                    } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_closed"] !== 'Closed') {
                                      // For roles other than 'Trading'
                                      // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                      echo '<td><a class="btn btn-warning" href="closing-project-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Close Project JC">Close</a></td>';
                                      if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-warning"
                                                    href="cancel-project-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '"
                                                    title="Cancel AMC JC">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                      // echo '<td><a class="btn btn-warning" href="cancel-project-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Cancel Project JC">Cancel</a></td>';
                                      // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                      
                                  
                                    } else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_closed"] !== 'Closed') {
                                      // For roles other than 'Trading'
                                      // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                      echo '<td><a class="btn btn-secondary" href="closing-admin-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Close Admin JC">Close</a></td>';
                                      if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-secondary"
                                                    href="cancel-admin-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '"
                                                    title="Cancel Admin JC">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                      // echo '<td><a class="btn btn-secondary" href="cancel-admin-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '" title="Cancel Admin JC">Cancel</a></td>';
                                      // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                             
                                    }  else if($rowAssigned["jc_closed"] === 'Cancelled') {
                                      // For roles other than 'Trading'
                                      // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                      echo '<td><a class="btn btn-primary" href="closing-the-jc-page.php?jc_id=' . $rowAssigned["id"] . '">Close</a></td>';
                                      if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-danger"
                                                    href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                      // echo '<td><a class="btn btn-danger" href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '">Cancel</a></td>';
                                      // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                      
                                    }  else if($rowAssigned["jc_closed"] === 'Closed') {
                                        // For roles other than 'Trading'
                                        // echo '<td><button class="btn btn-primary close-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Close</button></td>';
                                        echo '<td><a class="btn btn-danger" href="closing-the-jc-page.php?jc_id=' . $rowAssigned["id"] . '">Close</a></td>';
                                        if ($canCancel) { 
                                          echo '<td>
                                                  <a class="btn btn-primary"
                                                    href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '">
                                                    Cancel
                                                  </a>
                                                </td>';
                                      } else {
                                          echo '<td></td>'; // keeps table columns aligned
                                      }
                                        // echo '<td><a class="btn btn-primary" href="cancel-close-jc-page.php?jc_id=' . $rowAssigned["id"] . '">Cancel</a></td>';
                                        // echo '<td><button class="btn btn-primary cancel-jc-btn" data-jc-id="' . $rowAssigned["id"] . '">Cancel JC</button></td>';
                                    
                                    }  
                                    
                                    // echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                    // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';

                                    echo '</tr>';
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