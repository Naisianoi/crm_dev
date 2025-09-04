<?php include('partials/navbar.php'); 
    //   include('fetch_data_technician.php');
      //include('fetch_data_view_all_jc_perfomance.php');
      include('assign_jc_technician.php');
    
?>



<!-----------------------------------RIGHT TAB-------------------------------------------------------------->
<style>
    .red-text {
        color: red;
    }
</style>
<main id="main" class="main" style="margin-bottom: 0px;">
      <section>
        <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
              
              
            <div class="tab-content" id="customer_content">

                <div  class="tab-pane in active">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0" style="padding-top: 0px;">JC COSTING</h1>
                    <div>
                        <a href="jc-costing-page.php" class="btn btn-info">Back</a>
                    </div>
                  </div>
                    <!--<h1 style="padding-top: 0px;">JC COSTING</h1><br>-->

                    

                <!-- ... Your previous code ... -->

                    <div class="table-responsive">
                        <!-- Job Card Assignment Form -->
                        <form id="assignTechnicianForm" method="POST">
                            <!-- Your form fields -->
                        </form>
                    </div>

                    <!-- Display Assigned Job Cards -->
                    <div class="table-responsive">
                
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="text-align: center;">JC</th>
                                    <th scope="col" style="text-align: center;">Role</th>
                                    <!-- <th scope="col">JC Type</th> -->
                                    <th scope="col" style="text-align: center;">Customer Name</th>
                                    <!-- <th scope="col">Company Name</th> -->
                                    <!-- <th scope="col">Project Name</th> -->
                                    <!-- <th scope="col">Customer Type</th> -->
                                    <!-- <th scope="col">Create Date</th> -->
                                    <!-- <th scope="col">Technician</th> -->

                                    <!-- <th scope="col">Amount</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Fuel</th>-->
                                    <th scope="col" style="text-align: center;">Technician</th>

                                    <th scope="col" style="text-align: center;">Area</th>
                                    <th scope="col" style="text-align: center;">KM</th>
                                    <th scope="col" style="text-align: center;">Time</th>

                                    <!-- <th scope="col">Total</th>  -->

                                    <!--<th scope="col">JC1</th>-->
                                    <th scope="col" style="text-align: center;">JC2</th>
                                    <!--<th scope="col">JC3</th>-->
                                    <!--<th scope="col">P</th>-->
                                    
                                    
                                    <!--<th scope="col">Status</th>-->

                                    <th scope="col" style="text-align: center;">T.Paid</th>
                                    <th scope="col" style="text-align: center;">Material</th>
                                    <th scope="col" style="text-align: center;">Fuel</th>
                                    <th scope="col" style="text-align: center;">Technician</th>
                                    <th scope="col" style="text-align: center;">T.Cost</th>
                                    <th scope="col" style="text-align: center;">% Cost</th>
                                    <!--<th scope="col" style="text-align: right;">Payment Date</th>-->
                                    
                                </tr>
                            </thead>
                            
                            <tbody> 
                            <?php

                            // Check if start_date and end_date are set
                            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                            $start_date = $_POST['start_date'];
                            $end_date = $_POST['end_date'];

                            // Run the query only after we get the dates
                            $query = "SELECT 
                                          s.*,           -- All columns from tbl_service_jc (aliased as s)
                                          a.distance_KM  -- distance_KM from tbl_area (aliased as a)
                                      FROM 
                                          tbl_service_jc s
                                      INNER JOIN 
                                          tbl_area a ON s.area = a.area
                                      WHERE payment_date >= '$start_date' AND payment_date <= '$end_date'";
                            
                            $query_run = mysqli_query($conn, $query);

                            if ($query_run && mysqli_num_rows($query_run) > 0) {

                              $formatted_start_date = date("d-m-Y", strtotime($start_date));
                              $formatted_end_date = date("d-m-Y", strtotime($end_date));

                            echo '<p style="font-size: 15px; text-align: center;">Payment Date From: <strong>' . $formatted_start_date . '</strong>&nbsp;&nbsp;&nbsp;To: <strong>' . $formatted_end_date . '</strong></p>';
                                $sn = 1; // serial number for display

                                $total_jc = 0;
                                $total_km = 0;
                                $total_time = 0;
                                $total_paid_amount = 0;
                                $total_material_cost = 0;
                                $total_fuel_cost = 0;
                                $total_technician_cost = 0;
                                $total_cost = 0;
                                $total_percentage_profit = 0;

                                while ($rowAssigned = mysqli_fetch_array($query_run)) {

                                  $total_jc += $sn;
                                  $total_km += $rowAssigned['distance_KM'];
                                  $total_time += $rowAssigned['hours'];
                                  $total_paid_amount += $rowAssigned['total_paid_amount'];
                                  $total_material_cost += $rowAssigned['material_cost'];
                                  $total_fuel_cost += $rowAssigned['fuel_cost'];
                                  $total_technician_cost += $rowAssigned['technician_cost'];
                                  $total_cost += $rowAssigned['total_cost'];
                                  // Calculate total percentage profit safely
                                  $total_percentage_profit = round((($total_paid_amount / $total_cost) - 1) * 100, 1);

                                  /*$denominator = $total_material_cost + $total_fuel_cost + $total_technician_cost;
                                  if ($denominator != 0) {
                                      $total_percentage_profit = round((($total_paid_amount - $total_cost) / $denominator) * 100, 1);
                                  } else {
                                      $total_percentage_profit = 0; // or null if you want to indicate undefined
                                  }*/

                             // Display the row with assigned technician and an "Edit" button
                             echo '<tr>';
                             echo '<td style="text-align: center;">' . $rowAssigned["id"] . '</td>';
                             echo '<td>' . $rowAssigned["role"] . '</td>';
                            //  echo '<td>' . $rowAssigned["jc_type"] . '</td>';
                             echo '<td>' . $rowAssigned["customer_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["company_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["project_name"] . '</td>';
                            //  echo '<td>' . $rowAssigned["customer_type"] . '</td>';
                            //  echo '<td>' . $rowAssigned["jc_create_date"] . '</td>';
                             echo '<td>' . $rowAssigned["jc_assigned_to"] . '</td>';
                             
                             echo '<td>' . $rowAssigned["area"] . '</td>';
                             echo '<td style="text-align: center;">' . $rowAssigned["distance_KM"] . '</td>';
                             echo '<td style="text-align: center;">' . $rowAssigned["hours"] . '</td>';

                            //  echo '<td>' . $rowAssigned["total_paid_amount"] . '</td>';
                            //  echo '<td>' . $rowAssigned["material_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["fuel_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["technician_cost"] . '</td>';
                            //  echo '<td>' . $rowAssigned["total_cost"] . '</td>';
                          
                             echo '<td style="display: none;">' . $rowAssigned["paid"] . '</td>';
                             echo '<td style="display: none;">' . $rowAssigned["jc_closed"] . '</td>';
                             
                             // Check if the role is 'Trading'
                             if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Service' && $rowAssigned["jc_type"] !== 'AMC Service') {
                                 
                                //echo '<td><a href="pdf_service_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Service PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Product/Item"><i class="bi bi-file-pdf"></i></a></td>';
                                //echo '<td><a href="pdf_service_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Merged Service PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                //echo '<td><a href="pdf_jc_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Payment"><i class="bi bi-currency-dollar"></i></a></td>';
                                // echo '<td><a href="pdf_jobcard_costing.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank">COST</a></td>';
                                //echo '<td><b>PAID</b></td>';
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Service' && $rowAssigned["jc_type"] === 'AMC Service') {
                                 
                              //echo '<td><a href="pdf_service_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="AMC PDF"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="Product/Item"><i class="bi bi-file-pdf"></i></a></td>';
                              //echo '<td><a href="pdf_service_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="Merged AMC Service PDF"><i class="bi bi-file-pdf"></i></a></td>';
                              //echo '<td><a href="pdf_jc_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank" title="Payment"><i class="bi bi-currency-dollar"></i></a></td>';
                              // echo '<td><a href="pdf_jobcard_costing.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank">COST</a></td>';
                              //echo '<td><b>PAID</b></td>';
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Trading') {
                                 
                                //echo '<td><a href="pdf_trading_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Trading PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Product/Item"><i class="bi bi-file-pdf"></i></a></td>';
                                //echo '<td><a href="pdf_trading_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Merged Trading PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                //echo '<td><a href="pdf_jc_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank" title="Payment"><i class="bi bi-currency-dollar"></i></a></td>';
                                // echo '<td><a href="pdf_jobcard_costing.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank">COST</a></td>';
                                //echo '<td><b>PAID</b></td>';
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Project') {
                                 
                              //echo '<td><a href="pdf_project_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Project PDF"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td><a href="pdf_assign_project_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Product/Item"><i class="bi bi-file-pdf"></i></a></td>';
                              // '<td><a href="pdf_project_jc_paid_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Merged Project PDF"><i class="bi bi-file-pdf"></i></a></td>';
                              //echo '<td><a href="pdf_jc_project_admin_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank" title="Payment"><i class="bi bi-currency-dollar"></i></a></td>';
                              //echo '<td><b>PAID</b></td>';
                           
                             } else if ($rowAssigned["paid"] === 'Paid' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["role"] === 'Admin') {
                                 
                              //echo '<td><a href="pdf_admin_jc_paid.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank" title="Admin PDF"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td></td>';
                              //echo '<td><a href="pdf_jc_project_admin_p.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank" title="Payment"><i class="bi bi-currency-dollar"></i></a></td>';
                              //echo '<td><b>PAID</b></td>';
                           
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Cancelled' && $rowAssigned["jc_type"] !== 'AMC Service') {
                                // For roles other than 'Trading'
                                
                                echo '<td><a href="pdf_service_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="AMC PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Product/Item"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_service_jc_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank" title="Merged AMC PDF"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Cancelled' && $rowAssigned["jc_type"] === 'AMC Service') {
                              // For roles other than 'Trading'
                              
                              echo '<td><a href="pdf_service_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                              echo '<td></td>';
                              echo '<td><b style="color:grey;">Cancelled</b></td>';
                           } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_trading_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_service_jc_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_project_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_project_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_service_jc_merge.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             
                             } else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] === 'Cancelled') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_admin_jc_cancel.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-secondary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:grey;">Cancelled</b></td>';
                             
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["jc_type"] !== 'AMC Service') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:red;">Payment ?</b></td>';
                             } else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] === 'Closed' && $rowAssigned["jc_type"] === 'AMC Service') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-danger btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-primary btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:red;">Payment ?</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] === 'Closed') {
                              // For roles other than 'Trading'
                              
                                echo '<td><a href="pdf_assign_trading_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td><a href="pdf_assign_trading_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:red;">Payment ?</b></td>';
                             }  else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             
                             }else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] === '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b>Unassigned</b></td>';
                             
                             }  else if($rowAssigned["role"] === 'Service' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Trading' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Project' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             } else if($rowAssigned["role"] === 'Admin' && $rowAssigned["jc_closed"] !== 'Closed' && $rowAssigned["paid"] !== 'Paid' && $rowAssigned["jc_closed"] !== 'Cancelled' && $rowAssigned["jc_assigned_to"] !== '' ) {
                              // For roles other than 'Trading'
                              
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><b style="color:green;">Running</b></td>';
                             }
                             
                             
                             // echo '<td><a href="pdf_assign_jc.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-success btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                             // echo '<td><a href="pdf_assign_item_product.php?id=' . $rowAssigned["id"] . '&ACTION=VIEW" class="btn btn-warning btn-sm col-xs-2" target="_blank"><i class="bi bi-file-pdf"></i></a></td>';
                            //  echo '<td>' . $rowAssigned["percent_cost"] . '%</td>';
                            // Get the percent_cost value
                            
                             $percentCost = $rowAssigned["percent_cost"];

                             // Check if the value is less than 40
                             $colorClass = ($percentCost < 40) ? 'red-text' : '';

                             // Output the table cell with the appropriate style

                             echo '<td style="text-align: right;">' . number_format($rowAssigned["total_paid_amount"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["material_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["fuel_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["technician_cost"], 0) . '</td>';
                             echo '<td style="text-align: right;">' . number_format($rowAssigned["total_cost"], 0) . '</td>';

                             echo '<td class="' . $colorClass . '" style="text-align: right;">' . $percentCost . '</td>';
                             //echo '<td>' . $rowAssigned["payment_date"] . '</td>';
                             echo '</tr>';
                            
                           }

                           echo "
                            <tr>
                                <td colspan='14'><b>Total:</b></td>
                            </tr>";

                           echo '
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="text-align: center;">JC</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th scope="col" style="text-align: center;">KM</th>
                                    <th scope="col" style="text-align: center;">Time</th>
                                    <th></th>
                                    <th scope="col" style="text-align: center;">T.Paid</th>
                                    <th scope="col" style="text-align: center;">Material</th>
                                    <th scope="col" style="text-align: center;">Fuel</th>
                                    <th scope="col" style="text-align: center;">Technician</th>
                                    <th scope="col" style="text-align: center;">T.Cost</th>
                                    <th scope="col" style="text-align: center;">% Cost</th>
                                </tr>
                            </thead>
                            ';

                            echo "
                            <tr>
                                <td style='text-align: center;'>" . number_format($total_jc) . "</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style='text-align: center;'>" . number_format($total_km) . "</td>
                                <td style='text-align: center;'>" . number_format($total_time) . "</td>
                                <td></td>
                                <td style='text-align: right;'>" . number_format($total_paid_amount) . "</td>
                                <td style='text-align: right;'>" . number_format($total_material_cost) . "</td>
                                <td style='text-align: right;'>" . number_format($total_fuel_cost) . "</td>
                                <td style='text-align: right;'>" . number_format($total_technician_cost) . "</td>
                                <td style='text-align: right;'>" . number_format($total_cost) . "</td>
                                <td style='text-align: right;'>" . number_format($total_percentage_profit, 1) . "</td>
                                <td colspan='3'></td>
                            </tr>";

                      } else {
                          echo '<p>No records found for the selected date range.</p>';
                          // echo '<br>MySQLi Error: ' . mysqli_error($conn); // For debugging
                      }
                  } else {
                      echo '<p>Start date and end date are required.</p>';
                  }
                  ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ... Your remaining code ... -->


            
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


<script src="js/main.js"></script>
<script src="js/assign_jc.js"></script>
<script src="js/unassign_jc.js"></script>



</body>
</html>