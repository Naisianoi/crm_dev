<?php include('partials/navbar.php'); 
      include('fetch_data_technician.php');
    //   include('fetch_data_service_jobcard.php');
      include('assign_jc_technician.php');    
?>

<!-----------------------------------RIGHT TAB------------------------------------------------>

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
            
            <div style="display:none;">
                <?php include('amc-jobcard-page.php'); ?>
            </div>

         <div class="tab-content">

                <div  class="tab-pane in active">
                    <h1 style="padding-top: 0px;">ASSIGN JOB CARD</h1><br>

                    <div class="table-responsive">
                    <h2>Unassigned Job Cards</h2>
                    
                    <form id="assignTechnicianForm" method="POST" action="">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                
                                <th scope="col">JC</th>
                                <th scope="col">Role</th>
                                <th scope="col">JC Type</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Proposed Date</th>
                                <th scope="col">Technician</th>
                                <th scope="col">Slot</th>
                                
                                
                                <th scope="col"></th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                
                            if(mysqli_num_rows( $query_run) > 0)
                            {  

                              while ($row = mysqli_fetch_array($query_run_unassigned)) {
                                
                        
                                    
                                $role = $row['role'];
                                $jcType = $row['jc_type'];
                                    if ($role === 'Trading') {
                                        $buttonEdit = 'btn btn-success  btn-sm col-xs-2';
                                    } elseif ($role === 'Project') {
                                        $buttonEdit = 'btn btn-warning  btn-sm col-xs-2';
                                    } elseif ($role === 'Service' && $jcType != 'AMC Service') {
                                        $buttonEdit = 'btn btn-primary  btn-sm col-xs-2';
                                    }elseif ($role === 'Service' && $jcType === 'AMC Service') {
                                        $buttonEdit = 'btn btn-danger  btn-sm col-xs-2';
            
                                    } elseif ($role === 'Admin') {
                                        $buttonEdit = 'btn btn-secondary  btn-sm col-xs-2';
                                    }

                                $role = $row['role'];
                                $jcType = $row['jc_type'];
                                if ($role === 'Trading') {
                                    $buttonEditHref = 'edit-trading-jobcard-page.php?id=' . $row["id"];
                                } elseif ($role === 'Project') {
                                    $buttonEditHref = 'edit-jobcard-page.php?id=' . $row["id"];
                                } elseif ($role === 'Service' && $jcType != 'AMC Service'){
                                    $buttonEditHref = 'edit-service-jobcard-page.php?id=' . $row["id"];
                                }elseif ($role === 'Service' && $jcType === 'AMC Service'){
                                    $buttonEditHref = 'edit-amc-jobcard-page.php?id=' . $row["id"];
                                } elseif ($role === 'Admin'){
                                    $buttonEditHref = 'edit-admin-jobcard-page.php?id=' . $row["id"];
                                }
                                    
                                // $buttonEdit = ($row['role'] === 'Trading') ? 'btn btn-success  btn-sm col-xs-2' : 'btn btn-primary  btn-sm col-xs-2';
                                // $buttonEdit = ($row['role'] === 'Project') ? 'btn btn-warning  btn-sm col-xs-2' : 'btn btn-primary  btn-sm col-xs-2';

                                // $buttonEditHref = ($row['role'] === 'Trading') ? 'btn btn-warning  btn-sm col-xs-2' : 'btn btn-primary  btn-sm col-xs-2';
                                // $buttonEditHref = ($row['role'] === 'Project') ? 'btn btn-warning  btn-sm col-xs-2' : 'btn btn-primary  btn-sm col-xs-2';

                                // $buttonClass = ($row['role'] === 'Trading') ? 'btn btn-success assign-technician-btn' : 'btn btn-primary assign-technician-btn';
                                // $buttonClass = ($row['role'] === 'Project') ? 'btn btn-warning assign-technician-btn' : 'btn btn-primary assign-technician-btn';
                                
                                $role = $row['role'];
                                $jcType = $row['jc_type'];
                                    if ($role === 'Trading') {
                                        $buttonClass = 'btn btn-success assign-technician-btn';
                                    } elseif ($role === 'Project') {
                                        $buttonClass = 'btn btn-warning assign-technician-btn';
                                    } elseif ($role === 'Service' && $jcType != 'AMC Service') {
                                        $buttonClass = 'btn btn-primary assign-technician-btn';
                                    }elseif ($role === 'Service' && $jcType === 'AMC Service') {
                                        $buttonClass = 'btn btn-danger assign-technician-btn';
                                    } elseif ($role === 'Admin') {
                                        $buttonClass = 'btn btn-secondary assign-technician-btn';
                                    }

                              

                                ?>  
                                    
                                    

                                    <tr>
                                        <td class="service_jc_id"><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["role"]; ?></td>
                                        <td><?php echo $row["jc_type"]; ?></td>
                                        <td><?php echo $row["customer_name"]; ?></td>
                                        <!-- <td><?php echo $row["jc_create_date"]; ?></td> -->
                                        <td><?php echo date("d-m-Y", strtotime($row["jc_create_date"])); ?></td>

                                        <td>
                                            <input type="date" name="proposed_work_date" data-jc-id="<?php echo $row['id']; ?>" class="form-control proposed_work_date" id="proposed_work_date">
                                        </td>

                                        <td>


                                            <div class="mb-3">
                                                <select class="form-select" name="technician[<?php echo $row['id']; ?>]" class="edit_technician">
                                                    <option selected disabled>Choose Technician</option>
                                                    <?php
                                                        // Fetch data from database
                                                        $query1 = "SELECT * FROM tbl_technician";
                                                        $result1 = mysqli_query($conn, $query1);

                                                        // Populate options
                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                            echo '<option value="' . $row1['technician_name'] . '">' . $row1['technician_name'] . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="mb-3">
                                                <select class="form-select" name="time_slot" data-jc-id="<?php echo $row['id']; ?>" class="time_slot" id="time_slot" required>
                                                <option selected="selected" disabled value="">Slot</option>
                                                <option value="Slot 1">Slot 1 (9:00-10:30)</option>
                                                <option value="Slot 2">Slot 2 (10:30-1:00)</option>
                                                <option value="Slot 3">Slot 3 (2:00-3:30)</option>
                                                <option value="Slot 4">Slot 4 (3:30-5:00)</option>
                                                </select>
                                            </div>
                                        </td>

                                        <!-- <td><a href="<?php echo $buttonEditHref; ?>" class="<?php echo $buttonEdit; ?>" style="<?php echo $buttonEditHide; ?>" title="Edit"><i class="bi bi-pencil-fill"></i></a></td> -->

                                        <!-- <td>
                                        <button type="button" class="<?php echo $buttonClass; ?>" data-jc-id="<?php echo $row['id']; ?>" title="Assign">Assign</button>
                                            
                                        </td> -->

                                        <!-- test -->
                                        <!-- Sales -->
                                        
                                        <td>
                                                                                
                                            <?php if ($userType === 'sales' && $role === 'Project'): ?>
                                                <a style="display:none;" href="<?php echo $buttonEditHref; ?>" class="<?php echo $buttonEdit; ?>" title="Edit JC"><i class="bi bi-pencil-fill"></i></a>
                                                <?php else: ?>
                                                <a href="<?php echo $buttonEditHref; ?>" class="<?php echo $buttonEdit; ?>" title="Edit JC"><i class="bi bi-pencil-fill"></i></a>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($userType === 'sales' && $role === 'Project'): ?>
                                                <button style="display:none;" type="button" class="<?php echo $buttonClass; ?>" data-jc-id="<?php echo $row['id']; ?>" title="Assign">Assign</button>
                                                <?php else: ?>
                                                <button type="button" class="<?php echo $buttonClass; ?>" data-jc-id="<?php echo $row['id']; ?>" title="Assign JC">Assign</button>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Sales -->

                                        
                                        <!-- test -->
                                    </tr>

                                <?php

                                } //Test profile
                              
                                }
                            
                            
                            else {
                                echo "<h5>No Record Found</h5>";
                            }
                            
                                
                            ?>  
                                
                                
                            </tbody>
                        </table>
                    </form>
                </div><br>


                <!-- ... Your previous code ... -->
                    
                    <div class="table-responsive">
                        <!-- Job Card Assignment Form -->
                        <form id="assignTechnicianForm" method="POST">
                            <!-- ... Your form fields ... -->
                        </form>
                    </div>

                    <!-- Display Assigned Job Cards -->
                    <div class="table-responsive">
                        <h2>Assigned Job Cards</h2>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">JC</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">JC Type</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">JC Create Dt</th>
                                    <th scope="col">Planned Dt</th>
                                    <th scope="col">Technician</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">JC1</th>
                                    <th scope="col">JC2</th>
                                    <th scope="col">Merged PDF</th>             
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // session_start();
                                $red_column_count = 0;
                                // Fetch and display assigned job cards with technicians
                                // Modify your query to fetch data with assigned technicians
                                while ($rowAssigned = mysqli_fetch_array($query_run_assigned)) {
                                    // Display the row with assigned technician and an "Edit" button
                                    echo '<tr>';
                                    echo '<td>' . $rowAssigned["id"] . '</td>';
                                    echo '<td>' . $rowAssigned["role"] . '</td>';
                                    echo '<td>' . $rowAssigned["jc_type"] . '</td>';
                                    // echo '<td>' . $rowAssigned["customer_name"] . '</td>';
                                    
                                    $currentDate = date("Y-m-d"); // Get current date in Y-m-d format

                                    // Assuming $rowAssigned is your array containing database values
                                    $proposedWorkDate = date("Y-m-d", strtotime($rowAssigned["proposed_work_date"]));

                                    // Check if proposed work date is in the past
                                    if ($proposedWorkDate < $currentDate) {
                                        $red_column_count++;
                                        // If it's in the past, echo with bold and red styling
                                        echo '<td><b style="color:red;">' . $rowAssigned["customer_name"] . '</b></td>'; 
                                        echo '<td>' . date("d-m-Y", strtotime($rowAssigned["jc_create_date"])) . '</td>';
                                        echo '<td><b style="color:red;">' . date("d-m-Y", strtotime($rowAssigned["proposed_work_date"])) . '</b></td>';
                                    } else {   
                                        // If it's not in the past, echo normally
                                        echo '<td>' . $rowAssigned["customer_name"] . '</td>'; 
                                        echo '<td>' . date("d-m-Y", strtotime($rowAssigned["jc_create_date"])) . '</td>';
                                        echo '<td>' . date("d-m-Y", strtotime($rowAssigned["proposed_work_date"])) . '</td>';
                                    }
                                    
                                    // echo '<td>' . date("d-m-Y", strtotime($rowAssigned["proposed_work_date"])) . '</td>';
                                    echo '<td>' . $rowAssigned["jc_assigned_to"] . '</td>'; 
                                    
                                    // Check if the role is 'Trading'
                                    if ($rowAssigned["role"] === 'Trading') { 
                                        echo '<td><button class="btn btn-success edit-technician-btn" data-jc-id="' . $rowAssigned["id"] . '" title="Unassign Trading JC">Unassign</button></td>';
                                        echo '<td><a href="pdf_assign_trading_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Trading PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Product/Item PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_trading_jc_assign_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Merged Trading PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                    } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_type"] !== 'AMC Service') {
                                        // For roles other than 'Trading'
                                        echo '<td><button class="btn btn-primary edit-technician-btn" data-jc-id="' . $rowAssigned["id"] . '" title="Unassign Service JC">Unassign</button></td>';
                                        echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Service PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Product/Item PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_service_jc_assign_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Merged Service PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                    }else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_type"] === 'AMC Service') {
                                        // For roles other than 'Trading'
                                        echo '<td><button class="btn btn-danger edit-technician-btn" data-jc-id="' . $rowAssigned["id"] . '" title="Unassign AMC JC">Unassign</button></td>';
                                        echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="AMC PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="Product/Item PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_service_jc_assign_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="Merged AMC Service PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                    } else if($rowAssigned["role"] === 'Project') {
                                        // For roles other than 'Trading'
                                        echo '<td><button class="btn btn-warning edit-technician-btn" data-jc-id="' . $rowAssigned["id"] . '" title="Unassign Project JC">Unassign</button></td>';
                                        echo '<td><a href="pdf_assign_project_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Project PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_assign_project_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Product/Item PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                        echo '<td><a href="pdf_project_jc_assign_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Merged Project PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                    } else if($rowAssigned["role"] === 'Admin') {
                                        // For roles other than 'Trading'
                                        echo '<td><button class="btn btn-secondary edit-technician-btn" data-jc-id="' . $rowAssigned["id"] . '" title="Unassign Admin JC">Unassign</button></td>';
                                        echo '<td><a href="pdf_assign_admin_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank" title="Admin PDF JC"><i class="bi bi-file-pdf"></i></a></td>';
                                        // echo '<td><a href="pdf_assign_admin_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                    }
                                    
                                    // echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                    // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';

                                    echo '</tr>';
                                }

                                // Store the count in a session variable
                                $_SESSION['red_column_count'] = $red_column_count;
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ... Your remaining code ... -->


            
                </div>

                  
                  

                  
            </div>


        </div>
        
      </section>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                
                </div>
                <div class="modal-body">
                    <h5>Please create Pending AMC Jobcards, now!!</h5>
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal" onclick="window.location.href = 'amc-jobcard-page.php'">OK</button>                                              
                    </div>

                </div>
                </div>
            </div>
            </div>
            <!-- Modal -->     

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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="js/main.js"></script>
<script src="js/assign_jc.js"></script>
<script src="js/unassign_jc.js"></script>



</body>
</html>