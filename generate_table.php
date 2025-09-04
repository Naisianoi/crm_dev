daily_status_date
unassigned_jc -> <?php
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
running_jc -> <?php
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
pending_payment_jc -> <?php
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
              ?>
            <!-- FETCH PAYMENT TOTAL FOR AMOUNT -->

              <div class="card">
              <div class="card-body">
                  <h5 class="card-title"  style="font-size:12px;">Pending Payment </h5>
              
                  <?php
                      $total_payment_query = "SELECT *
                      FROM tbl_service_jc
                      WHERE jc_closed IS NOT NULL
                        AND jc_closed = 'Closed'
                        AND (paid IS NULL OR paid != 'Paid');
                      ";
                      $total_payment_query_run = mysqli_query($conn, $total_payment_query);

                      if($payment_total = mysqli_num_rows($total_payment_query_run))
                      {
                          echo '<h4>'.$payment_total.' (<span style="font-size: 14px;">'.$formattedTotalAmount.'</span>)</h4>';
                      }
                      else 
                      {
                          echo '<h4> 0</h4>';
                      }
                  ?>
pending_payment_amount -> <?php
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
              ?>
            <!-- FETCH PAYMENT TOTAL FOR AMOUNT -->

              <div class="card">
              <div class="card-body">
                  <h5 class="card-title"  style="font-size:12px;">Pending Payment </h5>
              
                  <?php
                      $total_payment_query = "SELECT *
                      FROM tbl_service_jc
                      WHERE jc_closed IS NOT NULL
                        AND jc_closed = 'Closed'
                        AND (paid IS NULL OR paid != 'Paid');
                      ";
                      $total_payment_query_run = mysqli_query($conn, $total_payment_query);

                      if($payment_total = mysqli_num_rows($total_payment_query_run))
                      {
                          echo '<h4>'.$payment_total.' (<span style="font-size: 14px;">'.$formattedTotalAmount.'</span>)</h4>';
                      }
                      else 
                      {
                          echo '<h4> 0</h4>';
                      }
                  ?>
past_planned_jc -> <?php
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
stock_qty_products -> <?php
                                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_product";
                                                    $result = mysqli_query($conn, $query);
                                                    $data = mysqli_fetch_assoc($result);

                                                    $total_qty = $data['total_qty'] ?? 0;
                                                    $total_value = $data['total_value'] ?? 0;

                                                    echo '<h4>'.number_format($total_qty).'</h4>';

                                                    echo "<p><strong>Stock Qty:</strong> " . number_format($total_qty) . "</p>";
                                                    //echo "<p><strong>Stock Value:</strong> KES " . number_format($total_value, 2) . "</p>";
                                                ?>
stock_value_products -> <?php
                                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_product";
                                                    $result = mysqli_query($conn, $query);
                                                    $data = mysqli_fetch_assoc($result);

                                                    $total_qty = $data['total_qty'] ?? 0;
                                                    $total_value = $data['total_value'] ?? 0;

                                                    echo '<h4>'.number_format($total_value).'</h4>';

                                                    //echo "<p><strong>Stock Qty:</strong> " . number_format($total_qty) . "</p>";
                                                    echo "<p><strong>Stock Value:</strong> KES " . number_format($total_value, 2) . "</p>";
                                                ?>
stock_qty_items -> <?php
                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_item";
                                    $result = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_assoc($result);

                                    $total_qty = $data['total_qty'] ?? 0;
                                    $total_value = $data['total_value'] ?? 0;

                                    echo '<h4>'.number_format($total_qty).'</h4>';

                                    echo "<p><strong>Stock Qty:</strong> " . number_format($total_qty) . "</p>";
                                    //echo "<p><strong>Stock Value:</strong> KES " . number_format($total_value, 2) . "</p>";
                                ?>
stock_value_items -> <?php
                                    $query = "SELECT SUM(stock_qty) AS total_qty, SUM(stock_qty * auto_purchase_price) AS total_value FROM tbl_item";
                                    $result = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_assoc($result);

                                    $total_qty = $data['total_qty'] ?? 0;
                                    $total_value = $data['total_value'] ?? 0;

                                    echo '<h4>'.number_format($total_value).'</h4>';

                                    //echo "<p><strong>Stock Qty:</strong> " . number_format($total_qty) . "</p>";
                                    echo "<p><strong>Stock Value:</strong> KES " . number_format($total_value, 2) . "</p>";
                                ?>
