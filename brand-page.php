<?php include('partials/navbar.php'); 
      include('add_brand.php');
      include('edit_ajax.php');
      include('delete_brand.php');
      include('fetch_data_brand.php');

?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content">

              <!-- DASHBOARD PHP -->
              
              <!--- END DASHBOARD PHP---- -->
              
              <!-- BRAND PHP -->

              <div id="brand" class="tab-pane in active">
              <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0" style="padding-top: 0px;">BRAND</h1>
                    <div>
                        <button class="btn btn-info" id="btn">Add New Brand</button>
                    </div>
                </div>

                <?php
          // Fetch distinct business abbreviations from products
          $business_query = "SELECT DISTINCT business FROM tbl_product";
          $business_results = mysqli_query($conn, $business_query);

          // Fetch full business names from tbl_business
          $full_names_query = "SELECT business, business_name FROM tbl_business";
          $full_names_results = mysqli_query($conn, $full_names_query);

          // Create map: business => full business name
          $businessNames = [];
          while ($row = mysqli_fetch_assoc($full_names_results)) {
              $short = $row['business'];       // e.g. IWT
              $full = $row['business_name'];     // e.g. Industrial Water Treatment
              $businessNames[$short] = "$full ($short)";
          }

          while ($business_row = mysqli_fetch_assoc($business_results)) {
              $currentBusiness = $business_row['business'];
              $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

              echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

              $brand_query = "SELECT * FROM tbl_brand WHERE business = '$currentBusiness' ORDER BY brand ASC";
              $brand_results = mysqli_query($conn, $brand_query);

              if (mysqli_num_rows($brand_results) > 0) {
                  echo '<table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col" width="5%" style="text-align: center;">ID</th>
                              <th scope="col" width="5%" style="text-align: center;">S.N</th>
                              <th scope="col" width="80%">Brand</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>';

                  $sn = 1;
                  while ($row = mysqli_fetch_array($brand_results)) {
                      echo "<tr>
                              <td class='brand_id' width='5%' style='text-align:center'>" . htmlspecialchars($row["id"]) . "</td>
                              <td width='5%' style='text-align:center'>" . $sn++ . ".</td>
                              <td class='brand' width='80%'>" . htmlspecialchars($row["brand"]) . "</td>
                              <td class='business' style='display:none;'>" . htmlspecialchars($row['business']) . "</td> <!-- ADDED THIS HIDDEN CELL -->
                              <td><a href='#' class='btn btn-info edit_btn btn-sm' title='Edit'><i class='bi bi-pen'></i></a></td>
                            </tr>";
                  }

                  echo '</tbody></table>';
              } else {
                  echo "<h5 class='text-center'>No Record Found</h5>";
              }
          }
          ?>
                
                                                                             
              </div><!------------------end view data---------------------------->

                <div id="brand-form">

                               
                    <!-- Add Brand Modal -->
                    <div class="modal fade" id="goalmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Brand</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="add_brand.php" id="reset_brand_form" onclick="this.form.reset();" onsubmit="return validateForm()">
                                    <div class="mb-3">
                                      <select class="form-select business" name="business" id="business_select" required>
                                        <option selected disabled>Choose Business</option>
                                        <?php
                                              
                                              // Fetch data from database
                                              $query1 = "SELECT * FROM tbl_business";
                                              $result1 = mysqli_query($conn, $query1);

                                              // Populate options
                                              while ($row1 = mysqli_fetch_assoc($result1)) {
                                                echo '<option value="' . $row1['business'] . '">' . $row1['business_name'] . '</option>';
                                              }

                                              // Close connection
                                              // mysqli_close($conn);
                                        ?>
                                      </select>
                                    </div><br>

                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input class="form-control brand" name="brand" required>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#goalmodal').modal('hide');">Close</button>
                                      
                                      <button type="submit" class="btn btn-primary add_ajax" id="brand-page" name="add">Add</button></a>
                                     
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div><!-- End Modal---->

                    <!-- Edit Brand Modal -->
                    <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editBrandModal">Edit Brand</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="#" onsubmit="return validateForm()">
                                    <div class="mb-3">
                                      <select class="form-select" name="business" id="edit_business" required>
                                        <option selected disabled>Choose Business</option>
                                        <?php
                                              
                                              // Fetch data from database
                                              $query1 = "SELECT * FROM tbl_business";
                                              $result1 = mysqli_query($conn, $query1);

                                              // Populate options
                                              while ($row1 = mysqli_fetch_assoc($result1)) {
                                                echo '<option value="' . $row1['business'] . '">' . $row1['business_name'] . '</option>';
                                              }

                                              // Close connection
                                              // mysqli_close($conn);
                                        ?>
                                      </select>
                                    </div><br>
                                    <input type="hidden" name="edit_brand_id" id="edit_brand_id">
                                    

                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input class="form-control" name="brand" id="edit_brand">
                                    </div>

                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editBrandModal').modal('hide');">Close</button>                             
                                      <button type="submit" class="btn btn-primary update_brand" name="update_brand">Update</button>
                            
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- End Modal--->

                    <!-----------------------Edit data Brand form to database------------------------------------->


                    <!-----------------------Delete data Brand form from database------------------------------------->

                    <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="deleteBrandModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteBrandModal">Delete Brand</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="delete_brand_id" id="delete_brand_id">
                                <h5>Are you sure you want to delete this data?</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deleteBrandModal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_brand">Yes, Delete</button>
                                
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-----------------------Delete data Brand form from database------------------------------------->
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


</body>
</html>