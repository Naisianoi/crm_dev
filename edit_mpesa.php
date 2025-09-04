<?php
    include('config/constants.php');
    $success = "";

    if(isset($_POST['checking_edit_mpesa_btn']))
       {
            $mpesa_id = $_POST['mpesa_id'];
            // echo $return = $product_id;
            // Assuming you have a database connection established
            // Fetch the data from the database based on the product_id
            $query = "SELECT * FROM tbl_mpesa_number WHERE id = $mpesa_id";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);


            // Prepare the data to be returned as a JSON string
            $response = array(
              'mpesa_name' => $data['name'],
              'edit_mpesa_id' => $data['id'],
              'mpesa_number' => $data['number'],
              
            );




            // Return the data as a JSON string
            echo json_encode($response);
       }
    

/*--------------------------query for UPDATING data when edit clicked---------------------------------*/
            
        if(isset($_POST['update_mpesa']))
        {
            $id = $_POST['edit_mpesa_id'];
            $mpesa_name = $_POST['mpesa_name'];
            $mpesa_number = $_POST['mpesa_number'];
            

            $query = "UPDATE tbl_mpesa_number SET name='$mpesa_name', number='$mpesa_number'  WHERE id='$id' ";
            
            $query_run = mysqli_query($conn, $query);
                if ($query_run) {
                  echo '<script>window.location.href = "mpesa-page.php";</script>';
                    exit;
                } else {
                    echo "Error updating mpesa.";
                }

                
        }
/*--------------------------query for UPDATING data when edit clicked---------------------------------*/

  ?>