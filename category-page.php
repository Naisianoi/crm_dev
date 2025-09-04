<?php include('partials/navbar.php');
      include('add_category.php');
      include('edit_category.php');
      include('delete_category.php');
      include('fetch_data_category.php');

?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
    <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
            <div class="tab-content">
                <div id="category" class="tab-pane in active">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h1 class="m-0" style="padding-top: 0px;">CATEGORY</h1>
                      <div>
                          <button class="btn btn-info" id="btn">Add New Category</button>
                      </div>
                    </div>

                    <?php
                    // Fetch distinct business abbreviations from products
                    $business_query = "SELECT DISTINCT business FROM tbl_business";
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

                        $category_query = "SELECT * FROM tbl_category WHERE business = '$currentBusiness' ORDER BY category ASC";
                        $category_results = mysqli_query($conn, $category_query);

                        if (mysqli_num_rows($category_results) > 0) {
                            echo '
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" width="5%" style="text-align: center;">ID</th>
                                        <th scope="col" width="5%" style="text-align: center;">S.N</th>
                                        <th scope="col" width="80%">Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>';

                            $sn = 1;
                            while ($row = mysqli_fetch_assoc($category_results)) {
                                echo "<tr>
                                    <td class='category_id' width='5%' style='text-align:center'>{$row['id']}</td>
                                    <td width='5%' style='text-align:center'>{$sn}.</td>
                                    <td class='category' width='80%' >" . htmlspecialchars($row['category']) . "</td>
                                    <td class='business' style='display:none;'>" . htmlspecialchars($row['business']) . "</td> <!-- ADDED THIS HIDDEN CELL -->
                                    <td>
                                        <a href='#' class='btn btn-info btn-sm edit_category_btn' title='Edit'><i class='bi bi-pen'></i></a>
                                    </td>
                                </tr>";
                                $sn++;
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "<h5 class='text-muted'>No Category Found for $businessName</h5>";
                        }
                    }
                    ?>
                </div>



                                                                             
              </div><!------------------end view data---------------------------->

                <div id="category-form">

                               
                    <!-- Add Category Modal -->
                    <div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="add_category.php" id="reset_category_form" onclick="this.form.reset();">
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
                                               //mysqli_close($conn);
                                        ?>
                                      </select>
                                    </div><br>

                                    <!--<div class="form-group">
                                        <label>Business</label>
                                        <input class="form-control" name="business" required>
                                    </div>-->



                                    <div class="form-group">
                                        <label>Category</label>
                                        <input class="form-control category" name="category" required>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#categorymodal').modal('hide');">Close</button>
                                      
                                      <button type="submit" class="btn btn-primary add-category" id="category-page" name="add-category">Add</button></a>
                                      
                                      
                                      <!-- <li class="subcategory">
                                          <a class="nav-link px-0 subcategory" role="tab" data-toggle="tab" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#brand"> <span class="d-none d-sm-inline">Brand</span></a>
                                      </li> -->
                                      
                                      
                            
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div><!-- End Modal---->

                    
                    
                                      
                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editcategorymodal" tabindex="-1" role="dialog" aria-labelledby="editcategorymodal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editcategorymodal">Edit Category</h5>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="#">
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
                                                ?>
                                            </select>
                                        </div><br>
                                        <input type="hidden" name="edit_category_id" id="edit_category_id">

                                        <div class="form-group">
                                            <label>Category</label>
                                            <input class="form-control" name="category" id="edit_category">
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editcategorymodal').modal('hide');">Close</button>
                                            <button type="submit" class="btn btn-primary update_category" name="update_category">Update</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-----------------------Edit data Category form to database------------------------------------->


                    <!-----------------------Delete data Category form from database------------------------------------->

                    <div class="modal fade" id="deletecategorymodal" tabindex="-1" role="dialog" aria-labelledby="deletecategorymodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deletecategorymodal">Delete Category</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="delete_category_id" id="delete_category_id">
                                <h5>Are you sure you want to delete this data?</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deletecategorymodal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_category">Yes, Delete</button>
                                
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-----------------------Delete data Category form from database------------------------------------->
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

<script src="js/category.js"></script>
<script src="js/main.js"></script>



</body>
</html>