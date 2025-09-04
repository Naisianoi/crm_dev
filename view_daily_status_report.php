<?php
include('config/constants.php');
include('partials/navbar.php');

// Fetch data
$result = mysqli_query($conn, "SELECT * FROM tbl_daily_status ORDER BY daily_status_date DESC");
?>

<!DOCTYPE html>
<html>
<!-- <head>
    <title>Daily Status Report</title>
    <style>
        th {
            background-color: #1997D4;
            color: white;
            text-align: center;
        }
        .table th, .table td {
            vertical-align: middle !important;
        }
    </style>
</head> -->
<body>

<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding: 0 20px; margin-left: 0px;">

      <div class="tab-content" id="search">
        <div class="tab-pane in active">
          <h1 class="m-0">DAILY STATUS</h1>

          <?php 
          if (!$result || mysqli_num_rows($result) === 0) {
              echo "<p class='text-center mt-4'>No daily status reports found.</p>";
          } else {
              echo '<div class="table-responsive">';
              echo '<table class="table">';

              function printTableHeader() {
                  echo '<thead class="thead-dark text-center">
                      <tr>
                          <th>Date</th>
                          <th>Unassigned JC</th>
                          <th>Running JC</th>
                          <th>Pending Payment JC</th>
                          <th>Pending Amount</th>
                          <th>Past Planned JC</th>
                          <th>JC Created</th>
                          <th>Work Done</th>
                          <th>Concluded JC</th>
                          <th>Payment Received</th>
                          <th>Stock Qty (Products)</th>
                          <th>Stock Value (Products)</th>
                          <th>Stock Qty (Items)</th>
                          <th>Stock Value (Items)</th>
                      </tr>
                  </thead>';
              }

              printTableHeader();
              echo '<tbody>';

              $rowCount = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                  if ($rowCount > 0 && $rowCount % 10 === 0) {
                      echo '</tbody>';
                      printTableHeader();
                      echo '<tbody>';
                  }

                  echo '<tr class="text-center">';
                  $date = DateTime::createFromFormat('Y-m-d', $row['daily_status_date']);
                  echo '<td>' . ($date ? $date->format('d-m-Y') : '') . '</td>';
                  echo '<td>' . $row['unassigned_jc'] . '</td>';
                  echo '<td>' . $row['running_jc'] . '</td>';
                  echo '<td>' . $row['pending_payment_jc'] . '</td>';
                  echo '<td>' . number_format($row['pending_payment_amount']) . '</td>';
                  echo '<td>' . $row['past_planned_jc'] . '</td>';
                  echo '<td>' . $row['no_of_jc_created'] . '</td>';
                  echo '<td>' . $row['no_of_work_done'] . '</td>';
                  echo '<td>' . $row['concluded_jc'] . '</td>';
                  echo '<td>' . number_format($row['payment']) . '</td>';
                  echo '<td>' . $row['stock_qty_products'] . '</td>';
                  echo '<td>' . number_format($row['stock_value_products']) . '</td>';
                  echo '<td>' . $row['stock_qty_items'] . '</td>';
                  echo '<td>' . number_format($row['stock_value_items']) . '</td>';
                  echo '</tr>';

                  $rowCount++;
              }

              echo '</tbody></table>';
              echo '</div>'; // close table-responsive
          }
          ?>
        </div><!-- End of tab-pane -->
      </div><!-- End of tab-content -->
    </div><!-- End of container -->
  </section>
</main><!-- End #main -->

</body>
</html>


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

<script src="js/price-list.js"></script>
<script src="js/purchase-price.js"></script>
<!-- <script src="js/item-edit.js"></script> -->
<script src="js/main.js"></script>

</body>
</html>
