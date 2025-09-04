<?php
    include('config/constants.php');
    $sn =1;
    
    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];


        // Build the SQL query to retrieve payment data for the specified project_id
        $fetchPaymentDataQuery = "SELECT amount, payment_code, payment_type, part_final, payment_date, payment_post_date FROM tbl_project_payment WHERE project_id = '$project_id'";

        // Execute the query
        $result = mysqli_query($conn, $fetchPaymentDataQuery);

        // Check if data is found
        if ($result) {
            $paymentData = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $paymentData[] = $row;
            }
        } else {
            // Handle the case where no payment data is found
            $paymentData = array();
        }
    } else {
        // Handle the case where the project_id is not provided in the URL
        $paymentData = array();
    }


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Fetch the job card details from the tbl_service_jc table based on $jcId
        $query = "SELECT * FROM tbl_project WHERE id = $id";
        $query_run = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
            
        // Get the customer name from the fetched data
        $id= $row['id'];
        $customer_id = $row['customer_id'];
        $company_name = $row['company_name'];
        
        $customer_name = $row['customer_name'];
        $address = $row['address'];

        $city = $row['city'];
        $county = $row['county'];
        $contact_name_one = $row['contact_name_one'];
        $contact_name_two = $row['contact_name_two'];
        $contact_phone_one = $row['contact_phone_one'];
        $contact_phone_two = $row['contact_phone_two'];
                 
        $google_location = $row['google_location']; 
        $project_name = $row['project_name'];
        $project_info_date = $row['project_info_date'];
        $project_created_by = $row['project_created_by'];
        $agent_name = $row['agent_name'];
        $agent_number = $row['agent_number'];
        $site_name = $row['site_name'];
        $site_address = $row['site_address'];
        $site_city = $row['site_city'];
        $site_county = $row['site_county'];
        $site_g_location = $row['site_g_location'];
        $site_contact_name_1 = $row['site_contact_name_1'];
        $site_contact_number_1 = $row['site_contact_number_1'];
        $site_contact_name_2 = $row['site_contact_name_2'];
        $site_contact_number_2 = $row['site_contact_number_2'];
        
    
          
        } else {
            echo "No job card found with the provided ID.";
        }
    } else {

        echo "Job card ID not provided.";
    }

    
    // UPDATE PROJECT
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo "ID from URL: $id";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-project-payment'])) {
        
        
        

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-project-payment'])) {
            // Get the payment_date from the form input
            //$payment_date = $_POST['payment_date'];
            $paymentDate = mysqli_real_escape_string($conn, $_POST['payment_date']);
            // Assign the payment_date value to payment_post_date
            $payment_post_date = $payment_date;
            // Get the payment values from the form
            $projectId = mysqli_real_escape_string($conn, $_POST['project_id']);
            $paymentAmount = mysqli_real_escape_string($conn, $_POST['amount']);
            //$paymentDate = mysqli_real_escape_string($conn, $_POST['payment_date']);
            $paymentPostDate = mysqli_real_escape_string($conn, $_POST['payment_post_date']);
            $paymentType = mysqli_real_escape_string($conn, $_POST['payment_type']);
            $paymentCode = mysqli_real_escape_string($conn, $_POST['payment_code']);
            $paymentStatus = mysqli_real_escape_string($conn, $_POST['payment_status']);
    
            // Insert the payment data into tbl_project_payment
            $insertPaymentQuery = "INSERT INTO tbl_project_payment (project_id, amount, payment_date, payment_post_date, payment_type, payment_code, part_final) 
                                    VALUES ('$projectId', '$paymentAmount', '$paymentDate', '$paymentPostDate', '$paymentType', '$paymentCode', '$paymentStatus')";
    
            if (mysqli_query($conn, $insertPaymentQuery)) {
                // Redirect or display a success message after inserting
                // header("Location: close-jc-page.php");
                // echo "Payment added successfully.";
                echo '<script>window.location.href = "project-page.php";</script>';
            } else {
                echo "Error inserting payment record: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Job card ID not provided.";
    }

}

    // UPDATE PROJECT

?>