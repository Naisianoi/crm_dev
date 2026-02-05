<?php
/*include('config/constants.php'); // DB connection
session_start();

// Check if user is admin
if (isset($_SESSION['user_type'] === 'admin') {
    date_default_timezone_set('Africa/Nairobi');
    $currentTime = date("H:i");
    $today = date("Y-m-d");

    // Only trigger after 11:30 PM
    if ($currentTime >= "09:00") {
        // Check if today's report already exists
        $check = mysqli_query($conn, "SELECT 1 FROM daily_status_report_test WHERE daily_status_date = '$today'");

        if (mysqli_num_rows($check) == 0) {
            // Trigger report silently
            include('generate_daily_report.php');
        }
    }
}*/
?>


<div id="dashboard" class="tab-pane in active">
    <h5>Dashboard</h5>


    <div class="row">
        <div class="col-sm-8">

            <div class="row">
            <div class="col-sm-3">
              <div class="card">
              <div class="card-body">
                  <h5 class="card-title"  style="font-size:12px;">Unassigned JC</h5>
              
                  <?php
                      // $total_assigned_jc_query = "SELECT * FROM tbl_service_jc";
                      $total_unassigned_jc_query = "SELECT * FROM tbl_service_jc WHERE jc_assigned_to IS NULL OR jc_assigned_to = ''";

                      $total_unassigned_jc_query_run = mysqli_query($conn, $total_unassigned_jc_query);

                      if($unassigned_jc_total = mysqli_num_rows($total_unassigned_jc_query_run))
                      {
                          echo '<h4>'.$unassigned_jc_total.'</h4>';
                      }
                      else 
                      {
                          echo '<h4> 0 </h4>';
                      }
                  ?>
              
              </div>
              </div>
          </div><!---------Unassigned JC Total----------------->

          <div class="col-sm-3">
              <div class="card">
              <div class="card-body">
                  <h5 class="card-title" style="font-size:12px;">Running JC</h5>
              
                  <?php
                      // $total_assigned_jc_query = "SELECT * FROM tbl_service_jc";
                    //   $total_assigned_jc_query = "SELECT * FROM tbl_service_jc WHERE jc_assigned_to IS NOT NULL AND jc_closed != 'Closed' AND jc_closed != 'Cancelled' AND jc_closed IS NOT NULL AND role != 'Project' ";
                      $total_assigned_jc_query = "SELECT * FROM tbl_service_jc WHERE jc_assigned_to IS NOT NULL AND jc_assigned_to <> '' 
                      AND jc_closed IS NULL AND paid IS NULL";

                      $total_assigned_jc_query_run = mysqli_query($conn, $total_assigned_jc_query);

                      if($assigned_jc_total = mysqli_num_rows($total_assigned_jc_query_run))
                      {
                          echo '<h4>'.$assigned_jc_total.'</h4>';
                      }
                      else 
                      {
                          echo '<h4> 0</h4>';
                      }
                  ?>
              </div>
              </div>
          </div><!---------Running JC Total----------------->

           <div class="col-sm-3"> 
            
            <!-- FETCH PAYMENT TOTAL FOR AMOUNT -->
              <?php
                $sql = "SELECT SUM(amount) AS total_amount FROM tbl_service_jc WHERE 
                jc_closed IS NOT NULL
                AND jc_closed = 'Closed'
                AND (paid IS NULL OR paid != 'Paid');";

                $result = mysqli_query($conn, $sql);
                
                // Check if the query was successful
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalAmount = $row['total_amount'];
                
                    // Format the total amount with commas
                    $formattedTotalAmount = number_format($totalAmount); // Use 2 for two decimal places
                } else {
                    // Handle the error, e.g., display an error message
                    $formattedTotalAmount = "Error fetching total amount";
                }

                $age_sql = "SELECT
                                CASE
                                    WHEN DATEDIFF(CURDATE(), STR_TO_DATE(jc_create_date, '%d-%m-%Y')) BETWEEN 0 AND 10 THEN 'black'
                                    WHEN DATEDIFF(CURDATE(), STR_TO_DATE(jc_create_date, '%d-%m-%Y')) BETWEEN 11 AND 20 THEN 'orange'
                                    ELSE 'red'
                                END AS age_group,
                                COUNT(*) AS total_count,
                                SUM(amount) AS total_amount
                            FROM tbl_service_jc
                            WHERE jc_closed = 'Closed'
                            AND (paid IS NULL OR paid != 'Paid')
                            GROUP BY age_group
                            ";

                            $age_result = mysqli_query($conn, $age_sql);

                            // Initialize defaults
                            $ageData = [
                                'black'  => ['count' => 0, 'amount' => 0],
                                'orange' => ['count' => 0, 'amount' => 0],
                                'red'    => ['count' => 0, 'amount' => 0],
                            ];

                            while ($row = mysqli_fetch_assoc($age_result)) {
                                $ageData[$row['age_group']]['count']  = $row['total_count'];
                                $ageData[$row['age_group']]['amount'] = $row['total_amount'];
                            }

              ?>
            <!-- FETCH PAYMENT TOTAL FOR AMOUNT -->

              <div class="card">
                <div class="card-body" style="padding-bottom: 10px;">
                    <h5 class="card-title" style="padding-bottom: 1px; font-size:12px;">Pending Payment</h5>

                    <?php
                    $total_payment_query = "SELECT *
                        FROM tbl_service_jc
                        WHERE jc_closed = 'Closed'
                        AND (paid IS NULL OR paid != 'Paid')";
                        
                    $total_payment_query_run = mysqli_query($conn, $total_payment_query);
                    $payment_total = mysqli_num_rows($total_payment_query_run);
                    ?>

                    <?php if ($payment_total > 0) { ?>

                        <!-- <h4>
                            <?php echo $payment_total; ?>
                            (<span style="font-size:14px;">
                                <?php echo $formattedTotalAmount; ?>
                            </span>)
                        </h4> -->

                        <div style="padding-bottom: 1px; font-size:13px;">

                            <div style="color:black;">
                                <!-- ● 0–10 days : -->
                                <?php echo $ageData['black']['count']; ?>
                                (<?php echo number_format($ageData['black']['amount']); ?>)
                            </div>

                            <div style="color:orange;">
                                <!-- ● 11–20 days : -->
                                <?php echo $ageData['orange']['count']; ?>
                                (<?php echo number_format($ageData['orange']['amount']); ?>)
                            </div>

                            <div style="color:red;">
                                <!-- ● 21+ days : -->
                                <?php echo $ageData['red']['count']; ?>
                                (<?php echo number_format($ageData['red']['amount']); ?>)
                            </div>

                        </div>


                    <?php } else { ?>

                        <h4>0</h4>

                    <?php } ?>

                </div>
                </div>

          </div><!---------Payment Total----------------->
          

        
          <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size:12px;">Past Planned JC</h5>
                                <?php
                                            // Query to fetch assigned job cards with technicians
                                            $query_assigned = "SELECT * FROM tbl_service_jc WHERE jc_assigned_to IS NOT NULL AND jc_assigned_to <> '' 
                                            AND jc_closed IS NULL AND paid IS NULL ORDER BY id DESC";
                                            $query_run_assigned = mysqli_query($conn, $query_assigned);
                        
                                                $red_column_count = 0;
                                                // Fetch and display assigned job cards with technicians
                                                // Modify your query to fetch data with assigned technicians
                                                while ($rowAssigned = mysqli_fetch_array($query_run_assigned)) {
                                                    // Display the row with assigned technician and an "Edit" button
                                                    
                                                    $currentDate = date("Y-m-d"); // Get current date in Y-m-d format

                                                    // Assuming $rowAssigned is your array containing database values
                                                    $proposedWorkDate = date("Y-m-d", strtotime($rowAssigned["proposed_work_date"]));

                                                    // Check if proposed work date is in the past
                                                    if ($proposedWorkDate < $currentDate) {
                                                
                                                        $red_column_count++;
                                                    
                                                    }
                                                }
                                                echo '<h4 style="color: red;"><b>' . $red_column_count . '</b></h4>';
                                        ?>

                                
                            </div>
                        </div>
                    </div><!--- JC Passed Condition --->
            </div>
            

            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"  style="font-size:12px;">Individual Customer</h5>
                    
                        <?php
                            $total_individual_query = "SELECT * FROM tbl_customer WHERE customer_type = 'Individual'";
                            $total_individual_query_run = mysqli_query($conn, $total_individual_query);

                            if($individual_total = mysqli_num_rows($total_individual_query_run))
                            {
                                echo '<h4>'.$individual_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4> 0</h4>';
                            }
                        ?>
                    </div>
                    </div>
                </div><!---------Individual Customer Total----------------->

                <div class="col-sm-3">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:12px;">Company Customer</h5>
                    
                        <?php
                            $total_individual_query = "SELECT * FROM tbl_customer WHERE customer_type = 'Company'";
                            $total_individual_query_run = mysqli_query($conn, $total_individual_query);

                            if($individual_total = mysqli_num_rows($total_individual_query_run))
                            {
                                echo '<h4>'.$individual_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4> 0</h4>';
                            }
                        ?>
                    </div>
                    </div>
                </div><!---------Company Customer Total----------------->
                

            
                <div class="col-sm-3">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"  style="font-size:12px;">Resellers</h5>
                    
                        <?php
                            $total_reseller_query = "SELECT * FROM tbl_customer WHERE customer_type = 'Reseller'";
                            $total_reseller_query_run = mysqli_query($conn, $total_reseller_query);

                            if($reseller_total = mysqli_num_rows($total_reseller_query_run))
                            {
                                echo '<h4>'.$reseller_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4> 0</h4>';
                            }
                        ?>
                    </div>
                    </div>
                </div><!---------Resellers Total----------------->

                <div class="col-sm-3">
              <div class="card">
              <div class="card-body">
                  <h5 class="card-title"  style="font-size:12px;">Running Project</h5>
                  <h4>
                  <?php
                      // $total_assigned_jc_query = "SELECT * FROM tbl_service_jc";
                      $total_project_jc_query = "SELECT * FROM tbl_project WHERE close_project != 'Closed' OR close_project IS NULL";

                      $total_project_jc_query_run = mysqli_query($conn, $total_project_jc_query);

                      if($project_jc_total = mysqli_num_rows($total_project_jc_query_run))
                      {
                          echo '<h4>'.$project_jc_total.'</h4>';
                      }
                      else 
                      {
                          echo '<h4> 0</h4>';
                      }
                  ?>
                  </h4>
                  
              </div>
              </div>
              </div>
          <!---------Running Project Total----------------->

            </div>


        <div class="row">
            <div class="col-sm-3">
                    <!---------<div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:12px;">Commerce</h5>
                        
                            <?php
                                /*$total_commerce_query = "SELECT * FROM tbl_commerce";
                                $total_commerce_query_run = mysqli_query($conn, $total_commerce_query);

                                if($commerce_total = mysqli_num_rows($total_commerce_query_run))
                                {
                                    echo '<h4>'.$commerce_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }*/
                            ?>
                        </div>
                        </div>
                    </div>Commerce Total----------------->

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:12px;">Business</h5>
                        
                            <?php
                                $total_business_query = "SELECT * FROM tbl_business";
                                $total_business_query_run = mysqli_query($conn, $total_business_query);

                                if($business_total = mysqli_num_rows($total_business_query_run))
                                {
                                    echo '<h4>'.$business_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                        </div>
                        </div>
                    </div><!---------Business Total----------------->
                

                
                           
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"  style="font-size:12px;">Brand</h5>
                        
                            <?php
                                $total_brand_query = "SELECT * FROM tbl_brand";
                                $total_brand_query_run = mysqli_query($conn, $total_brand_query);

                                if($brand_total = mysqli_num_rows($total_brand_query_run))
                                {
                                    echo '<h4>'.$brand_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                        </div>
                        </div>
                    </div><!---------Brands Total----------------->

                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"  style="font-size:12px;">Category</h5>
                        
                            <?php
                                $total_category_query = "SELECT * FROM tbl_category";
                                $total_category_query_run = mysqli_query($conn, $total_category_query);

                                if($category_total = mysqli_num_rows($total_category_query_run))
                                {
                                    echo '<h4>'.$category_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                        </div>
                        </div>
                    </div><!---------Category Total----------------->

                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"  style="font-size:12px;">Sub-Category</h5>
                            <?php
                                $total_subcategory_query = "SELECT * FROM tbl_subcategory";
                                $total_subcategory_query_run = mysqli_query($conn, $total_subcategory_query);

                                if($subcategory_total = mysqli_num_rows($total_subcategory_query_run))
                                {
                                    echo '<h4>'.$subcategory_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                            
                        </div>
                        </div>
                    </div><!---------Sub-Category Total----------------->

                    

            </div>

            <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"  style="font-size:12px;">Items</h5>
                        
                            <?php
                                $total_item_query = "SELECT * FROM tbl_item";
                                $total_item_query_run = mysqli_query($conn, $total_item_query);

                                if($item_total = mysqli_num_rows($total_item_query_run))
                                {
                                    echo '<h4>'.$item_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                        </div>
                        </div>
                    </div><!---------Items Total----------------->

                    <div style="display: none;">
                            <table class="table">
                            <thead class="thead-dark">
                               
                            </thead>
                            <tbody>


                            <?php
                        
                                include('add_item.php');
                                include('fetch_data_item.php');
                        
                            $totalCost = 0;
                            
                            if(mysqli_num_rows( $query_run) > 0)
                            {  

                                while($row = mysqli_fetch_array($query_run)){
                                    $totalCostForRow = $row["stock_qty"] * $row["auto_purchase_price"]; // Calculate total cost for the row
                                    $totalCost += $totalCostForRow; // Add to the total cost
                                ?>  
                                <tr> 
                                    
                                    
                                    <td class="item_id" style="display:none;"><?php echo $row["id"]; ?></td>
                                    <td><?php echo $sn++; ?>.</td>
                                    
                                    <td class="business"><?php echo $row["business"]; ?></td>
                                    <td class="category"><?php echo $row["category"]; ?></td>
                                    <td class="subcategory"><?php echo $row["subcategory"]; ?></td>
                                    <td class="brand"><?php echo $row["brand"]; ?></td>
                                    <td class="item_name"><?php echo $row["item_name"]; ?></td>
                                    <td class="price" style="text-align: right;"><?php echo number_format($row["price"]); ?></td> 
                                    <td class="price" style="text-align: right;"><?php echo number_format($row["auto_purchase_price"]); ?></td> 
                                    <td class="price" style="text-align: right;"><?php echo $row["selling_price"]; ?></td> 
                                    <td class="price" style="text-align: right;"><?php echo number_format($row["auto_selling_price"]); ?></td> 
                                    <td class="price"><?php echo $row["min_stock"]; ?></td> 
                                    <td class="price"><?php echo $row["stock_qty"]; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($totalCostForRow); ?></td> 
                                    <td class="price"><?php echo $row["purchase_mode"]; ?></td> 
                                    <td class="price"><?php echo $row["company_name"]; ?></td> 
                                    
                                    <td id="table-data">
                                        
                                    <a href="#" class="btn btn-info edit_item_btn btn-sm col-xs-2" title="Edit"><i class="bi bi-pen"></i></a> 
                                        
                                    
                                    </td>
                                                                                        
                                </tr> 
                                <?php
                                }
                            }
                            
                            else {
                                echo "<h5>No Record Found</h5>";
                            }
                            

                                
                            ?> 
                            
                            <tr>
                    
                                <td colspan="11"><b>Total:</b></td>
                                <td style="color: red;"><?php echo number_format($totalStock); ?></td>
                                <td style="color: red; text-align: right;"><?php echo number_format($totalCost); ?></td> <!-- Display total cost for all rows -->
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                                
                                
                            </tbody>
                        </table>
                    </div><!----------------item table-------------------------------->

                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size:12px;">Stock Value: Items</h5>
                                <?php
                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_item";
                                    $result = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_assoc($result);

                                    $total_qty = $data['total_qty'] ?? 0;
                                    $total_value = $data['total_value'] ?? 0;

                                    //echo '<h4>'.number_format($total_value).'</h4>';

                                    echo "<p>" . number_format($total_qty) . " (" . number_format($total_value) . ")</p>";

                                ?>
                            </div>
                        </div>
                    </div>


                    
                            <!--<div class="col-sm-3">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"  style="font-size:12px;">Stock Value: Items</h5>
                                
                                    <?php
                                        
                                        if(mysqli_num_rows( $query_run) > 0)
                                        {
                                            echo '<h4>'.number_format($totalCost).'</h4>';
                                        }
                                        else 
                                        {
                                            echo '<h4> 0</h4>';
                                        }
                                    ?>
                                </div>
                                </div>
                            </div>Item stock value----------------->

                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:12px;">Products</h5>
                        
                            <?php
                                $total_product_query = "SELECT * FROM tbl_product";
                                $total_product_query_run = mysqli_query($conn, $total_product_query);

                                if($product_total = mysqli_num_rows($total_product_query_run))
                                {
                                    echo '<h4>'.$product_total.'</h4>';
                                }
                                else 
                                {
                                    echo '<h4> 0</h4>';
                                }
                            ?>
                        </div>
                        </div>
                    </div><!---------Product Total----------------->

                    <div style="display: none;">
                                            
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    
                                                </thead>
                                                <tbody>


                                                <?php
                                                include('add_product.php');
                                                include('edit_product.php');
                                                include('delete_product.php');
                                                include('fetch_data_product.php');

                                                $totalProductCost = 0; // Initialize total cost variable 
                                
                                                if(mysqli_num_rows( $query_run) > 0)
                                                {  

                                                    while($row = mysqli_fetch_array($query_run)){
                                                        $totalCostForRow = $row["stock_qty"] * $row["auto_purchase_price"]; // Calculate total cost for the row
                                                        $totalProductCost += $totalCostForRow; // Add to the total cost

                                                        
                                                    ?>  
                                                    <tr> 
                                                        
                                                        
                                                        <td class="product_id" style="display:none;"><?php echo $row["id"]; ?></td>
                                                    
                                                        <td><?php echo $row["min_stock"]; ?></td>  
                                                        <td><?php echo $row["stock_qty"]; ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($totalCostForRow); ?></td> <!-- Display total cost for the row -->  
                                                        <td><?php echo $row["purchase_mode"]; ?></td>  
                                                        <td><?php echo $row["company_name"]; ?></td>  
                                                        
                                                        <td id="table-data"><a href="#" class="btn btn-info edit_product_btn btn-sm col-xs-2" title="Edit"><i class="bi bi-pen"></i></a></td>
                                                        
                                                        <!-- <a href="pdf_product.php?id=<?php echo $row["id"]; ?>&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td> -->
                                                                                                            
                                                    </tr> 
                                                    <?php
                                                    }
                                                }
                                                
                                                else {
                                                    echo "<h5>No Record Found</h5>";
                                                }
                                                    
                                                ?> 

                                                <tr>
                                        
                                                    <td colspan="9"><b>Total:</b></td>
                                                    <td style="color: red;"><?php echo number_format($totalStock); ?></td>
                                                    <td style="color: red; text-align: right;"><?php echo number_format($totalProductCost); ?></td> <!-- Display total cost for all rows -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                            
                                                    
                                                </tbody>
                                            </table>
                                            
                                                            
                                    </div><!------------------product table----------------------------->

                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size:12px;">Stock Value: Products</h5>
                                                <?php
                                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_product";
                                                    $result = mysqli_query($conn, $query);
                                                    $data = mysqli_fetch_assoc($result);

                                                    $total_qty = $data['total_qty'] ?? 0;
                                                    $total_value = $data['total_value'] ?? 0;

                                                    //echo '<h4>'.number_format($total_value).'</h4>';

                                                    echo "<p>" . number_format($total_qty) . " (" . number_format($total_value) . ")</p>";


                                                    //echo "<p><strong>Stock Qty:</strong> " . number_format($total_qty) . "</p>";
                                                    //echo "<p><strong>Stock Value:</strong> KES " . number_format($total_value, 2) . "</p>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                            <!-- <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"  style="font-size:12px;">Stock Value: Products</h5>
                                    
                                        <?php
                                            
                                            if(mysqli_num_rows( $query_run) > 0)
                                            {
                                                echo '<h4>'.number_format($totalProductCost).'</h4>';
                                            }
                                            else 
                                            {
                                                echo '<h4> 0</h4>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div><!--------Product stock value----------------->

                    

                </div>


                    

                    



  </div>

        

        <!-- Column for the "Service Calls" card on the right -->
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body" style="height: 34rem;">
                    <h5 class="card-title" style="font-size:12px;">Service Calls</h5>
                    <h4>...</h4>
                </div>
            </div>
        </div>

        <!-- Column for the "Memo" card -->
                            <div style="display: none;">
                            <?php
                            // Assuming you've already established a database connection using $conn
                            include('config/constants.php');
                            // Query to fetch data from tbl_memo
                            $query = "SELECT id, memo_content, jc_id, memo_by, before_dt, closed, role FROM tbl_memo";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                echo '<div class="col-lg-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body" style="height: 34rem;">
                                                <h5 class="card-title" style="font-size: 12px;">Memo</h5>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $memoContent = $row['memo_content'];
                                    $jcId = $row['jc_id'];
                                    $memoBy = $row['memo_by'];
                                    $beforeDt = $row['before_dt'];
                                    $closed = $row['closed'];
                                    $role = $row['role'];

                                    // Exclude rows with a "closed" value in the `closed` column
                                    if ($closed != 'closed') {
                                        // Display the data in a small, readable font
                                        echo '<div class="memo-record" data-memo-id="' . $id . '">
                                                <p style="font-size: 10px;">
                                                
                                                    jc_id: ' . $jcId . '<br>
                                                    Role: ' . $role . '<br>
                                                    Memo Content: ' . $memoContent . '<br>
                                                    Memo By: ' . $memoBy . '<br>
                                                    Before Date: ' . $beforeDt . '<br>
                                                 <button class="btn btn-sm btn-danger close-btn">Close</button>
                                                </p>
                                            </div>';
                                    }
                                }

                                echo '</div>
                                    </div>
                                </div>';
                            } else {
                                echo '<div class="col-lg-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body" style="height: 34rem;">
                                                <h5 class="card-title" style="font-size: 12px;">Memo</h5>

                                
                                        </div>
                                    </div>
                                </div>';
                                
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>

                            </div>
                                            
                            <!-- Close Modal -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Are you sure you want to close this memo?</p>
                                        </div>
                                        <div class="modal-footer">
                                        
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                                            <button type="button" id="confirmCloseBtn" class="btn btn-danger">Close Memo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         <!-- Close Modal -->


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        // Attach a click event to the "Close" buttons in your cards
                        $('.close-btn').click(function () {
                            var memoRecord = $(this).closest('.memo-record'); // Get the memo record container

                            // Show the confirmation modal
                            $('#confirmationModal').modal('show');

                            // Store the memo ID for removal upon confirmation
                            var memoId = memoRecord.data('memo-id');

                            // Attach a click event to the "Close Memo" button in the modal
                            $('#confirmCloseBtn').off('click').on('click', function () {
                                // Close the modal
                                $('#confirmationModal').modal('hide');

                                // Send a request to update the database with a "closed" status
                                $.post('close_memo.php', { id: memoId, status: 'closed' }, function (data) {
                                    // Handle the response if needed
                                    // Remove the memo record from the DOM
                                    memoRecord.remove();
                                });
                            });
                        });
                    });

                </script>

                <script>
                    // Close Modal
                    document.getElementById('closeModal').addEventListener('click', function () {
                        // Trigger the modal close action
                        $('#confirmationModal').modal('hide');
                    });
                </script>





        <!-- Memo -->

    </div>
    
    
    
</div>
   


    

    
