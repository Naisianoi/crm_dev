<?php include('partials/navbar.php');
      // include('add_product.php');
    //   include('edit-close-jc.php');
      //include('edit_receive_material.php');
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

              <div id="commerce" class="tab-pane in active col-6">
              <h1>Stock Correction</h1>
                    
                  <div class="mb-3">
                      <select class="form-select" name="id" class="edit_business" onchange="window.location.href = 'stock-correction-page.php?id=' + this.value;">
                          <option selected disabled>Choose Business</option>
                          <?php
                              // Fetch data from database
                              $query1 = "SELECT * FROM tbl_business";
                              $result1 = mysqli_query($conn, $query1);

                              // Populate options
                              while ($row1 = mysqli_fetch_assoc($result1)) {
                                  echo '<option value="' . $row1['id'] . '">' . $row1['business'] . '</option>';
                              }
                          ?>
                      </select>
                  </div>

                   
                                       <!-- <a href="closing-the-jc-product-item.php?jc_id=<?php echo isset($_GET['jc_id']) ? $_GET['jc_id'] : ''; ?>"> <button class="btn btn-primary">Add New Product/Item</button></a>                                       -->
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
</footer> End Footer -->

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