no_of_jc_created -> if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $date_columns = [
        'jc_create_date'     => 'Job Card Created',
        'proposed_work_date' => 'Proposed Work',
        'work_done_date'     => 'Work Done',
        'payment_date'       => 'Payment',
        'jc_conclude_date'   => 'Concluded',
        'payment_post_date'  => 'Payment Posted',
    ];

    $summary_counts = [];

    echo "<h2 class='text-center mt-4'>Summary from <strong>$start_date</strong> to <strong>$end_date</strong></h2>";

    foreach ($date_columns as $column => $label) {
      if ($column === 'jc_create_date') {
            $query = "
                SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date
                FROM tbl_service_jc s
                WHERE STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') BETWEEN '$start_date' AND '$end_date'
                ORDER BY STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') ASC";
      } elseif ($column === 'payment_post_date') {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    p.payment_post_date AS $column
                  FROM tbl_service_jc s
                  LEFT JOIN tbl_project_payment p ON s.project_id = p.project_id
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        } else {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    s.$column
                  FROM tbl_service_jc s
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        }

        $result = mysqli_query($conn, $query);

        echo "<h4 class='mt-4' style='color:#1997D4;'>$label</h4>";

        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            echo "<table class='table'>
                    <thead class='thead-dark'>
                        <tr>";
            if ($column !== 'jc_create_date') {
                echo "<th class='text-center'>$label Date</th>";
            }
            echo "      <th class='text-center'>Job Card Date</th>
                        <th class='text-center'>ID</th>
                        <th class='text-center'>Customer Name</th>
                        <th class='text-center'>Company</th>
                        <th class='text-center'>Paid</th>
                        <th class='text-center'>Closed</th>
                        <th class='text-center'>Lead By</th>
                      </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                $customer_name_short = explode(" ", $row['customer_name'])[0];
                $company_name_short = explode(" ", $row['company_name'])[0];

                echo "<tr>";
                if ($column !== 'jc_create_date') {
                    echo "<td class='text-center'>" . htmlspecialchars($row[$column]) . "</td>";
                }
                echo "  <td class='text-center'>" . htmlspecialchars($row['jc_create_date']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($customer_name_short) . "</td>
                        <td>" . htmlspecialchars($company_name_short) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['paid']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_closed']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_lead_by']) . "</td>
                    </tr>";
            }

            echo "</tbody></table>";
            echo "<p><strong>Total Job Cards for $label: $count</strong></p>";

            // Count summary
            $code = match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            };
            $summary_counts[$code] = $count;
        } else {
            echo "<p>No records found for <strong>$label</strong> between <strong>$start_date</strong> and <strong>$end_date</strong>.</p>";
            $summary_counts[match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            }] = 0;
        }
    }
no_of_work_done -> if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $date_columns = [
        'jc_create_date'     => 'Job Card Created',
        'proposed_work_date' => 'Proposed Work',
        'work_done_date'     => 'Work Done',
        'payment_date'       => 'Payment',
        'jc_conclude_date'   => 'Concluded',
        'payment_post_date'  => 'Payment Posted',
    ];

    $summary_counts = [];

    echo "<h2 class='text-center mt-4'>Summary from <strong>$start_date</strong> to <strong>$end_date</strong></h2>";

    foreach ($date_columns as $column => $label) {
      if ($column === 'jc_create_date') {
            $query = "
                SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date
                FROM tbl_service_jc s
                WHERE STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') BETWEEN '$start_date' AND '$end_date'
                ORDER BY STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') ASC";
      } elseif ($column === 'payment_post_date') {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    p.payment_post_date AS $column
                  FROM tbl_service_jc s
                  LEFT JOIN tbl_project_payment p ON s.project_id = p.project_id
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        } else {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    s.$column
                  FROM tbl_service_jc s
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        }

        $result = mysqli_query($conn, $query);

        echo "<h4 class='mt-4' style='color:#1997D4;'>$label</h4>";

        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            echo "<table class='table'>
                    <thead class='thead-dark'>
                        <tr>";
            if ($column !== 'jc_create_date') {
                echo "<th class='text-center'>$label Date</th>";
            }
            echo "      <th class='text-center'>Job Card Date</th>
                        <th class='text-center'>ID</th>
                        <th class='text-center'>Customer Name</th>
                        <th class='text-center'>Company</th>
                        <th class='text-center'>Paid</th>
                        <th class='text-center'>Closed</th>
                        <th class='text-center'>Lead By</th>
                      </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                $customer_name_short = explode(" ", $row['customer_name'])[0];
                $company_name_short = explode(" ", $row['company_name'])[0];

                echo "<tr>";
                if ($column !== 'jc_create_date') {
                    echo "<td class='text-center'>" . htmlspecialchars($row[$column]) . "</td>";
                }
                echo "  <td class='text-center'>" . htmlspecialchars($row['jc_create_date']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($customer_name_short) . "</td>
                        <td>" . htmlspecialchars($company_name_short) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['paid']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_closed']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_lead_by']) . "</td>
                    </tr>";
            }

            echo "</tbody></table>";
            echo "<p><strong>Total Job Cards for $label: $count</strong></p>";

            // Count summary
            $code = match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            };
            $summary_counts[$code] = $count;
        } else {
            echo "<p>No records found for <strong>$label</strong> between <strong>$start_date</strong> and <strong>$end_date</strong>.</p>";
            $summary_counts[match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            }] = 0;
        }
    }
