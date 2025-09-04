<?php include('partials/navbar.php'); ?>

<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
      <div class="tab-content" id="customer_content">
        <div class="tab-pane in active">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="m-0" style="padding-top: 0px;">ACTIVITY</h1>
            <div>
              <a href="activity-performance-page.php" class="btn btn-info">Back</a>
            </div>
          </div>

<?php
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
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
            $query = "SELECT 
                        s.id,
                        s.customer_name,
                        s.company_name,
                        s.paid,
                        s.jc_closed,
                        s.jc_lead_by,
                      DATE_FORMAT(STR_TO_DATE(s.jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_create_date
                      FROM tbl_service_jc s
                      WHERE STR_TO_DATE(s.jc_create_date, '%d-%m-%Y') BETWEEN '$start_date' AND '$end_date'
                      ORDER BY id ASC";
      } elseif ($column === 'payment_post_date') {
            $query = "SELECT 
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
                      ORDER BY id ASC";
        } else {
            $query = "SELECT 
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
                      ORDER BY id ASC";
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
                            echo "<th class='text-center'>Job Card Date</th>
                                <th class='text-center'>ID</th>
                                <th class='text-center'>Customer Name</th>
                                <th class='text-center'>Company</th>
                                <th class='text-center'>Payment Status</th>
                                <th class='text-center'>Closure Status</th>
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
                        <td>" . htmlspecialchars($row['jc_lead_by']) . "</td>
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

    echo "
        <h3 class='text-center mt-10' style='color: #1997D4; padding-top: 20px;'>ACTIVITY TOTALS</h3>
        <p class='text-center'>Following are Totals of Activity done between dates from <strong>$start_date</strong> to <strong>$end_date</strong>.</p>
";

    echo "<table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th class='text-center'>Job Card Created (A)</th>
                    <th class='text-center'>Proposed Work (B)</th>
                    <th class='text-center'>Work Done (C)</th>
                    <th class='text-center'>Payment (D)</th>
                    <th class='text-center'>Concluded (E)</th>
                    <th class='text-center'>Payment Posted (F)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='text-center'>{$summary_counts['A']}</td>
                    <td class='text-center'>{$summary_counts['B']}</td>
                    <td class='text-center'>{$summary_counts['C']}</td>
                    <td class='text-center'>{$summary_counts['D']}</td>
                    <td class='text-center'>{$summary_counts['E']}</td>
                    <td class='text-center'>{$summary_counts['F']}</td>
                </tr>
            </tbody>
        </table>";
echo "</div>"; // Close performance-summary container

}
?>

<h1 style="padding-top: 20px;">PERFORMANCE</h1>

<?php
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    echo "<h2 class='text-center mt-4'>Summary from <strong>$start_date</strong> to <strong>$end_date</strong></h2>";

    $query = "SELECT 
                id,
                paid,
                jc_closed,
                DATE_FORMAT(STR_TO_DATE(jc_create_date, '%d-%m-%Y'), '%Y-%m-%d') AS jc_created,
                work_done_date,
                payment_date,
                jc_conclude_date
              FROM tbl_service_jc
              WHERE STR_TO_DATE(jc_create_date, '%d-%m-%Y') BETWEEN '$start_date' AND '$end_date'
              ORDER BY id ASC";

    $result = mysqli_query($conn, $query);

    echo '<table class="table">';
    echo '<thead class="thead-dark text-center">
        <tr>
            <th rowspan="2">ID</th>
            <th rowspan="2">JC Created (A)</th>
            <th rowspan="2">Work Done (B)</th>
            <th rowspan="2">Closure Status</th>
            <th rowspan="2">Payment (C)</th>
            <th rowspan="2">Payment Status</th>
            <th rowspan="2">Conclude Date (D)</th> 
            <th rowspan="2">Work Done In (B - A)</th>
            <th rowspan="2">Paid In (C - B)</th>  
            <th rowspan="2">Conclude In (D - C)</th>
            <th rowspan="2">Total Days(D - A)</th>
        </tr>
    </thead>
    <tbody>';

    // Initialize totals and counts
    $sum_work_days = $sum_payment_days = $sum_conclude_x = $sum_conclude_y = 0;
    $count_work_days = $count_payment_days = $count_conclude_x = $count_conclude_y = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $e = $row['id'];
        $f = $row['jc_closed'];
        $g = $row['paid'];
        $a = $row['jc_created'];
        $b = $row['work_done_date'];
        $c = $row['payment_date'];
        $d = $row['jc_conclude_date'];

        // Convert each date to DateTime
        $dateA = $a ? DateTime::createFromFormat('Y-m-d', $a) : null;
        $dateB = $b ? DateTime::createFromFormat('Y-m-d', $b) : null;
        $dateC = $c ? DateTime::createFromFormat('Y-m-d', $c) : null;
        $dateD = $d ? DateTime::createFromFormat('Y-m-d', $d) : null;

        // Calculate day differences
        $work_days    = ($dateA && $dateB) ? $dateA->diff($dateB)->days : '';
        $payment_days = ($dateB && $dateC) ? $dateB->diff($dateC)->days : '';        
        $conclude_y   = ($dateC && $dateD) ? $dateC->diff($dateD)->days : '';
        $conclude_x   = ($dateA && $dateD) ? $dateA->diff($dateD)->days : '';

        // Tally sums and counts
        if ($work_days !== '') { $sum_work_days += $work_days; $count_work_days++; }
        if ($payment_days !== '') { $sum_payment_days += $payment_days; $count_payment_days++; }
        if ($conclude_y !== '') { $sum_conclude_y += $conclude_y; $count_conclude_y++; }
        if ($conclude_x !== '') { $sum_conclude_x += $conclude_x; $count_conclude_x++; }        

        // Check performance conditions
        // Color each number individually if below threshold
        $workDaysCell = ($work_days !== '' && $work_days > 1)
            ? "<span style='color:red;'>$work_days</span>"
            : $work_days;

        $paymentDaysCell = ($payment_days !== '' && $payment_days > 3)
            ? "<span style='color:red;'>$payment_days</span>"
            : $payment_days;

        $concludeYCell = ($conclude_y !== '' && $conclude_y > 4)
            ? "<span style='color:red;'>$conclude_y</span>"
            : $conclude_y;

        $concludeXCell = ($conclude_x !== '' && $conclude_x > 5)
            ? "<span style='color:red;'>$conclude_x</span>"
            : $conclude_x;


        // Render row with conditional red background
        echo '<tr class="text-center">';
        echo '<td>' . htmlspecialchars($e) . '</td>';
        echo '<td>' . htmlspecialchars($a) . '</td>';
        echo '<td>' . htmlspecialchars($b) . '</td>';
        echo '<td>' . htmlspecialchars($f) . '</td>';
        echo '<td>' . htmlspecialchars($c) . '</td>';
        echo '<td>' . htmlspecialchars($g) . '</td>';
        echo '<td>' . htmlspecialchars($d) . '</td>';
        echo '<td>' . $workDaysCell . '</td>';
        echo '<td>' . $paymentDaysCell . '</td>';
        echo '<td>' . $concludeYCell . '</td>';
        echo '<td>' . $concludeXCell . '</td>';
        echo '</tr>';
    }

    // Calculate averages
    $avg_work_days    = $count_work_days ? round($sum_work_days / $count_work_days, 2) : 'N/A';
    $avg_payment_days = $count_payment_days ? round($sum_payment_days / $count_payment_days, 2) : 'N/A';
    $avg_conclude_y   = $count_conclude_y ? round($sum_conclude_y / $count_conclude_y, 2) : 'N/A';
    $avg_conclude_x   = $count_conclude_x ? round($sum_conclude_x / $count_conclude_x, 2) : 'N/A';

    // Print average row
    echo "<tr>
            <td colspan='3'><b>Averages:</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: center;'>$avg_work_days</td>
            <td style='text-align: center;'>$avg_payment_days</td>
            <td style='text-align: center;'>$avg_conclude_y</td>
            <td style='text-align: center;'>$avg_conclude_x</td>
        </tr>";

    echo '</tbody></table>';
}
?>

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
