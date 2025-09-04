<?php 

include('partials/navbar.php'); 
include('fetch_data_business.php');
include('add_business.php');

?>


<!-----------------------------------RIGHT TAB-------------------------------------------------------------->

<main id="main" class="main" style=" margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content">

              <!-- DASHBOARD PHP -->
              
              <!--- END DASHBOARD PHP---- -->
              
              <!-- BRAND PHP -->

              <div id="business" class="tab-pane in active">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0" style="padding-top: 0px;">BUSINESS</h1>
                    <div>
                        <button class="btn btn-info" id="btn">Add New Business</button>
                    </div>
                </div>
              <!--<h1 style="padding-top: 0px;">BUSINESS</h1><br>
              
               Button trigger modal 
                <button class="btn btn-info" id="btn" style="float: right;">Add</button><br><br> -->

                <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="text-align: center;">ID</th>
                          <th scope="col" style="text-align: center;">S.N</th>
                          <th scope="col">Business Name</th>
                          <th scope="col">Business</th>
                          
                        </tr>
                      </thead>
                      <tbody>


                      <?php
                        
                      if(mysqli_num_rows( $query_run) > 0)
                      {  

                        while($row = mysqli_fetch_array($query_run)){
                          ?>  
                          <tr> 
                              
                              
                              <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                              <td style="text-align: center;"><?php echo $sn++; ?>.</td>
                              
                              <td><?php echo $row["business_name"]; ?></td>
                              <td><?php echo $row["business"]; ?></td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                               
                              
                                                                                
                          </tr> 
                          <?php
                        }
                      }
                      
                      else {
                        echo "<h5>No Record Found</h5>";
                      }
                    

                         
                      ?>  
                            
                        
                      </tbody>
                </table>

                
                                                                             
              </div><!------------------end view data---------------------------->

                <div id="brand-form">

                               
                    <!-- Add Business Modal -->
                    <div class="modal fade" id="businessmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Business</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="add_business.php" id="reset_business_form" onclick="this.form.reset();">
                                    <div class="mb-3">
                                      
                                      <div class="form-group">
                                        <label>Business Name</label>
                                        <input class="form-control brand" name="business-name" required>
                                    </div>
                                    </div><br>

                        
                                    <div class="form-group">
                                        <label>Business Code</label>
                                        <input class="form-control brand" name="business-code" maxlength="3" required>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#businessmodal').modal('hide');">Close</button>
                                      
                                      <button type="submit" class="btn btn-primary add_business" id="add-business" name="add-business">Add</button></a>
                                                                            
                                     
                                      
                                      
                            
                                    </div>
                                    
                                    
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div><!-- End Modal---->

                    
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

<script src="js/business.js"></script>
<script src="js/main.js"></script>


</body>
</html>