concluded_jc -> if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $date_columns = [
        'jc_create_date'     => 'Job Card Created',
        'proposed_work_date' => 'Proposed Work',
        'work_done_date'     => 'Work Done',
        'payment_date'       => 'Payment',
        'jc_conclude_date'   => 'Concluded',
        'payment_post_date'  => 'Payment Posted',
    ];

    $summary_counts = [];

    echo "<h2 class='text-center mt-4'>Summary from <strong>$start_date</strong> to <strong>$end_date</strong></h2>";

    foreach ($date_columns as $column => $label) {
      if ($column === 'jc_create_date') {
            $query = "
                SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date
                FROM tbl_service_jc s
                WHERE STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') BETWEEN '$start_date' AND '$end_date'
                ORDER BY STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') ASC";
      } elseif ($column === 'payment_post_date') {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    p.payment_post_date AS $column
                  FROM tbl_service_jc s
                  LEFT JOIN tbl_project_payment p ON s.project_id = p.project_id
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        } else {
            $query = "
                  SELECT 
                    s.id,
                    s.customer_name,
                    s.company_name,
                    s.paid,
                    s.jc_closed,
                    s.jc_lead_by,
                    DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date,
                    s.$column
                  FROM tbl_service_jc s
                  WHERE $column BETWEEN '$start_date' AND '$end_date'
                  ORDER BY $column ASC";
        }

        $result = mysqli_query($conn, $query);

        echo "<h4 class='mt-4' style='color:#1997D4;'>$label</h4>";

        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            echo "<table class='table'>
                    <thead class='thead-dark'>
                        <tr>";
            if ($column !== 'jc_create_date') {
                echo "<th class='text-center'>$label Date</th>";
            }
            echo "      <th class='text-center'>Job Card Date</th>
                        <th class='text-center'>ID</th>
                        <th class='text-center'>Customer Name</th>
                        <th class='text-center'>Company</th>
                        <th class='text-center'>Paid</th>
                        <th class='text-center'>Closed</th>
                        <th class='text-center'>Lead By</th>
                      </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                $customer_name_short = explode(" ", $row['customer_name'])[0];
                $company_name_short = explode(" ", $row['company_name'])[0];

                echo "<tr>";
                if ($column !== 'jc_create_date') {
                    echo "<td class='text-center'>" . htmlspecialchars($row[$column]) . "</td>";
                }
                echo "  <td class='text-center'>" . htmlspecialchars($row['jc_create_date']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($customer_name_short) . "</td>
                        <td>" . htmlspecialchars($company_name_short) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['paid']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_closed']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($row['jc_lead_by']) . "</td>
                    </tr>";
            }

            echo "</tbody></table>";
            echo "<p><strong>Total Job Cards for $label: $count</strong></p>";

            // Count summary
            $code = match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            };
            $summary_counts[$code] = $count;
        } else {
            echo "<p>No records found for <strong>$label</strong> between <strong>$start_date</strong> and <strong>$end_date</strong>.</p>";
            $summary_counts[match($column) {
                'jc_create_date'     => 'A',
                'proposed_work_date' => 'B',
                'work_done_date'     => 'C',
                'payment_date'       => 'D',
                'jc_conclude_date'   => 'E',
                'payment_post_date'  => 'F',
            }] = 0;
        }
    }
