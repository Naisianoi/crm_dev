<?php include('partials/navbar.php');
      include('add_subcategory.php');
      include('edit_subcategory.php');
      include('delete_subcategory.php');
      include('fetch_data_subcategory.php');
      // include('fetch_data_subcategory_ajax.php');

?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" id="tab-content">
              
              
            <div class="tab-content">

              <!-- DASHBOARD PHP -->
              
              <!--- END DASHBOARD PHP---- -->
              
              <!-- BRAND PHP -->

              <div id="category" class="tab-pane in active">
              <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0" style="padding-top: 0px;">SUBCATEGORY</h1>
                    <div>
                        <button class="btn btn-info" id="btn">Add New SubCategory</button>
                    </div>
                </div>

                
                   <?php
$business_query = "SELECT DISTINCT business FROM tbl_subcategory";
$business_results = mysqli_query($conn, $business_query);

$businessNames = [
    "DWS" => "Drinking Water System (DWS)",
    "IEL" => "Industrial Electrical (IEL)",
    "IWT" => "Industrial Water Treatment (IWT)",
    "WTW" => "Water Treatment Wholesale (WTW)"
];

while ($business_row = mysqli_fetch_assoc($business_results)) {
    $currentBusiness = $business_row['business'];
    $businessName = $businessNames[$currentBusiness] ?? $currentBusiness;

    echo "<h2 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h2>";

    // Get distinct categories for this business
    $category_query = "SELECT DISTINCT category FROM tbl_subcategory WHERE business = '$currentBusiness' ORDER BY category ASC";
    $category_results = mysqli_query($conn, $category_query);

    while ($category_row = mysqli_fetch_assoc($category_results)) {
        $currentCategory = $category_row['category'];

        echo "<h4 style='margin-top:20px; color: green;'>$currentCategory</h4>";

        $sub_category_query = "SELECT * FROM tbl_subcategory WHERE category = '$currentCategory' AND business = '$currentBusiness' ORDER BY subcategory ASC";
        $sub_category_results = mysqli_query($conn, $sub_category_query);

        if (mysqli_num_rows($sub_category_results) > 0) {
            echo '<table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="5%" style="text-align: center;">ID</th>
                            <th scope="col" width="5%" style="text-align: center;">S.N</th>
                            <th scope="col" width="80%">Sub-Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';

            $sn = 1;
            while ($row = mysqli_fetch_assoc($sub_category_results)) {
                echo "<tr>
                          <td class='subcategory_id' width='5%' style='text-align:center'>{$row['id']}</td>
                          <td width='5%' style='text-align:center'>{$sn}.</td>
                          <td class='subcategory' width='80%'>" . htmlspecialchars($row['subcategory']) . "</td>
                          <td class='business' style='display:none;'>" . htmlspecialchars($row['business']) . "</td> <!-- ADDED THIS HIDDEN CELL -->
                          <td class='category' style='display:none;'>" . htmlspecialchars($row['category']) . "</td> <!-- ADDED THIS HIDDEN CELL -->
                          <td id='table-data'><a href='#' class='btn btn-info edit_subcategory_btn btn-sm col-xs-2' title='Edit'><i class='bi bi-pen'></i></a>
                       </tr>";
                $sn++;
            }

            echo '</tbody></table>';
        } else {
            echo '<p><em>No Record Found</em></p>';
        }
    }
}
?>



                
                                                                             
              </div><!------------------end view data---------------------------->

                <div id="subcategory-form">

                               
                    <!-- Add SubCategory Modal -->
                    <div class="modal fade" id="subcategorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sub-Category</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" id="subcategorymodal">
                              <form method="POST" action="add_subcategory.php" onsubmit="return validateForm1()" id="reset_subcategory_form" onclick="this.form.reset();" >
                                    <div class="mb-3">
                                      <select class="form-select business" name="business" id="business_select" required>
                                        <option selected="selected" disabled value="">Choose Business</option>
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
                                                                                                                  
                                    <div class="mb-3">
                                      <select class="form-select category" name="category" id="category_select" required>
                                        <option selected="selected" disabled >Choose Category</option>
                                        <script></script>
                                        
                                       
                                        </select> 
                                    </div><br>
                                
                                    <div class="form-group mb-3">
                                        <label>Sub-Category</label>
                                        <input class="form-control subcategory" name="subcategory" required>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#subcategorymodal').modal('hide');">Close</button>
                                      
                                      <button type="submit" class="btn btn-primary add-subcategory" id="subcategory-page" name="add-subcategory">Add</button></a>
                                                            
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div><!-- End Modal---->
                    

                    <!-- Edit SubCategory Modal -->
                    <div class="modal fade" id="editsubcategorymodal" tabindex="-1" role="dialog" aria-labelledby="editsubcategorymodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editsubcategorymodal">Edit Sub-Category</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="#" onsubmit="return validateForm3()">
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

                                    <div class="mb-3">
                                      <select class="form-select" name="category" id="edit_category" required >
                                        <option selected disabled>Choose Category</option>
                                        <?php
                                              
                                              // Fetch data from database
                                              $query1 = "SELECT * FROM tbl_category";
                                              $result1 = mysqli_query($conn, $query1);

                                              // Populate options
                                              while ($row1 = mysqli_fetch_assoc($result1)) {
                                                echo '<option value="' . $row1['category'] . '">' . $row1['category'] . '</option>';
                                              }

                                            

                                              // Close connection
                                              // mysqli_close($conn);
                                        ?>
                                        
                                        
                                      </select>
                                    </div><br>

                                    <input type="hidden" name="edit_subcategory_id" id="edit_subcategory_id">
                                    
                                    <div class="form-group">
                                        <label>Sub-Category</label>
                                        <input class="form-control" name="subcategory" id="edit_subcategory">
                                    </div>

                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editsubcategorymodal').modal('hide');">Close</button>                             
                                      <button type="submit" class="btn btn-primary update_subcategory" name="update_subcategory">Update</button>
                            
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- End Modal--->

                    <!-----------------------Edit data SubCategory form to database------------------------------------->


                    <!-----------------------Delete data SubCategory form from database------------------------------------->

                    <div class="modal fade" id="deletesubcategorymodal" tabindex="-1" role="dialog" aria-labelledby="deletesubcategorymodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deletesubcategorymodal">Delete Sub-Category</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="delete_subcategory_id" id="delete_subcategory_id">
                                <h5>Are you sure you want to delete this data?</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deletesubcategorymodal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_subcategory">Yes, Delete</button>
                                
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-----------------------Delete data SubCategory form from database------------------------------------->
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

<script src="js/subcategory.js"></script>
<!-- <script src="js/edit_subcategory.js"></script> -->
<script src="js/main.js"></script>



</body>
</html>