<?php include('partials/navbar.php'); 
    //   include('add_brand.php');
    //   include('edit_ajax.php');
    //   include('delete_brand.php');
    //   include('fetch_data_brand.php');

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
              <h1 style="padding-top: 0px;">COLLECTION (P&A)</h1><br>
              
             
                <form action="pdf_collection_report_pa.php?ACTION=VIEW" method="post" target="_blank">
                    <div class="row">
                        <div class="col-3">
                            <label for="start_date">Start Date:</label>
                            <input class="form-control" type="date"  name="start_date" id="start_date" required>
                        </div>

                        <div class="col-3">
                            <label for="end_date">End Date:</label>
                            <input class="form-control" type="date" name="end_date" id="end_date" required>
                        </div>

                        <div class="col-2">
                            <label></label>
                            <!-- echo '<td><a href="pdf_assign_admin_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>'; -->
                            <!-- <a href="pdf_collection_report.php&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a> -->
                            
                            <input class="form-control btn btn-info" type="submit" name="submit" value="Generate PDF">
                        </div>

                    </div>
                    
                    
                    
                    
                    
                </form>

                

                  
                  

                  
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