payment -> 
        $summary_total_paid_amount = 0;
        $summary_material_cost = 0;
        $summary_fuel_cost = 0;
        $summary_technician_cost = 0;

        $grouped_data = [];
        $invoice_total = 0;
        $cheque_total = 0;
        $cash_total = 0; // Initialize cash total

        while ($row = mysqli_fetch_array($pdf_results, MYSQLI_ASSOC)) {
            $payment_type = $row['payment_type'];

            if (!isset($grouped_data[$payment_type])) {
                $grouped_data[$payment_type] = [];
            }
            $grouped_data[$payment_type][] = $row;

            // Calculate separate totals
            if ($payment_type === 'Invoice') {
                $invoice_total += $row['total_paid_amount'];
            } elseif ($payment_type === 'Cheque') {
                $cheque_total += $row['total_paid_amount'];
            } else {
                $cash_total += $row['total_paid_amount']; // Summing up other payment types as 'Cash' group
            }
        }

        // Define a function to truncate a string if it doesn't exist
        if (!function_exists('truncateString')) {
            function truncateString($string, $maxLength) {
                if (strlen($string) > $maxLength) {
                    $string = substr($string, 0, $maxLength) . '...'; // Added ellipsis
                }
                return $string;
            }
        }

        // Create the content for the PDF with adjusted font size
        $content .= '<table style="width: 100%; font-size: 9px;" border="0.5" cellpadding="2">';

        foreach ($grouped_data as $payment_type => $group) {
            $content .= '<tr>';
            // Increased colspan for the payment type header
            $content .= '<td colspan="10" style="background-color: #f2f2f2;"><strong>' . $payment_type;

            // Append phone numbers based on payment_type
            switch ($payment_type) {
                case 'M1':
                    $content .= ' - 0714 776 325';
                    break;
                case 'M2':
                    $content .= ' - 0705 776 325';
                    break;
                // Add more cases for other payment_type values if needed
            }
            $content .= ':</strong></td>';
            $content .= '</tr>'; // Removed <br/> here as it's not valid inside <tr>

            $content .= '<tr>';
            $content .= '<th style="width: 7%;"><strong>JC#</strong></th>'; // Adjusted width
            $content .= '<th style="width: 8%;"><strong>JC Dt</strong></th>'; // Adjusted width
            $content .= '<th style="width: 20%;"><strong>Customer Name</strong></th>';
            $content .= '<th style="width: 8%;"><strong>Paid Dt</strong></th>'; // Adjusted width
            $content .= '<th style="width: 10%;"><strong>Payment Code</strong></th>';
            $content .= '<th style="width: 10%;" align="right"><strong>Amount Agreed</strong></th>';
            $content .= '<th style="width: 10%;" align="right"><strong>Amount Paid</strong></th>';
            $content .= '<th style="width: 9%;" align="right"><strong>Material Cost</strong></th>'; // Adjusted width
            $content .= '<th style="width: 9%;" align="right"><strong>Fuel Cost</strong></th>'; // Adjusted width
            $content .= '<th style="width: 9%;" align="right"><strong>Technician Cost</strong></th>'; // Adjusted width
            $content .= '</tr>';

            $group_total_paid_amount = 0;
            $group_material_cost = 0;
            $group_fuel_cost = 0;
            $group_technician_cost = 0;

            foreach ($group as $row) {
                $content .= '<tr>';
                $content .= '<td>' . $row['id'] . '</td>';
                $content .= '<td>' . date('d-m', strtotime($row['jc_create_date'])) . '</td>';
                $content .= '<td style="width: 20%;">' . htmlspecialchars(truncateString($row['customer_name'], 18)) . '</td>';
                $content .= '<td>' . date('d-m', strtotime($row['payment_date'])) . '</td>';
                $content .= '<td>' . $row['payment_code'] . '</td>';
                $content .= '<td align="right">' . number_format((float)$row['amount'], 0) . '</td>'; // Formatted here
                $content .= '<td align="right">' . number_format($row['total_paid_amount'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['material_cost'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['fuel_cost'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['technician_cost'], 0) . '</td>';
                $content .= '</tr>';

                // Update the group totals
                $group_total_paid_amount += $row['total_paid_amount'];
                $group_material_cost += $row['material_cost'];
                $group_fuel_cost += $row['fuel_cost'];
                $group_technician_cost += $row['technician_cost'];
            }

            // Display the subtotal for the current group
            $content .= '<tr>';
            $content .= '<td colspan="6" align="right"><strong>Sub-total: ' . $payment_type . '</strong></td>'; // Added payment type to subtotal
            $content .= '<td align="right"><strong>' . number_format($group_total_paid_amount, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_material_cost, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_fuel_cost, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_technician_cost, 0) . '</strong></td>';
            $content .= '</tr>';

            // Add a new row with a line break to create spacing between groups
            $content .= '<tr><td colspan="10" style="height: 5px;"></td></tr>'; // Using height for spacing

            // Update the overall summary total
            $summary_total_paid_amount += $group_total_paid_amount;
            $summary_material_cost += $group_material_cost;
            $summary_fuel_cost += $group_fuel_cost;
            $summary_technician_cost += $group_technician_cost;
        }  

// Grand totals for all categories
        $content .= '<tr>';
        $content .= '<td><strong>Grand Total:</strong></td>';
        $content .= '<td align="right"><strong>' . number_format($summary_total_paid_amount, 0) . '</strong></td>';
