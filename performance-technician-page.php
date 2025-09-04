<?php
include('config/constants.php');
include('partials/navbar.php');
?>

<!--<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Technician Report</title>

   Bootstrap 5 CSS 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    Optional: your own custom styles 
  <style>
    body {
      padding: 20px;
    }
  </style>
</head>

<body>-->

<main id="main" class="main" style="margin-bottom: 0px;">
  <section>
    <div class="container" style="padding-top: 0px; margin-left: 0px; padding-bottom: 0px;">
      <div class="tab-content" id="customer_content">
        <div class="tab-pane in active">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="m-0" style="padding-top: 0px;">TECHNICIAN</h1>
            <div>
              <a href="technician-performance-page.php" class="btn btn-info">Back</a>
            </div>
          </div>

          <div class="table-responsive">
            <form id="assignTechnicianForm" method="POST">
              <!-- Your form fields here -->
            </form>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="text-center">JC#</th>
                  <th scope="col">Role</th>
                  <th scope="col">Conclude Date</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">JC Type</th>
                  <th scope="col" class="text-end">Total Paid</th>
                  <th></th>
                  <th scope="col" class="text-center">KM</th>
                  <th scope="col" class="text-center">Hours</th>
                  <th scope="col" class="text-end">Cost</th>
                </tr>
              </thead>
              <tbody>

<?php
if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['technician'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $technician = $_POST['technician'];

  $query = "SELECT s.*,           -- All columns from tbl_service_jc (aliased as s)
                   a.distance_KM  -- distance_KM from tbl_area (aliased as a)
            FROM 
                   tbl_service_jc s
            INNER JOIN 
                   tbl_area a ON s.area = a.area
            WHERE work_done_date BETWEEN '$start_date' AND '$end_date'
            AND jc_assigned_to = '$technician' AND jc_closed = 'Closed'
            ORDER BY jc_conclude_date";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $roleCounts = ['Service' => 0, 'Project' => 0, 'Trading' => 0, 'Admin' => 0];
    $roleSums = ['Service' => 0, 'Project' => 0, 'Trading' => 0, 'Admin' => 0];
    $roleTotalHours = ['Service' => 0, 'Project' => 0, 'Trading' => 0, 'Admin' => 0];

    //echo "<h2 class='text-center'>Technician Report</h2>";
    $formatted_start_date = date("d-m-Y", strtotime($start_date));
    $formatted_end_date = date("d-m-Y", strtotime($end_date));
    echo '<p style="font-size: 15px; text-align: center;">From: <strong>' . $formatted_start_date . '</strong>&nbsp;&nbsp;&nbsp;To: <strong>' . $formatted_end_date . '</strong></p>';
    echo '<p style="font-size: 15px; text-align: center;">TECHNICIAN:<strong>&nbsp;&nbsp;' . $technician . '</strong> </p>';

    while ($row = mysqli_fetch_assoc($result)) {
      $role = $row['role'];

      echo "<tr>
              <td class='text-center'>{$row['id']}</td>
              <td>{$row['role']}</td>
              <td>" . date("d-m-Y", strtotime($row['jc_conclude_date'])) . "</td>
              <td>{$row['customer_name']}</td>
              <td>{$row['jc_type']}</td>
              <td class='text-end'>" . number_format($row['total_paid_amount'], 0) . "</td>
              <td></td>
              <td class='text-center'>" . number_format($row['distance_KM'], 1) . "</td>
              <td class='text-center'>{$row['hours']}</td>
              <td class='text-end'>" . number_format($row['total_cost'], 0) . "</td>
            </tr>";

      $roleCounts[$role]++;
      $roleSums[$role] += $row['total_cost'];
      $roleTotalHours[$role] += $row['hours'];
      $roleTotalDistance[$role] += $row['distance_KM'];
    }

    echo "</tbody></table><br>";

    // Summary Table
    echo "<h3>Summary</h3>";
    echo "<table class='table'>";
    echo "<thead class='thead-dark'><tr>
            <th>Role</th>
            <th class='text-end'>Total Cost</th>
            <th></th>
            <th></th>
            <th class='text-center'>KM</th>
            <th class='text-center'>Jobcards</th>
            <th class='text-center'>Hours</th>
          </tr></thead>";

    foreach ($roleCounts as $role => $count) {
      echo "<tr>
              <td>$role</td>
              <td class='text-end'>" . number_format($roleSums[$role], 0) . "</td>
              <td></td>
              <td></td>
              <td class='text-center'>" . number_format($roleTotalDistance[$role], 1) . "</td>
              <td class='text-center'>$count</td>
              <td class='text-center'>{$roleTotalHours[$role]}</td>
            </tr>";
    }

    echo "<tr>
            <td><strong>Total</strong></td>
            <td class='text-end'><strong>" . number_format(array_sum($roleSums), 0) . "</strong></td>
            <td></td>
            <td></td>
            <td class='text-center'><strong>" . number_format(array_sum($roleTotalDistance), 1) . "</strong></td>
            <td class='text-center'><strong>" . array_sum($roleCounts) . "</strong></td>
            <td class='text-center'><strong>" . array_sum($roleTotalHours) . "</strong></td>
          </tr>";
    echo "</table>";
  } else {
    echo "<p>No records found for the selected date range and technician.</p>";
  }
} else {
  echo "<p>Start date, end date, and technician are required.</p>";
}
?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>
