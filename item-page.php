<?php 
include('partials/navbar.php');
include('add_item.php');
include('edit_item.php');
include('delete_item.php');
include('fetch_data_item.php');
?>

<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;  padding-right:25px;">
        <div class="tab-content" id="search">
            <div id="product" class="tab-pane in active">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0" style="padding-top: 0px;">ITEM</h1>
                    <div>
                        <a href="add-item-page.php" class="btn btn-info">Add New Item</a>
                    </div>
                </div>

          <?php
          $business_query = "SELECT DISTINCT business FROM tbl_item";
          $business_results = mysqli_query($conn, $business_query);

          $businessNames = [
              "DWS" => "Drinking Water System (DWS)",
              "IEL" => "Industrial Electrical (IEL)",
              "IWT" => "Industrial Water Treatment (IWT)",
              "WTW" => "Water Treatment Wholesale (WTW)"
          ];

          while ($business_row = mysqli_fetch_assoc($business_results)) {
              $currentBusiness = $business_row['business'];
              $businessName = isset($businessNames[$currentBusiness]) ? $businessNames[$currentBusiness] : $currentBusiness;

              echo "<h1 class='text-center' style='color: #1997D4; font-size:30px; margin-top:30px;'>$businessName</h1>";

              echo '<table class="table">';
              echo '<thead class="thead-dark">
                      <tr>
                        <th scope="col" style="text-align: center;">ID</th>
                        <th scope="col" style="text-align: center;">S.N</th>
                        <th scope="col" style="text-align: center;">Item Name</th>
                        <th scope="col" style="text-align: center;">Brand</th>
                        <th scope="col" style="text-align: center;">Auto Purchase Price</th>
                        <th scope="col" style="text-align: center;">Auto Selling Price</th>
                        <th scope="col" style="text-align: center;">Min. Stock</th>
                        <th scope="col" style="text-align: center;">Stock Qty</th>
                        <th scope="col" style="text-align: center;">Total Cost</th>
                        <th scope="col" style="text-align: center;">Purchase Mode</th>
                        <th scope="col" style="text-align: center;">Supplier</th>
                      </tr>
                    </thead><tbody>';

              $sn = 1;
              $totalCost = 0;
              $totalStock = 0;

              $category_query = "SELECT DISTINCT category FROM tbl_item WHERE business = '$currentBusiness' ORDER BY category ASC";
              $category_results = mysqli_query($conn, $category_query);

              while ($category_row = mysqli_fetch_assoc($category_results)) {
                  $currentCategory = $category_row['category'];

                  $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE category = '$currentCategory' AND business = '$currentBusiness' ORDER BY sub_category ASC";
                  $sub_category_results = mysqli_query($conn, $sub_category_query);

                  while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
                      $currentSubCategory = $sub_category_row['sub_category'];
                      echo '<tr><td colspan="12" style="font-size:18px;"><strong style="color: #1997D4;">' . htmlspecialchars($currentCategory) . '</strong>: <span style="color: green;">' . htmlspecialchars($currentSubCategory) . '</span></td></tr>';

                      $item_query = "SELECT tbl_item.*, tbl_supplier.company_name FROM tbl_item INNER JOIN tbl_supplier ON tbl_supplier.id = tbl_item.supplier_id WHERE category = '$currentCategory' AND sub_category = '$currentSubCategory' AND business = '$currentBusiness' ORDER BY item_name ASC";
                      $item_results = mysqli_query($conn, $item_query);

                      if (mysqli_num_rows($item_results) > 0) {
                          while ($row = mysqli_fetch_assoc($item_results)) {
                              $rowTotal = $row['stock_qty'] * $row['auto_purchase_price'];
                              $totalCost += $rowTotal;
                              $totalStock += $row['stock_qty'];

                              $formatted_price = number_format($row['auto_purchase_price']);
                              $formatted_selling_price = number_format($row['auto_selling_price']);
                              $formatted_row_total = number_format($row['stock_qty'] * $row['auto_purchase_price']);

                              $name = explode(" ", $row['company_name']);
                              $company_name_short = $name[0];

                               echo <<<HTML_ITEM_ROW
                                        <tr>
                                            <td class="item_id">{$row["id"]}</td>
                                            <td class="text-center">{$sn}.</td>
                                            <td class="item_name" style="text-align: left;">{$row["item_name"]}</td>
                                            <td class="brand" style="text-align: left;">{$row["brand"]}</td>
                                            <td class="text-end text-success" style="text-align: right; color: green;">$formatted_price</td>
                                            <td class="text-end" style="color: #6C3BAA;">$formatted_selling_price</td>
                                            <td class="text-center text-danger" style="color: red;">{$row['min_stock']}</td>
                                            <td class="text-center text-primary" style="color: #0000FF;">{$row['stock_qty']}</td>
                                            <td class="text-end text-dark">{$formatted_row_total}</td>
                                            <td class="purchase_mode">{$row["purchase_mode"]}</td>
                                            <td class="company_name">{$company_name_short}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-info edit_item_btn btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#edititemmodal">
                                                    <i class="bi bi-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        HTML_ITEM_ROW;
                              $sn++;
                          }
                      } else {
                          echo "<tr><td colspan='12' class='text-center'>No items found</td></tr>";
                      }
                  }
              }

              echo "<tr>
                      <td colspan='7'><b>Total:</b></td>
                      <td style='text-align: center; color: #0000FF;'>{$totalStock}</td>
                      <td style='text-align: right; color: red;'>" . number_format($totalCost) . "</td>
                      <td colspan='4'></td>
                    </tr>";

              echo '</tbody></table>';
          }
          ?>
        </div>

        <div id="category-form">
            <div class="modal fade" aria-hidden="true">
                <select class="form-select" name="business" id="edit_business_select_item" required></select>
            </div>
                        
        <!-----------------------Delete data Item form from database------------------------------------->
        <div class="modal fade" id="deleteitemmodal" tabindex="-1" role="dialog" aria-labelledby="deleteproductmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletecategorymodal">Delete Item</h5>
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form action="#" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_item_id" id="delete_item_id">
                                <h5>Are you sure you want to delete this data?</h5>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deleteitemmodal').modal('hide');">Close</button>                                      
                                <button type="submit" class="btn btn-danger" name="delete_item">Yes, Delete</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!-----------------------Delete data Item form from database------------------------------------->
    </div>
  </section>
</main>

<!-- Image Upload Script -->
<?php
if (isset($_FILES["image"]["name"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>alert('Invalid Image Extension');</script>";
    } elseif ($imageSize > 1200000) {
        echo "<script>alert('Image Size Is Too Large');</script>";
    } else {
        $newImageName = $name . " - " . date("Y.m.d - h.i.sa") . '.' . $imageExtension;
        $query = "UPDATE tbl_admin SET image_name = '$newImageName' WHERE id = $id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'images/admin-images/' . $newImageName);
        echo "<script>document.location.href = '../aquashine/general-manager.php?id=$id';</script>";
    }
}
?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="js/item-add.js"></script>
<script src="js/item-edit.js"></script>
<script src="js/main.js"></script>